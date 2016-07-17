<?php include '_preHtmlTag.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '_includes.html';?>
        <script src="js/employees.js"></script>
    </head>
    <body>
        <ul id="ulMain">
            <li id="liLeft">
                <?php include '_menu.html';?>
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

                        <button class="showOnTreeEdit" onclick="addUser();">
                            Add User
                        </button>
                        <button class="showOnTreeEdit" onclick="addRole();">
                            Add Role
                        </button>
                        <button id="btnEditTree" style="float: right; margin: 13px 4px 0 0;" onclick="editTree()">
                            Allow Edit
                        </button>
                    </li>
                    <li id="liContent">
                        <?php include '_employees.php';?>
                    </li>
                </ul>
            </li>
        </ul>
    </body>
</html>
