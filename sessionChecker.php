<?php
    date_default_timezone_set('Asia/Beirut');

    session_start();
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == '1'){

        $LOGGED_IN_USER_ROLE_ID = $_SESSION['userRoleId'];

        $LOGGED_IN_USER_ROLE_ID = 1;

        require_once 'database/userRole.php';

        $res = json_decode(getUserRoleById($LOGGED_IN_USER_ROLE_ID));

        $LOGGED_IN_USER_ID = $res->i->UserId;
        $LOGGED_IN_USER_ROLE_FIRST_NAME = $res->i->FirstName;
        $LOGGED_IN_USER_ROLE_LAST_NAME = $res->i->LastName;
        $LOGGED_IN_USER_ROLE_USERNAME = $res->i->Username;
        $LOGGED_IN_USER_ROLE_TELEPHONE = $res->i->Phone;
        $LOGGED_IN_USER_ROLE_EMAIL = $res->i->Email;
        $LOGGED_IN_USER_ROLE_ADDRESS = $res->i->Address;
        $LOGGED_IN_USER_ROLE_IMAGE = $res->i->Image;
        $LOGGED_IN_USER_ROLE_IS_MASTER = $res->i->IsMaster;

        echo $LOGGED_IN_USER_ID;

        echo '<script>LOGGEDUSERROLEID = '.$LOGGED_IN_USER_ROLE_ID.'; LOGGEDUSERID = '.$LOGGED_IN_USER_ID.'; LOGGEDUSERFIRSTNAME = "'.$LOGGED_IN_USER_ROLE_FIRST_NAME.'"; LOGGEDUSERADDRESS = "'.$LOGGED_IN_USER_ROLE_ADDRESS.'"; LOGGEDUSERLASTNAME = "'.$LOGGED_IN_USER_ROLE_LAST_NAME.'"; LOGGEDUSERUSERNAME = "'.$LOGGED_IN_USER_ROLE_USERNAME.'"; LOGGEDUSERPHONE = "'.$LOGGED_IN_USER_ROLE_TELEPHONE.'"; LOGGEDUSEREMAIL = "'.$LOGGED_IN_USER_ROLE_EMAIL.'"; LOGGEDUSERROLEIMAGE = "'.$LOGGED_IN_USER_ROLE_IMAGE.'";</script>';
    }else{
        header('Location: login.php');
    }


?>