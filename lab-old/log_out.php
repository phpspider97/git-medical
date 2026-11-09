<?php
include("root.php");
unset($_SESSION['member_id']);
unset($_SESSION['member_name']); 
session_destroy();
ob_clean();				
header("Location: ".SITE_URL."/login.php");
exit();