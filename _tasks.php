<link href="css/_tasks.css" rel="stylesheet" type="text/css"/>
<div id="divTasks">
    <div id="divTop">
        <span class="spanLeft">
            <img/>
            <span class="spanImgDescription">
                Add Task
            </span>
        </span>
        <span class="spanRight">
            <ul id="ulTopList">
                <li>
                    <img/>
                    All
                </li>
                <li>
                    <img/>
                    Assign
                </li>
                <li>
                    <img/>
                    In Progress
                </li>
                <li>
                    <img/>
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