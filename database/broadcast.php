<?php

require_once 'connection.php';


//insertBroadcast(1, 1, 'all', "t", 'c\\\\', date('Y/m/d H:i:s'), 0);
function insertBroadcast($from, $to, $totype, $title, $content, $sentDate, $isDeleted){
    $false = 0;
    $conn = connect();
    $stmt = $conn->prepare("insert into broadcast (FromUserRoleId, Title, Content, DateSent, IsDeleted) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("isssi", $from, $title, $content, $sentDate, $isDeleted);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("select BroadcastId from broadcast where FromUserRoleId = ? ORDER BY BroadcastId DESC LIMIT 1");
    $stmt->bind_param("i", $from);
    $stmt->execute();
    $stmt->bind_result($broadcastid);
    $stmt->fetch();
    $stmt->close();

    if ($totype == 'all') {
        //send to all
        $users = array();

        if ($stmt = $conn->prepare("select UserRoleId from userrole where IsDeleted = 0 and UserRoleId <> ?")) {
            $stmt->bind_param("s", $from);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();

            while ($row = $res->fetch_array()) {
                array_push($users, $row);
            }

            foreach ($users as $row) {
                $stmt = $conn->prepare("insert into broadcastline (BroadcastId, ToUserRoleId, IsReceived) values (?, ?, ?)");
                $ur = $row['UserRoleId'];
                $stmt->bind_param("iii", $broadcastid, $ur, $false);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            return encode(false, $conn->error);
        }

    } else if ($totype == 'children') {
        //to children only
        if ($stmt = $conn->prepare("select * from userrole where IsDeleted = ? and UserRoleId in (select UserRoleChildId from userrolehierarchy where UserRoleParentId = ? and IsDeleted = ?)")) {
            $stmt->bind_param("iii", $false, $from, $false);
            $stmt->execute();
            $res = $stmt->get_result();
            $users = array();

            while ($row = $res->fetch_array()) {
                array_push($users, $row);
            }
            foreach ($users as $row) {
                $stmt = $conn->prepare("insert into broadcastline (BroadcastId, ToUserRoleId, IsReceived) values (?, ?, ?)");
                $ur = $row['UserRoleId'];
                $stmt->bind_param("iii", $broadcastid, $ur, $false);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            return encode(false, var_dump($conn->error));
        }
    } else {
        //to custom
        if ($stmt = $conn->prepare("insert into broadcastline (BroadcastId, ToUserRoleId, IsReceived) values (?, ?, ?)")) {
            $toIds = explode(',', $to);
            foreach ($toIds as $ur) {
                $stmt->bind_param("iii", $broadcastid, $ur, $false);
                $stmt->execute();
            }
            $stmt->close();
        } else {
            return encode(false, var_dump($conn->error));
        }
    }

    return encode(true, '');
}


function getBroadcasts($userroleid, $limit) {
    $conn = connect();
    $q = "select  b.BroadcastId,
                  u.FirstName,
                  u.LastName,
                  u.Image,
                  r.Description as Role,
                  ur.Title as RoleTitle,
                  b.Title,
                  b.FromUserRoleId as UserRoleId,
                  b.Content,
                  b.DateSent,
                  1 as IsSender
          from broadcast b, userrole ur, role r, user u
          where b.FromUserRoleId = ?
                and b.IsDeleted = 0
                and ur.UserRoleId = b.FromUserRoleId
                and ur.RoleId = r.RoleId
                and ur.UserId = u.UserId

          UNION

          select  b.BroadcastId,
                  u.FirstName,
                  u.LastName,
                  u.Image,
                  r.Description as Role,
                  ur.Title as RoleTitle,
                  b.Title,
                  b.FromUserRoleId as UserRoleId,
                  b.Content,
                  b.DateSent,
                  0 as IsSender
          from broadcast b, userrole ur, role r, user u, broadcastline bl
          where bl.ToUserRoleId = ?
                and bl.BroadcastId = b.BroadcastId
                and b.IsDeleted = 0
                and ur.UserRoleId = b.FromUserRoleId
                and ur.RoleId = r.RoleId
                and ur.UserId = u.UserId
          order by DateSent desc limit ?";

    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param("iii", $userroleid, $userroleid, $limit);
        $stmt->execute();
        $res = array();
        $rows = $stmt->get_result();

        while ($row = $rows->fetch_assoc()) {
            array_push($res, $row);
        }
    } else {
        return encode(false, $conn->error);
    }

    return encode(true, $res);
}


function getUnreadBroadcasts($userRoleId){
    $conn = connect();
    $q = "select count(*) from broadcastline bl, broadcast b where b.BroadcastId = bl.BroadcastId and b.IsDeleted = 0 and bl.ToUserRoleId = ? and bl.IsReceived = 0";
    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param("i", $userRoleId);
        $stmt->execute();
        $stmt->bind_result($res);
        $stmt->fetch();
        $stmt->close();
        echo $res;
    }else{
        echo '0';
    }
}