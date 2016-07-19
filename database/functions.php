<?php
function encode($bool, $info){
    $_bool = false;
    if(is_bool($bool)){
        $_bool = $bool;
    }
    $res = array();
    $res['s'] = $_bool ? 1 : 0;
    $res['i'] = $info;
    return json_encode($res);
}
function any($obj){
    return $obj->num_rows > 0;
}
function firstRow($obj){
    return $obj->fetch_assoc();
}