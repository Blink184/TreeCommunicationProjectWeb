<link href="css/_addUser.css" rel="stylesheet" type="text/css"/>
<script src="js/_addUser.js"></script>
<div id="addUser">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>Add New User</h2>
                </div>
                <div id="body">
                    <span id="addUser_log"></span>
                    <ul>
                        <li>
                            <ul>
                                <li><label for="addUser_firstName">Firstname</label></li>
                                <li><input id="addUser_firstName" name="addUser_firstName" type="text"></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="addUser_lastName">Lastname</label></li>
                                <li><input id="addUser_lastName" name="addUser_lastName" type="text"></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="addUser_username">Username</label></li>
                                <li><input id="addUser_username" name="addUser_username" type="text"></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="addUser_password">Password</label></li>
                                <li><input id="addUser_password" name="addUser_password" type="text"></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelAddUser()">Cancel</button>
                    <button id="addUser_btnAdd" onclick="submitAddUser()">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>