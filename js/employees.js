window.onload = function () { setSelectedTab('tabEmployee');}
function addTask(target){
    setAddTaskTarget(target);
    document.getElementById('addTask').style.display = 'block';
}
function sendMessage(target){
    setSendMessageTarget(target);
    document.getElementById('sendMessage').style.display = 'block';
}