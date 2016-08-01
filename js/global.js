var isMenuExpanded = false;
var EXPANDARROW = "&#10095;";
var COLLAPSEARROW = "&#10094;";
var DISPLAYNUMBERITEMS = 9;


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
    post('\index.php', {logout: 1});
}
function profile(){
    displayEmployeeProfile(LOGGEDUSERID, LOGGEDUSERFIRSTNAME, LOGGEDUSERLASTNAME, LOGGEDUSERUSERNAME, LOGGEDUSERPHONE, LOGGEDUSERADDRESS, LOGGEDUSERROLEIMAGE);
}

function settings(){

}

function confirmAction(f, value) {
    showConfirmDialog(f, value, "Warning Dialog", "Are you sure you wish to delete?");
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

//html post
function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}



function timeSince(date) {
    var seconds = Math.floor((new Date() - date) / 1000);
    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes";
    }
    return Math.floor(seconds) + " seconds";
}

var BROADCAST = "broadcast";
var MESSAGE = "message";
var TASK = "task";
function notify(content, type, onClickListener, onLoadListener){
    if(type !== undefined && onClickListener === undefined){
        switch(type) {
            case BROADCAST:
                onClickListener = goToBroadcasts;
                break;
            case MESSAGE:
                onClickListener = goToMessages;
                break;
            case TASK:
                onClickListener = goToTasks;
                break;
        }
    }
    $.notify(content, {position: 'right bottom', className: type, onClick: onClickListener, onLoad: onLoadListener});
}
function goToMessages(){
    location = "messages.php";
}
function goToTasks(){
    location = "tasks.php";
}
function goToBroadcasts(){
    location = "broadcasts.php";
}

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};
String.prototype.startsWith = function (str) {
    return this.indexOf(str) == 0;
}