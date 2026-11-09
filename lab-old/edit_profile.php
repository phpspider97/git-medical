<?php
    include("root.php");
    if(!isset($_SESSION['member_id'])){
        ob_clean();				
        header("Location: ".SITE_URL."/login.php");
        exit();	
    }
    include(SITE_ROOT	.	"/includes/top.php");
    include(SITE_ROOT	.	"/classes/Login_registration.php");
    include(SITE_ROOT	.   "/classes/Encryption.php");

    $login_obj = NEW Login();
    $encryption_obj = NEW encryption();

    $member_display_name = ''; 
    $member_first_name = $_SESSION['member_first_name']; 
    $member_last_name = $_SESSION['member_last_name']; 
    $member_email = $_SESSION['member_email']; 
    $member_bio = ''; 

    $a_member_data = $login_obj->getMemberDetail($_SESSION['member_id']);
    if(!empty($a_member_data)){
        $member_display_name = $a_member_data['member_display_name']; 
        $member_bio = $a_member_data['member_bio'];
        $image_path = $a_member_data['image_path'];
        $member_lab_number = $a_member_data['member_lab_number'];
        $member_address = $a_member_data['member_address'];
        $member_phone = $a_member_data['member_phone'];
        $image_path = $a_member_data['image_path'];
    }

    if(isset($_POST['edit_profile'])){
        unset($_POST['edit_profile']);
        $encrypted_member_id = $encryption_obj->encode($_SESSION['member_id']);
        $is_updated = $login_obj->updateProfile($_POST,'lab_member',$_FILES,$encrypted_member_id);
        if(!empty($is_updated)){
            $_SESSION['notify_message'] = "Data $is_updated successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL."/edit_profile.php");
            exit();
        }else{
            $_SESSION['notify_message'] = "Some server error.";
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL."/edit_profile.php");
            exit();
        }
    }
    if(isset($_SESSION['notify_message'])){
        $notify_message = $_SESSION['notify_message'];
        $notify_type = $_SESSION['notify_type'];
        include("notify_me.php");
        unset($_SESSION['notify_message']);
        unset($_SESSION['notify_type']);
    }
?>
<script>

  $( document ).ready(function() {
    $("input").change(function(e) {
        var file = e.originalEvent.srcElement.files[0];
        const image_name =  file.name;   
        $('#image_name').text(image_name);
    });
  });
</script>

<div class="page-body">
    <div class="container-fluid">
    <div class="page-header">
        <div class="row">
        <div class="col-sm-6">
            <h3>Edit Lab Profile</h3>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= SITE_URL;?>">Home</a></li>
            <li class="breadcrumb-item active">Edit Lab Profile</li>
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
        <div class="col-xl-4" style="display:none">
            <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title mb-0">Welcome !!</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                <div class="row mb-2">
                    <div class="profile-title">
                    <div class="media">
                        <!-- <img class="img-70 rounded-circle" alt="" src="<?= SITE_URL;?>/assets/images/user/7.jpg"> -->
                        <div class="media-body">
                        <h3 class="mb-1 f-20 txt-primary"><?= $_SESSION['member_name']; ?></h3>
                        <!-- <p class="f-12">DESIGNER</p> -->
                        </div>
                    </div>
                    </div>
                </div>
                <!-- <div class="mb-3">
                    <h6 class="form-label">About Your Self</h6>
                    <textarea class="form-control" rows="5" placeholder="2 line about your self..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email-Address</label>
                    <input class="form-control" placeholder="your-email@domain.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" value="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Website</label>
                    <input class="form-control" placeholder="http://Uplor .com">
                </div>
                <div class="form-footer">
                    <button class="btn btn-primary btn-block">Save</button>
                </div> -->
                </form>
            </div>
            </div>
        </div>
        <div class="col-xl-12">
            <form class="card" method="POST" action="" enctype="multipart/form-data" id="field_form">
            <div class="card-header pb-0">
                <h4 class="card-title mb-0">Edit Profile</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body add-post">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">Lab Name</label>
                        <input class="form-control" type="text" name="member_display_name" value="<?= $member_display_name;?>" placeholder="Lab Name" required />
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">Lab Number</label>
                        <input class="form-control" type="text" name="member_lab_number" value="<?= $member_lab_number;?>" placeholder="Lab Number" required />
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" type="email" name="member_email" value="<?= $member_email;?>" placeholder="Email address">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">Your First Name</label>
                        <input class="form-control" type="text" name="member_first_name" value="<?= $member_first_name;?>" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">Your Last Name</label>
                        <input class="form-control" type="text" name="member_last_name" value="<?= $member_last_name;?>" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">Your Contact Number</label>
                        <input class="form-control" type="text" name="member_phone" value="<?= $member_phone;?>" placeholder="Contact phone">
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input class="form-control" type="text" placeholder="Home Address">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-3">
                        <label class="form-label">City</label>
                        <input class="form-control" type="text" placeholder="City">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                        <label class="form-label">Postal Code</label>
                        <input class="form-control" type="number" placeholder="ZIP Code">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                        <label class="form-label">Country</label>
                        <select class="form-control btn-square">
                            <option value="0">--Select--</option>
                            <option value="1">Germany</option>
                            <option value="2">Canada</option>
                            <option value="3">Usa</option>
                            <option value="4">Aus</option>
                        </select>
                        </div>
                    </div> -->
                    <div class="col-sm-12 col-md-12 mt-2 mb-4">
                        <div class="dropzone digits image-field image-upload text-center" id="singleFileUpload1">
                            <label class="m-0 dz-message needsclick mx-auto" for="file-input">
                                <?php if(empty($image_path)){ ?>
                                    <i class="icon-cloud-up"></i>
                                <?php }else{ ?>
                                    <?= "<img src='$image_path' style='width:100px;height:100px;' class='mb-3'>"; ?>
                                <?php } ?>
                                <h6 class="mb-0" id="image_name">Click to upload lab logo.</h6>
                            </label>
                            <input id="file-input" type="file" name="member_image" />
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">Lab Address ( Address / City / State / Pincode )</label>
                        <textarea class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Patient address" name="member_address" required> <?= $member_address; ?> </textarea>
                    </div>
                    <div class="col-md-12"> 
                        <label class="form-label">Tell something about Your lab</label>
                        <textarea class="form-control" rows="5" placeholder="2 line about your lab..." name="member_bio" id="editor1"><?= $member_bio;?></textarea>
                    </div>
 
                <div class="card-footer text-end mt-4">
                    <button name="edit_profile" class="btn btn-primary" type="submit">Update Profile</button>
                    <input type="hidden" name="member_id" value="<?= $_SESSION['member_id']; ?>">
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>
</div>
<style>
    .image-upload>input {
        display: none;
    }
</style>
<?php
  include(SITE_ROOT	.	"/includes/bottom.php");
?>  