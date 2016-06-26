function cancelSendMessage(){
    document.getElementById("sendMessage").style.display = "none";
}
function setSendMessageTarget(target){
    var input = document.getElementsByName('sendMessage_to')[0];
    input.value = target;
}