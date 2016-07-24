<?php

require 'connection.php';

//function insertBroadcast($from, $title, $content, $sentDate, $toType, $to){
//    $q1 = "INSERT INTO broadcast (FromUserRoleId, Title, Content, SentDate, IsDeleted) VALUES ($from, '$title', '$content', 0)";
//    $res1 = execute($q1);
//    $q2 = "insert into broadcastline (BroadcastId, ToUserRoleId) values ($res1.BroadcastId, $to)";
//    $res2 = execute ($q2);
//}


function getBroadcasts($userroleid) {
    $q = "select u.FirstName, u.LastName, r.Description as Description, ur.Title as RoleTitle, b.BroadcastId, b.FromUserRoleId, b.Title, b.Content, b.DateSent from role r, userrole ur,broadcast b, broadcastline br, user u where (b.FromUserRoleId = $userroleid or br.ToUserRoleId = $userroleid) and b.IsDeleted = 0 and (ur.UserRoleId = $userroleid and ur.UserId = u.UserId and r.RoleId = ur.RoleId)";

    $res = array();
    $rows = execute($q);

    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }

    return encode(true, $res);
}