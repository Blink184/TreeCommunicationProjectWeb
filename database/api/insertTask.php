<?php

include '../task.php';

if(empty($_REQUEST['title']) || empty($_REQUEST['desc'])
    || empty($_REQUEST['duedate']))
{
    echo encode(false, 'missing parameters');
    return;
}

$empnameto = $_REQUEST['empnameto'];
$empnamefrom = $_REQUEST['empnamefrom'];
$title = $_REQUEST['title'];
$desc = $_REQUEST['desc'];
$duedate = $_REQUEST['duedate'];

echo insertTask($empnamefrom, $empnameto, $title, $desc, $duedate);
?>