function cancelAddTask(){
    document.getElementById("addTask").style.display = "none";
}
function setAddTaskTarget(target){
    document.getElementsByName('addTask_to')[0].value = target;
}

function addTask(target){
    if(target !== undefined){
        setAddTaskTarget(target);
    }
    document.getElementById('addTask').style.display = 'block';
}