<link href="css/_employees.css" rel="stylesheet" type="text/css"/>
<link href="css/_employeeControl.css" rel="stylesheet" type="text/css"/>
<div id="divEmployee">
    <div id="divBot">
        <div id="employeeControlContainer">
        </div>
    </div>
</div>
<?php include '_addTask.php';?>
<?php include '_sendMessage.php';?>
<?php include '_showEmployeeProfile.php';?>
<?php include '_addUser.php';?>
<?php function addEmployeeControl($name, $img, $title, $isOpened = false){
    include '_employeeControl.php';
}