var CurrentUserRoleParentId;

function cancelAddUserRole(){
    getObject("addUserRole").style.display = "none";
}

function addUserRole(parentName, parentId){
    getObject('addUserRole').style.display = 'block';
    CurrentUserRoleParentId = parentId;
    updateUsersList();
    updateRolesList();
}
function deleteUserRole(userRoleId){
    $.post("database/api/deleteUserRole.php",
        {
            userroleid: userRoleId
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    loadTree();
                }else{
                    console.log(data);
                }
            }else{
                console.log(status);
            }
        }
    );
}

function updateRolesCombobox(){
    var cmb = getObject("addUserRole_role");
    var tmp = "";
    for(var i = 0; i < ROLES.length; i++){
        tmp += "<option value='"+ROLES[i].RoleId+"'>"+ROLES[i].Description+"</option>";
    }
    cmb.innerHTML = tmp;
}
function updateUsersCombobox(){
    var cmb = getObject("addUserRole_user");
    var tmp = "";
    for(var i = 0; i < USERS.length; i++){
        tmp += "<option value='"+USERS[i].UserId+"'>"+USERS[i].FirstName+"</option>";
    }
    cmb.innerHTML = tmp;
}

function submitAddUserRole(){
    var roleId = getValue("addUserRole_role");
    var userId = getValue("addUserRole_user");
    var title = getValue("addUserRole_title");
    var log = getObject("addUserRole_log");
    if(notEmpty(roleId) && notEmpty(userId) && notEmpty(title)){
        disable("addUserRole_btnAdd");
        setProcessingLog(log);
        insertUserRole(roleId, userId, CurrentUserRoleParentId, title);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}

function insertUserRole(roleId, userId, parentId, title){
    $.post("database/api/insertUserRole.php",
        {
            roleid: roleId,
            userid: userId,
            parentid: parentId,
            title: title
        },
        function(data, status){
            console.log(data);
            enable("addUserRole_btnAdd");
            var log = getObject("addUserRole_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    clearAddUserRoleForm();
                    cancelAddUserRole();
                    loadTree();
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