var SELECTEDTARGET;

function cancelAddTask(){
    document.getElementById("addTask").style.display = "none";
    onAddTaskPopupClosed();
}
function setAddTaskTarget(target){
    //document.getElementsByName('addTask_to')[0].value = target;
    SELECTEDTARGET = target;
}

function loadUserRoles(){
    $.post("database/api/getUserRoles.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    var users = jsonArrayData(data);
                    var tmp = '';
                    for(var i = 0; i < users.length; i++)
                    {
                        if(SELECTEDTARGET !== undefined && users[i].UserRoleId == SELECTEDTARGET){
                            tmp += '<option selected value="'+users[i].UserRoleId+'">'+users[i].FirstName + ' ' + users[i].LastName + ' (' + users[i].Role + ')'+'</option>';
                        }else{
                            tmp += '<option value="'+users[i].UserRoleId+'">'+users[i].FirstName + ' ' + users[i].LastName + ' (' + users[i].Role + ')'+'</option>';
                        }
                    }
                    SELECTEDTARGET = undefined;
                    getObject("addTask_empNameTo").innerHTML = tmp;
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function addTask(target){
    if(target !== undefined){
        setAddTaskTarget(target);
    }
    document.getElementById('addTask').style.display = 'block';
    loadUserRoles();
}

function submitAddTask() {
    var empNameTo = getValue("addTask_empNameTo");
    var title = getValue("addTask_title");
    var content = getValue("addTask_description");
    var dueDate = getValue("addTask_dueDate");
    var log = getObject("addTask_log");
    if(notEmpty(content) && notEmpty(empNameTo) && notEmpty(title) && notEmpty(dueDate)){
        disable("addTask_btnAdd");
        setProcessingLog(log);
        insertTask(empNameTo, LOGGEDUSERROLEID, title, content, dueDate);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}




function insertTask(empNameTo, empNameFrom, title, content, dueDate){
    $.post("database/api/insertTask.php",
        {
            empnameto: empNameTo,
            empnamefrom: empNameFrom,
            title: title,
            content: content,
            duedate: dueDate
        },
        function(data, status){
            console.log(data);
            enable("addTask_btnAdd");
            var log = getObject("addTask_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    clearAddTaskForm();
                    cancelAddTask();
                }else{
                    setFailureLog(log, jsonData(data));
                }
            }else{
                setFailureLog(log, status);
            }
        }
    );
}

function clearAddTaskForm(){
    clearValue("addTask_title");
    clearValue("addTask_empNameTo");
    clearValue("addTask_description");
    //clearValue("addTask_dueDate");
}