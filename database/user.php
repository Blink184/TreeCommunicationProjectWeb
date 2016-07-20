<?php

require 'connection.php';

function insertUser($firstname, $lastname, $username, $password, $phone, $address, $email, $isAdmin, $lastActiveDate, $isLoggedIn, $isBanned, $isDeleted){
    if(!usernameExists($username)){
        $q = "INSERT INTO user (FirstName, LastName, Username, Password, Phone, Address, Email, IsAdmin, LastActiveDate, IsLoggedIn, IsBanned, IsDeleted) VALUES ('$firstname', '$lastname', '$username', '$password', '$phone', '$address', '$email', $isAdmin, '$lastActiveDate', $isLoggedIn, $isBanned, $isDeleted)";
        return encode(execute($q), '');
    }else{
        return encode(false, 'username exists');
    }
}

function validateUser($username, $password) {
    $q = "select u.*, ur.UserRoleId, r.IsMaster from user u, userrole ur, role r where ur.UserId = u.UserId and ur.RoleId = r.RoleId and u.Username ='$username' and BINARY u.Password = '$password'";
    $res = execute($q);
    if(any($res)){
        return encode(true, firstRow($res));
    }
    return encode(false, 'invalid username/password');
}

function getUsers(){
    $q = "select * from user where IsDeleted = 0 and IsAdmin = 0 ORDER BY FirstName, LastName";
    $tmp = execute($q);
    $users = array();
    while ($row = $tmp->fetch_assoc()) {
        array_push($users, $row);
    }
    $users = json_encode($users);
    return encode(true, $users);
}

function getUser($id){
    $q = "select * from user where UserId = $id";
    return execute($q);
}
function getUserByUsername($username){
    $q = "select * from user where Username = '$username' and IsDeleted = 0";
    return execute($q);
}
function usernameExists($username){
    return any(getUserByUsername($username));
}

function updateUser($userId, $firstname, $lastname, $phone, $address){
    $q = "update user set FirstName = '$firstname', LastName = '$lastname', Phone = '$phone', Address = '$address' where UserId = $userId";
    return execute($q);
}
function updateUserImage($userId, $image){
    $q = "update user set Image = '$image' where UserId = $userId";
    return execute($q);
}

