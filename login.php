<?php
/**
 * Created by PhpStorm.
 * User: Kirby
 * Date: 7/1/2016
 * Time: 1:35 AM
 */
?>
<link href="css/login.css" rel="stylesheet" type="text/css"/>
<script src="js/login.js"></script>
<div id="loginMain">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <img id="treeLeftImg" src="resources/images/tree_left.png"/>
                    <img id="treeRightImg" src="resources/images/tree_right.png"/>
                    <div id="middleHeader">
                        <img id="treeMidImg" src="resources/images/global/tree_logo.svg"/>
                        <h3>Tree Communication</h3>
                    </div>
                </div>
                <div id="body">
                    <ul>
                        <li>
                            <ul>
                                <li><img id="usernameImg" src="resources/images/user.png"/> </li>
                                <li>
                                    <input id="username" placeholder="Username" type="text"/>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><img id="lockImg" src="resources/images/lock.png"/> </li>
                                <li>
                                    <input id="password" placeholder="Password" type="password"/>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li>
                                    <input id="keepSignedInCB" type="checkbox"/>Keep me signed in
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="goToEmployeesPage();">Sign in</button>
                    <br>
                    <br>
                    <a href="" for="forgotPassword">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
