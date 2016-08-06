<?php

require_once 'connection.php';

function insertUser($firstname, $lastname, $username, $password, $phone, $address, $email, $isAdmin, $lastActiveDate, $isLoggedIn, $isBanned, $isDeleted){
    $conn = connect();
    if(!usernameExists($username)) {
        if ($stmt = $conn->prepare("INSERT INTO user (FirstName, LastName, Username, Password, Phone, Address, Email, IsAdmin, LastActiveDate, IsLoggedIn, IsBanned, IsDeleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("sssssssisiii", $firstname, $lastname, $username, $password, $phone, $address, $email, $isAdmin, $lastActiveDate, $isLoggedIn, $isBanned, $isDeleted);
            return encode($stmt->execute(), '');
        } else {
            return encode(false, var_dump($conn->error));
        }
    }else{
        return encode(false, 'username exists');
    }
}

function validateUser($username, $password) {
    $conn = connect();
    $q = "select u.*, ur.UserRoleId, r.IsMaster from user u, userrole ur, role r where ur.UserId = u.UserId and ur.RoleId = r.RoleId and ur.IsDeleted = 0 and u.Username = ? and BINARY u.Password = ?";
    if ($stmt = $conn->prepare($q)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return encode(true, $res->fetch_assoc());
        } else {
            return encode(false, 'invalid username/password');
        }
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getUsers(){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from user where IsDeleted = 0 and IsAdmin = 0 ORDER BY FirstName, LastName")) {
        $stmt->execute();
        $rows = $stmt->get_result();
        $users = array();
        while ($row = $rows->fetch_assoc()) {
            array_push($users, $row);
        }
        return encode(true, json_encode($users));
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getUnassignedUsers(){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from user where IsDeleted = 0 and IsAdmin = 0 and UserId not in (select ur.UserId from userrole ur where ur.IsDeleted = 0) ORDER BY FirstName, LastName")) {
        $stmt->execute();
        $rows = $stmt->get_result();
        $users = array();
        while ($row = $rows->fetch_assoc()) {
            array_push($users, $row);
        }
        return encode(true, json_encode($users));
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getUser($id){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from user where UserId = ?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return encode(true, firstRow($stmt->get_result()));
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getUserByUsername($username){
    $conn = connect();
    $false = 0;
    if ($stmt = $conn->prepare("select * from user where Username = ? and IsDeleted = ?")) {
        $stmt->bind_param("si", $username, $false);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function usernameExists($username){
    $res = getUserByUsername($username);
    return any($res);
}

function updateUser($userId, $firstname, $lastname, $phone, $address, $username, $password){
    $conn = connect();
    if ($stmt = $conn->prepare("update user set FirstName = ?, LastName = ?, Phone = ?, Password = ?, Username = ?, Address = ? where UserId = ?")) {
        $stmt->bind_param("ssssssi", $firstname, $lastname, $phone, $password, $username, $address, $userId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function checkUsernameAvailability($userId, $username){
    $conn = connect();
    if ($stmt = $conn->prepare("select * from user where UserId <> ? and Username = ?")) {
        $stmt->bind_param("is", $userId, $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return encode(false, var_dump($conn->error));
    }
//    $q = "select * from user where UserId <> $userId and Username = '$username'";
//    return !any(execute($q));
}

function updateUserImage($userId, $image){
    $conn = connect();
    if ($stmt = $conn->prepare("update user set Image = ? where UserId = ?")) {
        $stmt->bind_param("si", $image, $userId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function deleteUser($userId){
    $conn = connect();
    if ($stmt = $conn->prepare("update user set IsDeleted = 1 where UserId = ?")) {
        $stmt->bind_param("i", $userId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

