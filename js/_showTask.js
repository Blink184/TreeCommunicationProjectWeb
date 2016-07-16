var CURRENTTASKID;
var CURRENTTASKSTATUS;

function cancelShowTask(){
    document.getElementById("showTask").style.display = "none";
}

function submitShowTaskStatus() {
    if (CURRENTTASKSTATUS == NEW) {
        //accept
        acceptTask(CURRENTTASKID, Date());
    } else if (CURRENTTASKSTATUS == INPROGRESS) {
        //finish
        finishTask(CURRENTTASKID, Date());
    }
    cancelShowTask();
    loadTasks();
}

function finishTask(taskid, date){
    $.post("database/api/finishTask.php",
        {
            taskid: taskid,
            date: date
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    console.log("Process completed");
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function acceptTask(taskid, date){
    $.post("database/api/acceptTask.php",
        {
            taskid: taskid,
            date: date
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    console.log("Process completed");
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function delegateTask() {
    document.getElementById("delegateTask").style.display = "block";
}


function displayTask(taskid){
    CURRENTTASKID = taskid;
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

    console.log(task.Status);
    if (task.Status == NEW) {
        setInnerHtml('showTask_btnSubmit', 'Accept');
        CURRENTTASKSTATUS = NEW;
    } else if (task.Status == INPROGRESS) {
        setInnerHtml('showTask_btnSubmit', 'Finish');
        CURRENTTASKSTATUS = INPROGRESS;
    } else {
        setInnerHtml('showTask_btnSubmit', 'Okay');
        CURRENTTASKSTATUS = FINISHED;
    }

    if (task.DelegatedByUserRoleId != 0) {
        document.getElementById("showTask_btnDelegate").style.display = "none";
    }

    document.getElementById('showTask').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}