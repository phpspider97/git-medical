<?php
    include("root.php");
    if(!isset($_SESSION['member_id'])){
        ob_clean();				
        header("Location: ".SITE_URL."/login.php");
        exit();	
    }
    include(SITE_ROOT	.	"/includes/top.php");
    include(SITE_ROOT	.	"/classes/Login_registration.php");

    $login_obj = NEW Login(); 

    if(isset($_POST['change_passowrd'])){
        unset($_POST['change_passowrd']);
        $is_changed = $login_obj->changePassowrd($_POST,'company_member');
        if(!empty($is_changed)){
            $notify_message = "Password is changed successful.";
            $notify_type = "success";
        }else{
            $notify_message = "Old Password is not correct.";
            $notify_type = "danger";
        }
        include("notify_me.php");
    }
?>
<div class="page-body">
    <div class="container-fluid">
    <div class="page-header">
        <div class="row">
        <div class="col-sm-6">
            <h3>Change Password</h3>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= SITE_URL;?>">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div>
        <div class="col-sm-6">
            <!-- Bookmark Start-->
            <div class="bookmark">
            <!--<ul>-->
            <!--    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>-->
            <!--    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>-->
            <!--    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>-->
            <!--    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>-->
            <!--    <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>-->
            <!--    <form class="form-inline search-form">-->
            <!--        <div class="form-group form-control-search">-->
            <!--        <input type="text" placeholder="Search..">-->
            <!--        </div>-->
            <!--    </form>-->
            <!--    </li>-->
            <!--</ul>-->
            </div>
            <!-- Bookmark Ends-->
        </div>
        </div>
    </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="" id="field_form">
            <div class="card-header pb-0">
                <h4 class="card-title mb-0">Change Password</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="mb-3 m-form__group">
                            <label class="form-label">Old Password</label>
                            <div class="input-group">
                            <span class="input-group-text"><i class="icofont icofont-pencil-alt-5"></i></span>
                                <input class="form-control" type="password" name="old_password" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="mb-3 m-form__group">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                            <span class="input-group-text"><i class="icofont icofont-pencil-alt-5"></i></span>
                                <input class="form-control" type="password" name="new_password" placeholder="New Password">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button name="change_passowrd" class="btn btn-primary" type="submit">Change Password</button>
                <input type="hidden" name="member_id" value="<?= $_SESSION['member_id']; ?>">
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<?php
  include(SITE_ROOT	.	"/includes/bottom.php");
?>  