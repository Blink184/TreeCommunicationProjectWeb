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
    document.getElementById('showEmployeeProfile').style.display = 'block';
}