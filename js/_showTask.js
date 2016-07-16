var CURRENTTASKID;
var CURRENTTASKSTATUS;

function cancelShowTask(){
    document.getElementById("showTask").style.display = "none";
}

function submitShowTaskStatus() {
    if (CURRENTTASKSTATUS == NEW) {
        acceptTask(CURRENTTASKID, getDateFormatted());
    } else if (CURRENTTASKSTATUS == INPROGRESS) {
        finishTask(CURRENTTASKID, getDateFormatted());
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
    setInnerHtml('showTask_empNameFrom', task.FromUserRole);
    setInnerHtml('showTask_empNameTo', task.ToUserRole);
    setInnerHtml('showTask_description', task.Content);
    setInnerHtml('showTask_attachments', "No Attachments");
    setInnerHtml('showTask_startDate', task.StartDate);
    setInnerHtml('showTask_dueDate', task.DueDate);
    if(task.DelegatedToUserRoleId !== null){
        setInnerHtml('showTask_delegatedTo', task.DelegatedToUserRole);
        getObject('showTask_liDelegatedTo').style.display = "block";
    }else{
        getObject('showTask_liDelegatedTo').style.display = "none";
    }

    document.getElementById('showTask_btnCancel').style.display = "inline-block";
    document.getElementById('showTask_btnSubmit').style.display = "inline-block";
    hideObject('showTask_btnDelegate');

    //hi

    CURRENTTASKSTATUS = task.Status;
    if (task.Type != SENTREQUEST) {

        if (CURRENTTASKSTATUS == NEW) {
            setInnerHtml('showTask_btnSubmit', 'Accept');
            if(task.DelegatedToUserRoleId === null){
                displayInlineObject("showTask_btnDelegate");
            }
        } else if (CURRENTTASKSTATUS == INPROGRESS) {
            setInnerHtml('showTask_btnSubmit', 'Finish');
        } else {
            getObject('showTask_btnSubmit').style.display = "none";
        }

    } else {
        getObject("showTask_btnDelegate").style.display = "none";
        getObject("showTask_btnSubmit").style.display = "none";
    }

    getObject('showTask').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}