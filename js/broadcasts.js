var SENTBROADCAST = "SENTBROADCAST";
var RECEIVEDBROADCAST = "RECEIVEDBROADCAST";

var SELECTEDTYPE;

window.onload = function () {
    setSelectedTab('tabBroadcast');
    SELECTEDTYPE = RECEIVEDBROADCAST;
    filterBroadcasts();
};

function selectType(object, type){
    setSelectedType(object, type);
    filterBroadcasts();
}

function setSelectedType(object, type){
    var lis = object.parentNode.childNodes;
    for(var i = 0; i < lis.length; i++){
        lis[i].className = "";
    }
    object.className = "selected";
    SELECTEDTYPE = type;
}

function filterBroadcasts() {
    var elements = document.getElementsByClassName('brdcastMsg');
    for(var i=0; i<elements.length; i++) {
        var elementType = elements[i].getAttribute('data-type');
        if (elementType == SELECTEDTYPE) {
            elements[i].style.display = "inline-block";
        } else {
            elements[i].style.display = "none";
        }
    }
}