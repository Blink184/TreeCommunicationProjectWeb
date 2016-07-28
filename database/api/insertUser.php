<?php

    include '../user.php';

    if(empty($_REQUEST['firstname'])
        || empty($_REQUEST['lastname'])
        || empty($_REQUEST['username'])
        || empty($_REQUEST['password'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $fn = $_REQUEST['firstname'];
    $ln = $_REQUEST['lastname'];
    $un = $_REQUEST['username'];
    $pw = $_REQUEST['password'];
    $tel = $_REQUEST['telephone'];
    $em = $_REQUEST['email'];

    echo insertUser($fn, $ln, $un, $pw, $tel, $em, "-", 0, date('Y-m-d H:i:s'), 0 , 0, 0);
?>