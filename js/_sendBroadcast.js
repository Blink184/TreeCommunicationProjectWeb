function closeSendBroadcast(){
    document.getElementById("sendBroadcast").style.display = "none";
}
function sendBroadcast(){
    document.getElementById('sendBroadcast').style.display = 'block';
}
function sendBroadcastToSelectionChanged(value){
    document.getElementById('liCustom').style.display = (value == 2) ? 'block' : 'none';
}
function submitSendBroadcast(){
    disable('btnSubmitSendBroadcast');
    var toType = '';
    var values = [];
    if (document.getElementById('to').value == 2) {
        values = getSelectedValues();
        toType = 'custom';
    } else if (document.getElementById('to').value == 1) {
        toType = 'children';
    } else {
        toType = 'all';
    }

    var title = getValue('sendBroadcast_Title');
    var content = getValue('message');

    insertBroadcast(toType, values, title, content);
}


function insertBroadcast(toType, toValues, title, content) {

    var to = '';
    if (toType == 'custom') {
        for (var i = 0; i < toValues.length; i++) {
            if (i == toValues.length - 1) {
                to = ''+toValues;
            } else
                to = ''+toValues+',';
        }
    }

    $.post("database/api/insertBroadcast.php",
        {
            fromuserroleid: LOGGEDUSERROLEID,
            totype: toType,
            touserroleids: to,
            title: title,
            content: content
        },
        function(data, status){
            if (status == "success") {
                if (jsonSuccess(data)) {
                    closeSendBroadcast();
                    getBroadcasts();
                } else {
                    console.log(data)
                }
            } else {
                console.log(status)
            }
            enable('btnSubmitSendBroadcast');
        }
    );
}

function getSelectedValues() {
    var toCustom = document.getElementById('toCustom');
    var values = [];
    for (var i = 0; i < toCustom.options.length; i++) {
        if (toCustom.options[i].selected) {
            values.push(toCustom.options[i].value);
        }
    }

    return values;
}
