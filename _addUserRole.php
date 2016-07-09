<link href="css/_addUserRole.css" rel="stylesheet" type="text/css"/>
<script src="js/_addUserRole.js"></script>
<div id="addUserRole">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>Add New Child</h2>
                </div>
                <div id="body">
                    <span id="addUserRole_log"></span>
                    <ul>
                        <li>
                            <ul>
                                <li><label for="addUserRole_role">Role</label></li>
                                <li><select name="addUserRole_role" id="addUserRole_role"></select></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="addUserRole_user">User</label></li>
                                <li><select name="addUserRole_user" id="addUserRole_user"></select></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="addUserRole_title">Title</label></li>
                                <li><input id="addUserRole_title" name="addUserRole_title" type="text"></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelAddUserRole()">Cancel</button>
                    <button id="addUserRole_btnAdd" onclick="submitAddUserRole()">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>