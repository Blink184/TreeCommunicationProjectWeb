function cancelDelegateTask() {
    document.getElementById("delegateTask").style.display = "none";
}

function submitDelegateTaskButton() {
    var empNameTo = getValue("delegateTask_empNameTo");
    var log = getObject("delegateTask_log");
    if(notEmpty(empNameTo)){
        disable("delegateTask_btnAccept");
        setProcessingLog(log);
        submitDelegateTask(CURRENTTASKID, empNameTo);
        hideObject('showTask');
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
                    closeShowTask();
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
    loadUserRolesMinusFromAndTo();
}

function loadUserRolesMinusFromAndTo(){
    $.post("database/api/getUserRoles.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    var users = jsonData(data);
                    var tmp = '';
                    for(var i = 0; i < users.length; i++){
                        if(users[i].UserRoleId != LOGGEDUSERROLEID && users[i].UserRoleId != CURRENTTASK.FromUserRoleId){
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