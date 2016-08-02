<?php
    session_start();
    if(isset($_POST['logout']) && $_POST['logout'] == '1'){
        session_destroy();
        header('Location: login.php');
    }else if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == '1'){
        header('Location: employees.php');
    }else if(isset($_POST['login']) && $_POST['login'] == '1'){
        if(isset($_POST['user']) && isset($_POST['pass'])){
            $u = $_POST['user'];
            $p = $_POST['pass'];
            checkLogin($u, $p);
        }
    }else{
        header('Location: login.php');
    }

    function checkLogin($u, $p){
        include 'database/user.php';
        $res = json_decode(validateUser($u, $p));
        $userRoleId = $res->i->UserRoleId;
        $_SESSION['isLoggedIn'] = '1';
        $_SESSION['userRoleId'] = $userRoleId;
        header('Location: employees.php');
    }
?>