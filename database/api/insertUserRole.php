<?php

require_once '../userRole.php';

    if(empty($_REQUEST['userid'])
        || empty($_REQUEST['roleid'])
        || empty($_REQUEST['parentid'])
        || empty($_REQUEST['title'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $uid = $_REQUEST['userid'];
    $rid = $_REQUEST['roleid'];
    $pid = $_REQUEST['parentid'];
    $title = $_REQUEST['title'];

    echo insertUserRole($uid, $rid, $pid, $title, 0);
?>