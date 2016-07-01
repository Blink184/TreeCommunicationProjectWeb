<link href="css/_broadcastControl.css" rel="stylesheet" type="text/css"/>
<div class="brdcastMsg" data-type="<?=$type;?>">
    <div id="top">
        <div id="theImg">
            <img src="resources/images/pp_jl.jpg" id="profPicBrd"/>
        </div>
        <div id="empName">
            <?=$empName?>
        </div>
        <span id="empRole">
            <?=$empRole?>
        </span>
        <span id="timeReceived">
            <?=$timeReceived?>
        </span>
    </div>
    <div id="content">
        <div id="title"><?=$title?></div>
        <div id="msgContent">
            <?=$msgContent?>
        </div>
    </div>
</div>