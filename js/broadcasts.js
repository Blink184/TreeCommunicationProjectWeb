var SENTBROADCAST = "SENTBROADCAST";
var RECEIVEDBROADCAST = "RECEIVEDBROADCAST";

var SELECTEDTYPE;
var BROADCASTS = [];

window.onload = function () {
    setSelectedTab('tabBroadcast');
    SELECTEDTYPE = RECEIVEDBROADCAST;
    getBroadcasts();
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
        }else{
            elements[i].style.display = "none";
        }
    }
}

function broadcast(firstname, lastname, roledescription, userroletitle, broadcastId, fromUserRoleId, title, content, dateSent, isSender) {
    var broadcast = {
        FirstName: firstname,
        LastName: lastname,
        FullName: firstname + ' ' + lastname,
        RoleDescription: roledescription,
        UserRoleTitle: userroletitle,
        BroadcastId: broadcastId,
        FromUserRoleId: fromUserRoleId,
        Title: title,
        Content: content,
        DateSent: dateSent.replaceAll("-", "/"),
        IsSender: isSender
    }

    return broadcast;
}

function getBroadcasts() {
    var res = [];
    //this is an ajax post
    $.post("database/api/getBroadcasts.php",
        {
            userroleid: LOGGEDUSERROLEID
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)) {
                    res = jsonData(data);
                    BROADCASTS = [];
                    for(var i = 0; i < res.length; i++) {
                        var o = res[i];

                        BROADCASTS.push(broadcast(o.FirstName, o.LastName, o.Role, o.RoleTitle, o.BroadcastId, o.UserRoleId, o.Title, o.Content, o.DateSent, o.IsSender));
                    }
                    extractArrayBroadcasts();

                } else {
                    console.log(data)
                }
            }else{
                console.log(status)
            }
        }
    );
}

function extractArrayBroadcasts() {
    var broadcastContainer = document.getElementById("broadcastMsgContainerUl");
    var data = getData(BROADCASTS);
    broadcastContainer.innerHTML = data;

    filterBroadcasts();
}

function getData(broadcasts) {
    var tmp = '';
    for(var i=0; i< broadcasts.length; i++) {
        tmp += parseBroadcast(broadcasts[i]);
    }
    return tmp;
}

function parseBroadcast(broadcast) {
    var type = "";

    if (broadcast.IsSender == '1') {
        type = SENTBROADCAST;
    } else {
        type = RECEIVEDBROADCAST;
    }

    var tmpUserRoleTitle = "";
    if(broadcast.UserRoleTitle.length > 0){
        tmpUserRoleTitle = ' / ' + broadcast.UserRoleTitle;
    }


    var tmp = '<li>'
            +'<div class="brdcastMsg" data-type="'
            +type
            +'" onclick="displayBroadcast('
            +broadcast.BroadcastId
            +')">'
            +'<div id="top">'
            +'<div id="theImg">'
            +'<img id="profPicBrd"/>'
            +'</div>'
            +'<div id="empName">'
            +broadcast.FullName
            +'</div>'
            +'<span id="empRole">'
            +broadcast.RoleDescription + tmpUserRoleTitle
            +'</span>'
            +'<span id="timeSent">'
            +timeSince(new Date(broadcast.DateSent))+ ' ago'
            +'</span>'
            +'</div>'
            +'<div id="content">'
            +'<div id="title">'
            +broadcast.Title
            +'</div>'
            +'<div id="msgContent">'
            +broadcast.Content
            +'</div>'
            +'</div>'
            +'</div>'
            +'</li>';


    return tmp;
}
