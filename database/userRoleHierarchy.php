<?php

require_once 'connection.php';

function insertUserRoleHierarchy($parentId, $childId){
    $conn = connect();
    if(any(getUserRoleHierarchy($parentId, $childId))){
        return encode(updateUserRoleHierarchy($parentId, $childId, false), '');
    }else{
        $q = "insert into UserRoleHierarchy(UserRoleParentId, UserRoleChildId, IsDeleted) VALUES(?, ?, ?);";
        $false = 0;
        if ($stmt = $conn->prepare($q)) {
            $stmt->bind_param("iii", $parentId, $childId, $false);
            return encode($stmt->execute(), '');
        } else {
            return encode(false, var_dump($conn->error));
        }
    }
}

function getUserRoleHierarchy($parentId, $childId){
    $conn = connect();
    $q = "select * from UserRoleHierarchy where UserRoleParentId = ? and UserRoleChildId = ?";
    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param("ii", $parentId, $childId);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function updateUserRoleHierarchy($parentId, $childId, $isDeleted){
    $_isDeleted = $isDeleted ? 1 : 0;
    $conn = connect();
    $q = "update UserRoleHierarchy set IsDeleted = ? where UserRoleParentId = ? and UserRoleChildId = ?";
    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param("iii", $_isDeleted, $parentId, $childId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

?>