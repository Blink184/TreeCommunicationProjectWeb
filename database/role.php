<?php

require 'connection.php';

function insertRole($description, $isMaster, $isDeleted){
    if(!roleExists($description)){
        $q = "INSERT INTO role (Description, IsMaster, IsDeleted) VALUES ('$description', $isMaster, $isDeleted)";
        return encode(execute($q), '');
    }else{
        return encode(false, 'role exists');
    }
}

function getRole($id){
    $q = "select * from role where RoleId = $id";
    return execute($q);
}

function getRoleByDescription($description){
    $q = "select * from role where Description = '$description' and IsDeleted = 0";
    return execute($q);
}

function roleExists($description){
    return any(getRoleByDescription($description));
}
