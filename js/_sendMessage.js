function cancelSendMessage(){
    document.getElementById("sendMessage").style.display = "none";
}
function setSendMessageTarget(target){
    document.getElementsByName('sendMessage_to')[0].value = target;
}
function sendMessage(target){
    setSendMessageTarget(target);
    document.getElementById('sendMessage').style.display = 'block';
}