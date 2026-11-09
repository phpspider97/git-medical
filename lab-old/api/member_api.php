<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Login_registration.php");
    $member_obj = NEW Login();

    if(isset($_GET['member_data'])){
        $permalink = $_GET['member_data'];
        $a_api_member_data = $member_obj->getPerticularApiMemberData($permalink);
        $api_member_comment_data = $member_obj->getPerticularApiMemberCommentData($permalink);
        $api_member_data['member_data'] = $a_api_member_data;
    }else{
        $api_member_data = $member_obj->getApiMemberDetail();
    }
    echo json_encode($api_member_data);
?>