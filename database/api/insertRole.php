<?php

require_once '../role.php';

    if(empty($_REQUEST['description'])
        || empty($_REQUEST['ismaster'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $desc = $_REQUEST['description'];
    $ismaster = $_REQUEST['ismaster'] == 'true' ? 1 : 0;

    echo insertRole($desc, $ismaster, 0);
?>