<?php

require_once '../role.php';

    if(empty($_REQUEST['roleid'])
        || empty($_REQUEST['description'])
        || empty($_REQUEST['ismaster'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $roleid = $_REQUEST['roleid'];
    $desc = $_REQUEST['description'];
    $ismaster = $_REQUEST['ismaster'] == 'true' ? 1 : 0;

echo updateRole($roleid, $desc, $ismaster);
?>