var CURRENTTASKID;
var CURRENTTASK;
var CURRENTTASKSTATUS;
var CURRENTTASKTYPE;


function closeShowTask(){
    document.getElementById("showTask").style.display = "none";
}

function submitBtnEvent() {
    if (CURRENTTASKTYPE == SENTREQUEST) {
        cancelTask(CURRENTTASKID, getDateFormatted());
    } else {
        if (CURRENTTASKSTATUS == NEW) {
            acceptTask(CURRENTTASKID, getDateFormatted());
        } else if (CURRENTTASKSTATUS == INPROGRESS) {
            finishTask(CURRENTTASKID, getDateFormatted());
        }
    }
}


function cancelTask(taskid, date) {
    $.post("database/api/cancelTask.php",
        {
            taskid: taskid,
            date: date
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    closeShowTask();
                    loadTasks();
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
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
                    closeShowTask();
                    loadTasks();
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
                    closeShowTask();
                    loadTasks();
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
            CURRENTTASK = task;
            break;
        }
    }

    CURRENTTASKSTATUS = task.Status;
    CURRENTTASKTYPE = task.Type;

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


    if (task.Type != SENTREQUEST) {

        if (CURRENTTASKSTATUS == NEW) {
            setInnerHtml('showTask_btnSubmit', 'Accept');
            if(task.DelegatedToUserRoleId === null){
                displayInlineObject("showTask_btnDelegate");
            }
        } else if (CURRENTTASKSTATUS == INPROGRESS) {
            setInnerHtml('showTask_btnSubmit', 'Finish');
        } else {
            hideObject('showTask_btnSubmit');
        }

    } else {
        hideObject('showTask_btnDelegate');
        setInnerHtml('showTask_btnSubmit', 'Cancel');
    }

    getObject('showTask').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}