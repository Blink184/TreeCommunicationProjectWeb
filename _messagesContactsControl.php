<link href="css/_messagesContactsControl.css" rel="stylesheet" type="text/css"/>
<div id="messagesContactsControl">
    <div id="innerDiv">
        <div>
            <div>
                <input type="text" onkeyup="search(this.value)" placeholder="search..."/>
            </div><!--
         --><div>
                <div id="divCompose">
                    <div>
                        Compose
                    </div>
                </div>
            </div>
        </div>
        <div>
            <ul id="ulContacts">
                <li><?php addMessageRow("Ahmad Hammoud", "pp_tm.PNG", "5 mins ago", "Is this the place we used to love? is this the place that I have been dreaming of", false);?></li>
                <li><?php addMessageRow("Aynur Ajami", "pp_ws.PNG", "5 mins ago", "ensa", false);?></li>
                <li><?php addMessageRow("Azzam Mourad", "pp_sc.PNG", "5 mins ago", "So what's the progress?", true);?></li>
                <li><?php addMessageRow("Jon Snow", "pp_jl.jpg", "5 mins ago", "The army is ready", true);?></li>
            </ul>
        </div>
    </div>
<div>
<?php
function addMessageRow($name, $img, $time, $lastMessage, $isRead){
    include '_messagesContactsControlRow.php';
}
?>