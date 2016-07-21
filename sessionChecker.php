<?php
    session_start();
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == '1'){
        $LOGGED_IN_USER_ROLE_FIRST_NAME = $_SESSION['firstName'];
        $LOGGED_IN_USER_ROLE_LAST_NAME = $_SESSION['lastName'];
        $LOGGED_IN_USER_ROLE_USER_ROLE_ID = $_SESSION['userRoleId'];
        $LOGGED_IN_USER_ROLE_IMAGE = $_SESSION['img'];
        $LOGGED_IN_USER_ROLE_IS_MASTER = $_SESSION['isMaster'];
        echo '<script>LOGGEDUSERROLEID = '.$LOGGED_IN_USER_ROLE_USER_ROLE_ID.';LOGGEDUSERROLEIMAGE = "'.$LOGGED_IN_USER_ROLE_IMAGE.'";</script>';
    }else{
        header('Location: login.php');
    }
?>