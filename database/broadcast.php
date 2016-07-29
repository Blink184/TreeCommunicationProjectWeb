<?php

require_once 'connection.php';

function insertBroadcast($from, $to, $totype, $title, $content, $sentDate, $isDeleted){
    $brQ = "insert into broadcast(FromUserRoleId, Title, Content, DateSent, IsDeleted) VALUES ($from, '$title', '$content', '$sentDate', $isDeleted)";
    execute($brQ);
    $selectLast = "SELECT * FROM broadcast where FromUserRoleId = $from ORDER BY BroadcastId DESC LIMIT 1";
    $lastRow = FirstRow(execute($selectLast));

    if ($totype == 'all') {
        //send to all
        $all = execute("select * from userrole where IsDeleted = 0 and UserRoleId <> $from");
        $users = array();
        while ($r = $all->fetch_assoc()) {
            array_push($users, $r);
        }
        foreach ($users as $row) {
            $q = "insert into broadcastline (BroadcastId, ToUserRoleId, IsReceived) values ($lastRow[BroadcastId], $row[UserRoleId], 0)";
            execute($q);
        }
    } else if ($totype == 'children') {
        //to children only
        $all = execute("select * from userrole where IsDeleted = 0 and UserRoleId in (select UserRoleChildId from userrolehierarchy where UserRoleParentId = $from and IsDeleted = 0)");
        $users = array();
        while ($r = $all->fetch_assoc()) {
            array_push($users, $r);
        }
        foreach ($users as $row) {
            $q = "insert into broadcastline (BroadcastId, ToUserRoleId, IsReceived) values ($lastRow[BroadcastId], $row[UserRoleId], 0)";
            execute($q);
        }
    } else {
        //to custom
        $toIds = explode(',', $to);
        foreach ($toIds as $ur) {
            $q = "insert into broadcastline (BroadcastId, ToUserRoleId, IsReceived) values ($lastRow[BroadcastId], $ur, 0)";
            execute($q);
        }
    }

    return encode(true, '');
}


function getBroadcasts($userroleid) {
//    $q = "select DISTINCT (b.BroadcastId), u.FirstName, u.LastName, r.Description as Description, ur.Title as RoleTitle, b.FromUserRoleId, b.Title, b.Content, b.DateSent from role r, userrole ur,broadcast b, broadcastline br, user u where (b.FromUserRoleId = $userroleid or br.ToUserRoleId = $userroleid) and b.IsDeleted = 0 and (ur.UserRoleId = $userroleid and ur.UserId = u.UserId and r.RoleId = ur.RoleId)";

    $q = "select  b.BroadcastId,
                  u.FirstName,
                  u.LastName,
                  r.Description as Role,
                  ur.Title as RoleTitle,
                  b.Title,
                  b.FromUserRoleId as UserRoleId,
                  b.Content,
                  b.DateSent,
                  1 as IsSender
          from broadcast b, userrole ur, role r, user u
          where b.FromUserRoleId = $userroleid
                and b.IsDeleted = 0
                and ur.UserRoleId = b.FromUserRoleId
                and ur.RoleId = r.RoleId
                and ur.UserId = u.UserId

          UNION

          select  b.BroadcastId,
                  u.FirstName,
                  u.LastName,
                  r.Description as Role,
                  ur.Title as RoleTitle,
                  b.Title,
                  b.FromUserRoleId as UserRoleId,
                  b.Content,
                  b.DateSent,
                  0 as IsSender
          from broadcast b, userrole ur, role r, user u, broadcastline bl
          where bl.ToUserRoleId = $userroleid
                and bl.BroadcastId = b.BroadcastId
                and b.IsDeleted = 0
                and ur.UserRoleId = b.FromUserRoleId
                and ur.RoleId = r.RoleId
                and ur.UserId = u.UserId
          order by DateSent desc";

    $res = array();
    $rows = execute($q);

    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }

    return encode(true, $res);
}