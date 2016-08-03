<?php
date_default_timezone_set('Asia/Beirut');

require_once 'functions.php';

function connect(){
    return new mysqli('localhost', 'root', '', 'treecommunicationproject');
}

function execute($query){
    $db = connect();
    $result = $db->query($query);
    return $result;
}

function prepare($query) {
    $conn = connect();
    if ($stmt = $conn->prepare($query)) {
        return $stmt;
    } else {
        return false;
    }
}

?>