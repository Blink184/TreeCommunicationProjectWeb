var CONTACTS = [];
var MESSAGES = [];
var SEARCH;

window.onload = function () { setSelectedTab('tabMessage');};
function searchContacts(value){
    SEARCH = value.trim();
    filterContacts();
}

function contact(userRoleId, name, role, date, image, lastMessage){
    return {
        UserRoleId: userRoleId,
        name: name,
        role: role,
        date: date,
        image: image,
        lastMessage: lastMessage
    };
}

function getContacts(){
    $.post("database/api/getContacts.php",
        {
            userroleid: LOGGEDUSERROLEID
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)) {
                    var res = jsonData(data);
                    CONTACTS = [];
                    for(var i = 0; i < res.length; i++){
                        var o = res[i];
                        CONTACTS.push(contact(o.UserRoleId, o.Name, o.Role, o.DateSent, o.Image, o.Content));
                    }
                    extractArrayContacts();
                } else {
                    console.log(data)
                }
            }else{
                console.log(status)
            }
        }
    );
}

function extractArrayContacts(){
    var taskContainer = document.getElementById("ulContacts");
    var data = getData(CONTACTS);
    taskContainer.innerHTML = data;
    filterContacts();
}

function getData(contacts){
    console.log(contacts);
}

function isSearching(){
    return SEARCH.length > 0;
}

function filterContacts(){
    var elements = document.getElementsByClassName('messagesContactsControlRow');
    for(var i = 0; i < elements.length; i++){
        var elementName = elements[i].getAttribute('data-name');
        if(isSearching() && !matchSearch(elementName)){
            elements[i].style.display = "none";
        }else{
            elements[i].style.display = "block";
        }
    }
}

function matchSearch(element){
    if(element.trim().toLowerCase().indexOf(SEARCH.toLowerCase()) > -1){
        return true;
    }
    return false;
}