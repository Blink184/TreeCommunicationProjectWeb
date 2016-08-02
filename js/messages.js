var CONTACTS = [];
var MESSAGES = [];
var SEARCH = "";
var SELECTEDCONTACT;
var LOADING = false;
var RELOADINTERVAL = 5000;

window.onload = function () {
    setSelectedTab('tabMessage');
    getContacts();
    reload(getContacts);
    reload(getMessages_reload)
};
function searchContacts(value){
    SEARCH = value.trim();
    filterContacts();
}


function reload(func) {
    window.setInterval(function(){
        func(false);
    }, RELOADINTERVAL);
}

function contact(userRoleId, name, role, date, image, lastMessage, isRead, isSender){
    return {
        UserRoleId: userRoleId,
        Name: name,
        Role: role,
        Date: date.replaceAll("-", "/"),
        Image: image,
        LastMessage: lastMessage,
        IsRead: isRead,
        IsSender: isSender
    };
}

function message(messageId, fromUserRoleId, toUserRoleId, attachmentId, content, dateReceived, dateSent){
    return {
        MessageId: messageId,
        FromUserRoleId: fromUserRoleId,
        ToUserRoleId: toUserRoleId,
        AttachmentId: attachmentId,
        Content: content,
        DateReceived: dateReceived,
        DateSent: dateSent
    };
}

function getContacts(){
    $.post("database/api/getContacts.php",
        {
            userroleid: LOGGEDUSERROLEID
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)) {
                    //getObject('ulMessages').innerHTML = "";
                    //getObject('messagesConversationControl').style.visibility = "hidden";
                    var res = jsonData(data);
                    CONTACTS = [];
                    for(var i = 0; i < res.length; i++){
                        var o = res[i];
                        CONTACTS.push(contact(o.UserRoleId, o.ContactName, o.Role, o.DateSent, o.Image, o.Content, o.IsRead, o.IsSender));
                    }
                    extractArrayContacts();
                } else {
                    console.log(data)
                }
            }else{
                console.log(status)
            }
        }
    );
}

function getMessages_reload(){
    if(SELECTEDCONTACT != undefined){
        getMessages(SELECTEDCONTACT.UserRoleId, SELECTEDCONTACT.Name, false)
    }
}

function getMessages(contactId, userFullName, scrollToBottom){
    $.post("database/api/getMessages.php",
        {
            userroleid: LOGGEDUSERROLEID,
            contactid: contactId
        },
        function(data, status){
            //check if the selectedContactId is the same since it might vary
            //if the user selects 2 contacts before the first process has been finished
            if(contactId == SELECTEDCONTACT.UserRoleId) {
                if (status == "success") {
                    if (jsonSuccess(data)) {
                        var res = jsonData(data);
                        MESSAGES = [];
                        for (var i = 0; i < res.length; i++) {
                            var o = res[i];
                            MESSAGES.push(message(o.MessageId, o.FromUserRoleId, o.ToUserRoleId, o.AttachmentId, o.Content, o.DateReceived, o.DateSent));
                        }
                        getObject('messagesConversationControl_contactName').innerHTML = "Conversation with " + userFullName + "<img class='deleteConversation' onclick=\"deleteConversation("+contactId+");\" src='resources/images/employee/delete.svg'/>";
                        extractArrayMessages();
                        var ulMessages = getObject("ulMessages");
                        if(scrollToBottom)
                            ulMessages.scrollTop = ulMessages.scrollHeight;
                    } else {
                        console.log(data)
                    }
                } else {
                    console.log(status)
                }
            }
        }
    );
}

function extractArrayContacts(){
    getObject('ulContacts').innerHTML = getContactsData(CONTACTS);
    filterContacts();
}
function extractArrayMessages(){
    getObject('ulMessages').innerHTML = getMessagesData(MESSAGES);
}

function getContactsData(contacts){
    var tmp = '';
    for(var i = 0; i < contacts.length; i++){
        tmp += '<li>'+extractContact(contacts[i])+'</li>';
    }
    return tmp;
}
function getMessagesData(messages){
    var tmp = '';
    for(var i = 0; i < messages.length; i++){
        tmp += '<li>'+extractMessage(messages[i])+'</li>';
    }
    return tmp;
}
function extractMessage(message) {
    var _classRotated = message.FromUserRoleId == LOGGEDUSERROLEID ? 'class="rotated"' : '';
    var _image = message.FromUserRoleId == LOGGEDUSERROLEID ? LOGGEDUSERROLEIMAGE : SELECTEDCONTACT.Image;
    var _files = '';
    // "<?php if(isset($files) && strlen($files) > 0) echo 'files: ' . $files;?>"
    return "<div id='messagesConversationControlRow' "+_classRotated+">"
    + "<table>"
    + "<tr>"
    + "<td rowspan='3' id='messagesConversationControlRow_picture'>"
        + "<img src='resources/images/employee/users/"+_image+"'>"
    + "</td>"
    + "<td id='messagesConversationControlRow_time'>"
    + "(" + message.DateSent + ")"
    + "<img class='deleteMessage' onclick='deleteMessage("+message.MessageId+")' src='resources/images/employee/delete.svg'/>"
    + "</td>"
    + "</tr>"
    + "<tr>"
    + "<td id='messagesConversationControlRow_message'>"
    + message.Content
    + "</td>"
    + "</tr>"
    + "<tr>"
    + "<td id='messagesConversationControlRow_files'>"
    + _files
    + "</td>"
    + "</tr>"
    + "</table>"
    + "</div>";
}

function extractContact(contact) {
    var dateObject = new Date(contact.Date);
    var _new = "";
    var _dotPath = "read_message_blue_tick.svg";
    if(contact.IsRead == 0 && contact.IsSender != 1){
        _new = "New";
        _dotPath = "unread_message_blue_dot.svg";
    }
    var tmpSelected = "";
    if(SELECTEDCONTACT != undefined && contact.UserRoleId == SELECTEDCONTACT.UserRoleId){
        tmpSelected = " selectedRow";
    }

    return "<div class='messagesContactsControlRow "+_new +tmpSelected+"' onclick='loadConversation(this, "+contact.UserRoleId+", \""+contact.Name+"\", \""+contact.Image+"\")' data-name='"+contact.Name+"'>"
                + "<table>"
                    + "<tr>"
                        + "<td rowspan='2' id='messagesContactsControlRow_picture'>"
                            + "<img src='resources/images/employee/users/"+contact.Image+"'>"
                        + "</td>"
                        + "<td id='messagesContactsControlRow_nameAndTime'>"
                            + "<span id='messagesContactsControlRow_name'>"+contact.Name+"</span>"
                            + "<span id='messagesContactsControlRow_time'>("+timeSince(dateObject)+")</span>"
                        + "</td>"
                        + "<td id='messagesContactsControlRow_status' align='right'>"
                            + "<img id='messagesContactsControlRow_status_image' src=\'resources/images/message/"+_dotPath+"\'/>"
                        + "</td>"
                    + "</tr>"
                    + "<tr>"
                        + "<td id='messagesContactsControlRow_lastMessage'>"
                            + contact.LastMessage
                        + "</td>"
                    + "</tr>"
                + "</table>"
            + "</div>";

}

function deleteMessage(messageId){
    $.post("database/api/deleteMessage.php",
        {
            userroleid: LOGGEDUSERROLEID,
            messageid: messageId
        },
        function(data, status){
            if (status == "success") {
                if (jsonSuccess(data)) {
                    getMessages(SELECTEDCONTACT.UserRoleId, SELECTEDCONTACT.Name, false);
                } else {
                    console.log(data)
                }
            } else {
                console.log(status)
            }
        }
    );
}

function deleteConversation(withUserRoleId){
    $.post("database/api/deleteConversation.php",
        {
            userroleid: LOGGEDUSERROLEID,
            withuserroleid: withUserRoleId
        },
        function(data, status){
            if (status == "success") {
                if (jsonSuccess(data)) {
                    getObject('ulMessages').innerHTML = "";
                    getObject('messagesConversationControl').style.visibility = "hidden";
                    getContacts();
                } else {
                    console.log(data)
                }
            } else {
                console.log(status)
            }
        }
    );
}

function loadConversation(sender, userRoleId, userFullName, userImage){
    setSelectedContactStyle(sender);
    getObject('messagesConversationControl').style.visibility = "visible";
    getObject('messagesConversationControl_contactName').innerHTML = "<i>Loading...</i>";
    SELECTEDCONTACT = {UserRoleId: userRoleId, Image: userImage, Name: userFullName};
    getMessages(userRoleId, userFullName, true);
}

function setSelectedContactStyle(contact){
    $(".messagesContactsControlRow").removeClass('selectedRow');
    contact.className += ' selectedRow';
}

function isSearching(){
    return SEARCH.length > 0;
}

function filterContacts(){
    var elements = document.getElementsByClassName('messagesContactsControlRow');
    for(var i = 0; i < elements.length; i++){
        var elementName = elements[i].getAttribute('data-name');
        if(isSearching() && !matchSearch(elementName)){
            elements[i].style.display = "none";
        }else{
            elements[i].style.display = "block";
        }
    }
}

function matchSearch(element){
    if(element.trim().toLowerCase().indexOf(SEARCH.toLowerCase()) > -1){
        return true;
    }
    return false;
}

function replyToContact(){
    var from = LOGGEDUSERROLEID;
    var to = SELECTEDCONTACT.UserRoleId;
    var message = getValue('messagesConversationControl_textArea');
    sendMessage(from, to, message, onReplyToContact);
}

function onReplyToContact(){
    clearValue('messagesConversationControl_textArea');
    getMessages(SELECTEDCONTACT.UserRoleId, SELECTEDCONTACT.Name, true);
}


function onSubmitSendMessageSuccess(){
    cancelSendMessage();
    getContacts();
}

function setAsRead(img){
    img.src = "resources/images/message/read_message_blue_tick.svg";
}