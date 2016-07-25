<?php

require 'connection.php';

function insertBroadcast($from, $to, $totype, $title, $content, $sentDate, $isDeleted){
    $brQ = "insert into broadcast(FromUserRoleId, Title, Content, DateSent, IsDeleted) VALUES ($from, '$title', '$content', '$sentDate', 0)";
    execute($brQ);
    $selectLast = "SELECT * FROM broadcast where FromUserRoleId = $from ORDER BY BroadcastId DESC LIMIT 1";
    $lastRow = FirstRow(execute($selectLast));

    //get all userroles now because there is no validation
    $getAll = "select * from userrole where IsDeleted = 0";
    $all = execute($getAll);
    $allUsers = array();
    while ($r = $all-> fetch_assoc()) {
        array_push($allUsers, $r);
    }

    if ($totype == 'all') {
        //send to all
        foreach ($allUsers as $row) {
            $q = "insert into broadcastline (BroadcastId, ToUserRoleId, DateReceived, IsReceived) values ($lastRow[BroadcastId], $row[UserRoleId], '$sentDate', 1)";
            execute($q);
        }
    } else if ($to == 'children') {
        //to children only
        foreach ($allUsers as $row) {
            $q = "insert into broadcastline (BroadcastId, ToUserRoleId, DateReceived, IsReceived) values ($lastRow[BroadcastId], $row[UserRoleId], '$sentDate', 1)";
            execute($q);
        }
    } else {
        //to custom
        $toIds = explode(',', $to);
        foreach ($toIds as $ur) {
            $q = "insert into broadcastline (BroadcastId, ToUserRoleId, DateReceived, IsReceived) values ($lastRow[BroadcastId], $ur, '$sentDate', 1)";
            execute($q);
        }
    }

    return encode(true, '');
}


function getBroadcasts($userroleid) {
    $q = "select DISTINCT (b.BroadcastId), u.FirstName, u.LastName, r.Description as Description, ur.Title as RoleTitle, b.FromUserRoleId, b.Title, b.Content, b.DateSent from role r, userrole ur,broadcast b, broadcastline br, user u where (b.FromUserRoleId = $userroleid or br.ToUserRoleId = $userroleid) and b.IsDeleted = 0 and (ur.UserRoleId = $userroleid and ur.UserId = u.UserId and r.RoleId = ur.RoleId)";

    $res = array();
    $rows = execute($q);

    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }

    return encode(true, $res);
}