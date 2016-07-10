function cancelAddTask(){
    document.getElementById("addTask").style.display = "none";
}
function setAddTaskTarget(target){
    document.getElementsByName('addTask_to')[0].value = target;
}

function addTask(target){
    if(target !== undefined){
        setAddTaskTarget(target);
    }
    document.getElementById('addTask').style.display = 'block';
}

function submitAddTask() {
    var empNameTo = getValue("addTask_empNameTo");
    console.log(empNameTo);
    var title = getValue("addTask_title");
    console.log(title);
    var desc = getValue("addTask_description");
    console.log(desc);
    var dueDate = getValue("addTask_dueDate");
    console.log(dueDate);
    var log = getObject("addTask_log");
    if(notEmpty(desc) && notEmpty(empNameTo) && notEmpty(title) && notEmpty(dueDate)){
        console.log('6.5');
        disable("addTask_btnAdd");
        console.log('7');
        setProcessingLog(log);
        insertTask(empNameTo, 1, title, desc, dueDate);
    }else{
        setFailureLog(log, "Please fill all the fields");
    }
}




function insertTask(empNameTo, empNameFrom, title, desc, dueDate){
    console.log(empNameTo);
    console.log(empNameFrom);
    console.log(title);
    console.log(desc);
    console.log(dueDate);

    $.post("database/api/insertTask.php",
        {
            empnameto: empNameTo,
            empnamefrom: empNameFrom,
            title: title,
            desc: desc,
            duedate: dueDate
        },
        function(data, status){
            console.log(data);
            enable("addTask_btnAdd");
            var log = getObject("addTask_log");
            if(status == "success"){
                if(jsonSuccess(data)){
                    setSuccessLog(log, "Process completed");
                    clearAddTaskForm();
                }else{
                    setFailureLog(log, jsonData(data));
                }
            }else{
                setFailureLog(log, status);
            }
        }
    );
}

function clearAddTaskForm(){
    clearValue("addTask_title");
    clearValue("addTask_empNameTo");
    clearValue("addTask_description");
    clearValue("addTask_dueDate");
}