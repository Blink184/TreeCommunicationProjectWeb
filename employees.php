<?php
if(isset($_REQUEST['updateUserForm'])){
    include 'database/user.php';
    include 'database/api/updateUser.php';
}
include 'sessionChecker.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include '_includes.php';?>
        <script src="js/employees.js"></script>
    </head>
    <body>
        <ul id="ulMain">
            <li id="liLeft">
                <?php include '_menu.php';?>
            </li>
            <li id="liRight">
                <ul class="inline-block">
                    <li id="liHeader">
                        <?php include '_header.php';?>
                    </li>
                    <li id="liTitle">
                        <div>
                            <h2>
                                E-Tree
                            </h2>
                        </div>
                        <?php
                            if($LOGGED_IN_USER_ROLE_IS_MASTER == '1'){
                                echo
                                    '<button class="showOnTreeEdit" onclick="addUser();">
                                        Add User
                                    </button>
                                    <button class="showOnTreeEdit" onclick="addRole();">
                                        Add Role
                                    </button>
                                    <button class="showOnTreeEdit" onclick="showUsers();">
                                        Show Users
                                    </button>
                                    <button class="showOnTreeEdit" onclick="showRoles();">
                                        Show Roles
                                    </button>
                                    <button id="btnEditTree" style="float: right; margin: 13px 4px 0 0;" onclick="editTree()">
                                        Allow Edit
                                    </button>'
                                ;
                            }else{
                                echo '<script>VIEW = 2;</script>';
                            }
                        ?>
                    </li>
                    <li id="liContent">
                        <?php include '_employees.php';?>
                    </li>
                </ul>
            </li>
        </ul>
    </body>
</html>
