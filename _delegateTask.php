<link href="css/_delegateTask.css" rel="stylesheet" type="text/css"/>
<script src="js/_delegateTask.js"></script>
<div id="delegateTask">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                </div>
                <div id="body">
                    <span id="delegateTask_log"></span>
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">Delegate To </label></li>
                                <li>
                                    <select id="delegateTask_empNameTo">
                                    </select>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelDelegateTask()">Cancel</button>
                    <button id="delegateTask_btnAccept" onclick="submitDelegateTaskButton()">Accept</button>
                </div>
            </div>
        </div>
    </div>
</div>