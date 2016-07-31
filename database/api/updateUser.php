<?php

if(empty($_REQUEST['userId'])
    || empty($_REQUEST['firstName'])
    || empty($_REQUEST['lastName'])
    || empty($_REQUEST['username']))
{
    echo 'missing fields';
    return;
}

$userid = $_REQUEST['userId'];
$firstname = $_REQUEST['firstName'];
$lastname = $_REQUEST['lastName'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];
$username = $_REQUEST['username'];

$real_old_pass = json_decode(getUser($userid))->i->Password;

$is_old_password_wrong = false;
$change_password = false;
if(!empty($_REQUEST['oldPassword']) && !empty($_REQUEST['password'])){
    $change_password = true;
    if($real_old_pass != $_REQUEST['oldPassword']){
        $is_old_password_wrong = true;
    }
}

if(checkUsernameAvailability($userid, $username)){
    if($is_old_password_wrong) {
        echo '<script>alert("Wrong password");</script>';
    }else{
        if($change_password){
            $user_updated = updateUser($userid, $firstname, $lastname, $phone, $address, $username, $_REQUEST['password']);
        } else{
            $user_updated = updateUser($userid, $firstname, $lastname, $phone, $address, $username, $real_old_pass);
        }
        if($user_updated)
            echo '<script>console.log("User updated");</script>';
        else
            echo '<script>alert("Update failed");</script>';
    }
}else{
    echo '<script>alert("Username exists");</script>';
}



if(!empty($_FILES['file-input']['name'])){
    $name = $_POST["userId"].'_'.date('Y-m-d_H-i-s');
    $target_dir = "resources/images/employee/users/";
    $target_file = $target_dir . $name . '.';
    $uploadOk = 1;
    $imageFileType = pathinfo(basename($_FILES["file-input"]["name"]), PATHINFO_EXTENSION);
    $target_file .= $imageFileType;
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file-input"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file-input"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target_file)) {
            if(!updateUserImage($_POST["userId"], $name . '.' . $imageFileType))
                echo "image failed to upload";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>