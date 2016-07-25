var USERROLES = [];
function cancelSendMessage(){
    document.getElementById("sendMessage").style.display = "none";
    clearValue('sendMessage_textArea');
}


function submitSendMessage(){
    disable('sendMessage_submitButton');
    var from = LOGGEDUSERROLEID;
    var to = getValue('sendMessage_to');
    var message = getValue('sendMessage_textArea');
    sendMessage(from, to, message, onSubmitSendMessageSuccess);
}

function setSendMessageTarget(target){
    if(target !== undefined) {
        var cmb = getObject('sendMessage_to');
        for(var i = 0; i < cmb.options.length; i++){
            if(cmb.options[i].value == target){
                cmb.options[i].selected = true;
            }
        }
    }
}
function composeNewMessage(target){
    getUserRoles(target);
    document.getElementById('sendMessage').style.display = 'block';
}

function sendMessage(from, to, content, onSuccess){
    $.post("database/api/insertMessage.php",
        {
            fromuserroleid: from,
            touserroleid: to,
            content: content
        },
        function(data, status){
            if (status == "success") {
                if (jsonSuccess(data)) {
                    onSuccess();
                    enable('sendMessage_submitButton');
                } else {
                    console.log(data)
                }
            } else {
                console.log(status)
            }
        }
    );
}

function getUserRoles(selectedUserRole){
    $.post("database/api/getUserRoles.php",
        function(data, status){
            if (status == "success") {
                if (jsonSuccess(data)) {
                    var obj = jsonData(data);
                    USERROLES = [];
                    for(var i = 0; i < obj.length; i++){
                        USERROLES.push(obj[i]);
                    }
                    updateUserRolesComboBox(selectedUserRole);
                } else {
                    console.log(data)
                }
            } else {
                console.log(status)
            }
        }
    );
}

function updateUserRolesComboBox(selectedUserRole){
    var cmb = getObject("sendMessage_to");
    var tmp = "";
    for(var i = 0; i < USERROLES.length; i++){
        if(USERROLES[i].UserRoleId == selectedUserRole){
            tmp += "<option selected value='"+USERROLES[i].UserRoleId+"'>"+USERROLES[i].FirstName+ ' ' +USERROLES[i].LastName+"</option>";
        }else{
            tmp += "<option value='"+USERROLES[i].UserRoleId+"'>"+USERROLES[i].FirstName+ ' ' +USERROLES[i].LastName+"</option>";
        }
    }
    cmb.innerHTML = tmp;
}