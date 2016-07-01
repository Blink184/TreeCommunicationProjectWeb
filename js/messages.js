window.onload = function () { setSelectedTab('tabMessage');};
var SEARCH;
function searchContacts(value){
    SEARCH = value.trim();
    filterContacts();
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