<!DOCTYPE html>
<!--/**-->
<!--* Created by PhpStorm.-->
<!--* User: Kirby-->
<!--* Date: 6/16/2016-->
<!--* Time: 11:27 PM-->
<!--*/-->
<html lang="en">
<head>
    <link href="css/_broadcast.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="divBroadcasts">
    <div id="divTop">
        <span class="spanLeft">
            <ul id="ulTopList">
                <li>
                    Received
                </li>
                <li>
                    Sent
                </li>
            </ul>
        </span>
        <span class="spanRight">
            <button id="compose">Compose</button>
        </span>
    </div>
    <div id="divMid">

    </div>
<div id="contentDiv">
    <?php include '_broadcastMsg.html';?>
</div>
</body>
</html>
