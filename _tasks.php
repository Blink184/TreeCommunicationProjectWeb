<link href="css/_tasks.css" rel="stylesheet" type="text/css"/>
<div id="divTasks">
    <div id="divTop">
        <span class="spanLeft">
            <img src="resources/images/task/add_orange.svg"/>
            Add Task
        </span>
        <span class="spanRight">
            <ul id="ulTopList">
                <li>
                    <img src="resources/images/task/all_tasks.svg"/>
                    All
                </li>
                <li>
                    <img src="resources/images/task/assign_white.svg"/>
                    Assign
                </li>
                <li>
                    <img src="resources/images/task/in_progress.svg"/>
                    In Progress
                </li>
                <li>
                    <img src="resources/images/task/finished.svg"/>
                    Finished
                </li>
            </ul>
        </span>
    </div>
    <div id="divMid">
        <span class="spanLeft">
            <ul id="ulMidList">
                <li>
                    My Tasks
                </li>
                <li>
                    Received Requests
                </li>
                <li>
                    Sent Requests
                </li>
            </ul>
        </span>
        <span class="spanRight">
            <input type="text" placeholder="search..."/>
        </span>
    </div>
    <div id="divBot">
        <div id="taskControlsContainer">
            <link href="css/_taskControl.css" rel="stylesheet" type="text/css"/>
            <ul>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
                <li><?php include '_taskControl.html';?></li>
            </ul>
        </div>
    </div>
</div>