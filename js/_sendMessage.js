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
    setSendMessageTarget(target);
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