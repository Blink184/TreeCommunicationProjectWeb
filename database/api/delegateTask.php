<?php

include '../task.php';

if(empty($_REQUEST['taskid'])
    || empty($_REQUEST['delegatetouserroleid']))
{
    echo 'missing parameters';
    return;
}

$taskid = $_REQUEST['taskid'];
$delegatetouserroleid = $_REQUEST['delegatetouserroleid'];

echo delegateTask($taskid, $delegatetouserroleid);
?>