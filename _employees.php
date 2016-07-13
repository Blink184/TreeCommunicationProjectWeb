<?php
if(isset($_POST["userId"])) {
    echo $_POST["userId"];
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
            include 'database/user.php';
            if(updateUserImage($_POST["userId"], $name . '.' . $imageFileType))
                echo "image updated";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>




<link href="css/_employees.css" rel="stylesheet" type="text/css"/>
<link href="css/_employeeControl.css" rel="stylesheet" type="text/css"/>
<div id="divEmployee">
    <div align="right">
        <input type="checkbox" id="cbEditTree" onclick="editTree()"/>
    </div>

    <div id="divBot">
        <div id="employeeControlContainer">
        </div>
    </div>
</div>
<?php include '_addTask.php';?>
<?php include '_sendMessage.php';?>
<?php include '_showEmployeeProfile.php';?>
<?php include '_addUser.php';?>
<?php include '_addRole.php';?>
<?php include '_addUserRole.php';?>
<?php function addEmployeeControl($name, $img, $title, $isOpened = false){
    include '_employeeControl.php';
}