<link href="css/_sendMessage.css" rel="stylesheet" type="text/css"/>
<script src="js/_sendMessage.js"></script>
<div id="sendMessage">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>Send a Message</h2>
                </div>
                <div id="body">
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">To</label></li>
                                <li>
                                    <select name="sendMessage_to" id="sendMessage_to"></select>
                                </li>
                            </ul>
                        </li>
                        <li class="liTextArea">
                            <ul>
                                <li><label for="message">Message</label></li>
                                <li><textarea id="sendMessage_textArea" type="text"></textarea></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelSendMessage()">Cancel</button>
                    <button onclick="">Attach</button>
                    <button id="sendMessage_submitButton" onclick="submitSendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>