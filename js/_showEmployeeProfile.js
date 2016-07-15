function cancelShowEmployeeProfile(){
    document.getElementById("showEmployeeProfile").style.display = "none";
}
function displayEmployeeProfile(employeeId, firstName, lastName, image){
    getObject("showEmployeeProfile_firstName").src = firstName;
    setValue("showEmployeeProfile_lastName", lastName);
    getObject("showEmployeeProfile_image").src = 'resources/images/employee/users/' + image;
    document.getElementById('showEmployeeProfile').style.display = 'block';
}