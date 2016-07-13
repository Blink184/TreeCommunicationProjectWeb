window.onload = function () {
    setSelectedTab('tabEmployee');
    loadTree();
};
function employee(userRoleId, userId, name, title, image, children){
    var employee = {
        UserRoleId: userRoleId,
        UserId: userId,
        Name: name,
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
    TREE = employee(userrole.UserRoleId, userrole.UserId, userrole.Name, userrole.Role, userrole.Image, getChildrenObjects(userrole));
}

function getChildrenObjects(userrole){
    var arr = [];
    for(var i = 0; i < userrole.Children.length; i++){
        arr.push(employee(userrole.Children[i].UserRoleId, userrole.Children[i].UserId, userrole.Children[i].Name, userrole.Children[i].Role, userrole.Children[i].Image, getChildrenObjects(userrole.Children[i])));
    }
    return arr;
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
    if(employee.Children !== undefined){
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
    return '<li><div class="divEmployeeControl" data-employeeId="'+employee.UserRoleId+'">'
        + '<div class="hexagon" onclick="displayEmployeeProfile('+employee.UserRoleId+')">'
        + '<img src="resources/images/employee/users/'+employee.Image+'"/>'
        + '<img src="resources/images/employee/hexagon.svg"/>'
        + '</div>'
        + '<div class="divBody">'
        + '<div class="divName" onclick="displayEmployeeProfile('+employee.UserRoleId+')">'+employee.Name+'</div>'
        + '<div class="divTitle">'+employee.Title+'</div>'
        + '<div class="divActions">'
        + '<img src="resources/images/employee/add_task.svg" onclick="addTask(\''+employee.Name+'\', ' + employee.UserRoleId + ');"/> '
        + '<img src="resources/images/employee/message.svg" onclick="sendMessage(\''+employee.Name+'\', ' + employee.UserRoleId + ');"/> '
        + '<img class="showOnTreeEdit" src="resources/images/employee/add.png" onclick="addUserRole(\''+employee.Name+'\', ' + employee.UserRoleId + ');" height="18" width="18"/> '
        + '<img class="showOnTreeEdit" src="resources/images/employee/delete.png" onclick="deleteUserRole(' + employee.UserRoleId+ ');" width="18" height="18"/> '
        + '<span class="showOnTreeEdit" class="image-upload"><label for="file-input'+employee.UserRoleId+'"><img src="resources/images/user.png" width="16" height="18"/></label><form method="post" enctype="multipart/form-data"><input id="file-input'+employee.UserRoleId+'" name="file-input" onchange="fileSelected(this)" type="file"/><input type="hidden" name="userId" value="'+employee.UserId+'"/></form></span>'
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