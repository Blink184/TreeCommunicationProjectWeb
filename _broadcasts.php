<link href="css/_broadcasts.css" rel="stylesheet" type="text/css"/>
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
        <div id="btnCompose">
            <span class="spanRight" onclick="sendBroadcast();">
                <img id="addBtnImg" src="resources/images/task/add_orange.svg"/>
                <span id="composeTxt">Compose</span>
            </span>
        </div>
    </div>
    <div id="divMid">

    </div>
<div id="contentDiv">
    <div id="broadcastMsgContainer">
        <ul>
            <li><?php include '_broadcastControl.html';?></li>
            <li><?php include '_broadcastControl.html';?></li>
            <li><?php include '_broadcastControl.html';?></li>
            <li><?php include '_broadcastControl.html';?></li>
            <li><?php include '_broadcastControl.html';?></li>
            <li><?php include '_broadcastControl.html';?></li>
        </ul>
    </div>
</div>
<?php include '_sendBroadcast.php';?>