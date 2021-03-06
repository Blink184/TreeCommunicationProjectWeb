<div class="divEmployeeControl">
    <div class="hexagon" onclick="displayEmployeeProfile(this.innerHTML)">
        <img src="resources/images/<?=$img?>"/>
        <img src="resources/images/employee/hexagon.svg"/>
    </div>
    <div class="divBody">
        <div class="divName" onclick="displayEmployeeProfile(this.innerHTML)"><?=$name?></div>
        <div class="divTitle"><?=$title?></div>
        <div class="divActions">
            <img src="resources/images/employee/add_task.svg" onclick="addTask('<?=$name?>');"/>
            <img src="resources/images/employee/message.svg" onclick="sendMessage('<?=$name?>');"/>
            <img src="resources/images/employee/add_child.svg" onclick="addChild('<?=$name?>');"/>
        </div>
    </div>
</div>
<input type="checkbox" <?php if($isOpened) echo 'checked';?>/>