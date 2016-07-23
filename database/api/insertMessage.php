<?php

include '../message.php';

if(empty($_REQUEST['content'])
    || empty($_REQUEST['fromuserroleid'])
    || empty($_REQUEST['touserroleid']))
{
    echo encode(false, 'missing parameters');
    return;
}

$content = $_REQUEST['content'];
$fromuserroleid = $_REQUEST['fromuserroleid'];
$touserroleid = $_REQUEST['touserroleid'];

echo insertMessage($fromuserroleid, $touserroleid, $content, date('Y/m/d H:i:s'), 0);
?>