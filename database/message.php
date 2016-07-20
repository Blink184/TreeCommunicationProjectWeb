<?php

require 'connection.php';

/*function insertMessage($from, $to, $title, $content, $duedate, $startdate){
    $q = "INSERT INTO task (FromUserRoleId, ToUserRoleId, Title, Content, TaskState, DueDate, StartDate, IsDeleted) VALUES ($from, $to, '$title', '$content', 1, '$duedate', '$startdate', 0)";
    return encode(execute($q), '');
}*/

function getMessages($fromUserRoleId, $toUserRoleId){
    $q = "
    SELECT
      *
    FROM
      message m
    WHERE
      (ToUserRoleId = $toUserRoleId
      OR FromUserRoleId = $fromUserRoleId)
      AND m.IsDeleted = 0
    ";
    $res = array();
    $rows = execute($q);
    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }
    return encode(true, $res);
}

function getLastMessages($userRoleId){
    $q = "
    SELECT DISTINCT
      m.*,
      If($userRoleId = m.FromUserRoleId, CONCAT(u2.FirstName, ' ', u2.LastName), CONCAT(u1.FirstName, ' ', u1.LastName)) as Contact,
      If($userRoleId = m.FromUserRoleId, u2.Image, u1.Image) as Image
    FROM message m
    LEFT JOIN userrole ur1 ON ur1.UserRoleId = m.FromUserRoleId
    LEFT JOIN user u1 ON u1.UserId = ur1.UserId
    LEFT JOIN userrole ur2 ON ur2.UserRoleId = m.ToUserRoleId
    LEFT JOIN user u2 ON u2.UserId = ur2.UserId

    WHERE
      (ToUserRoleId = $userRoleId
      OR FromUserRoleId = $userRoleId)
      AND m.IsDeleted = 0
      AND m.MessageId = (select m2.MessageId from message m2 where m2.DateSent = (select max(m3.DateSent) from message m3 where m3.ToUserRoleId = $userRoleId or m3.FromUserRoleId = $userRoleId))
    ";
    $res = array();
    $rows = execute($q);
    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }
    return encode(true, $res);
}

