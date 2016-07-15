<?php

require 'connection.php';
require 'userRoleHierarchy.php';

function insertUserRole($userId, $roleId, $parentId, $title, $isDeleted){
    if(!userRoleExists($userId, $roleId)){
        $q = "INSERT INTO userrole (UserId, RoleId, Title, IsDeleted) VALUES ($userId, $roleId, '$title', $isDeleted)";
        if(execute($q)){
            $userRole = getLastUserRole()->fetch_assoc();
            //return encode(true, '');
            return insertUserRoleHierarchy($parentId, $userRole['UserRoleId']);

        }else{
            return encode(false, 'ERR_CODE_0002');
        }
    }else{
        return encode(false, 'User already has this role');
    }
}

function updateUserRole($userRoleId, $userId, $roleId, $title){
    if(userRoleExistsWithId($userRoleId, $userId, $roleId) || !userRoleExists($userId, $roleId)){
        $q = "update userrole set UserId = $userId, RoleId = $roleId, Title = '$title' where UserRoleId = $userRoleId";
        return encode(execute($q), '');
    }else{
        return encode(false, 'User already has this role');
    }
}


function getLastUserRole(){
    $q = "select * from UserRole where IsDeleted = 0 order by UserRoleId desc limit 1";
    return execute($q);
}

function getUserRoleWithId($userRoleId, $userId, $roleId){
    $q = "select * from UserRole where UserId = $userId and RoleId = $roleId and UserRoleId = $userRoleId and IsDeleted = 0";
    return execute($q);
}
function getUserRole($userId, $roleId){
    $q = "select * from UserRole where UserId = $userId and RoleId = $roleId and IsDeleted = 0";
    return execute($q);
}
function getUserRoleById($userRoleId){
    $q = "select * from UserRole where UserRoleId = $userRoleId";
    return execute($q);
}

function userRoleExists($userId, $roleId){
    return any(getUserRole($userId, $roleId));
}
function userRoleExistsWithId($userRoleId, $userId, $roleId){
    return any(getUserRoleWithId($userRoleId, $userId, $roleId));
}


function deleteUserRole($userRoleId){
    $q = "UPDATE userrole set IsDeleted = 1 where UserRoleId = $userRoleId";
    return encode(execute($q), '');
}

function getUserRoles(){
    $q = "select ur.UserRoleId, u.FirstName, u.LastName, r.Description as Role from userrole ur, user u, Role r where ur.IsDeleted = 0 and ur.RoleId = r.RoleId and u.IsDeleted = 0 and u.UserId = ur.UserId ORDER BY FirstName, LastName";

    $res = array();
    $rows = execute($q);
    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }

    return encode(true, $res);
}


function getUserRoleTree($id){
    $sql="SELECT * FROM Role r, UserRole ur LEFT JOIN User u ON u.UserId = ur.UserId WHERE ur.RoleId = r.RoleId and ur.UserRoleId = $id";

    $row = execute($sql)->fetch_assoc();
    $o['UserRoleId'] = $row['UserRoleId'];
    $o['FirstName'] = $row['FirstName'];
    $o['LastName'] = $row['LastName'];
    $o['Name'] = $row['FirstName'] . ' ' . $row['LastName'];
    $o['Address'] = $row['Address'];
    $o['Phone'] = $row['Phone'];
    $o['Role'] = $row['Description'];
    $o['Image'] = $row['Image'];
    $o['LastActiveDate'] = $row['LastActiveDate'];
    $o['Title'] = $row['Title'];
    $o['UserId'] = $row['UserId'];
    $o['IsAssigned'] = !empty($row['UserId']);
    $o['RoleId'] = $row['RoleId'];
    $o['Children'] = array();
    $o['Children'] = getUserRoleChildren($o['Children'], $o['UserRoleId']);
    return encode(true, $o);
}

function getUserRoleChildren($children, $parentId) {
    $children = array();
    $sql="SELECT *, (select count(*) from UserRoleHierarchy where UserRoleChildId = ur.UserRoleId and IsDeleted = 0) as NumberOfParents FROM Role r, UserRole ur LEFT JOIN User u ON u.UserId = ur.UserId WHERE ur.RoleId = r.RoleId and ur.UserRoleId in (select UserRoleChildId from UserRoleHierarchy where UserRoleParentId = $parentId and IsDeleted = 0) and ur.IsDeleted = 0";
    $result = execute($sql);
    while ($row = $result->fetch_assoc()) {
        $o['UserRoleId'] = $row['UserRoleId'];
        $o['FirstName'] = $row['FirstName'];
        $o['LastName'] = $row['LastName'];
        $o['Name'] = $row['FirstName'] . ' ' . $row['LastName'];
        $o['Address'] = $row['Address'];
        $o['Phone'] = $row['Phone'];
        $o['Role'] = $row['Description'];
        $o['Title'] = $row['Title'];
        $o['Image'] = $row['Image'];
        $o['LastActiveDate'] = $row['LastActiveDate'];
        $o['UserId'] = $row['UserId'];
        $o['IsAssigned'] = !empty($row['UserId']);
        $o['NumberOfParents'] = $row['NumberOfParents'];
        $o['UserRoleParent'] = $parentId;
        $o['RoleId'] = $row['RoleId'];
        $o['Children'] = array();
        $o['Children'] = getUserRoleChildren($o['Children'], $o['UserRoleId']);
        array_push($children, $o);
    }
    return $children;
}