<?php

include 'functions.php';

function connect(){
    return new mysqli('localhost', 'root', '', 'treecommunicationproject');
}

function execute($query){
    $db = connect();
    $result = $db->query($query);
    return $result;
}

?>