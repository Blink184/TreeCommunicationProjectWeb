function cancel(){
    document.getElementById("addTask").style.display = "none";
}
function setAddTaskTarget(target){
    var input = document.getElementsByName('to')[0];
    input.value = target;
}