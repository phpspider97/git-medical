<?php
	include("root.php"); 
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	//include_once(SITE_ROOT_ADMIN	.	"/classes/Setting.php");
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
 
    //$setting_obj = NEW Setting();
    $encryption_obj = NEW encryption(); 
 
	$setting_id = 0;
    $setting_body_color = 0; 
	$setting_menu_color = 0;  
	$setting_menu_nav_color	=	0;
	$setting_card_color = 0;  
	$setting_text_color = 0; 
	$setting_website_name = '';
    $data_image = ''; 
    $is_active = '';
	$is_report_header = '';
	$setting_about = '';
	$admin_id = $_SESSION['admin_id'];
	$encrypted_admin_id	= $encryption_obj->encode($admin_id);
    
	$is_display = 'none';
	if(isset($_GET['is_display'])){
		$is_display = 'inline';
	}

	$a_get_data = $setting_obj->getData($admin_id);
	if(!empty($a_get_data)){
		$setting_id = $a_get_data['setting_id']; 
		$setting_website_name = $a_get_data['setting_website_name']; 
		$setting_body_color = $a_get_data['setting_body_color']; 
		$setting_menu_color = $a_get_data['setting_menu_color']; 
		$setting_menu_nav_color = $a_get_data['setting_menu_nav_color']; 
		$setting_card_color = $a_get_data['setting_card_color']; 
		$setting_text_color = $a_get_data['setting_text_color']; 
		$setting_about = $a_get_data['setting_about']; 
		$data_image = $a_get_data['data_image']; 
		$is_active = $a_get_data['is_active']; 
		$is_report_header = $a_get_data['is_report_header']; 
	}

    if(isset($_POST['data_submit'])){ 
        unset($_POST['data_submit']);
		$_POST['admin_id']  =   $admin_id; 
        $is_updated = $setting_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'setting',$_FILES);

        if($is_updated['status'] == 200){
            $_SESSION['notify_message'] = "Data ".$is_updated['msg']." successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-setting.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_updated['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-setting.php");
            exit();
        }
    }
?> 
<!-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> -->
<div class="content-wrapper">
	<div class="container-fluid"> 
		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							ADD SETTING
							<lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
						</div>
						<hr> 
						<?php if(isset($_SESSION['notify_message'])){ ?>
							<div class="notification-div alert alert-<?= $_SESSION['notify_type']; ?> p-2"><?= $_SESSION['notify_message']; ?></div>
						<?php unset($_SESSION['notify_message']); }?>
						<form method="POST" action="" enctype="multipart/form-data">
							<div style="display:<?= $is_display; ?>">
								<div class="row">
									<div class="col-md-3"> 
										<div class="form-group">
											<label for="input-1">Body Color</label>
											<input type="color" class="form-control body-color" id="input-1" placeholder="Enter Name" name="setting_body_color" value="<?= $setting_body_color; ?>" />
										</div>
									</div>
									<div class="col-md-3"> 
										<div class="form-group">
											<label for="input-1">Menu Color</label>
											<input type="color" class="form-control menu-color" id="input-1" placeholder="Enter Name" name="setting_menu_color" value="<?= $setting_menu_color; ?>" />
										</div>
									</div>
									<div class="col-md-3"> 
										<div class="form-group">
											<label for="input-1">Menu Nav Bar Color</label>
											<input type="color" class="form-control menu-nav-color" id="input-1" placeholder="Enter Name" name="setting_menu_nav_color" value="<?= $setting_menu_nav_color; ?>" />
										</div>
									</div>
									<div class="col-md-3"> 
										<div class="form-group">
											<label for="input-1">Card Box Color</label>
											<input type="color" class="form-control card-color" id="input-1" placeholder="Enter Name" name="setting_card_color" value="<?= $setting_card_color; ?>" />
										</div>
									</div>
									<div class="col-md-12"> 
										<div class="form-group">
											<label for="input-1">Text Color</label>
											<input type="color" class="form-control text-color" id="input-1" placeholder="Enter Name" name="setting_text_color" value="<?= $setting_text_color; ?>" />
										</div>
									</div>
								</div>  
							</div>  
							<div class="form-group d-none">
								<label for="input-1">Website Name</label>
								<input type="text" class="form-control text-color" id="input-1" placeholder="Enter Website Name" name="setting_website_name" value="<?= $setting_website_name; ?>" />
							</div>
							<div class="form-group d-none">
								<label for="input-1">About Us</label>
								<textarea id="editor" type="color" class="form-control text-color" placeholder="Enter About Content" name="setting_about"><?= $setting_about; ?></textarea>
							</div> 
							<!-- <div class="form-group">
								<label for="input-1">Lab Logo</label> <br />
								<input type="file" name="data_image" class="form-control mb-1" onChange="filevalidation()" id="file-upload-size">
								<span style="font-size:10px;">Preferred image size (100 X 100) px</span><br />
								<?php if(!empty($data_image)){ ?> 
									<img src="<?= $data_image; ?>" class="mt-2 ml-3" style="width:60px;height:60px;"/>
								<?php } ?>
							</div>  -->
							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox1" name="is_report_header" value="1" <?= ($is_report_header)?'checked':''; ?>/>
								<label for="user-checkbox1">Is Rport Header Display</label>
								</div>
							</div> 
							<!-- <div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox2" name="is_active" value="1" <?= ($is_active)?'checked':''; ?>/>
								<label for="user-checkbox2">Is Active</label>
								</div>
							</div> -->
							<div class="form-group">
								<button type="submit" name="data_submit" class="btn btn-light"><i class="icon-lock"></i> Submit</button> 
								<input type="hidden" name="setting_id" value="<?= $setting_id; ?>">
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
<script>
	// CKEDITOR.replace( 'editor' ); 
	// CKEDITOR.on('instanceReady', function(e) { 
	// 	e.editor.document.getBody().setStyle('background', '#202938');
	// 	e.editor.document.getBody().setStyle('color', 'white');
	
	// }); 
    // CKEDITOR.config.removePlugins = ['pastetext','pastetools','pastefromgdocs','pastefromword','undo','about','removeformat','strike']; 
</script>
<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>