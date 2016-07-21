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
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $SENTBROADCAST);?></li>
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $SENTBROADCAST);?></li>
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $SENTBROADCAST);?></li>
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $SENTBROADCAST);?></li>
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $SENTBROADCAST);?></li>
            <li><?php addBroadcastControl("Aynur Ajami", "Head of Department", "20 minutes ago", "Hi", "I am testing
            this new fantastic application!", $RECEIVEDBROADCAST);?></li>
            <li><?php addBroadcastControl("Ahmad Hammoud", "IT Administrator", "1 day ago", "Information", "Do not
            share your passwords.", $RECEIVEDBROADCAST);?></li>
            <li><?php addBroadcastControl("Jack Black", "Guitarist", "3 hours ago", "New Solo", "Check out my new solo.", $RECEIVEDBROADCAST);?></li>
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $RECEIVEDBROADCAST);?></li>
            <li><?php addBroadcastControl("Jared Leto", "Singer", "5 minutes ago", "Gentle Reminder", "Don't
            forget our meeting at 5 pm", $RECEIVEDBROADCAST);?></li>
            <li><?php addBroadcastControl("Azzam Mourad", "Head of IT", "55 minutes ago", "Congratulations!", "Well done!
                You are now proud members of Batikha Inc. This is a very long broadcast, read it carefully please. I want you to be more serious about what happened yesterday", $RECEIVEDBROADCAST);?></li>
        </ul>
    </div>
</div>
<?php include '_sendBroadcast.php';?>
<?php include '_showBroadcast.php';?>
