<?php

require_once '../task.php';

if(empty($_REQUEST['taskid'])
    || empty($_REQUEST['date']))
{
    echo 'missing parameters';
    return;
}

$taskid = $_REQUEST['taskid'];
$date = $_REQUEST['date'];

echo cancelTask($taskid, $date);
?>