function cancelDelegateTask() {
    document.getElementById("delegateTask").style.display = "none";
}

function submitDelegateTaskButton() {
    console.log(CURRENTTASKID);
    var empNameTo = getValue("delegateTask_empNameTo");
    console.log(empNameTo);
    var log = getObject("delegateTask_log");
    if(notEmpty(empNameTo)){
        disable("delegateTask_btnAccept");
        setProcessingLog(log);
        submitDelegateTask(CURRENTTASKID, empNameTo);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}

function submitDelegateTask(CURRENTTASKID, empNameTo){
    $.post("database/api/delegateTask.php",
        {
            taskid: CURRENTTASKID,
            delegatetouserroleid: empNameTo
        },
        function(data, status){
            console.log(data);
            enable("delegateTask_btnAccept");
            var log = getObject("delegateTask_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    cancelDelegateTask();
                    cancelShowTask();
                    loadTasks();
                }else{
                    setFailureLog(log, jsonData(data));
                }
            }else{
                setFailureLog(log, status);
            }
        }
    );
}


function delegateTask(target) {
    if(target !== undefined){
        setAddTaskTarget(target);
    }
    document.getElementById('delegateTask').style.display = 'block';
    loadUserRolesMinusCurrent();
}

function loadUserRolesMinusCurrent(){
    $.post("database/api/getUserRoles.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    var users = jsonData(data);
                    var tmp = '';
                    for(var i = 0; i < users.length; i++){
                        if(users[i].UserRoleId != LOGGEDUSERROLEID){
                            tmp += '<option value="'+users[i].UserRoleId+'">'+users[i].FirstName + ' ' + users[i].LastName + ' (' + users[i].Role + ')'+'</option>';
                        }
                    }
                    SELECTEDTARGET = undefined;
                    getObject("delegateTask_empNameTo").innerHTML = tmp;
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}