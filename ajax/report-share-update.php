<?php
    include("../root.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Report.php");
    $report_obj = NEW Report();

    if(isset($_POST)){
        $patient_id  =  $_POST['patient_id'];
        echo $report_obj->updateReportShareView($patient_id,'lab_patient');
    }
?>