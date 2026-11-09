<?php
    include("root.php"); 
    session_destroy();
    unset($_SESSION['admin_id']);
    unset($_SESSION['is_super_admin']);
    ob_clean();				
    header("Location: ".SITE_URL_ADMIN."/");
    exit();	