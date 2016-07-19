<?php
    session_start();
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == '1'){
        $LOGGED_IN_USER_ROLE_FIRST_NAME = $_SESSION['firstName'];
        $LOGGED_IN_USER_ROLE_LAST_NAME = $_SESSION['lastName'];
        $LOGGED_IN_USER_ROLE_USER_ROLE_ID = $_SESSION['userRoleId'];
        $LOGGED_IN_USER_ROLE_IMAGE = $_SESSION['img'];
        echo '<script>LOGGEDUSERROLEID = '.$LOGGED_IN_USER_ROLE_USER_ROLE_ID.'</script>';
//        echo '<script>console.log("LOGGEDUSERROLEID = '.$LOGGED_IN_USER_ROLE_USER_ROLE_ID.'");</script>';
    }else{
        header('Location: login.php');
    }
?>