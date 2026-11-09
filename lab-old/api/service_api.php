<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Service.php");
    $service_obj = NEW Service();

    if(isset($_GET['service_data'])){
        $permalink = $_GET['service_data'];
        $a_api_service_data = $service_obj->getPerticularApiServiceData($permalink);
        $api_service_comment_data = $service_obj->getPerticularApiServiceBlogData($permalink);
        $api_service_data['service_data'] = $a_api_service_data;
        $api_service_data['blog_data'] = $api_service_comment_data;
    }else{
        $api_service_data = $service_obj->getAllApiServiceData();
    }
    echo json_encode($api_service_data);
?>