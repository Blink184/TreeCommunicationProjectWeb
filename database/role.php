<?php

require_once 'connection.php';

function insertRole($description, $isMaster, $isDeleted){
    $conn = connect();
    if(!roleExists($description)){
        if ($stmt = $conn->prepare("INSERT INTO role (Description, IsMaster, IsDeleted) VALUES (?, ?, ?)")) {
            $stmt->bind_param("sii", $description, $isMaster, $isDeleted);
            return encode($stmt->execute(), $isMaster);
        } else {
            return encode(false, var_dump($conn->error));
        }
    }else{
        return encode(false, 'role exists');
    }
}

function updateRole($roleId, $description, $isMaster){
    $conn = connect();
    if(!any(checkDescriptionExistsWithId($roleId, $description))){
        if ($stmt = $conn->prepare("UPDATE role SET Description = ?, IsMaster = ? WHERE RoleId = ?")) {
            $stmt->bind_param("sii", $description, $isMaster, $roleId);
            return encode($stmt->execute(), '');
        } else {
            return encode(false, var_dump($conn->error));
        }
    }else{
        return encode(false, 'role exists');
    }
}

function getRoles(){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from role WHERE IsDeleted = 0 ORDER BY Description")) {
        $stmt->execute();
        $rows = $stmt->get_result();
        $roles = array();
        while ($row = $rows->fetch_assoc()) {
            array_push($roles, $row);
        }
        return encode(true, json_encode($roles));
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getRole($id){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from role where RoleId = ?")) {
        $stmt->bind_param("i", $id);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getRoleByDescription($description){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("select * from role where Description = ? and IsDeleted = ?")) {
        $stmt->bind_param("si", $description, $false);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    } else {
        return encode(false, var_dump($conn->error));
    }
}
function checkDescriptionExistsWithId($roleId, $description){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("select * from role where Description = ? and IsDeleted = ? and role.RoleId <> ?")) {
        $stmt->bind_param("sii", $description, $false, $roleId);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function roleExists($description){
    return any(getRoleByDescription($description));
}

function getUnusedRoles(){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("select * from role where IsDeleted = ? and RoleId not in (select ur.RoleId from userrole ur where ur.IsDeleted = ?)")) {
        $stmt->bind_param("ii", $false, $false);
        $stmt->execute();
        $rows = $stmt->get_result();
        $roles = array();
        while ($row = $rows->fetch_assoc()) {
            array_push($roles, $row);
        }
        return encode(true, json_encode($roles));
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getRolesWithUsageStatus(){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("select r.*, (select count(*) from userrole ur where ur.IsDeleted = ? and ur.RoleId = r.RoleId) as 'Usage' from role r where r.IsDeleted = ?")) {
        $stmt->bind_param("ii", $false, $false);
        $stmt->execute();
        $rows = $stmt->get_result();
        $roles = array();
        while ($row = $rows->fetch_assoc()) {
            array_push($roles, $row);
        }
        return encode(true, json_encode($roles));
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function deleteRole($roleId){
    $conn = connect();
    $true = 1;
    if ($stmt = $conn->prepare("update role set IsDeleted = ? where RoleId = ?")) {
        $stmt->bind_param("ii", $true, $roleId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}