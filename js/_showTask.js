function cancelShowTask(){
    document.getElementById("showTask").style.display = "none";
}

function delegateTask() {
    document.getElementById("delegateTask").style.display = "block";
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
    
    setInnerHtml('showTask_title', task.TaskTitle);
    setInnerHtml('showTask_empNameFrom', task.EmpNameFrom);
    setInnerHtml('showTask_empNameTo', task.EmpNameTo);
    setInnerHtml('showTask_description', task.Content);
    setInnerHtml('showTask_attachments', "No Attachments");
    setInnerHtml('showTask_startDate', task.StartDate);
    setInnerHtml('showTask_dueDate', task.DueDate);
    document.getElementById('showTask').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}