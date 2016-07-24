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
                    <span id="sentBroadcast_log"></span>
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">To</label></li>
                                <li>
                                    <select id="to" onchange="sendBroadcastToSelectionChanged(this.value);">
                                        <option value="0">All</option>
                                        <option value="1">Children</option>
                                        <option value="2">Custom</option>
                                    </select>
                                </li>
                            </ul>
                        </li>
                        <li id="liCustom">
                            <ul>
                                <li><label for="toCustom">Custom</label></li>
                                <li>
                                    <select id="toCustom" multiple="multiple">
                                        <?php
                                        include "database/userRole.php";
                                        $res = json_decode(getUserRoles())->i;
                                        for($i = 0; $i < sizeof($res); $i++){
                                            echo "<option value='".$res[$i]->UserRoleId."'>".$res[$i]->FirstName." ".$res[$i]->LastName." [".$res[$i]->Role."]</option>";
                                        }
                                        ?>
<!--                                        <option>Aynur Ajami</option>-->
<!--                                        <option>Ahmad Hammoud</option>-->
<!--                                        <option>Azzam Mourad</option>-->
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
                    <button onclick="closeSendBroadcast()">Close</button>
                    <button onclick="">Attach</button>
                    <button id="btnSubmitSendBroadcast" onclick="submitSendBroadcast()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>