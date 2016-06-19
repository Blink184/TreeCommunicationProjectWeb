<?php
/**
 * Created by PhpStorm.
 * User: Kirby
 * Date: 6/19/2016
 * Time: 3:20 PM
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
                        Broadcast
                    </h2>
                </div>
            </li>
            <li id="liContent">
                <?php include '_broadcast.php';?>
            </li>
        </ul>
    </li>
</ul>
</body>
</html>
