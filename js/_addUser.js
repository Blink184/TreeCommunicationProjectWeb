var USERS = [];

function cancelAddUser(){
    getObject("addUser").style.display = "none";
    setInnerHtml("addUser_log", '');
}

function addUser(){
    getObject('addUser').style.display = 'block';
}

function updateUsersList(selectedUser){
    $.post("database/api/getUsers.php",
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    var obj = jsonArrayData(data);
                    USERS = [];
                    for(var i = 0; i < obj.length; i++){
                        USERS.push(obj[i]);
                    }
                    updateUsersCombobox(selectedUser);
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function submitAddUser(){
    var fn = getValue("addUser_firstName");
    var ln = getValue("addUser_lastName");
    var un = getValue("addUser_username");
    var pw = getValue("addUser_password");
    var tel = getValue("addUser_phoneNumber");
    var em = getValue("addUser_email");
    var add = getValue("addUser_address");
    var log = getObject("addUser_log");
    if(notEmpty(fn) && notEmpty(ln) && notEmpty(un) && notEmpty(pw)){
        disable("addUser_btnAdd");
        setProcessingLog(log);
        insertUser(fn, ln, un, pw, tel, em, add);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}

function insertUser(firstname, lastname, username, password, telephone, email, address){
    $.post("database/api/insertUser.php",
        {
            firstname: firstname,
            lastname: lastname,
            username: username,
            password: password,
            telephone: telephone,
            email: email,
            address: address
        },
        function(data, status){
            enable("addUser_btnAdd");
            var log = getObject("addUser_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    clearAddUserForm();
                }else{
                    setFailureLog(log, jsonData(data));
                }
            }else{
                setFailureLog(log, status);
            }
        }
    );
}

function clearAddUserForm(){
    clearValue("addUser_firstName");
    clearValue("addUser_lastName");
    clearValue("addUser_username");
    clearValue("addUser_password");
    clearValue("addUser_phoneNumber");
    clearValue("addUser_email");
    clearValue("addUser_address");
}