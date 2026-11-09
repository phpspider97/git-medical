<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	
	include(SITE_ROOT_ADMIN	.	"/classes/Banner.php");
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
 
    $class_obj = NEW Banner();
    $encryption_obj = NEW encryption(); 

	$banner_id = 0;
    $banner_name = "";
    $data_image = "";
    $banner_description = ""; 
    $is_active = "";
	$admin_id = $_SESSION['admin_id'];
	$encrypted_admin_id	= $encryption_obj->encode($admin_id);
    
	if(isset($_GET['data_id'])){
		$encrypted_id = $_GET['data_id'];
		$data_id = $encryption_obj->decode($encrypted_id);
		$a_get_data = $class_obj->getData($data_id);
		if(!empty($a_get_data)){
			$banner_id = $a_get_data['banner_id']; 
			$banner_name = $a_get_data['banner_name']; 
			$data_image = $a_get_data['data_image']; 
			$banner_description = $a_get_data['banner_description']; 
			$is_active = $a_get_data['is_active']; 
		}
	}

    if(isset($_POST['data_submit'])){ 
        unset($_POST['data_submit']);
		$_POST['admin_id']  =   $admin_id; 
        $is_updated = $class_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'banner',$_FILES);

		if($is_updated['status'] == 200){
            $_SESSION['notify_message'] = "Data ".$is_updated['msg']." successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-banner.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_updated['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-banner.php");
            exit();
        }
    }
?>
<div class="content-wrapper">
	<div class="container-fluid"> 
		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Add Banner
							<lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
						</div>
						<hr>
						<?php if(isset($_SESSION['notify_message'])){ ?>
							<div class="notification-div alert alert-danger p-2"><?= $_SESSION['notify_message']; ?></div>
						<?php unset($_SESSION['notify_message']); }?>
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="input-1">Banner Name *</label>
								<input type="text" class="form-control" id="input-1" placeholder="Enter Name" name="banner_name" value="<?= $banner_name; ?>" required />
							</div>
							<div class="form-group">
								<label for="input-1">Banner Description</label> 
								<textarea type="text" class="form-control"id="input-1"  name="banner_description"><?= $banner_description; ?></textarea>
							</div>
							<div class="form-group">
								<label for="input-1">Banner Image *</label> <br />
								<input type="file" name="data_image" class="form-control mb-1" onChange="filevalidation()" id="file-upload-size" required>
								<span>Preferred image size (1920 X 930) px</span><br />
								<?php if(!empty($data_image)){ ?> 
									<img src="<?= $data_image; ?>" class="mt-2 ml-3" style="width:60px;height:60px;"/>
								<?php } ?>
							</div> 
							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox1" name="is_active" value="1" <?= ($is_active)?'checked':''; ?>/>
								<label for="user-checkbox1">Is Active</label>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" name="data_submit" class="btn btn-light px-5"><i class="icon-lock"></i> Submit</button>
								<a href="<?= SITE_URL_ADMIN;?>/manage-banner.php" class="btn btn-light">
									Manage banner <i class="fa-solid fa-arrow-right"></i>
								</a>
								<input type="hidden" name="banner_id" value="<?= $banner_id; ?>">
								<input type="hidden" name="encrypted_admin_id" value="<?= $encrypted_admin_id; ?>">
							</div>
						</form>
					</div>
				</div>
			</div> 
		</div> 
		<div class="overlay toggle-menu"></div>  
	</div> 
</div> 
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a> 

<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>