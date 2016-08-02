<?php

require_once 'connection.php';

function insertMessage($from, $to, $content, $dateSent, $isDeleted){
    $q = "INSERT INTO message (FromUserRoleId, ToUserRoleId, Content, DateSent, IsDeleted) VALUES ($from, $to, '$content', '$dateSent', $isDeleted)";
    return encode(execute($q), '');
}

function getMessages($userRoleId, $contactId){
    $q = "
    SELECT * FROM message m
    WHERE ((ToUserRoleId = $userRoleId AND FromUserRoleId = $contactId)
            OR (ToUserRoleId = $contactId AND FromUserRoleId = $userRoleId))
          AND m.IsDeleted = 0
          AND ((m.IsDeletedBySender = 0 AND FromUserRoleId = $userRoleId) OR (m.IsDeletedByReceiver = 0 AND ToUserRoleId = $userRoleId))
    ";
    $res = array();
    $rows = execute($q);
    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }
    setMessagesAsRead($userRoleId, $contactId);
    return encode(true, $res);
}

function setMessagesAsRead($userRoleId, $fromUserRoleId){
    $q = "UPDATE message SET DateReceived = NOW() WHERE FromUserRoleId = $fromUserRoleId and ToUserRoleId = $userRoleId";
    return execute($q);
}

function getLastMessagePerContact($userRoleId){
    $q = "
    SELECT DISTINCT
      m.*,
      If($userRoleId = m.FromUserRoleId, CONCAT(u2.FirstName, ' ', u2.LastName), CONCAT(u1.FirstName, ' ', u1.LastName)) as ContactName,
      If($userRoleId = m.FromUserRoleId, u2.Image, u1.Image) as Image,
      If($userRoleId = m.FromUserRoleId, m.ToUserRoleId, m.FromUserRoleId) as UserRoleId,
      If($userRoleId = m.FromUserRoleId, r2.Description, r1.Description) as Role,
      If($userRoleId = m.FromUserRoleId, 1, 0) as IsSender,
      If(m.DateReceived is null, 0, 1) as IsRead
    FROM message m
    LEFT JOIN userrole ur1 ON ur1.UserRoleId = m.FromUserRoleId
    LEFT JOIN user u1 ON u1.UserId = ur1.UserId
    LEFT JOIN role r1 ON r1.RoleId = ur1.RoleId
    LEFT JOIN userrole ur2 ON ur2.UserRoleId = m.ToUserRoleId
    LEFT JOIN user u2 ON u2.UserId = ur2.UserId
    LEFT JOIN role r2 ON r2.RoleId = ur2.RoleId

    WHERE
      (ToUserRoleId = $userRoleId
      OR FromUserRoleId = $userRoleId)
      AND m.IsDeleted = 0
      AND m.MessageId = (select m2.MessageId from message m2
                        where m2.DateSent =
                          (select max(m3.DateSent) from message m3
                            where (m3.ToUserRoleId = m.ToUserRoleId and m3.FromUserRoleId = m.FromUserRoleId)
                             or (m3.ToUserRoleId = m.FromUserRoleId and m3.FromUserRoleId = m.ToUserRoleId)))
      AND ((m.IsDeletedBySender = 0 AND FromUserRoleId = $userRoleId) OR (m.IsDeletedByReceiver = 0 AND ToUserRoleId = $userRoleId))
    ORDER BY m.DateSent DESC
    ";
    $res = array();
    $rows = execute($q);
    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }
    return encode(true, $res);
}


function deleteMessage($userRoleId, $messageId){
    $q = "UPDATE message
          SET IsDeletedBySender = CASE WHEN FromUserRoleId = $userRoleId THEN 1 ELSE IsDeletedBySender END,
              IsDeletedByReceiver = CASE WHEN ToUserRoleId = $userRoleId THEN 1 ELSE IsDeletedByReceiver END
          WHERE MessageId = $messageId";
    return encode(execute($q), '');
}
function deleteConversation($byUserRoleId, $withUserRoleId){
    $q = "UPDATE message
          SET IsDeletedBySender = CASE WHEN FromUserRoleId = $byUserRoleId THEN 1 ELSE IsDeletedBySender END,
              IsDeletedByReceiver = CASE WHEN ToUserRoleId = $byUserRoleId THEN 1 ELSE IsDeletedByReceiver END
          WHERE ((ToUserRoleId = $byUserRoleId AND FromUserRoleId = $withUserRoleId)
            OR (ToUserRoleId = $withUserRoleId AND FromUserRoleId = $byUserRoleId))";
    return encode(execute($q), '');
}
