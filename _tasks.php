<?php
$NEW = "NEW";
$INPROGRESS = "INPROGRESS";
$FINISHED = "FINISHED";
$MYTASK = "MYTASK";
$RECEIVEDREQUEST = "RECEIVEDREQUEST";
$SENTREQUEST = "SENTREQUEST";
function addTaskControl($name, $title, $content, $type, $status){
    include '_taskControl.php';
}
?>
<link href="css/_tasks.css" rel="stylesheet" type="text/css"/>
<div id="divTasks">
    <div id="divTop">
        <span class="spanLeft" onclick="addTask();">
            <img src="resources/images/task/add_orange.svg"/>
            Add Task
        </span>
        <span class="spanRight">
            <ul id="ulTopList">
                <li class="selected" onclick="selectStatus(this, ALL)">
                    <img src="resources/images/task/all_tasks.svg"/>
                    All
                </li>
                <li onclick="selectStatus(this, NEW)">
                    <img src="resources/images/task/new.svg"/>
                    New
                </li>
                <li onclick="selectStatus(this, INPROGRESS)">
                    <img src="resources/images/task/in_progress.svg"/>
                    In Progress
                </li>
                <li onclick="selectStatus(this, FINISHED)">
                    <img src="resources/images/task/finished.svg"/>
                    Finished
                </li>
            </ul>
        </span>
    </div>
    <div id="divMid">
        <span class="spanLeft">
            <ul id="ulMidList">
                <li class="selected" onclick="selectType(this, MYTASK);">
                    My Tasks
                </li>
                <li onclick="selectType(this, RECEIVEDREQUEST);">
                    Received Requests
                </li>
                <li onclick="selectType(this, SENTREQUEST);">
                    Sent Requests
                </li>
            </ul>
        </span>
        <span class="spanRight">
            <input type="text" onkeyup="search(this.value)" placeholder="search..."/>
        </span>
    </div>
    <div id="divBot">
        <div id="taskControlsContainer">
            <link href="css/_taskControl.css" rel="stylesheet" type="text/css"/>
            <ul id="taskControlsUl">
            </ul>
        </div>
    </div>
</div>
<?php include '_addTask.php';?>
<?php include '_showTask.php';?>