function cancelAddUserRole(){
    getObject("addUserRole").style.display = "none";
}

function addUserRole(parentName, parentId){
    getObject('addUserRole').style.display = 'block';
}

function submitAddUserRole(){
    var roleId = getValue("addUserRole_role");
    var userId = getValue("addUserRole_user");
    var title = getValue("addUserRole_title");
    var log = getObject("addUserRole_log");
    if(notEmpty(roleId) && notEmpty(userId) && notEmpty(title)){
        disable("addUserRole_btnAdd");
        setProcessingLog(log);
        insertUserRole(roleId, userId, title);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}

function insertUserRole(roleId, userId, title){
    $.post("database/api/insertUser.php",
        {
            roleid: roleId,
            userid: userId,
            title: title
        },
        function(data, status){
            enable("addUserRole_btnAdd");
            var log = getObject("addUserRole_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    clearAddUserRoleForm();
                }else{
                    setFailureLog(log, jsonData(data));
                }
            }else{
                setFailureLog(log, status);
            }
        }
    );
}

function clearAddUserRoleForm(){
    clearValue("addUserRole_user");
    clearValue("addUserRole_role");
    clearValue("addUserRole_title");
}