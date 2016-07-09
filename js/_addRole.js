function cancelAddRole(){
    getObject("addRole").style.display = "none";
}
function addRole(){
    getObject('addRole').style.display = 'block';
}

function submitAddRole(){
    var desc = getValue("addRole_description");
    var isMaster = getChecked("addRole_isMaster");
    var log = getObject("addRole_log");
    if(notEmpty(desc)){
        disable("addRole_btnAdd");
        setProcessingLog(log);
        insertRole(desc, isMaster);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}




function insertRole(description, isMaster){
    $.post("database/api/insertRole.php",
        {
            description: description,
            ismaster: isMaster
        },
        function(data, status){
            console.log(data);
            enable("addRole_btnAdd");
            var log = getObject("addRole_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    clearAddRoleForm();
                }else{
                    setFailureLog(log, jsonData(data));
                }
            }else{
                setFailureLog(log, status);
            }
        }
    );
}

function clearAddRoleForm(){
    clearValue("addRole_description");
    clearChecked("addRole_isMaster");
}