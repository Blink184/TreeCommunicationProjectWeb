<?php

include_once 'connection.php';

function insertUserRoleHierarchy($parentId, $childId){
    if(any(getUserRoleHierarchy($parentId, $childId))){
        return encode(updateUserRoleHierarchy($parentId, $childId, false), '');
    }else{
        $q = "insert into UserRoleHierarchy(UserRoleParentId, UserRoleChildId, IsDeleted) VALUES($parentId, $childId, 0);";
        return encode(execute($q), '');
    }
}

function getUserRoleHierarchy($parentId, $childId){
    $q = "select * from UserRoleHierarchy where UserRoleParentId = $parentId and UserRoleChildId = $childId";
    return execute($q);
}

function updateUserRoleHierarchy($parentId, $childId, $isDeleted){
    $_isDeleted = $isDeleted ? 1 : 0;
    $q = "update UserRoleHierarchy set IsDeleted = $_isDeleted where UserRoleParentId = $parentId and UserRoleChildId = $childId";
    return execute($q);
}

?>