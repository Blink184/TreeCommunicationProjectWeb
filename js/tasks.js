var ALL = "ALL";
var NEW = "NEW";
var INPROGRESS = "INPROGRESS";
var FINISHED = "FINISHED";
var MYTASK = "MYTASK";
var RECEIVEDREQUEST = "RECEIVEDREQUEST";
var SENTREQUEST = "SENTREQUEST";

var SELECTEDSTATUS;
var SELECTEDTYPE;
var SEARCH;
var TASKS = [];

window.onload = function () {
    setSelectedTab('tabTask');
    loadTasks();
    setDateTimePicker('.datetimepicker');

    SELECTEDTYPE = MYTASK;
    SELECTEDSTATUS = ALL;
    SEARCH = "";

};

function search(value){
    SEARCH = value.trim();
    filterTasks();
}

function isSearching(){
    return SEARCH.length > 0;
}

function matchSearch(object){
    var textNodes = textNodesUnder(object);
    for(var i = 0; i < textNodes.length; i++){
        if(textNodes[i].data.trim().toLowerCase().indexOf(SEARCH.toLowerCase()) > -1){
            return true;
        }
    }
    return false;
}

function textNodesUnder(node){
    var all = [];
    for (node=node.firstChild;node;node=node.nextSibling){
        if (node.nodeType==3) all.push(node);
        else all = all.concat(textNodesUnder(node));
    }
    return all;
}

function selectType(object, type){
    setSelectedType(object, type);
    filterTasks();
}
function selectStatus(object, status){
    setSelectedStatus(object, status);
    filterTasks();
}

function filterTasks(){
    var elements = document.getElementsByClassName('divTaskControl');
    for(var i = 0; i < elements.length; i++){
        var elementType = elements[i].getAttribute('data-type');
        var elementStatus = elements[i].getAttribute('data-status');
        if(elementType == SELECTEDTYPE && (ALL == SELECTEDSTATUS || elementStatus == SELECTEDSTATUS)){
            if(isSearching() && !matchSearch(elements[i])){
                elements[i].style.display = "none";
            }else{
                elements[i].style.display = "inline-block";
            }
        }else{
            elements[i].style.display = "none";
        }
    }
}

function setSelectedType(object, type){
    var lis = object.parentNode.childNodes;
    for(var i = 0; i < lis.length; i++){
        lis[i].className = "";
    }
    object.className = "selected";
    SELECTEDTYPE = type;
}
function setSelectedStatus(object, status){
    var lis = object.parentNode.childNodes;
    for(var i = 0; i < lis.length; i++){
        lis[i].className = "";
    }
    object.className = "selected";
    SELECTEDSTATUS = status;
}

function task (taskid, toUserRole, toUserRoleId, fromUserRole, fromUserRoleId, delegatedToUserRole, delegatedToUserRoleId, taskTitle, content, type, status, startdate, duedate) {
    var task = {
        TaskId: taskid,
        ToUserRole: toUserRole,
        ToUserRoleId: toUserRoleId,
        FromUserRole: fromUserRole,
        FromUserRoleId: fromUserRoleId,
        DelegatedToUserRole: delegatedToUserRole,
        DelegatedToUserRoleId: delegatedToUserRoleId,
        TaskTitle: taskTitle,
        Content: content,
        Type: type,
        Status: status,
        StartDate: startdate,
        DueDate: duedate
    };
    return task;
}
function onAddTaskPopupClosed(){
    loadTasks();
}
function loadTasks() {
    getTasks();
}

function getTasks() {
    var res = [];
    $.post("database/api/getTasks.php",
        {
            userroleid: LOGGEDUSERROLEID
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)) {
                    res = jsonData(data);
                    TASKS = [];
                    for(var i = 0; i < res.length; i++){
                        var o = res[i];

                        var type;
                        if(o.DelegatedToUserRoleId != null && o.FromUserRoleId == LOGGEDUSERROLEID){
                            type = SENTREQUEST;
                        }
                        else if(o.FromUserRoleId == o.ToUserRoleId){
                            type = MYTASK;
                        }else if(o.FromUserRoleId == LOGGEDUSERROLEID){
                            type = SENTREQUEST;
                        }else {
                            type = RECEIVEDREQUEST;
                        }

                        var status;
                        if(o.TaskState == 1){
                            status = NEW;
                        }else if(o.TaskState == 2){
                            status = INPROGRESS;
                        }else if(o.TaskState == 3){
                            status = FINISHED;
                        }

                        TASKS.push(task(o.TaskId, o.ToUserRole, o.ToUserRoleId, o.FromUserRole, o.FromUserRoleId, o.DelegatedToUserRole, o.DelegatedToUserRoleId, o.Title, o.Description, type, status, o.StartDate, o.DueDate));
                        extractArrayTasks();
                    }
                } else {
                    console.log(data)
                }
            }else{
                console.log(status)
            }
        }
    );
}


function extractArrayTasks() {
    var taskContainer = document.getElementById("taskControlsUl");
    var data = getData(TASKS);
    taskContainer.innerHTML = data;

    filterTasks();
}

function getData(tasks) {
    var tmp = '';
    for(var i=0; i< tasks.length; i++) {
        tmp += parseTask(tasks[i]);
    }
    return tmp;
}

function parseTask(task) {
    var type = "";
    var img ='';

    if (task.Status == NEW) {
        img = '<img src="resources/images/task/new_blue.svg"/>';
    } else if (task.Status == INPROGRESS) {
        img = '<img src="resources/images/task/in_progress_blue.svg"/>';
    } else if (task.Status == FINISHED) {
        img = '<img src="resources/images/task/finished_blue.svg"/>';
    }

    var header;
    if(task.DelegatedToUserRoleId == null){
        header = task.Type == SENTREQUEST ? task.ToUserRole : task.FromUserRole;
    }else{
        header = task.DelegatedToUserRole;
    }

    var tmp = '<li>'
                +'<div class="divTaskControl" onclick="displayTask('
                +task.TaskId
                +')" data-type="'
                +task.Type
                +'" data-status="'
                +task.Status
                +'">'
                +'<div class="header">'
                +header
                +'</div>'
                +'<div class="statusImage">'
                +img
                +'</div>'
                +'<div class="body">'
                +'<div class="title">'
                +'<img src="resources/images/task/task.svg"/>'
                +task.TaskTitle
                +'</div>'
                +'<div class="description">'
                +task.Content
                +'</div>'
                +'<div class="date">'
                +'<div class="dateTop">'
                +'<div><img src="resources/images/task/date.svg"/><br>Start</div>'
                +'<div><label></label></div>'
                +'<div><img src="resources/images/task/date.svg"/><br>Due</div>'
                +'</div>'
                +'<div class="dateMid">'
                +'<div><label></label></div>'
                +'</div>'
                +'<div class="dateBot">'
                +'<div>'
                +task.StartDate
                +'</div>'
                +'<div></div>'
                +'<div>'
                +task.DueDate
                +'</div>'
                +'</div>'
                +'</div>'
                +'</div>'
                +'</div>'
                +'</li>';

    return tmp;
}
