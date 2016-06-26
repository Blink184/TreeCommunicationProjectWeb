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
                                <li><input id="to" name="sendMessage_to" type="text"></li>
                            </ul>
                        </li>
                        <li class="liTextArea">
                            <ul>
                                <li><label for="message">Message</label></li>
                                <li><textarea id="message" type="text"></textarea></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelSendMessage()">Cancel</button>
                    <button onclick="cancelSendMessage()">Attach</button>
                    <button onclick="cancelSendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>