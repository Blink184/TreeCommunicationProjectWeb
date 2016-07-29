<?php

require_once '../role.php';

    if(empty($_REQUEST['roleid'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $roleid = $_REQUEST['roleid'];

    echo deleteRole($roleid);
?>