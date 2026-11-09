<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Category.php");
    $category_obj = NEW Category();

    if(isset($_GET['category_data'])){
        $permalink = $_GET['category_data'];
        $a_api_category_data = $category_obj->getPerticularApiCategoryData($permalink);
        $api_category_comment_data = $category_obj->getPerticularApiCategoryBlogData($permalink);
        $api_category_data['category_data'] = $a_api_category_data;
        $api_category_data['blog_data'] = $api_category_comment_data;
    }else{
        $api_category_data = $category_obj->getAllApiCategoryData();
    }
    echo json_encode($api_category_data);
?>