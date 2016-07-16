<?php

require 'connection.php';

function insertTask($from, $to, $title, $desc, $duedate, $startdate){
    $q = "INSERT INTO task (FromUserRoleId, ToUserRoleId, Title, Description, TaskState, DueDate, StartDate, IsDeleted) VALUES ($from, $to, '$title', '$desc', 1, '$duedate', '$startdate', 0)";
    return encode(execute($q), '');
}

function delegateTask($taskid, $delegatetouserroleid) {
    $q = "update task set DelegatedToUserRoleId = $delegatetouserroleid where TaskId = $taskid";
    return encode(execute($q), '');
}

function getTasks($userroleid) {
    $q = "
    select
      t.TaskId,
      t.FromUserRoleId,
      (case when t.DelegatedToUserRoleId is NULL then t.ToUserRoleId else t.DelegatedToUserRoleId end) as ToUserRoleId,
      (case when t.DelegatedToUserRoleId is NULL then 0 else t.ToUserRoleId end) as DelegatedByUserRoleId,
      Date(t.StartDate) as StartDate,
      t.TaskState,
      Date(t.DueDate) as DueDate,
      t.Title,
      t.Description,
      t.ToUserRoleId,
      t.FromUserRoleId,
      Concat(u1.FirstName, ' ', u1.LastName) as 'FromUserRole',
      Concat(u2.FirstName, ' ', u2.LastName) as 'ToUserRole'
      from task t
      left join userrole ur1 on ur1.UserRoleId = t.FromUserRoleId
      left join user u1 on u1.UserId = ur1.UserId
      left join userrole ur2 on ur2.UserRoleId = t.ToUserRoleId
      left join user u2 on u2.UserId = ur2.UserId
      left join userrole ur3 on ur3.UserRoleId = t.DelegatedToUserRoleId
      left join user u3 on u3.UserId = ur3.UserId
      where (DelegatedToUserRoleId = $userroleid or ((FromUserRoleId = $userroleid or ToUserRoleId = $userroleid) and DelegatedToUserRoleId is NULL)) and t.IsDeleted = 0
    ";
    $res = array();
    $rows = execute($q);
    while ($row = $rows->fetch_assoc()) {
        array_push($res, $row);
    }
    return encode(true, $res);
}

function acceptTask($taskId, $date){
    $q = "UPDATE task SET AcceptedDate = '$date', TaskState = 2 where TaskId = $taskId";
    return encode(execute($q), '');
}

function finishTask($taskId, $date){
    $q = "UPDATE task SET DoneDate = '$date', TaskState = 3 where TaskId = $taskId";
    return encode(execute($q), '');
}