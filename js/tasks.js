var ALL = "ALL";
var ASSIGN = "ASSIGN";
var INPROGRESS = "INPROGRESS";
var FINISHED = "FINISHED";
var MYTASK = "MYTASK";
var RECEIVEDREQUEST = "RECEIVEDREQUEST";
var SENTREQUEST = "SENTREQUEST";

var SELECTEDSTATUS;
var SELECTEDTYPE;
var SEARCH;

window.onload = function () {
    setSelectedTab('tabTask');
    SELECTEDTYPE = MYTASK;
    SELECTEDSTATUS = ALL;
    SEARCH = "";
    filterTasks();
}


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
                elements[i].style.display = "table-cell";
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
function displayTask(task){
    alert("not implemented yet.");
}

function addTask(task){
    document.getElementById('addTask').style.display = 'block';
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