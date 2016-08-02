<?php include 'sessionChecker.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '_includes.php';?>
        <script src="js/broadcasts.js"></script>
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
                                BROADCASTS
                            </h2>
                        </div>
                    </li>
                    <li id="liContent">
                        <?php include '_broadcasts.php';?>
                    </li>
                </ul>
            </li>
        </ul>
        <?php include '_extraIncludes.php';?>
    </body>
</html>
