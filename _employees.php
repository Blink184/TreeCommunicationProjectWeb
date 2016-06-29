<link href="css/_employees.css" rel="stylesheet" type="text/css"/>
<div id="divEmployee">
    <div id="divBot">
        <div id="employeeControlContainer">

            <link href="css/_employeeControl.css" rel="stylesheet" type="text/css"/>
            <ol class="tree">
                <li>
                    <?php addEmployeeControl("Jared Leto", "pp_jl.jpg", "Singer", true); ?>
                    <ol class="tree">
                        <li>
                            <?php addEmployeeControl("Ted Mosby", "pp_tm.PNG", "Actor"); ?>
                        </li>
                        <li>
                            <?php addEmployeeControl("Simon Cowell", "pp_sc.PNG", "Judge"); ?>
                            <ol>
                                <li>
                                    <?php addEmployeeControl("Will Smith", "pp_ws.PNG", "Actor"); ?>
                                    <ol class="tree">
                                        <li>
                                            <?php addEmployeeControl("Jon Snow", "pp_sc.PNG", "Swordsman"); ?>
                                            <ol class="tree">
                                                <li>
                                                    <?php addEmployeeControl("Jared Leto", "pp_jl.jpg", "Singer"); ?>
                                                </li>
                                                <li>
                                                    <?php addEmployeeControl("Azzam Mourad", "pp_ws.PNG", "Employee"); ?>
                                                    <ol class="tree">
                                                        <li>
                                                            <?php addEmployeeControl("Azzam Mourad", "pp_sc.PNG", "Employee"); ?>
                                                        </li>
                                                        <li>
                                                            <?php addEmployeeControl("Aynur Ajami", "pp_tm.PNG", "Employee"); ?>
                                                        </li>
                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                                <li>
                                    <?php addEmployeeControl("Ahmad Hammoud", "pp_tm.PNG", "IT Department"); ?>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <?php addEmployeeControl("Will Smith", "pp_ws.PNG", "Actor"); ?>
                        </li>
                    </ol>
                </li>
            </ol>

        </div>
    </div>
</div>
<?php include '_addTask.php';?>
<?php include '_sendMessage.php';?>
<?php include '_showEmployeeProfile.php';?>
<?php function addEmployeeControl($name, $img, $title, $isOpened = false){
    include '_employeeControl.php';
}