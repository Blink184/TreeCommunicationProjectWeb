<link href="css/_showTask.css" rel="stylesheet" type="text/css"/>
<script src="js/_showTask.js"></script>
<div id="showTask">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2 id="showTask_title"></h2>
                </div>
                <div id="body">
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">From</label></li>
                                <li><div id="showTask_empNameFrom"></div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="title">To</label></li>
                                <li><div id="showTask_empNameTo"></div></li>
                            </ul>
                        </li>
                        <li id="showTask_liDelegatedTo">
                            <ul>
                                <li><label for="showTask_delegatedTo">Delegated To</label></li>
                                <li><div id="showTask_delegatedTo"></div></li>
                            </ul>
                        </li>
                        <li class="liTextArea">
                            <ul>
                                <li><label for="description">Description</label></li>
                                <li><div id="showTask_description"></div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="attachments">Attachments</label></li>
                                <li><div id="showTask_attachments"></div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="startDate">Start Date</label></li>
                                <li><div id="showTask_startDate"></div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="dueDate">Due Date</label></li>
                                <li><div id="showTask_dueDate"></div></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button id="showTask_btnDelegate" onclick="delegateTask()">Delegate</button>
                    <button id="showTask_btnCancel" onclick="closeShowTask()">Close</button>
                    <button id="showTask_btnSubmit" onclick="submitBtnEvent()">Accept</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '_delegateTask.php';?>
<!--hi-->
