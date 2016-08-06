<?php
require_once '../task.php';
require_once '../message.php';
require_once '../broadcast.php';

if(empty($_REQUEST['userroleid']))
{
    echo encode(false, 'missing parameters');
    return;
}

$userroleid = $_REQUEST['userroleid'];
$b = getUnreadBroadcasts($userroleid);
$m = getUnreadMessages($userroleid);
$t = getUnreadTasks($userroleid);

$res = array();
$res['b'] = $b;
$res['m'] = $m;
$res['t'] = $t;

echo encode(true, $res);
?>