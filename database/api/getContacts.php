<?php
require_once '../message.php';

if(empty($_REQUEST['userroleid']))
{
    echo encode(false, 'missing parameters');
    return;
}

$userroleid = $_REQUEST['userroleid'];


echo getLastMessagePerContact($userroleid);
?>