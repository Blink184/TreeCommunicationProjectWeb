<?php
$NEW = "NEW";
$INPROGRESS = "INPROGRESS";
$FINISHED = "FINISHED";
?>
<div class="divTaskControl" onclick="displayTask(this)" data-type="<?=$type;?>" data-status="<?=$status;?>">
    <div class="Header">
        <?=$name?>
    </div>
    <div class="statusImage">
        <?php
            if($status == $INPROGRESS){
                echo '<img src="resources/images/task/in_progress_blue.svg"/>';
            }else if($status == $FINISHED){
                echo '<img src="resources/images/task/finished_blue.svg"/>';
            }else if($status == $NEW){
                echo '<img src="resources/images/task/new_blue.svg"/>';
            }
        ?>
    </div>
    <div class="body">
        <div class="title">
            <img src="resources/images/task/task.svg"/><?=$title?>
        </div>
        <div class="description">
            <?=$content?>
        </div>
        <div class="date">
            <div class="dateTop">
                <div><img src="resources/images/task/date.svg"/><br>Start</div>
                <div><img/></div>
                <div><img src="resources/images/task/date.svg"/><br>Due</div>
            </div>
            <div class="dateMid">
                <div><img/></div>
            </div>
            <div class="dateBot">
                <div>19/6/2016</div>
                <div><img/></div>
                <div>21/6/2016</div>
            </div>
        </div>
    </div>
</div>