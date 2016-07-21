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

    setInnerHtml('showBroadcast_empNameFrom', broadcast.FromUserRole);
    setInnerHtml('showBroadcast_title', broadcast.Title);
    setInnerHtml('showBroadcast_content', broadcast.Content);
    setInnerHtml('showBroadcast_attachments', '');

    document.getElementById('showBroadcast').style.display = 'block';
}