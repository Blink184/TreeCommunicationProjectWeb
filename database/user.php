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

function getUsers(){
    $q = "select * from user where IsDeleted = 0 and IsAdmin = 0";
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
