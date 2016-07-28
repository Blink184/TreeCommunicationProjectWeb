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

function getRoles(){
    $q = "select * from role WHERE IsDeleted = 0 ORDER BY Description";
    $tmp = execute($q);
    $roles = array();
    while ($row = $tmp->fetch_assoc()) {
        array_push($roles, $row);
    }
    $roles = json_encode($roles);
    return encode(true, $roles);
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

function getUnusedRoles(){
    $q = "select * from role where IsDeleted = 0 and RoleId not in (select ur.RoleId from userrole ur where ur.IsDeleted = 0)";
    $tmp = execute($q);
    $roles = array();
    while ($row = $tmp->fetch_assoc()) {
        array_push($roles, $row);
    }
    return encode(true, json_encode($roles));
}

function deleteRole($roleId){
    $q = "update role set IsDeleted = 1 where RoleId = $roleId";
    return encode(execute($q), '');
}