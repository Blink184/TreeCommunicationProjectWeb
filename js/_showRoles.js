function closeShowRoles(){
    document.getElementById("showRoles").style.display = "none";
}

function showRoles(){
    getObject('showRoles').style.display = 'block';
    getUnusedRoles();
}

function getUnusedRoles() {
    $.post("database/api/getRolesWithUsageStatus.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    fillRolesTable(jsonArrayData(data));
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function fillRolesTable(a){
    var tmp = "";
    if(a !== undefined) {
        for (var i = 0; i < a.length; i++) {
            var tmpDesc = a[i].Description.safeQuotes();
            if(a[i].RoleId == 1){
                tmp += '<tr><td>' + a[i].Description + '</td><td></td><td></td></tr>';
            }else if(a[i].Usage != 0){
                tmp += '<tr><td>' + a[i].Description + '</td><td><button onclick="show_editRole('+a[i].RoleId+', \''+tmpDesc+'\', \''+a[i].IsMaster+'\')">Edit</button></td><td></td></tr>';
            }else{
                tmp += '<tr><td>' + a[i].Description + '</td><td><button onclick="show_editRole('+a[i].RoleId+', \''+tmpDesc+'\', \''+a[i].IsMaster+'\')">Edit</button></td><td><button onclick="confirmAction(deleteRole, ' + a[i].RoleId + ')">Delete</button></td></tr>';
            }
        }
    }
    getObject('unusedRoles').innerHTML = tmp;
}

function show_editRole(roleId, description, isMaster){
    editRole(roleId, description, isMaster == 1);
    closeShowRoles();
}

function deleteRole(roleId) {
    $.post("database/api/deleteRole.php",
        {
            roleid: roleId
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    getUnusedRoles();
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}
