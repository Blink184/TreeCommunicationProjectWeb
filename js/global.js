var isMenuExpanded = false;
var EXPANDARROW = "&#10095;";
var COLLAPSEARROW = "&#10094;";
var LOGGEDUSERROLEID = 2;

function getDateFormatted(){
    return new Date().toISOString().slice(0, 19).replace('T', ' ');
}

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
    var result = JSON.parse(data);
    return result.s == 1;
}
function jsonData(data){
    var result = JSON.parse(data);
    return result.i;
}

function jsonArrayData(data){
    var result = JSON.parse(JSON.parse(data).i);
    return result;
}

function hideObject(objectId){
    getObject(objectId).style.display = "none";
}
function displayObject(objectId){
    getObject(objectId).style.display = "block";
}
function displayInlineObject(objectId){
    getObject(objectId).style.display = "inline-block";
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
function clearChecked(objectId){
    setChecked(objectId, false);
}
function getChecked(objectId){
    return getObject(objectId).checked;
}
function setChecked(objectId, isChecked){
    getObject(objectId).checked = isChecked;
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

function setDateTimePicker(selector) {
    $(selector).datetimepicker({
        yearOffset:0,
        lang:'ch',
        timepicker:false,
        format:'Y/m/d',
        formatDate:'Y/m/d',
        mask:'9999/19/39',
        value: new Date()
    });
}