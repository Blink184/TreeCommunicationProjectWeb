<link href="css/_addRole.css" rel="stylesheet" type="text/css"/>
<script src="js/_addRole.js"></script>
<div id="addRole">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>Add New Role</h2>
                </div>
                <div id="body">
                    <span id="addRole_log"></span>
                    <ul>
                        <li>
                            <ul>
                                <li><label for="addRole_description">Description</label></li>
                                <li><input id="addRole_description" name="addRole_description" type="text"></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="addRole_isMaster">Master</label></li>
                                <li><input id="addRole_isMaster" name="addRole_isMaster" type="checkbox"></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelAddRole()">Cancel</button>
                    <button id="addRole_btnAdd" onclick="submitAddRole()">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>