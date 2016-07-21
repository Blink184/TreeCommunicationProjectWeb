<link href="css/_header.css" rel="stylesheet" type="text/css"/>
<div id="divHeader">
    <ul>
        <span class="element" onclick="profile()">
            <img src="resources/images/employee/users/<?=$LOGGED_IN_USER_ROLE_IMAGE?>" id="imgUser"/>
            <span id="spnUser"><?=$LOGGED_IN_USER_ROLE_FIRST_NAME?> <?=$LOGGED_IN_USER_ROLE_LAST_NAME?></span>
        </span>
        <span class="element" onclick="settings()">
            <img src="resources/images/global/settings.svg" id="imgSettings"/>
            Settings
        </span>
        <span class="element" onclick="logout()">
            <img src="resources/images/global/logout.svg" id="imgLogout"/>
            Logout
        </span>
    </ul>
</div>
