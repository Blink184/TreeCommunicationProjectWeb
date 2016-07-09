function cancelShowTask(){
    document.getElementById("showTask").style.display = "none";
}
function displayTask(taskid){
    var task;
    for (var i=0; i < TASKS.length; i++) {
        var tmp = TASKS[i];
        if (tmp.TaskId == taskid) {
            task = tmp;
            break;
        }
    }
    
    setInnerHtml('showTask_Title', task.TaskTitle);
    setInnerHtml('showTask_empNameFrom', task.EmpNameFrom);
    setInnerHtml('showTask_empNameTo', task.EmpNameTo);
    setInnerHtml('showTask_Description', task.Content);
    setInnerHtml('showTask_Attachments', "No Attachments");
    setInnerHtml('showTask_StartDate', task.StartDate);
    setInnerHtml('showTask_DueDate', task.DueDate);
    document.getElementById('showTask').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}