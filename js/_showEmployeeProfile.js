function cancelShowEmployeeProfile(){
    document.getElementById("showEmployeeProfile").style.display = "none";
}
function displayEmployeeProfile(userId, firstName, lastName, username, phone, address, image, lastActiveDate){
    setValue("showEmployeeProfile_firstName", firstName);
    setValue("showEmployeeProfile_lastName", lastName);
    setValue("showEmployeeProfile_phone", phone);
    setValue("showEmployeeProfile_address", address);
    setValue("showEmployeeProfile_userId", userId);
    setValue("showEmployeeProfile_username", username);
    setValue("showEmployeeProfile_lastActiveDate", lastActiveDate);
    getObject("showEmployeeProfile_image").src = 'resources/images/employee/users/' + image;
    hideObject('showEmployeeProfile_liOldPassword');
    clearValue('showEmployeeProfile_oldPassword');
    clearValue('showEmployeeProfile_password');
    if(VIEW != 1 && userId != LOGGEDUSERID){
        hideObject('showEmployeeProfile_liPassword');
        disable("showEmployeeProfile_firstName");
        disable("showEmployeeProfile_lastName");
        disable("showEmployeeProfile_phone");
        disable("showEmployeeProfile_address");
        disable("showEmployeeProfile_username");
        hideObject("file-input");
        hideObject("showEmployeeProfile_submitButton");
    }else{
        displayInlineObject('showEmployeeProfile_liPassword');
        enable("showEmployeeProfile_username");
        enable("showEmployeeProfile_firstName");
        enable("showEmployeeProfile_lastName");
        enable("showEmployeeProfile_phone");
        enable("showEmployeeProfile_address");
        displayInlineObject("file-input");
        displayInlineObject("showEmployeeProfile_submitButton");
    }
    document.getElementById('showEmployeeProfile').style.display = 'block';
}

function newPasswordChanged(val){
    if(val.length > 0){
        displayInlineObject('showEmployeeProfile_liOldPassword');
    }else{
        hideObject('showEmployeeProfile_liOldPassword');
    }
}