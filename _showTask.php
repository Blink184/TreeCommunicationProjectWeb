<link href="css/_showTask.css" rel="stylesheet" type="text/css"/>
<script src="js/_showTask.js"></script>
<div id="showTask">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>This is a title</h2>
                </div>
                <div id="body">
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">Assignee</label></li>
                                <li><div>Azzam Mourad</div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="title">Assigned To</label></li>
                                <li><div>Jared Leto</div></li>
                            </ul>
                        </li>
                        <li class="liTextArea">
                            <ul>
                                <li><label for="description">Description</label></li>
                                <li><div>This is the description of this task. This is the description of this task. This is the description of this task. This is the description of this task.</div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="attachments">Attachments</label></li>
                                <li><div><a href="">Image01.png</a> | <a href="">document01.doc</a></div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="startDate">Start Date</label></li>
                                <li><div>24/6/2016</div></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="dueDate">Due Date</label></li>
                                <li><div>26/6/2016</div></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelShowTask()">Cancel</button>
                    <button onclick="cancelShowTask()">Accept</button>
                </div>
            </div>
        </div>
    </div>
</div>