window.onload = function () {
    setSelectedTab('tabEmployee');
    extractArray();
};
function employee(employeeId, name, title, children){
    var employee = {
            EmployeeId: employeeId,
            Name: name,
            Title: title,
            Children: children
        };
    return employee;
}

var Employee =
    employee(1, "Ahmad Hammoud", "President", [
            employee(2, "Azzam Mourad", "Vice President"),
            employee(3, "Aynur Ajami", "Advisor IT")
        ]
    );


function extractArray(){
    var employeeControlContainer = document.getElementById("employeeControlContainer");
    var data = '<ol class="tree">' + getData(Employee) + '</ol>';
    employeeControlContainer.innerHTML = data;
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
    return '<li><div class="divEmployeeControl" data-employeeId="'+employee.EmployeeId+'">'
        + '<div class="hexagon" onclick="displayEmployeeProfile('+employee.EmployeeId+')">'
        + '<img src="resources/images/pp_sc.PNG"/>'
        + '<img src="resources/images/employee/hexagon.svg"/>'
        + '</div>'
        + '<div class="divBody">'
        + '<div class="divName" onclick="displayEmployeeProfile('+employee.EmployeeId+')">'+employee.Name+'</div>'
        + '<div class="divTitle">'+employee.Title+'</div>'
        + '<div class="divActions">'
        + '<img src="resources/images/employee/add_task.svg" onclick="addTask(\''+employee.Name+'\', ' + employee.EmployeeId + ');"/> '
        + '<img src="resources/images/employee/message.svg" onclick="sendMessage(\''+employee.Name+'\', ' + employee.EmployeeId + ');"/> '
        + '<img src="resources/images/employee/add_child.svg" onclick="addChild(\''+employee.Name+'\', ' + employee.EmployeeId + ');" width="16"/> '
        + '</div>'
        + '</div>'
        + '</div>'
        + '<input type="checkbox" checked/>';
}
