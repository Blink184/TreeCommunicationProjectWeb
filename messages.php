<?php
/**
 * Created by PhpStorm.
 * User: Kirby
 * Date: 6/20/2016
 * Time: 12:45 AM
 */
?>
<html>
<head>
    <link href="css/global.css" rel="stylesheet" type="text/css"/>
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
                        Messages
                    </h2>
                </div>
            </li>
            <li id="liContent">
                <?php include '_messages.php';?>
            </li>
        </ul>
    </li>
</ul>
</body>
</html>
