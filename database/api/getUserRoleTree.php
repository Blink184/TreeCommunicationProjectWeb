<?php

    include '../userRole.php';

    if(empty($_REQUEST['parentid'])){
        echo encode(false, 'missing parameters');
        return;
    }

    $parentid = $_REQUEST['parentid'];

    echo getUserRoleTree($parentid);
?>