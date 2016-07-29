<?php

require_once '../task.php';

if(empty($_REQUEST['title'])
    || empty($_REQUEST['content'])
    || empty($_REQUEST['empnameto'])
    || empty($_REQUEST['empnamefrom'])
    || empty($_REQUEST['duedate']))
{
    echo encode(false, 'missing parameters');
    return;
}

$empnameto = $_REQUEST['empnameto'];
$empnamefrom = $_REQUEST['empnamefrom'];
$title = $_REQUEST['title'];
$content = $_REQUEST['content'];
$duedate = $_REQUEST['duedate'];

echo insertTask($empnamefrom, $empnameto, $title, $content, $duedate, date('Y/m/d H:i:s'));
?>