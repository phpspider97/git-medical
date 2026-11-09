<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Blog.php");
    $blog_obj = NEW Blog();

    if(isset($_GET['blog_data'])){
        $permalink = $_GET['blog_data'];
        $a_api_blog_data = $blog_obj->getPerticularApiBlogData($permalink);
        $api_blog_comment_data = $blog_obj->getPerticularApiBlogCommentData($permalink);
        $api_blog_data['blog_data'] = $a_api_blog_data;
        $api_blog_data['comment_data'] = $api_blog_comment_data;
    }else{
        $api_blog_data = $blog_obj->getAllApiBlogData();
    }
    echo json_encode($api_blog_data);
?>