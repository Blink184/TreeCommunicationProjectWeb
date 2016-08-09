<link href="css/_showEmployeeProfile.css" rel="stylesheet" type="text/css"/>
<script src="js/_showEmployeeProfile.js"></script>
<div id="showEmployeeProfile">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <form method="post" enctype="multipart/form-data">
                    <div id="header">
                        <label>
                            <img id="showEmployeeProfile_image" src="resources/images/1.jpg"/>
                        </label>
                        <br>
                        <input style="color:black; max-width:270px;" id="file-input" name="file-input" type="file"/>
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
                                    <li><label for="showEmployeeProfile_phone">Number</label></li>
                                    <li><input type="text" id="showEmployeeProfile_phone" name="phone"/></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_email">Email</label></li>
                                    <li><input type="text" id="showEmployeeProfile_email" name="email"/></li>
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
                                    <li><label for="showEmployeeProfile_username">Username</label></li>
                                    <li><input type="text" id="showEmployeeProfile_username" name="username"/></li>
                                </ul>
                            </li>
                            <li id="showEmployeeProfile_liPassword">
                                <ul>
                                    <li><label for="showEmployeeProfile_password">Password</label></li>
                                    <li><input type="password"  onkeyup="newPasswordChanged(this.value)" id="showEmployeeProfile_password" name="password"/></li>
                                </ul>
                            </li>
                            <li id="showEmployeeProfile_liOldPassword">
                                <ul>
                                    <li><label for="showEmployeeProfile_oldPassword">Old Password</label></li>
                                    <li><input type="password" id="showEmployeeProfile_oldPassword" name="oldPassword"/></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><label for="showEmployeeProfile_lastActiveDate">Last Active Date</label></li>
                                    <li><input type="text" id="showEmployeeProfile_lastActiveDate" value="26/6/2016" disabled/></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="footer">
                        <button type="button" onclick="cancelShowEmployeeProfile()">Close</button>
                        <button type="submit" id="showEmployeeProfile_submitButton" name="updateUserForm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>