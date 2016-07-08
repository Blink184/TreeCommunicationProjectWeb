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

    $('.datetimepicker').datetimepicker({
        yearOffset:0,
        lang:'ch',
        timepicker:false,
        format:'Y/m/d',
        formatDate:'Y/m/d',
        mask:'9999/19/39',
        value: new Date()
    });

    SELECTEDTYPE = MYTASK;
    SELECTEDSTATUS = ALL;
    SEARCH = "";
    filterTasks();

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

function task (taskid, empNameTo, taskTitle, content, type, status, startdate, duedate) {
    var task = {
        Id: taskid,
        EmpName: empNameTo,
        TaskTitle: taskTitle,
        Content: content,
        Type: type,
        Status: status,
        StartDate: startdate,
        DueDate: duedate
    };
    return task;
}

function loadTasks() {
    //db
    TASKS = [
        task(1, "Dalia Al Ali", "Documents", "Please print the documents", SENTREQUEST, INPROGRESS, "29/12/2016", "02/02/2017"),
        task(2, "Karen Shall", "Documents", "Please send the documents", SENTREQUEST, FINISHED, "12/10/2016", "15/10/2016"),
        task(3, "Sarah Majzoub", "Documents", "Please receive the documents", RECEIVEDREQUEST, FINISHED, "15/08/2016", "09/09/2016"),
        task(4, "Farah Kassem", "Documents", "Please email the documents", SENTREQUEST, INPROGRESS, "02/10/2016", "12/10/2016"),
        task(5, "Mariam Derbas", "Documents", "Please attach the documents", SENTREQUEST, NEW,"22/11/2016", "26/11/2016"),
        task(6, "Jared Leto", "Documents", "Please kebb the documents", MYTASK, NEW, "12/12/2016", "12/12/2016"),
        task(7, "Jared Leto", "Documents", "Please move away", MYTASK, NEW, "07/10/2016", "30/11/2016"),
        task(8, "Jared Leto", "Documents", "Please shower", MYTASK, NEW, "07/08/2016", "22/08/2016"),
        task(9, "Jared Leto", "Documents", "Please sleep", MYTASK, NEW, "12/09/2016", "12/10/2016"),
        task(10, "Jared Leto", "Documents", "Please eat", MYTASK, INPROGRESS, "12/09/2016", "12/01/2017"),
    ];

    extractArrayTasks();
}

function addTask(from, to, title, content, startdate, duedate) {
    
}

function extractArrayTasks() {
    var taskContainer = document.getElementById("taskControlsUl");
    var data = getData(TASKS);
    taskContainer.innerHTML = data;
    console.log(taskContainer);
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

    var tmp = '<li>'
                +'<div class="divTaskControl" onclick="displayTask(this)" data-type="'
                +task.Type
                +'" data-status="'
                +task.Status
                +'">'
                +'<div class="header">'
                +task.EmpName
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

//function getTasks(){
//    var array = [];
//    for(var i = 0; i < 20; i++){
//        var item =
//        {
//            title: "this is a title",
//            content: "this is a content, once you click on it, you get to see it in a pop up",
//            status: ASSIGN,
//            type: MYTASKS,
//            user: "John Smith",
//            dateStart: "19/6/2016",
//            dateEnd: "21/6/2016"
//        }
//        array.push(item);
//    }
//    return array;
//}