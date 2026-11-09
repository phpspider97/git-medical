<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Blog.php");
    $blog_obj = NEW Blog();

    if(isset($_POST['blog_view'])){
        $blog_view = $_POST['blog_view'];
        $blog_id = $_POST['blog_id'];
        $api_view_data = $blog_obj->insertApiViewBlogData($blog_view,$blog_id);
    }
?>