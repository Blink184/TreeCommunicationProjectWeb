<?php

require 'connection.php';

function insertBroadcast($from, $to, $totype, $title, $content, $sentDate, $isDeleted){
    $brQ = "insert into broadcast(FromUserRoleId, Title, Content, SentDate, IsDeleted) VALUES ($from, '$title', '$content', $sentDate, 0)";
    execute($brQ);
    $selectLast = "SELECT * FROM broadcast where FromUserRoleId = $from ORDER BY BroadcastId DESC LIMIT 1";
    $lastRow = FirstRow(execute($selectLast));


//    $q2 = "insert into broadcastline (BroadcastId, ToUserRoleId) values ($res1.BroadcastId, $to)";
//    $res2 = execute ($q2);
}


function getBroadcasts($userroleid) {
    $q = "select u.FirstName, u.LastName, r.Description as Description, ur.Title as RoleTitle, b.BroadcastId, b.FromUserRoleId, b.Title, b.Content, b.DateSent from role r, userrole ur,broadcast b, broadcastline br, user u where (b.FromUserRoleId = $userroleid or br.ToUserRoleId = $userroleid) and b.IsDeleted = 0 and (ur.UserRoleId = $userroleid and ur.UserId = u.UserId and r.RoleId = ur.RoleId)";

    $res = array();
    $rows = execute($q);

    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }

    return encode(true, $res);
}