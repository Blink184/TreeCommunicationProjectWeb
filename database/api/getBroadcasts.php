<?php
include '../broadcast.php';

if(empty($_REQUEST['userroleid']))
{
    echo encode(false, 'missing parameters');
    return;
}

$userroleid = $_REQUEST['userroleid'];

echo getBroadcasts($userroleid);
?>