var ADD = "ADD";
var EDIT = "EDIT";

var MODE;
var CurrentUserRoleParentId;
var CurrentUserRoleId;

function cancelAddUserRole(){
    getObject("addUserRole").style.display = "none";
    setInnerHtml("addUserRole_log", '');
}

function addUserRole(parentId){
    getObject('addUserRole').style.display = 'block';
    getObject("addUserRole_popupTitle").innerHTML = "Add";
    CurrentUserRoleParentId = parentId;
    MODE = ADD;
    setInnerHtml("addUserRole_btnAdd", "Add");
    updateUsersList(-1);
    updateRolesList(-1);
}

function editUserRole(userRoleId, userId, roleId, title){
    getObject('addUserRole').style.display = 'block';
    getObject("addUserRole_popupTitle").innerHTML = "Edit";
    CurrentUserRoleId = userRoleId;
    MODE = EDIT;
    updateUsersList(userId);
    updateRolesList(roleId);
    setInnerHtml("addUserRole_btnAdd", "Save");
    setValue("addUserRole_title", title);
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

function updateRolesCombobox(selectedRole){
    var cmb = getObject("addUserRole_role");
    var tmp = "";
    for(var i = 0; i < ROLES.length; i++){
        if(ROLES[i].RoleId == selectedRole){
            tmp += "<option selected value='"+ROLES[i].RoleId+"'>"+ROLES[i].Description+"</option>";
        }else{
            tmp += "<option value='"+ROLES[i].RoleId+"'>"+ROLES[i].Description+"</option>";
        }
    }
    cmb.innerHTML = tmp;
}
function updateUsersCombobox(selectedUser){
    var cmb = getObject("addUserRole_user");
    var tmp = "";
    for(var i = 0; i < USERS.length; i++){
        if(USERS[i].UserId == selectedUser){
            tmp += "<option selected value='"+USERS[i].UserId+"'>"+USERS[i].FirstName+ ' ' +USERS[i].LastName+"</option>";
        }else{
            tmp += "<option value='"+USERS[i].UserId+"'>"+USERS[i].FirstName+ ' ' +USERS[i].LastName+"</option>";
        }
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
        if(MODE == ADD){
            insertUserRole(roleId, userId, CurrentUserRoleParentId, title);
        }else if(MODE == EDIT){
            updateUserRole(CurrentUserRoleId, roleId, userId, title);
        }
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
function updateUserRole(userRoleId, roleId, userId, title){
    $.post("database/api/updateUserRole.php",
        {
            userroleid: userRoleId,
            roleid: roleId,
            userid: userId,
            title: title
        },
        function(data, status){
            enable("addUserRole_btnAdd");
            var log = getObject("addUserRole_log");
            if(status == "success"){
                console.log(data);
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