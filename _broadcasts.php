<?php
$RECEIVEDBROADCAST = "RECEIVEDBROADCAST";
$SENTBROADCAST = "SENTBROADCAST";

function addBroadcastControl ($empName, $empRole, $timeReceived, $title, $msgContent, $type) {
    include '_broadcastControl.php';
}
?>
<link href="css/_broadcasts.css" rel="stylesheet" type="text/css"/>
<link href="css/_broadcastControl.css" rel="stylesheet" type="text/css"/>
<script src="js/_showBroadcast.js"></script>
<div id="divBroadcasts">
    <div id="divTop">
        <span class="spanLeft">
            <ul id="ulTopList">
                <li class="selected" onclick="selectType(this, RECEIVEDBROADCAST);">
                    Received
                </li>
                <li onclick="selectType(this, SENTBROADCAST);">
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
        <ul id="broadcastMsgContainerUl">

        </ul>
    </div>
</div>
<?php include '_sendBroadcast.php';?>
<?php include '_showBroadcast.php';?>
