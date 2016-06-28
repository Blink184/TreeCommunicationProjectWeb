<link href="css/_messagesConversationControlRow.css" rel="stylesheet" type="text/css"/>
<div id="messagesConversationControlRow" <?php if(!$isSender) echo 'class="rotated"';?>>
    <table>
        <tr>
            <td rowspan="3" id="messagesConversationControlRow_picture">
                <img src="resources/images/pp_tm.PNG">
            </td>
            <td id="messagesConversationControlRow_time">
                (<?=$time?>)
            </td>
        </tr>
        <tr>
            <td id="messagesConversationControlRow_message">
                <?=$message?>
            </td>
        </tr>
        <tr>
            <td id="messagesConversationControlRow_files">
                <?php if(isset($files) && strlen($files) > 0) echo 'files: ' . $files;?>
            </td>
        </tr>
    </table>
</div>
