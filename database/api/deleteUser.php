<?php

require_once '../user.php';

    if(empty($_REQUEST['userid'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $userid = $_REQUEST['userid'];

    echo deleteUser($userid );
?>