<?php

require_once '../userRole.php';

    if(empty($_REQUEST['userroleid'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $userroleid = $_REQUEST['userroleid'];

    echo deleteUserRole($userroleid );
?>