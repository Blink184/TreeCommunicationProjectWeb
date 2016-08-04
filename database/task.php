<?php

require_once 'connection.php';

function insertTask($from, $to, $title, $content, $duedate, $startdate){
    $conn = connect();
    $true = 1;
    $false = 0;
    if ($stmt = $conn->prepare("INSERT INTO task (FromUserRoleId, ToUserRoleId, Title, Content, TaskState, DueDate, StartDate, IsDeleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param("iississi", $from, $to, $title, $content, $true, $duedate, $startdate, $false);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function delegateTask($taskid, $delegatetouserroleid) {
    $conn = connect();
    if ($stmt = $conn->prepare("update task set DelegatedToUserRoleId = ? where TaskId = ?")) {
        $stmt->bind_param("ii", $delegatetouserroleid, $taskid);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function getTasks($userroleid, $limit) {
    $conn = connect();
    if ($stmt = $conn->prepare("\"
    (select
      t.TaskId,
      t.FromUserRoleId,
      t.DelegatedToUserRoleId,
      t.ToUserRoleId,
      Date(t.StartDate) as StartDate,
      t.TaskState,
      Date(t.DueDate) as DueDate,
      t.Title,
      t.Content,
      t.ToUserRoleId,
      t.FromUserRoleId,
      Concat(u1.FirstName, ' ', u1.LastName) as 'FromUserRole',
      Concat(u2.FirstName, ' ', u2.LastName) as 'ToUserRole',
      Concat(u3.FirstName, ' ', u3.LastName) as 'DelegatedToUserRole'
      from task t
      left join userrole ur1 on ur1.UserRoleId = t.FromUserRoleId
      left join user u1 on u1.UserId = ur1.UserId
      left join userrole ur2 on ur2.UserRoleId = t.ToUserRoleId
      left join user u2 on u2.UserId = ur2.UserId
      left join userrole ur3 on ur3.UserRoleId = t.DelegatedToUserRoleId
      left join user u3 on u3.UserId = ur3.UserId
      where (DelegatedToUserRoleId = ? or FromUserRoleId = ? or (ToUserRoleId = ? and DelegatedToUserRoleId is NULL)) and t.IsDeleted = 0 and t.IsCanceled = 0
      and t.TaskState = 1)

      UNION

      (select
      t.TaskId,
      t.FromUserRoleId,
      t.DelegatedToUserRoleId,
      t.ToUserRoleId,
      Date(t.StartDate) as StartDate,
      t.TaskState,
      Date(t.DueDate) as DueDate,
      t.Title,
      t.Content,
      t.ToUserRoleId,
      t.FromUserRoleId,
      Concat(u1.FirstName, ' ', u1.LastName) as 'FromUserRole',
      Concat(u2.FirstName, ' ', u2.LastName) as 'ToUserRole',
      Concat(u3.FirstName, ' ', u3.LastName) as 'DelegatedToUserRole'
      from task t
      left join userrole ur1 on ur1.UserRoleId = t.FromUserRoleId
      left join user u1 on u1.UserId = ur1.UserId
      left join userrole ur2 on ur2.UserRoleId = t.ToUserRoleId
      left join user u2 on u2.UserId = ur2.UserId
      left join userrole ur3 on ur3.UserRoleId = t.DelegatedToUserRoleId
      left join user u3 on u3.UserId = ur3.UserId
      where (DelegatedToUserRoleId = ? or FromUserRoleId = ? or (ToUserRoleId = ? and DelegatedToUserRoleId is NULL)) and t.IsDeleted = 0 and t.IsCanceled = 0
      and t.TaskState = 2)

      UNION

      (select
      t.TaskId,
      t.FromUserRoleId,
      t.DelegatedToUserRoleId,
      t.ToUserRoleId,
      Date(t.StartDate) as StartDate,
      t.TaskState,
      Date(t.DueDate) as DueDate,
      t.Title,
      t.Content,
      t.ToUserRoleId,
      t.FromUserRoleId,
      Concat(u1.FirstName, ' ', u1.LastName) as 'FromUserRole',
      Concat(u2.FirstName, ' ', u2.LastName) as 'ToUserRole',
      Concat(u3.FirstName, ' ', u3.LastName) as 'DelegatedToUserRole'
      from task t
      left join userrole ur1 on ur1.UserRoleId = t.FromUserRoleId
      left join user u1 on u1.UserId = ur1.UserId
      left join userrole ur2 on ur2.UserRoleId = t.ToUserRoleId
      left join user u2 on u2.UserId = ur2.UserId
      left join userrole ur3 on ur3.UserRoleId = t.DelegatedToUserRoleId
      left join user u3 on u3.UserId = ur3.UserId
      where (DelegatedToUserRoleId = ? or FromUserRoleId = ? or (ToUserRoleId = ? and DelegatedToUserRoleId is NULL)) and t.IsDeleted = 0 and t.IsCanceled = 0
      and t.TaskState = 3
      limit ?)
    ")) {
        $stmt->bind_param("iiiiiiiiii", $userroleid, $userroleid, $userroleid, $userroleid, $userroleid, $userroleid, $userroleid, $userroleid, $userroleid, $limit);
        $stmt->execute();
        $res = array();
        $rows = $stmt->get_result();
        while ($row = $rows->fetch_assoc()) {
            array_push($res, $row);
        }
        return encode(true, json_encode($res));
    } else {
        return encode(false, var_dump($conn->error));
    }

}

function acceptTask($taskId, $date){
    $conn = connect();
    $taskstate = 2;
    if ($stmt = $conn->prepare("UPDATE task SET AcceptedDate = ?, TaskState = ? where TaskId = ?")) {
        $stmt->bind_param("sii", $date, $taskstate, $taskId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function finishTask($taskId, $date){
    $conn = connect();
    $taskstate = 3;
    if ($stmt = $conn->prepare("UPDATE task SET DoneDate = ?, TaskState = ? where TaskId = ?")) {
        $stmt->bind_param("sii", $date, $taskstate, $taskId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}

function cancelTask($taskId, $date){
    $conn = connect();
    $true = 1;
    if ($stmt = $conn->prepare("UPDATE task SET IsCanceled = ?, CancelDate = ? where TaskId = ?")) {
        $stmt->bind_param("isi", $true, $date, $taskId);
        return encode($stmt->execute(), '');
    } else {
        return encode(false, var_dump($conn->error));
    }
}