<?php
    date_default_timezone_set('Asia/Beirut');

    session_start();
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == '1'){
        $LOGGED_IN_USER_ROLE_FIRST_NAME = $_SESSION['firstName'];
        $LOGGED_IN_USER_ROLE_LAST_NAME = $_SESSION['lastName'];
        $LOGGED_IN_USER_ROLE_TELEPHONE = $_SESSION['telephone'];
        $LOGGED_IN_USER_ROLE_EMAIL = $_SESSION['email'];
        $LOGGED_IN_USER_ROLE_ID = $_SESSION['userRoleId'];
        $LOGGED_IN_USER_ROLE_IMAGE = $_SESSION['img'];
        $LOGGED_IN_USER_ROLE_IS_MASTER = $_SESSION['isMaster'];


        echo '<script>LOGGEDUSERROLEID = '.$LOGGED_IN_USER_ROLE_ID.'; LOGGEDUSERFN = "'.$LOGGED_IN_USER_ROLE_FIRST_NAME.'"; LOGGEDUSERLN = "'.$LOGGED_IN_USER_ROLE_LAST_NAME.'"; LOGGEDUSERTEL = "'.$LOGGED_IN_USER_ROLE_TELEPHONE.'"; LOGGEDUSEREMAIL = "'.$LOGGED_IN_USER_ROLE_EMAIL.'"; LOGGEDUSERROLEIMAGE = "'.$LOGGED_IN_USER_ROLE_IMAGE.'";</script>';
    }else{
        header('Location: login.php');
    }


?>