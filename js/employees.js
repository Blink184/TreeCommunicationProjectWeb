window.onload = function () {
    setSelectedTab('tabEmployee');
    loadTree();
    setDateTimePicker('.datetimepicker');
};
function employee(userRoleId, userId, roleId, firstName, lastName, phone, address, lastActiveDate, role, title, image, children){
    var employee = {
        UserRoleId: userRoleId,
        UserId: userId,
        RoleId: roleId,
        FirstName: firstName,
        LastName: lastName,
        Name: firstName + ' ' + lastName,
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

var TREE;

function loadTree(){
    $.post("database/api/getUserRoleTree.php",
        {
            parentid: 1
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
    return employee(userrole.UserRoleId, userrole.UserId, userrole.RoleId, userrole.FirstName, userrole.LastName, userrole.Phone, userrole.Address, userrole.LastActiveDate, userrole.Role, userrole.Title, userrole.Image, getChildrenObjects(userrole));
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
    if(employee.Title.length > 0)
        title += ' / ' + employee.Title;
    return '<li><div class="divEmployeeControl" data-employeeId="'+employee.UserRoleId+'">'
        + '<div class="hexagon" onclick="displayEmployeeProfile('+employee.UserId+', \''+employee.FirstName+'\', \''+employee.LastName+'\',\''+employee.Phone+'\', \''+employee.Address+'\', \''+employee.Image+'\')">'
        + '<img src="resources/images/employee/users/'+employee.Image+'"/>'
        + '<img src="resources/images/employee/hexagon.svg  "/>'
        + '</div>'
        + '<div class="divBody">'
        + '<div class="divName" onclick="displayEmployeeProfile('+employee.UserId+', \''+employee.FirstName+'\', \''+employee.LastName+'\',\''+employee.Phone+'\', \''+employee.Address+'\', \''+employee.Image+'\')">'+employee.Name+'</div>'
        + '<div class="divTitle">'+ title +'</div>'
        + '<div class="divActions">'
        + '<img title="Assign Task" src="resources/images/employee/add_task.svg" onclick="addTask(' + employee.UserRoleId + ');"/> '
        + '<img title="Send Message" src="resources/images/employee/message.svg" onclick="sendMessage(\''+employee.Name+'\', ' + employee.UserRoleId + ');"/> '
        + '<img class="showOnTreeEdit" title="Add Child" src="resources/images/employee/add.png" onclick="addUserRole(' + employee.UserRoleId + ');" height="18" width="18"/> '
        + '<img class="showOnTreeEdit" title="Delete User Role" src="resources/images/employee/delete.png" onclick="deleteUserRole(' + employee.UserRoleId + ');" width="18" height="18"/> '
        + '<img class="showOnTreeEdit" title="Edit User Role" src="resources/images/employee/edit.png" onclick="editUserRole(' + employee.UserRoleId + ', ' + employee.UserId + ', ' + employee.RoleId + ', \'' + employee.Title + '\');" width="18" height="18"/> '
        + '</div>'
        + '</div>'
        + '</div>'
        + '<input type="checkbox" checked/>';
}

function fileSelected(obj){
    obj.parentNode.submit();
}

function editTree(){
    var chb = getObject("cbEditTree");
    var value = chb.checked ? "visible" : "hidden";
    var elmnts = document.getElementsByClassName("showOnTreeEdit");
    for(var i = 0; i < elmnts.length; i++){
        elmnts[i].style.visibility = value;
    }
}

function onAddTaskPopupClosed(){

}
