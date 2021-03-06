var TREE;

window.onload = function () {
    setSelectedTab('tabEmployee');
    loadTree();
    setDateTimePicker('.datetimepicker');
    getNotifications();
};

function employee(userRoleId, userId, roleId, firstName, lastName, username, phone, email, address, lastActiveDate, role, title, image, children){
    var employee = {
        UserRoleId: userRoleId,
        UserId: userId,
        RoleId: roleId,
        FirstName: firstName,
        LastName: lastName,
        Name: firstName + ' ' + lastName,
        Username: username,
        Phone: phone,
        Email: email,
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
    if(userrole.Children != null){
        for(var i = 0; i < userrole.Children.length; i++){
            var tmp = userrole.Children[i];
            arr.push(extractUserRole(tmp));
        }
    }
    return arr;
}
function extractUserRole(userrole){
    return employee(userrole.UserRoleId, userrole.UserId, userrole.RoleId, userrole.FirstName, userrole.LastName, userrole.Username, userrole.Phone, userrole.Email, userrole.Address, userrole.LastActiveDate, userrole.Role, userrole.Title, userrole.Image, getChildrenObjects(userrole));
}


function extractArray(){
    var employeeControlContainer = document.getElementById("employeeControlContainer");
    var data = '<ol class="tree">' + getData(TREE) + '</ol>';
    employeeControlContainer.innerHTML = data;
    editTree();
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

    employee.FirstName = employee.FirstName.safeQuotes();
    employee.LastName = employee.LastName.safeQuotes();
    employee.Email = employee.Email.safeQuotes();
    employee.Phone = employee.Phone.safeQuotes();
    employee.Address = employee.Address.safeQuotes();
    employee.Username = employee.Username.safeQuotes();

    if(employee.Title.length > 0) {
        title += ' / ' + employee.Title;
    }
    if(VIEW == 1){
        tmpView = '<img class="showOnTreeEdit" title="Add Child" src="resources/images/employee/add.png" onclick="addUserRole(' + employee.UserRoleId + ');" height="20" width="20"/> ';
        if(LOGGEDUSERROLEID != employee.UserRoleId) {
            //so that the logged in employee cant delete or edit himself.
            tmpView += '<img class="showOnTreeEdit" title="Delete User Role" src="resources/images/employee/delete.png" onclick="confirmAction(deleteUserRole, ' + employee.UserRoleId + ');" width="20" height="20"/> ';
            tmpView += '<img class="showOnTreeEdit" title="Edit User Role" src="resources/images/employee/edit.png" onclick="editUserRole(' + employee.UserRoleId + ', ' + employee.UserId + ', ' + employee.RoleId + ', \'' + employee.Title + '\');" width="20" height="20"/> ';
        }
    }
    var tmpMessage = '';
    if(LOGGEDUSERROLEID != employee.UserRoleId){
        tmpMessage = '<img title="Send Message" width="18px" height="12px" src="resources/images/employee/message.svg" onclick="composeNewMessage(' + employee.UserRoleId + ');"/> ';
    }

    return '<li><div class="divEmployeeControl" data-employeeId="'+employee.UserRoleId+'">'
        + '<div class="hexagon" onclick="displayEmployeeProfile('+employee.UserId+', \''+employee.FirstName+'\', \''+employee.LastName+'\', \''+employee.Username+'\',\''+employee.Phone+'\', \''+employee.Address+'\', \''+employee.Email+'\', \''+employee.Image+'\', \''+employee.LastActiveDate+'\')">'
        + '<img src="resources/images/employee/users/'+employee.Image+'"/>'
        + '<img src="resources/images/employee/hexagon.svg  "/>'
        + '</div>'
        + '<div class="divBody">'
        + '<div class="divName" id="divNameOfUserRole'+employee.UserRoleId+'" onclick="displayEmployeeProfile('+employee.UserId+', \''+employee.FirstName+'\', \''+employee.LastName+'\', \''+employee.Username+'\',\''+employee.Phone+'\', \''+employee.Address+'\', \''+employee.Email+'\', \''+employee.Image+'\', \''+employee.LastActiveDate+'\')">'+employee.Name+'</div>'
        + '<div class="divTitle">'+ title +'</div>'
        + '<div class="divActions">'
        + '<img title="Assign Task" width="18px" height="20px" src="resources/images/employee/add_task.svg" onclick="addTask(' + employee.UserRoleId + ');"/> '
        + tmpMessage
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
    console.log(1);
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