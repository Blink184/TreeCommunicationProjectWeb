<link href="css/_sendBroadcast.css" rel="stylesheet" type="text/css"/>
<script src="js/_sendBroadcast.js"></script>
<div id="sendBroadcast">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>Compose Broadcast</h2>
                </div>
                <div id="body">
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">To</label></li>
                                <li>
                                    <select id="to">
                                        <option>All</option>
                                        <option>Children</option>
                                        <option>Custom</option>
                                        <!--if custom is selected, this widget should appear-->
                                        <!--http://www.erichynds.com/examples/jquery-ui-multiselect-widget/demos/#filter-->
                                    </select>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="title">Title</label></li>
                                <li><input id="title" name="sendBroadcast_title" type="text"></li>
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
                    <button onclick="cancelSendBroadcast()">Cancel</button>
                    <button onclick="cancelSendBroadcast()">Attach</button>
                    <button onclick="cancelSendBroadcast()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>