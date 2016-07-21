<?php
include '../message.php';

if(empty($_REQUEST['userroleid'])
    ||empty($_REQUEST['contactid']))
{
    echo encode(false, 'missing parameters');
    return;
}

$userroleid = $_REQUEST['userroleid'];
$contactid = $_REQUEST['contactid'];


echo getMessages($userroleid, $contactid);
?>