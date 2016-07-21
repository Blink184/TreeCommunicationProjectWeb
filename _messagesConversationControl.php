<link href="css/_messagesConversationControl.css" rel="stylesheet" type="text/css"/>
<link href="css/_messagesConversationControlRow.css" rel="stylesheet" type="text/css"/>
<div id="messagesConversationControl">
    <div id="innerDiv">
        <div id="header">
            <h2><span id="messagesConversationControl_contactName">Conversation with Ahmad Hammoud</span></h2>
        </div>
        <div id="messages">
            <ul id="ulMessages">
                <li><?php addMessageConversationRow(true, "2012-12-12 12:00pm", "hi, let's hang out sometime and drink coffee, it's on me");?></li>
                <li><?php addMessageConversationRow(false, "2011-12-12 14:00pm", "okay, thank you, I'll check my schedule.");?></li>
                <li><?php addMessageConversationRow(true, "2012-12-12 12:00pm", "I sent you the files.", "<a href=''>Document1.doc</a> | <a href=''>Document2.doc</a>");?></li>
            </ul>
        </div>
        <div id="form">
            <textarea placeholder="Write here..."></textarea>
            <div id="buttons">
                <button>Attach</button>
                <button>Send</button>
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