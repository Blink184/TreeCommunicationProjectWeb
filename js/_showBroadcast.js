/**
 * Created by Kirby on 7/1/2016.
 */
var CURRENTBROADCASTID;
var CURRENTBROADCAST;

function closeShowBroadcast(){
    document.getElementById("showBroadcast").style.display = 'none';
}

function displayBroadcast(broadcastid) {
    CURRENTBROADCASTID = broadcastid;
    var broadcast;
    for (var i=0; i < BROADCASTS.length; i++) {
        var tmp = BROADCASTS[i];
        if (tmp.BroadcastId == CURRENTBROADCASTID) {
            broadcast = tmp;
            CURRENTBROADCAST = broadcast;
            break;
        }
    }

    setInnerHtml('showBroadcast_empNameFrom', broadcast.UFirstName + ' ' + broadcast.ULastName);
    setInnerHtml('showBroadcast_title', broadcast.Title);
    setInnerHtml('showBroadcast_content', broadcast.Content);
    setInnerHtml('showBroadcast_attachments', 'none');

    document.getElementById('showBroadcast').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}
