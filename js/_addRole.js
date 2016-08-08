var ROLES = [];
var EDITEDROLEID = null;
function cancelAddRole(){
    setInnerHtml("addRole_log", '');
    getObject("addRole").style.display = "none";
}

function addRole(){
    getObject('addRole').style.display = 'block';
    clearAddRoleForm();
}
function editRole(roleId, description, isMaster){
    getObject('addRole').style.display = 'block';
    getObject("addRole_btnAdd").innerHTML = "Update"
    EDITEDROLEID = roleId;
    setValue('addRole_description', description);
    setChecked('addRole_isMaster', isMaster);
}

function updateRolesList(selectedRole){
    $.post("database/api/getRoles.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    var obj = jsonArrayData(data);
                    ROLES = [];
                    for(var i = 0; i < obj.length; i++){
                        ROLES.push(obj[i]);
                    }
                    updateRolesCombobox(selectedRole);
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function submitAddRole(){
    var desc = getValue("addRole_description");
    var isMaster = getChecked("addRole_isMaster");
    var log = getObject("addRole_log");
    if(notEmpty(desc)){
        disable("addRole_btnAdd");
        setProcessingLog(log);
        if(EDITEDROLEID == null){
            insertRole(desc, isMaster);
        }else{
            updateRole(EDITEDROLEID, desc, isMaster);
        }
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

function updateRole(roleId, description, isMaster){
    $.post("database/api/updateRole.php",
        {
            roleid: roleId,
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
    EDITEDROLEID = null;
    clearValue("addRole_description");
    clearChecked("addRole_isMaster");
    getObject("addRole_btnAdd").innerHTML = "Add"
}