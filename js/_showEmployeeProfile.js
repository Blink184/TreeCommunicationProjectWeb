function cancelShowEmployeeProfile(){
    document.getElementById("showEmployeeProfile").style.display = "none";
}
function displayEmployeeProfile(userId, firstName, lastName, phone, address, image){
    setValue("showEmployeeProfile_firstName", firstName);
    setValue("showEmployeeProfile_lastName", lastName);
    setValue("showEmployeeProfile_phone", phone);
    setValue("showEmployeeProfile_address", address);
    setValue("showEmployeeProfile_userId", userId);
    getObject("showEmployeeProfile_image").src = 'resources/images/employee/users/' + image;
    if(VIEW != 1){
        disable("showEmployeeProfile_firstName");
        disable("showEmployeeProfile_lastName");
        disable("showEmployeeProfile_phone");
        disable("showEmployeeProfile_address");
        hideObject("file-input");
        hideObject("showEmployeeProfile_submitButton");
    }
    document.getElementById('showEmployeeProfile').style.display = 'block';
}