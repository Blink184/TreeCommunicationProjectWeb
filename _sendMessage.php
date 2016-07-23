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
                                    <select name="sendMessage_to" id="addUserRole_role">
                                        <?php
                                        include "database/userRole.php";
                                        $res = json_decode(getUserRoles())->i;
                                        for($i = 0; $i < sizeof($res); $i++){
//                                            echo "<option value=''>$res[$i]->FirstName</option>";
                                        }
                                        ?>
                                    </select>
                                </li>
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