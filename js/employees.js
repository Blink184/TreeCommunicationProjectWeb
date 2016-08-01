var TREE;
var VIEW = 1;

window.onload = function () {
    setSelectedTab('tabEmployee');
    loadTree();
    setDateTimePicker('.datetimepicker');
    notify("New Message from Ahmad Hammoud", MESSAGE);
    notify("New Broadcast from Ahmad Hammoud", BROADCAST);
    notify("New Task from Ahmad Hammoud", TASK);

};

function employee(userRoleId, userId, roleId, firstName, lastName, username, phone, address, lastActiveDate, role, title, image, children){
    var employee = {
        UserRoleId: userRoleId,
        UserId: userId,
        RoleId: roleId,
        FirstName: firstName,
        LastName: lastName,
        Name: firstName + ' ' + lastName,
        Username: username,
        Phone: phone,
        Address: address,
        LastActiveDate: lastActiveDate,
        Role: role,
        Title: title,
        Children: children,
        Image: image
    };
    return employee;
}


function loadTree(){
    $.post("database/api/getUserRoleTree.php",
        {
            parentid: LOGGEDUSERROLEID
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)){
                    var obj = JSON.parse(data).i;
                    addChildToTree(obj);
                    extractArray();
                }else{
                    console.log(jsonData(data));
                }
            }else{
                console.log(status);
            }
        }
    );
}

function addChildToTree(userrole){
    TREE = extractUserRole(userrole);
}

function getChildrenObjects(userrole){
    var arr = [];
    for(var i = 0; i < userrole.Children.length; i++){
        var tmp = userrole.Children[i];
        arr.push(extractUserRole(tmp));
    }
    return arr;
}
function extractUserRole(userrole){
    return employee(userrole.UserRoleId, userrole.UserId, userrole.RoleId, userrole.FirstName, userrole.LastName, userrole.Username, userrole.Phone, userrole.Address, userrole.LastActiveDate, userrole.Role, userrole.Title, userrole.Image, getChildrenObjects(userrole));
}


function extractArray(){
    var employeeControlContainer = document.getElementById("employeeControlContainer");
    var data = '<ol class="tree">' + getData(TREE) + '</ol>';
    employeeControlContainer.innerHTML = data;
    editTree();
}

function getData(employee){
    var tmp = '';
    tmp += generateDataFor(employee);
    if(employee.Children !== undefined && employee.Children.length > 0){
        tmp += '<ol class="tree">';
        for(var i = 0; i < employee.Children.length; i++){
            tmp += getData(employee.Children[i]);
        }
        tmp += '</ol>';
    }
    tmp += '</li>';
    return tmp;
}

function generateDataFor(employee){
    var title = employee.Role;
    var tmpView = '';
    if(employee.Title.length > 0) {
        title += ' / ' + employee.Title;
    }
    if(VIEW == 1){
        tmpView = '<img class="showOnTreeEdit" title="Add Child" src="resources/images/employee/add.png" onclick="addUserRole(' + employee.UserRoleId + ');" height="18" width="18"/> '
        + '<img class="showOnTreeEdit" title="Delete User Role" src="resources/images/employee/delete.png" onclick="confirmAction(deleteUserRole, ' + employee.UserRoleId + ');" width="18" height="18"/> '
        + '<img class="showOnTreeEdit" title="Edit User Role" src="resources/images/employee/edit.png" onclick="editUserRole(' + employee.UserRoleId + ', ' + employee.UserId + ', ' + employee.RoleId + ', \'' + employee.Title + '\');" width="18" height="18"/> ';
    }

    return '<li><div class="divEmployeeControl" data-employeeId="'+employee.UserRoleId+'">'
        + '<div class="hexagon" onclick="displayEmployeeProfile('+employee.UserId+', \''+employee.FirstName+'\', \''+employee.LastName+'\', \''+employee.Username+'\',\''+employee.Phone+'\', \''+employee.Address+'\', \''+employee.Image+'\')">'
        + '<img src="resources/images/employee/users/'+employee.Image+'"/>'
        + '<img src="resources/images/employee/hexagon.svg  "/>'
        + '</div>'
        + '<div class="divBody">'
        + '<div class="divName" id="divNameOfUserRole'+employee.UserRoleId+'" onclick="displayEmployeeProfile('+employee.UserId+', \''+employee.FirstName+'\', \''+employee.LastName+'\', \''+employee.Username+'\',\''+employee.Phone+'\', \''+employee.Address+'\', \''+employee.Image+'\')">'+employee.Name+'</div>'
        + '<div class="divTitle">'+ title +'</div>'
        + '<div class="divActions">'
        + '<img title="Assign Task" src="resources/images/employee/add_task.svg" onclick="addTask(' + employee.UserRoleId + ');"/> '
        + '<img title="Send Message" src="resources/images/employee/message.svg" onclick="composeNewMessage(' + employee.UserRoleId + ');"/> '
        + tmpView
        + '</div>'
        + '</div>'
        + '</div>'
        + '<input type="checkbox" checked/>';
}

function fileSelected(obj){
    obj.parentNode.submit();
}

var btnEditTreeActivated = false;
function editTree(){
    var value = btnEditTreeActivated ? "visible" : "hidden";
    var elmnts = document.getElementsByClassName("showOnTreeEdit");
    for(var i = 0; i < elmnts.length; i++){
        elmnts[i].style.visibility = value;
    }
    btnEditTreeActivated = !btnEditTreeActivated;
    if(getObject("btnEditTree") != null)
        getObject("btnEditTree").innerHTML = btnEditTreeActivated ? "Allow Edit " : "Finish Edit";
}

function onAddTaskPopupClosed(){

}

function onSubmitSendMessageSuccess(){
    cancelSendMessage();
}

function search(value){
    $('.divName').removeClass('search');
    if(value.length != 0){
        _search(value, TREE);
    }
}
function _search(value, obj){

    for(var i = 0; i < obj.Children.length; i++){
        _search(value, obj.Children[i]);
    }

    var thisIsTheOne;
    if(value.indexOf(' ') > -1){
        thisIsTheOne = obj.Name.toLowerCase().startsWith(value.toLowerCase());
    }else{
        thisIsTheOne = obj.FirstName.toLowerCase().startsWith(value.toLowerCase()) || obj.LastName.toLowerCase().startsWith(value.toLowerCase());
    }

    if(thisIsTheOne) {
        scrollToEmployee(obj.UserRoleId);
    }

}
function scrollToEmployee(userRoleId){
    $('#liContent').scrollTop(0);
    var control = $('.divEmployeeControl[data-employeeId="' + userRoleId + '"]');
    if(control !== undefined && control != null){
        $('#liContent').scrollTop(control.offset().top - 200);
        $('#divNameOfUserRole' + userRoleId).addClass('search');
    }
}