function closeShowUsers(){
    document.getElementById("showUsers").style.display = "none";
}

function showUsers(){
    getObject('showUsers').style.display = 'block';
    getUnassignedUsers();
}

function getUnassignedUsers() {
    $.post("database/api/getUnassignedUsers.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    fillUnassignedUsersTable(jsonArrayData(data));
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function fillUnassignedUsersTable(a){
    var tmp = "";
    if(a !== undefined) {
        for (var i = 0; i < a.length; i++) {
            tmp += '<tr><td>' + a[i].FirstName + '</td><td>' + a[i].LastName + '</td><td><button onclick="confirmAction(deleteUser, ' + a[i].UserId + ')">Delete</button></td></tr>';

            //tmp += '<tr><td>' + a[i].FirstName + '</td><td>' + a[i].LastName + '</td><td><button onclick="deleteUser(' + a[i].UserId + ')">Delete</button></td></tr>';
        }
    }
    getObject('unassignedUsers').innerHTML = tmp;
}

function deleteUser(userId) {
    $.post("database/api/deleteUser.php",
        {
            userid: userId
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    getUnassignedUsers();
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}
