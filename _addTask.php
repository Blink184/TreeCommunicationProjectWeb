<link href="css/_addTask.css" rel="stylesheet" type="text/css"/>
<script src="js/_addTask.js"></script>
<div id="addTask">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div id="header">
                    <h2>Add New Task</h2>
                </div>
                <div id="body">
                    <ul>
                        <li>
                            <ul>
                                <li><label for="to">To</label></li>
                                <li><input id="to" name="addTask_to" type="text"></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="title">Title</label></li>
                                <li><input id="title" type="text"></li>
                            </ul>
                        </li>
                        <li class="liTextArea">
                            <ul>
                                <li><label for="description">Description</label></li>
                                <li><textarea id="description" type="text"></textarea></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><label for="dueDate">Due Date</label></li>
                                <li><input id="dueDate" type="text"></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="footer">
                    <button onclick="cancelAddTask()">Cancel</button>
                    <button onclick="cancelAddTask()">Attach</button>
                    <button onclick="cancelAddTask()">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>