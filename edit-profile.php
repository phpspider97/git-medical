<?php
	include("root.php"); 
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	include(SITE_ROOT_ADMIN	.	"/classes/Admin.php"); 
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Location.php");
    
    $admin_obj = NEW Admin(); 
    $encryption_obj = NEW encryption(); 
    $location_obj = NEW Location();

    $admin_id = ''; 
	$admin_name = '';
	$admin_email = ''; 
	$admin_shop_name = '';
	$admin_shop_number = ''; 
    $admin_shop_zip_code = '';
    $admin_shop_city = '';
    $admin_shop_state = '';
    $admin_shop_country = 101;
	$admin_shop_address = '';
	$admin_about_shop = '';
	$admin_youtube_link = '';
	$admin_facebook_link = '';
	$admin_instagram_link = '';
    $is_active = 1; 
    $is_complete = 0; 
    $admin_id = $_SESSION['admin_id']; 
	$encrypted_admin_id	= $encryption_obj->encode($admin_id); 
    $all_country = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'country','');
	$all_state = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'state',' WHERE country_id=101');
	$all_city = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'city',' WHERE state_id=4015');
 
	if(isset($admin_id)){ 
		$a_get_data = $admin_obj->getData($admin_id);
		if(!empty($a_get_data)){ 
			$admin_id = $a_get_data['admin_id']; 
			$admin_name = $a_get_data['admin_name']; 
			$admin_email = $a_get_data['admin_email']; 
			$admin_shop_name = $a_get_data['admin_shop_name'];  
			$admin_shop_number = $a_get_data['admin_shop_number']; 
			$admin_shop_zip_code = $a_get_data['admin_shop_zip_code']; 
			$admin_shop_city = $a_get_data['admin_shop_city']; 
			$admin_shop_state = $a_get_data['admin_shop_state']; 
			$admin_shop_country = $a_get_data['admin_shop_country']; 
			$admin_shop_address = $a_get_data['admin_shop_address']; 
			$admin_about_shop = $a_get_data['admin_about_shop']; 
			$admin_facebook_link = $a_get_data['admin_facebook_link']; 
			$admin_instagram_link = $a_get_data['admin_instagram_link']; 
			$admin_youtube_link = $a_get_data['admin_youtube_link']; 
			$data_image = $a_get_data['data_image']; 
			$user_image = $a_get_data['user_image']; 
			$is_active = $a_get_data['is_active']; 
			$is_complete = $a_get_data['is_complete']; 

            if(empty($admin_shop_country)){
                $admin_shop_country = 101;
            }
            $all_state = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'state'," WHERE country_id=$admin_shop_country");
			$all_city = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'city'," WHERE state_id=$admin_shop_state");
		}
	}

    if(isset($_POST['data_submit'])){
        unset($_POST['data_submit']); 
        $_POST['admin_id']  =   $_SESSION['admin_id'];    
        $is_updated = $admin_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'admin',$_FILES);

        if($is_updated['status'] == 200){
            $_SESSION['notify_message'] = "Data ".$is_updated['msg']." successful.";
            $_SESSION['notify_type'] = "success";
            $_SESSION['is_complete'] = 1;
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/edit-profile.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_updated['msg'];
            $_SESSION['notify_type'] = "danger";
            
            $admin_name = $_POST['admin_name']; 
			$admin_email = $_POST['admin_email']; 
			$admin_shop_name = $_POST['admin_shop_name'];   
			$admin_shop_number = $_POST['admin_shop_number']; 
			$admin_shop_zip_code = $_POST['admin_shop_zip_code']; 
			$admin_shop_city = $_POST['admin_shop_city']; 
			$admin_shop_state = $_POST['admin_shop_state']; 
			$admin_shop_country = $_POST['admin_shop_country']; 
			$admin_shop_address = $_POST['admin_shop_address']; 
			$admin_about_shop = $_POST['admin_about_shop']; 
			$admin_facebook_link = $_POST['admin_facebook_link']; 
			$admin_instagram_link = $_POST['admin_instagram_link']; 
			$admin_youtube_link = $_POST['admin_youtube_link'];  

            if(empty($admin_shop_country)){
                $admin_shop_country = 101;
            }
            $all_state = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'state'," WHERE country_id=$admin_shop_country");
			$all_city = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'city'," WHERE state_id=$admin_shop_state");
        } 
 
    }
?>
    <script> 
        $(document).ready(function(){
            $('.change-active-status').on('click',function(e){  
                let step_number = $(this).data('step');
                let bottom_posiotion = $(this).data('position');
                if(step_number == 2){
                    if($('.admin_name').val() == ''){
                        alert('Please enter full name.');
                        $(".admin_name").focus();
                        return false;
                    } 
                }
                if(step_number == 3){
                    if($('.admin_shop_type').val() == 0){
                        alert('Please select shop type.');
                        $(".admin_shop_type").focus();
                        return false;
                    }
                    if($('.admin_shop_name').val() == ''){
                        alert('Please enter shop name.');
                        $(".admin_shop_name").focus();
                        return false;
                    }
                    if($('.admin_shop_number').val() == ''){
                        alert('Please enter shop number.');
                        $(".admin_shop_number").focus();
                        return false;
                    }
                    if($('.admin_shop_zip_code').val() == ''){
                        alert('Please enter shop zipcode.');
                        $(".admin_shop_zip_code").focus();
                        return false;
                    }
                    if($('.admin_shop_country').val() == 0){
                        alert('Please select shop country.');
                        $(".admin_shop_country").focus();
                        return false;
                    }
                    if($('.admin_shop_state').val() == 0){
                        alert('Please select shop state.');
                        $(".admin_shop_state").focus();
                        return false;
                    }
                    if($('.admin_shop_city').val() == 0){
                        alert('Please select shop city.');
                        $(".admin_shop_city").focus();
                        return false;
                    }
                    if($('.admin_shop_address').val() == ''){
                        alert('Please enter shop address.');
                        $(".admin_shop_address").focus();
                        return false;
                    }
                }  
                if(bottom_posiotion == 'bottom'){
                    $('.nav-link').removeClass('active')  
                    $(`.nav-link-${step_number}`).addClass('active') 
                }
            })

            $(".admin-shop-type").on('change',function(e){
                if(e.target.value == 11121){
                    $('.other-shop-type-name').show();
                }else{
                    $('.other-shop-type-name').hide();
                }  
            });
        });
        
        function changeState(country_id){ 
            $('#submit-spin').show();
            let send_data	=	{
                country_id : country_id
            }
            $.ajax({
                type:'POST',
                url:'ajax/change-state.php',
                data:send_data,
                success:function(response){  
                    $('.state_data').html(response)
                    $('#submit-spin').hide();
                }
            });
        }
        function changeCity(state_id){ 
            $('#submit-spin').show();
            let send_data	=	{
                state_id : state_id
            }
            $.ajax({
                type:'POST',
                url:'ajax/change-city.php',
                data:send_data,
                success:function(response){  
                    $('.city_data').html(response)
                    $('#submit-spin').hide();
                }
            });
        }
    </script> 
  <div class="content-wrapper">
    <div class="container-fluid">
        <?php if(empty($is_complete)){ ?>
            <div class="alert alert-danger p-2 text-center">
                Your profile is not update. Please fill ( Step 1 and Step 2 ) form.
            </div>
        <?php }?>
      <div class="row mt-3">
        <div class="col-lg-4">
           <div class="card profile-card-2">
            <div class="card-img-block">
                <img class="img-fluid" src="<?= ($data_image)?$data_image:NO_IMAGE_URL; ?>" alt="Card image cap">
            </div>
            <div class="card-body pt-5 text-center">
                <img src="<?= ($user_image)?$user_image:NO_IMAGE_URL; ?>" alt="profile-image" class="profile" style="width:65px;height:65px">
                <h5 class="card-title"><?= $admin_name; ?></h5> 
                <!-- <input class="form-control" type="text" name="admin_name" value="<?= SITE_URL;?>/shop/<?= $encrypted_admin_id;?>" disabled> -->
                <a target="" href="#" class="btn btn-light mt-2" style="width:100%"> 
                    <i class="fa-solid fa-shop"></i> <?= $admin_shop_name; ?>
                </a>
                <!-- <a target="_blank" href="<?= SITE_URL;?>/shop/<?= $encrypted_admin_id;?>" class="btn btn-light mt-2" style="width:100%"> 
                    <i class="fa-solid fa-copy"></i> Copy Shop Link
                </a> -->
            </div>
 
        </div>

        </div>

        <div class="col-lg-8">
           <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <!-- <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Messages</span></a>
                </li> -->
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#step-1" data-toggle="pill" class="nav-link nav-link-1 change-active-status active hide-loader" data-step='1'>
                        <i class="icon-note"></i> <span class="hidden-xs">STEP 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#step-2" data-toggle="pill" class="nav-link nav-link-2 change-active-status hide-loader" data-step='2'>
                        <i class="icon-note"></i> <span class="hidden-xs">STEP 2</span>
                    </a>
                </li> 
            </ul>

            <form method="POST" action="" enctype="multipart/form-data">
            <div class="tab-content p-3">
                <?php if(isset($_SESSION['notify_message'])){ ?>
                    <div class="notification-div alert alert-<?= ($_SESSION['notify_type'] == 'success')?'success':'danger'?> p-2"><?= $_SESSION['notify_message']; ?></div>
                <?php unset($_SESSION['notify_message']); unset($_SESSION['notify_type']); }?>
                <!-- <div class="tab-pane" id="profile">
                    <h5 class="mb-3">Recent Activity</h5>
                    <div class="row"> 
                        <div class="col-md-12"> 
                             <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div> 
                </div>  -->

                    <div class="tab-pane active" id="step-1">
                        <lable><b>YOUR DETAIL</b></lable>
                        <lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
                        <hr />  
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Full Name *</label>
                            <div class="col-lg-9">
                                <input class="form-control admin_name" type="text" name="admin_name" value="<?= $admin_name; ?>" required />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email address *</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" name="admin_email" value="<?= $admin_email; ?>" required readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" name="admin_password" value="">
                                <span>For change password enter password.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Your Image</label>
                            <div class="col-lg-9">
                                <input class="form-control mb-1" type="file" name="user_image" onChange="userFilevalidation()" id="user-file-upload-size"> 
                                <span style="font-size:10px;">Preferred image size (200 X 200) px</span>
                                <?php if(!empty($user_image)){ ?> 
                                    <br /><img src="<?= $user_image; ?>" class="mt-2" style="width:55px;height:60px;"/>
                                <?php } ?>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="button" data-target="#step-2" data-toggle="pill" class="btn btn-light px-5 w-100 border change-active-status" data-step='2' data-position='bottom'> Next <i class="fa-solid fa-angle-right"></i></button> 
                            </div>
                        </div> 
                    </div>
                    <div class="tab-pane" id="step-2">    
                        <lable><b>LAB DETAIL</b></lable>
                        <lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
                        <hr />  
                        <div class="form-group row other-shop-type-name" style="display:none">
                            <label class="col-lg-3 col-form-label form-control-label">-</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="admin_shop_type_name" value="" placeholder="Enter Shop Type Name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Lab Name *</label>
                            <div class="col-lg-9">
                                <input class="form-control admin_shop_name" type="text" name="admin_shop_name" value="<?= $admin_shop_name; ?>" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Number *</label>
                            <div class="col-lg-9">
                                <input class="form-control admin_shop_number" type="number" name="admin_shop_number" value="<?= $admin_shop_number; ?>" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Zip Code *</label>
                            <div class="col-lg-9">
                                <input class="form-control admin_shop_zip_code" type="number" name="admin_shop_zip_code" value="<?= $admin_shop_zip_code; ?>" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Country *</label>
                            <div class="col-lg-9">
                            <select class="form-control admin_shop_country" name="admin_shop_country" onChange="changeState(this.value)">
                                <option value=''>Select</option>
                                <?php if(!empty($all_country)){
                                    foreach($all_country as $country){
                                        $country_id 	= 	$country['id'];
                                        $country_name 	= 	$country['name'];
                                ?>
                                    <option value='<?= $country_id; ?>' <?= ($country_id==$admin_shop_country)?'selected':''; ?> ><?= $country_name; ?></option>
                                <?php } } ?> 
                            </select>
                        </div> 
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">State *</label>
                            <div class="col-lg-9">
                            <select class="form-control state_data admin_shop_state" name="admin_shop_state" onChange="changeCity(this.value)">
                                <option value='0'>Select</option> 
                                <?php
                                if(!empty($all_state)){
                                    foreach($all_state as $state){
                                        $state_id 	    = 	$state['id'];
                                        $state_name 	= 	$state['name'];
                                ?>
                                    <option value='<?= $state_id; ?>' <?= ($state_id==$admin_shop_state)?'selected':''; ?>>
                                        <?= $state_name; ?>
                                    </option>
                                <?php  } }  ?>
                            </select>
                        </div> 
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">City *</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="admin_shop_city" value="<?= $admin_shop_city; ?>"> 
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Address *</label>
                            <div class="col-lg-9">
                                <textarea class="form-control admin_shop_address" type="text" name="admin_shop_address" required ><?= $admin_shop_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">About Lab</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" type="text" name="admin_about_shop" style="height:200px;" ><?= $admin_about_shop; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Lab Logo</label>
                            <div class="col-lg-9">
                                <input class="form-control mb-1" type="file" name="data_image" onChange="filevalidation()" id="file-upload-size"> 
                                <span style="font-size:10px;">Preferred image size (192 X 640) px</span> 
                                <?php if(!empty($data_image)){ ?> 
                                    <br /><img src="<?= $data_image; ?>" class="mt-2" style="width:60px;height:60px;"/>
                                <?php } ?>
                            </div>
                        </div>

                        <lable><b>Social Link</b> <sub class="text-warning">(Optional)</sub></lable>
                        <hr />            
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Facebook Link</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="admin_facebook_link" value="<?= $admin_facebook_link; ?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Instagram Link</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="admin_instagram_link" value="<?= $admin_instagram_link; ?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Youtube Link</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="admin_youtube_link" value="<?= $admin_youtube_link; ?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9"> 
                                <input type="submit" name="data_submit" class="btn btn-light px-5 border w-100" value="Save Changes">  
                                <input type="hidden" name="encrypted_admin_id" value="<?= $encrypted_admin_id; ?>">
                                <input type="hidden" name="is_active" value="1">
                            </div>
                        </div>   
                    </div> 
                </div>
            </div>
        </div>
      </div>
      </form>
    </div> 
	<div class="overlay toggle-menu"></div> 
	
    </div> 
   </div>
    <a href="javaScript:void();" class="back-to-top hide-loader"><i class="fa fa-angle-double-up"></i> </a> 
<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>