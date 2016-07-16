<?php
if(isset($_REQUEST['updateUserForm'])){
    include 'database/api/updateUser.php';
}
?>
<link href="css/_showEmployeeProfile.css" rel="stylesheet" type="text/css"/>
<script src="js/_showEmployeeProfile.js"></script>
<div id="showEmployeeProfile">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <form method="post" enctype="multipart/form-data">
                    <div id="header">
                        <label for="file-input" style="cursor: pointer">
                            <img id="showEmployeeProfile_image" src="resources/images/1.jpg"/>
                        </label>
                        <br>
                        <input style="color:black" id="file-input" name="file-input" type="file"/>
                    </div>
                    <div id="body">
                        <span id="showEmployeeProfile_log"></span>
                        <input type="hidden" name="userId" id="showEmployeeProfile_userId" value=""/>
                        <ul>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_firstName">First Name</label></li>
                                    <li><input type="text" id="showEmployeeProfile_firstName" name="firstName"/></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_lastName">Last Name</label></li>
                                    <li><input type="text" id="showEmployeeProfile_lastName" name="lastName"/></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_address">Address</label></li>
                                    <li><input type="text" id="showEmployeeProfile_address" name="address"/></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_phone">Number</label></li>
                                    <li><input type="text" id="showEmployeeProfile_phone" name="phone"/></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_lastActiveDate">Last Active Date</label></li>
                                    <li><div id="showEmployeeProfile_lastActiveDate">26/6/2016</div></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="footer">
                        <button type="button" onclick="cancelShowEmployeeProfile()">Close</button>
                        <button type="submit" name="updateUserForm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>