<?php

    include '../userRole.php';

    if(empty($_REQUEST['userid'])
        || empty($_REQUEST['roleid'])
        || empty($_REQUEST['userroleid'])
        || empty($_REQUEST['title'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $uid = $_REQUEST['userid'];
    $rid = $_REQUEST['roleid'];
    $urid = $_REQUEST['userroleid'];
    $title = $_REQUEST['title'];

    echo updateUserRole($urid, $uid, $rid, $title);
?>