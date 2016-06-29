function cancelSendBroadcast(){
    document.getElementById("sendBroadcast").style.display = "none";
}
function sendBroadcast(){
    document.getElementById('sendBroadcast').style.display = 'block';
}
function sendBroadcastToSelectionChanged(value){
    document.getElementById('liCustom').style.display = (value == 2) ? 'block' : 'none';
}