<?php

include '../message.php';

if(empty($_REQUEST['fromuserroleid'])
    || empty($_REQUEST['title'])
    || empty($_REQUEST['content'])
    )
{
    echo encode(false, 'missing parameters');
    return;
} else if (($_REQUEST['totype'])=='custom') {
    if (empty($_REQUEST['touserroleids'])) {
        echo encode(false, 'missing parameters');
        return;
    }
}

$content = $_REQUEST['content'];
$title = $_REQUEST['title'];
$totype = $_REQUEST['totype'];
$fromuserroleid = $_REQUEST['fromuserroleid'];
$touserroleids = $_REQUEST['touserroleids'];

echo insertBroadcast($fromuserroleid, $touserroleids, $totype, $title, $content, date('Y/m/d H:i:s'), 0);
?>