<link href="css/_messages.css" rel="stylesheet" type="text/css"/>
<div id="divMessages">
    <ul>
        <li>
            <div id="contacts">
                <?php include "_messagesContactsControl.php";?>
            </div>
        </li>
        <li>
            <div id="conversation">
                <?php include "_messagesConversationControl.php";?>
            </div>
        </li>
    </ul>
</div>
<?php include '_sendMessage.php';?>
