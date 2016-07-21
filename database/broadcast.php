<?php

require 'connection.php';

//function insertBroadcast($from, $to, $title, $content, $sentDate){
//    $q1 = "INSERT INTO broadcast (FromUserRoleId, Title, Content, SentDate, IsDeleted) VALUES ($from, '$title', '$content', 0)";
//    $res1 = execute($q1);
//    $q2 = "insert into broadcastline (BroadcastId, ToUserRoleId) values ($res1.BroadcastId, $to)";
//    $res2 = execute ($q2);
//}


function getBroadcasts($userroleid) {
    $q = "select b.BroadcastId, b.FromUserRoleId, b.Title, b.Content, b.DateSent from broadcast b, broadcastline where (b.FromUserRoleId = $userroleid or broadcastline.ToUserRoleId = $userroleid) and b.IsDeleted = 0";

    $res = array();
    $rows = execute($q);

    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }

    return encode(true, $res);
}