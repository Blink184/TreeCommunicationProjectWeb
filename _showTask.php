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
                                <li><label for="to">Assignee</label></li>
                                <li><div id="showTask_empNameFrom"></div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="title">Assigned To</label></li>
                                <li><div id="showTask_empNameTo"></div></li>
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
                    <button onclick="delegateTask()">Delegate</button>
                    <button onclick="cancelShowTask()">Cancel</button>
                    <button onclick="cancelShowTask()">Accept</button>
                </div>
            </div>
        </div>
    </div>
</div>