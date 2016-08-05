<?php

require_once 'connection.php';
require_once 'userRoleHierarchy.php';

function insertUserRole($userId, $roleId, $parentId, $title, $isDeleted){
    $conn = connect();
    if(!userRoleExists($userId, $roleId)){
        if ($stmt = $conn->prepare("INSERT INTO userrole (UserId, RoleId, Title, IsDeleted) VALUES (?, ?, ?, ?)")) {
            $stmt->bind_param("iisi", $userId, $roleId, $title, $isDeleted);
            if ($stmt->execute()) {
                $userRole = getLastUserRole()->fetch_assoc();
                return insertUserRoleHierarchy($parentId, $userRole['UserRoleId']);
            } else {
                return encode(false, "ERR_CODE_002");
            }
        } else {
            return encode(false, var_dump($conn->error));
        }
    }else{
        return encode(false, 'User already has this role');
    }
}

function updateUserRole($userRoleId, $userId, $roleId, $title){
    $conn = connect();
    if(userRoleExistsWithId($userRoleId, $userId, $roleId) || !userRoleExists($userId, $roleId)){
        if ($stmt = $conn->prepare("update userrole set UserId = ?, RoleId = ?, Title = ? where UserRoleId = ?")) {
            $stmt->bind_param("iisi", $userId, $roleId, $title, $userRoleId);
            return encode($stmt->execute(), '');
        } else {
            return encode(false, var_dump($conn->error));
        }
    }else{
        return encode(false, 'User already has this role');
    }
}


function getLastUserRole(){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from UserRole where IsDeleted = 0 order by UserRoleId desc limit 1")) {
        $stmt->execute();
        $res = $stmt->get_result();
        return encode(true, ($res->fetch_assoc()));
    } else {
        return encode(false, var_dump($conn->error));
    }
//    $q = "select * from UserRole where IsDeleted = 0 order by UserRoleId desc limit 1";
//    return execute($q);
}

function getUserRoleWithId($userRoleId, $userId, $roleId){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from UserRole where UserId = ? and RoleId = ? and UserRoleId = ? and IsDeleted = 0")) {
        $stmt->bind_param("iii", $userId, $roleId, $userRoleId);
        $stmt->execute();
        $res = $stmt->get_result();
        return encode(true, ($res->fetch_assoc()));
    } else {
        return encode(false, var_dump($conn->error));
    }
//    $q = "select * from UserRole where UserId = $userId and RoleId = $roleId and UserRoleId = $userRoleId and IsDeleted = 0";
//    return execute($q);
}
function getUserRole($userId, $roleId){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from UserRole where UserId = ? and RoleId = ? and IsDeleted = 0")) {
        $stmt->bind_param("ii", $userId, $roleId);
        $stmt->execute();
        $res = $stmt->get_result();
        return encode(true, ($res->fetch_assoc()));
    } else {
        return encode(false, var_dump($conn->error));
    }
//    $q = "select * from UserRole where UserId = $userId and RoleId = $roleId and IsDeleted = 0";
//    return execute($q);
}

//getUserRoleById(1);
function getUserRoleById($userRoleId){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from userrole ur, user u, role r where u.UserId = ur.UserId and r.RoleId = ur.RoleId and UserRoleId = ?")) {
        $stmt->bind_param("i", $userRoleId);
        $stmt->execute();
        $res = $stmt->get_result();
        return encode(true, ($res->fetch_assoc()));
    } else {
        return encode(false, var_dump($conn->error));
    }
//    $q = "select * from userrole ur, user u, role r where u.UserId = ur.UserId and r.RoleId = ur.RoleId and UserRoleId = $userRoleId";
//    print_r(firstRow(execute($q)));
//    return encode(true, firstRow(execute($q)));
}

function userRoleExists($userId, $roleId){
    return any(getUserRole($userId, $roleId));
}
function userRoleExistsWithId($userRoleId, $userId, $roleId){
    return any(getUserRoleWithId($userRoleId, $userId, $roleId));
}


function deleteUserRole($userRoleId){
    $conn = connect();
    if ($stmt = $conn->prepare("UPDATE userrole set IsDeleted = 1 where UserRoleId = ?")) {
        $stmt->bind_param("i", $userRoleId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
//    $q = "UPDATE userrole set IsDeleted = 1 where UserRoleId = $userRoleId";
//    return encode(execute($q), '');
}

function getUserRoles(){
    $q = "select ur.UserRoleId, u.FirstName, u.LastName, r.Description as Role from userrole ur, user u, Role r where ur.IsDeleted = 0 and ur.RoleId = r.RoleId and u.IsDeleted = 0 and u.UserId = ur.UserId ORDER BY FirstName, LastName";
    $conn = connect();
    if ($stmt = $conn->prepare($q)) {
        $stmt->execute();
        $res = array();
        $rows = $stmt->get_result();
        $stmt->close();
        while ($row = $rows->fetch_assoc()) {
            array_push($res, $row);
        }
        return encode(true, json_encode($res));
    } else {
        return encode(false, var_dump($conn->error));
    }
    //return encode(true, $res);
}

function getUserRoleTree($id){
    $q="SELECT * FROM Role r, UserRole ur LEFT JOIN User u ON u.UserId = ur.UserId WHERE ur.RoleId = r.RoleId and ur.UserRoleId = ?";
    $conn = connect();
    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();

        $o['UserRoleId'] = $row['UserRoleId'];
        $o['FirstName'] = $row['FirstName'];
        $o['LastName'] = $row['LastName'];
        $o['Name'] = $row['FirstName'] . ' ' . $row['LastName'];
        $o['Username'] = $row['Username'];
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

        $conn->close();
        return encode(true, $o);
    } else {
        return encode(false, var_dump($conn->error));
    }

}

function getUserRoleChildren($children, $parentId) {
    $conn = connect();
    $q="SELECT *, (select count(*) from UserRoleHierarchy where UserRoleChildId = ur.UserRoleId and IsDeleted = 0) as NumberOfParents FROM Role r, UserRole ur LEFT JOIN User u ON u.UserId = ur.UserId WHERE ur.RoleId = r.RoleId and ur.UserRoleId in (select UserRoleChildId from UserRoleHierarchy where UserRoleParentId = ? and IsDeleted = 0) and ur.IsDeleted = 0";
    if ($stmt = $conn->prepare($q)) {
        $children = array();
        $stmt->bind_param("i", $parentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        if ($result->num_rows > 0) {
            foreach ($result->fetch_assoc() as $row)
            {
                $o['UserRoleId'] = $row['UserRoleId'];
                $o['FirstName'] = $row['FirstName'];
                $o['LastName'] = $row['LastName'];
                $o['Name'] = $row['FirstName'] . ' ' . $row['LastName'];
                $o['Username'] = $row['Username'];
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
                array_push($children, $row);
            }
            return $children;
        } else {
            return null;
        }
    } else {
        return null;
    }
}