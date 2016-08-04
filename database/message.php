<?php

require_once 'connection.php';

function insertMessage($from, $to, $content, $dateSent, $isDeleted){
    $conn = connect();
    if ($stmt = $conn->prepare("INSERT INTO message (FromUserRoleId, ToUserRoleId, Content, DateSent, IsDeleted) VALUES (?, ?, ?, ?, ?)")) {
        $stmt->bind_param("iissi", $from, $to, $content, $dateSent, $isDeleted);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getMessages($userRoleId, $contactId){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("SELECT * FROM message m
    WHERE ((ToUserRoleId = ? AND FromUserRoleId = ?)
            OR (ToUserRoleId = ? AND FromUserRoleId = ?))
          AND m.IsDeleted = ?
          AND ((m.IsDeletedBySender = ? AND FromUserRoleId = ?) OR (m.IsDeletedByReceiver = ? AND ToUserRoleId = ?))")) {
        $stmt->bind_param("iiiiiiiii", $userRoleId, $contactId, $contactId, $userRoleId, $false, $false, $userRoleId, $false, $userRoleId);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        $result = array();
        while ($row = $res->fetch_assoc()) {
            array_push($result, $row);
        }
        setMessagesAsRead($userRoleId, $contactId);
        return encode(true, $result);
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function setMessagesAsRead($userRoleId, $fromUserRoleId){
    $conn = connect();
    if ($stmt = $conn->prepare("UPDATE message SET DateReceived = NOW() WHERE FromUserRoleId = ? and ToUserRoleId = ?")) {
        $stmt->bind_param("ii", $fromUserRoleId, $userRoleId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getLastMessagePerContact($userRoleId){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("SELECT DISTINCT
      m.*,
      If(? = m.FromUserRoleId, CONCAT(u2.FirstName, ' ', u2.LastName), CONCAT(u1.FirstName, ' ', u1.LastName)) as ContactName,
      If(? = m.FromUserRoleId, u2.Image, u1.Image) as Image,
      If(? = m.FromUserRoleId, m.ToUserRoleId, m.FromUserRoleId) as UserRoleId,
      If(? = m.FromUserRoleId, r2.Description, r1.Description) as Role,
      If(? = m.FromUserRoleId, 1, 0) as IsSender,
      If(m.DateReceived is null, 0, 1) as IsRead
    FROM message m
    LEFT JOIN userrole ur1 ON ur1.UserRoleId = m.FromUserRoleId
    LEFT JOIN user u1 ON u1.UserId = ur1.UserId
    LEFT JOIN role r1 ON r1.RoleId = ur1.RoleId
    LEFT JOIN userrole ur2 ON ur2.UserRoleId = m.ToUserRoleId
    LEFT JOIN user u2 ON u2.UserId = ur2.UserId
    LEFT JOIN role r2 ON r2.RoleId = ur2.RoleId

    WHERE
      (ToUserRoleId = ?
      OR FromUserRoleId = ?)
      AND m.IsDeleted = ?
      AND m.MessageId = (select m2.MessageId from message m2
                        where m2.DateSent =
                          (select max(m3.DateSent) from message m3
                            where (m3.ToUserRoleId = m.ToUserRoleId and m3.FromUserRoleId = m.FromUserRoleId)
                             or (m3.ToUserRoleId = m.FromUserRoleId and m3.FromUserRoleId = m.ToUserRoleId)))
      AND ((m.IsDeletedBySender = ? AND FromUserRoleId = ?) OR (m.IsDeletedByReceiver = ? AND ToUserRoleId = ?))
    ORDER BY m.DateSent DESC")) {
        $stmt->bind_param("iiiiiiiiiiii", $userRoleId, $userRoleId, $userRoleId, $userRoleId, $userRoleId, $userRoleId, $userRoleId, $false, $false, $userRoleId, $false, $userRoleId);
        $stmt->execute();
        $rows = $stmt->get_result();
        $res = array();
        while ($row = $rows->fetch_assoc()) {
            array_push($res, $row);
        }
        return encode(true, $res);
    } else {
        return encode(false, var_dump($conn->error));
    }
}


function deleteMessage($userRoleId, $messageId){
    $conn = connect();
    if ($stmt = $conn->prepare("UPDATE message
          SET IsDeletedBySender = CASE WHEN FromUserRoleId = ? THEN 1 ELSE IsDeletedBySender END,
              IsDeletedByReceiver = CASE WHEN ToUserRoleId = ? THEN 1 ELSE IsDeletedByReceiver END
          WHERE MessageId = ?")) {
        $stmt->bind_param("iii", $userRoleId, $userRoleId, $messageId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function deleteConversation($byUserRoleId, $withUserRoleId){
    $conn = connect();
    if ($stmt = $conn->prepare("UPDATE message
          SET IsDeletedBySender = CASE WHEN FromUserRoleId = ? THEN 1 ELSE IsDeletedBySender END,
              IsDeletedByReceiver = CASE WHEN ToUserRoleId = ? THEN 1 ELSE IsDeletedByReceiver END
          WHERE ((ToUserRoleId = ? AND FromUserRoleId = ?)
            OR (ToUserRoleId = ? AND FromUserRoleId = ?))")) {
        $stmt->bind_param("iiiiii", $byUserRoleId, $byUserRoleId, $byUserRoleId, $withUserRoleId, $withUserRoleId, $byUserRoleId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}
