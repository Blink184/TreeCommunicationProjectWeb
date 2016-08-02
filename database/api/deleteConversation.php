<?php

require_once '../message.php';

    if(empty($_REQUEST['userroleid']) || empty($_REQUEST['withuserroleid'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $userroleid = $_REQUEST['userroleid'];
    $withuserroleid = $_REQUEST['withuserroleid'];

    echo deleteConversation($userroleid, $withuserroleid);
?>