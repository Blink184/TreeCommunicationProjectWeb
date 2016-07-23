function cancelSendMessage(){
    document.getElementById("sendMessage").style.display = "none";
}
function setSendMessageTarget(target){
    if(target !== undefined) {
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
                } else {
                    console.log(data)
                }
            } else {
                console.log(status)
            }
        }
    );
}