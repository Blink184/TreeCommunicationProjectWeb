<?php

require_once '../message.php';

    if(empty($_REQUEST['userroleid']) || empty($_REQUEST['messageid'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $userroleid = $_REQUEST['userroleid'];
    $messageid = $_REQUEST['messageid'];

    echo deleteMessage($userroleid, $messageid);
?>