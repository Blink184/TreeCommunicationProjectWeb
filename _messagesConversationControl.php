<link href="css/_messagesConversationControl.css" rel="stylesheet" type="text/css"/>
<link href="css/_messagesConversationControlRow.css" rel="stylesheet" type="text/css"/>
<div id="messagesConversationControl">
    <div id="innerDiv">
        <div id="header">
            <h2><span id="messagesConversationControl_contactName"></span></h2>
        </div>
        <div id="messages">
            <ul id="ulMessages">
            </ul>
        </div>
        <div id="form">
            <textarea id="messagesConversationControl_textArea" placeholder="Write here..."></textarea>
            <div id="buttons">
                <button>Attach</button>
                <button onclick="replyToContact();">Send</button>
            </div>
        </div>
    </div>
</div>
<style>

</style>
<?php
function addMessageConversationRow($isSender, $time, $message, $files = null){
    include '_messagesConversationControlRow.php';
}
?>