<?php
require_once '../user.php';


    if(empty($_REQUEST['username'])
        || empty($_REQUEST['password'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $user = $_REQUEST['username'];
    $pwd = $_REQUEST['password'];

    echo validateUser($user, $pwd);
?>