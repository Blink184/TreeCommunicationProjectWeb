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
    setInnerHtml('confirmDialog_title', title);
    setInnerHtml('confirmDialog_content', content);
    getObject('confirmDialog').style.display = 'block';
}

function setInnerHtml(id, value) {
    document.getElementById(id).innerHTML = value;
}