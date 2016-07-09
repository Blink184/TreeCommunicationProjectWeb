var isMenuExpanded = false;
var EXPANDARROW = "&#10095;";
var COLLAPSEARROW = "&#10094;";


function setSelectedTab(tab){
    document.getElementById(tab).className = "selectedTab";
}
function expandCollapseMenu(object){
    if(isMenuExpanded){
        collapseMenu(object);
    }else{
        expandMenu(object);
    }
}
function collapseMenu(object){
    setMenuWidth(100);
    isMenuExpanded = false;
    object.innerHTML = EXPANDARROW;
    setMenuDescriptionWidth(0);
}
function expandMenu(object){
    setMenuWidth(150);
    isMenuExpanded = true;
    object.innerHTML = COLLAPSEARROW;
    setMenuDescriptionWidth(80);
}
function setMenuDescriptionWidth(width){
    var desc = document.getElementsByClassName("menuDescription");
    for(var i = 0; i < desc.length; i++){
        desc[i].style.width = width + "px";
    }
}
function setMenuWidth(width){
    var left = document.getElementById("liLeft");
    var right = document.getElementById("liRight");
    left.style.width = width + "px";
    right.style.marginLeft = width + "px";
}
function setSuccessLog(object, text){
    object.innerHTML = text;
    object.style.color = "Green";
}
function setFailureLog(object, text){
    object.innerHTML = text;
    object.style.color = "Red";
}
function setProcessingLog(object, text){
    object.innerHTML = "Processing...";
    object.style.color = "blue";
}
function notEmpty(string){
    return string !== undefined && string.length > 0;
}

function jsonSuccess(data){
    result = JSON.parse(data);
    return result.s == 1;
}
function jsonData(data){
    result = JSON.parse(data);
    return result.i;
}

function getObject(objectId){
    return document.getElementById(objectId);
}
function setValue(objectId, value){
    getObject(objectId).value = value;
}
function clearValue(objectId){
    setValue(objectId, "");
}
function getValue(objectId){
    return getObject(objectId).value;
}

function disable(objectId){
    getObject(objectId).disabled = true;
}
function enable(objectId){
    getObject(objectId).disabled = false;
}

function logout(){
    location = "index.php";
}
function profile(){
}
function settings(){
}