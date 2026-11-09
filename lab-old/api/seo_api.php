<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Content.php");
    $page_obj = NEW Content();

    if(isset($_GET['page_data'])){
        $page_name = $_GET['page_data'];
        $api_page_data = $page_obj->getPerticularApiPageData($page_name);
    }else{
        $api_page_data = $page_obj->getPerticularApiPageData();
    }
    echo json_encode($api_page_data);
?>