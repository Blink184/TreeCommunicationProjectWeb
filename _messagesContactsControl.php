<link href="css/_messagesContactsControl.css" rel="stylesheet" type="text/css"/>
<link href="css/_messagesContactsControlRow.css" rel="stylesheet" type="text/css"/>
<div id="messagesContactsControl">
    <div id="innerDiv">
        <div id="header">
            <div>
                <input type="text" onkeyup="searchContacts(this.value)" placeholder="search..."/>
            </div><!--
         --><div>
                <div id="divCompose" onclick="sendMessage(null)">
                    <div>
                        Compose
                    </div>
                </div>
            </div>
        </div>
        <div id="body">
            <ul id="ulContacts">
                <li id="liLoadingContact">Loading...</li>
            </ul>
        </div>
    </div>
</div>
<?php
function addMessageRow($name, $img, $time, $lastMessage, $isRead){
    include '_messagesContactsControlRow.php';
}
?>