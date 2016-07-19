/**
 * Created by Kirby on 7/1/2016.
 */


$(document).ready(function(){
    $('#password').keypress(function(e){
        if(e.keyCode==13)
            $('#btnLogin').click();
    });
    console.log('asd');
});


function goToEmployeesPage(user) {
    //1LOGGEDUSERROLEID =
    window.location="employees.php"
}

function login() {
    var user = getValue('username');
    var pwd = getValue('password');
    checkLogin(user, pwd);
}

function checkLogin(user, pwd) {
    var log = getObject('login_log');
    $.post("database/api/validateUser.php",
        {
          username: user,
          password: pwd
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    goToEmployeesPage(data);
                }else{
                    setFailureLog(log, "Invalid Username or Password");
                    console.log(data);
                }
            }else{
                console.log(status);
            }
        }
    );
}