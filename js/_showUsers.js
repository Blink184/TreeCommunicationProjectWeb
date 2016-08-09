function closeShowUsers(){
    document.getElementById("showUsers").style.display = "none";
}

function showUsers(){
    getObject('showUsers').style.display = 'block';
    getUsers();
}

function getUsers() {
    $.post("database/api/getUsers.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    fillUsersTable(jsonArrayData(data));
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function fillUsersTable(a){
    var tmp = "";
    if(a !== undefined) {
        for (var i = 0; i < a.length; i++) {

            var tmpFN = a[i].FirstName.safeQuotes();
            var tmpLN = a[i].LastName.safeQuotes();
            a[i].Address = a[i].Address.safeQuotes();
            a[i].Email = a[i].Email.safeQuotes();
            a[i].Phone = a[i].Phone.safeQuotes();
            a[i].Username = a[i].Username.safeQuotes();

            if(a[i].Usage != 0){
                tmp += '<tr><td>' + a[i].FirstName + '</td><td>' + a[i].LastName + '</td><td><button onclick="show_editUser('+a[i].UserId+', \''+a[i].FirstName+'\', \''+a[i].LastName+'\', \''+a[i].Username+'\',\''+a[i].Phone+'\', \''+a[i].Address+'\', \''+a[i].Email+'\', \''+a[i].Image+'\', \''+a[i].LastActiveDate+'\')">Edit</button></td><td></td></tr>';
            }else{
                tmp += '<tr><td>' + a[i].FirstName + '</td><td>' + a[i].LastName + '</td><td><button onclick="show_editUser('+a[i].UserId+', \''+a[i].FirstName+'\', \''+a[i].LastName+'\', \''+a[i].Username+'\',\''+a[i].Phone+'\', \''+a[i].Address+'\', \''+a[i].Email+'\', \''+a[i].Image+'\', \''+a[i].LastActiveDate+'\')">Edit</button></td><td><button  onclick="confirmAction(deleteUser, ' + a[i].UserId + ')">Delete</button></td></tr>';
            }
        }
    }
    getObject('unassignedUsers').innerHTML = tmp;
}

function show_editUser(userId, firstName, lastName, username, phone, address, email, image, lastActiveDate){
    displayEmployeeProfile(userId, firstName, lastName, username, phone, address, email, image, lastActiveDate);
    closeShowUsers();
}

function deleteUser(userId) {
    $.post("database/api/deleteUser.php",
        {
            userid: userId
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    getUsers();
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}
