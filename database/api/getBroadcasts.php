<?php
require_once '../broadcast.php';

if(empty($_REQUEST['userroleid']) || empty($_REQUEST['limit']))
{
    echo encode(false, 'missing parameters');
    return;
}

$userroleid = $_REQUEST['userroleid'];
$limit = $_REQUEST['limit'];

echo getBroadcasts($userroleid, $limit);
?>