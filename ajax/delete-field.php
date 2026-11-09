<?php
include("../root.php");

include(SITE_ROOT	.	"/classes/Report.php");
$report_obj = NEW Report();

if(isset($_POST)){  
    $report_obj->deleteReportField($_POST);
} 
?>