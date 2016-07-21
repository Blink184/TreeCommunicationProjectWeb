var SENTBROADCAST = "SENTBROADCAST";
var RECEIVEDBROADCAST = "RECEIVEDBROADCAST";

var SELECTEDTYPE;
var BROADCASTS = [];

window.onload = function () {
    setSelectedTab('tabBroadcast');
    $("#toCustom").multiselect().multiselectfilter();
    SELECTEDTYPE = RECEIVEDBROADCAST;
    //filterBroadcasts();
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

function broadcast(broadcastId, fromUserRoleId, title, content, dateSent) {
    var broadcast = {
        BroadcastId: broadcastId,
        FromUserRoleId: fromUserRoleId,
        Title: title,
        Content: content,
        DateSent: dateSent
    }

    return broadcast;
}

function getBroadcasts() {
    var res = [];
    $.post("database/api/getBroadcasts.php",
        {
            userroleid: LOGGEDUSERROLEID
        },
        function(data, status){
            if(status == "success"){
                if(jsonSuccess(data)) {
                    console.log(data);
                    res = jsonData(data);
                    BROADCASTS = [];
                    console.log(res.length);
                    for(var i = 0; i < res.length; i++) {
                        var o = res[i];


                        BROADCASTS.push(broadcast(o.BroadcastId, o.FromUserRoleId, o.Title, o.Content, o.DateSent));
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

    console.log(broadcast);
    console.log(broadcast.FromUserRoleId);

    if (broadcast.FromUserRoleId == 2) {
        type = SENTBROADCAST;
    } else {
        type = RECEIVEDBROADCAST;
    }

    console.log(type);

    var tmp = '<li>'
            +'<div class="brdcastMsg" data-type="'
            +type
            +'" onclick="displayBroadcast('
            +broadcast.BroadcastId
            +')">'
            +'<div id="top">'
            +'<div id="theImg">'
            +'<img src="resources/images/pp_jl.jpg" id="profPicBrd"/>'
            +'</div>'
            +'<div id="empName">'
            +broadcast.FromUserRoleId
            +'</div>'
            +'<span id="empRole">'
            +broadcast.FromUserRoleId
            +'</span>'
            +'<span id="timeSent">'
            +timeSince(broadcast.DateSent)
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
