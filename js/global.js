var isMenuExpanded = false;
var EXPANDARROW = "&#10095;";
var COLLAPSEARROW = "&#10094;";

function setSelectedTab(tab){
    document.getElementById(tab).className = "selectedTab";
}
function expandCollapseMenu(object){
    if(isMenuExpanded){
        collapseMenu(object);
    }else{
        expandMenu(object);
    }
}
function collapseMenu(object){
    setMenuWidth(100);
    isMenuExpanded = false;
    object.innerHTML = EXPANDARROW;
    setMenuDescriptionWidth(0);
}
function expandMenu(object){
    setMenuWidth(150);
    isMenuExpanded = true;
    object.innerHTML = COLLAPSEARROW;
    setMenuDescriptionWidth(80);
}
function setMenuDescriptionWidth(width){
    var desc = document.getElementsByClassName("menuDescription");
    for(var i = 0; i < desc.length; i++){
        desc[i].style.width = width;
    }
}
function setMenuWidth(width){
    var left = document.getElementById("liLeft");
    var right = document.getElementById("liRight");
    left.style.width = width;
    right.style.marginLeft = width;

}