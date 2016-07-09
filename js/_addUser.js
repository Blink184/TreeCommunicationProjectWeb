function cancelAddUser(){
    getObject("addUser").style.display = "none";
}

function addUser(){
    getObject('addUser').style.display = 'block';
}

function submitAddUser(){
    var fn = getValue("addUser_firstName");
    var ln = getValue("addUser_lastName");
    var un = getValue("addUser_username");
    var pw = getValue("addUser_password");
    var log = getObject("addUser_log");
    if(notEmpty(fn) && notEmpty(ln) && notEmpty(un) && notEmpty(pw)){
        disable("addUser_btnAdd");
        setProcessingLog(log);
        insertUser(fn, ln, un, pw);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}

function insertUser(firstname, lastname, username, password){
    $.post("database/api/insertUser.php",
        {
            firstname: firstname,
            lastname: lastname,
            username: username,
            password: password
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
}