<?php

require 'connection.php';

function insertTask($from, $to, $title, $desc, $duedate){
    $q = "INSERT INTO task 
(AttachmentId, FromUserRoleId, ToUserRoleId, Title, Description, TaskState, DueDate, IsDeleted) 
VALUES (null, $from, $to, '$title', '$desc', 1, $duedate, 0)";
    return encode(execute($q), '');
}
