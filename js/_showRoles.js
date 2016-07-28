function closeShowRoles(){
    document.getElementById("showRoles").style.display = "none";
}

function showRoles(){
    getObject('showRoles').style.display = 'block';
    getUnusedRoles();
}

function getUnusedRoles() {
    $.post("database/api/getUnusedRoles.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    fillUnusedRolesTable(jsonArrayData(data));
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function fillUnusedRolesTable(a){
    var tmp = "";
    if(a !== undefined) {
        for (var i = 0; i < a.length; i++) {
            tmp += '<tr><td>' + a[i].Description + '</td><td><button onclick="deleteRole(' + a[i].RoleId + ')">Delete</button></td></tr>';
        }
    }
    getObject('unusedRoles').innerHTML = tmp;
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
