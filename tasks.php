<?php include '_preHtmlTag.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '_includes.html';?>
        <script src="js/tasks.js"></script>
    </head>
    <body>
        <ul id="ulMain">
            <li id="liLeft">
                <?php include '_menu.html';?>
            </li>
            <li id="liRight">
                <ul>
                    <li id="liHeader">
                        <?php include '_header.php';?>
                    </li>
                    <li id="liTitle">
                        <div>
                            <h2>
                                TASKS
                            </h2>
                        </div>
                    </li>
                    <li id="liContent">
                        <?php include '_tasks.php';?>
                    </li>
                </ul>
            </li>
        </ul>
    </body>
</html>
