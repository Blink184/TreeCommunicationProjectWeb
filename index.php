<?php
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == '1'){
        header('Location: login.php');
    }else if(isset($_POST['login']) && $_POST['login'] == '1'){
        if(isset($_POST['user']) && isset($_POST['pass'])){
            $u = $_POST['user'];
            $p = $_POST['pass'];
            checkLogin($u, $p);
        }
    }else if(isset($_POST['logout']) && $_POST['logout'] == '1'){
        session_start();
        session_destroy();
        header('Location: login.php');
    }else{
        header('Location: login.php');
    }

    function checkLogin($u, $p){
        include 'database/user.php';
        //var res = validateUser($u, $p);
        $res = json_decode(validateUser($u, $p));
        $fn = $res->i->FirstName;
        $ln = $res->i->LastName;
        $img = $res->i->Image;
        $userRoleId = $res->i->UserRoleId;
        $isMaster = $res->i->IsMaster;
        session_start();
        $_SESSION['isLoggedIn'] = '1';
        $_SESSION['firstName'] = $fn;
        $_SESSION['lastName'] = $ln;
        $_SESSION['img'] = $img;
        $_SESSION['userRoleId'] = $userRoleId;
        $_SESSION['isMaster'] = $isMaster;
        header('Location: employees.php');
    }
?>