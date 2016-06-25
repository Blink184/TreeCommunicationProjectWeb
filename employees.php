<?php
/**
 * Created by PhpStorm.
 * User: ahmad hammoud
 * Date: 6/16/2016
 * Time: 10:26 PM
 */
?>
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
                        <?php include '_header.html';?>
                    </li>
                    <li id="liTitle">
                        <div>
                            <h2>
                                EMPLOYEES
                            </h2>
                        </div>
                    </li>
                    <li id="liContent">
                        <?php include '_employees.php';?>
                    </li>
                </ul>
            </li>
        </ul>
    </body>
</html>