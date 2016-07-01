<link href="css/_messagesContactsControlRow.css" rel="stylesheet" type="text/css"/>
<div class="messagesContactsControlRow <?php if(!$isRead) echo 'new';?>" data-name="<?=$name?>">
    <table>
        <tr>
            <td rowspan="2" id="messagesContactsControlRow_picture">
                <img src="resources/images/<?=$img?>">
            </td>
            <td id="messagesContactsControlRow_nameAndTime">
                <span id="messagesContactsControlRow_name"><?=$name?></span>
                <span id="messagesContactsControlRow_time">(<?=$time?>)</span>
            </td>
            <td id="messagesContactsControlRow_status" align="right">
                <?php
                    if($isRead){
                        echo '<img src="resources/images/message/read_message_blue_tick.svg"/>';
                    }else{
                        echo '<img src="resources/images/message/unread_message_blue_dot.svg"/>';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td id="messagesContactsControlRow_lastMessage">
                <?=$lastMessage?>
            </td>
        </tr>
    </table>
</div>
