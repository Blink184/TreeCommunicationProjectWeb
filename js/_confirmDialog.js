var ACTION;
var VALUE;

function cancelAction(){
    document.getElementById("confirmDialog").style.display = "none";
}

function submitAction(){
    console.log("SUBMITTING");
    ACTION(VALUE);
    document.getElementById("confirmDialog").style.display = "none";
}

function showConfirmDialog(f, value, title, content) {
    ACTION = f;
    VALUE = value;
    setInnerHtml('confirmDialog_title', "this is a title");
    setInnerHtml('confirmDialog_content', "this is the content");

    console.log(getObject('confirmDialog'));
    getObject('confirmDialog').style.display = 'block';
    console.log(getObject('confirmDialog'));
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}