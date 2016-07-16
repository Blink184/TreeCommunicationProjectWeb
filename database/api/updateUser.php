<?php

include dirname(__DIR__).'../user.php';

if(empty($_REQUEST['userId'])
    || empty($_REQUEST['firstName'])
    || empty($_REQUEST['lastName'])
    || empty($_REQUEST['address'])
    || empty($_REQUEST['phone']))
{
    echo 'missing parameters';
    return;
}

$userid = $_REQUEST['userId'];
$firstname = $_REQUEST['firstName'];
$lastname = $_REQUEST['lastName'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];

if(updateUser($userid, $firstname, $lastname, $phone, $address))
    echo '<script>console.log("user updated");</script>';
else
    echo '<script>console.log("updated failed");</script>';


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