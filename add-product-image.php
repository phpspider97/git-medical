<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	
	include(SITE_ROOT_ADMIN	.	"/classes/ProductImage.php");
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
 
    $class_obj = NEW ProductImage();
    $encryption_obj = NEW encryption(); 

	$image_id = 0;
	$data_id = 0;
    $product_name = "";
    $data_image = "";
    $product_description = ""; 
    $product_color = "#D2B48C"; 
	$product_price = "";  
    $is_active = "";
    $admin_id = $_SESSION['admin_id'];
	$encrypted_admin_id	= $encryption_obj->encode($admin_id);
	$encrypted_product_id	= $_GET['data_id'];
    
	if(isset($_GET['data_id']) && isset($_GET['image_id']) ){
		$encrypted_id = $_GET['data_id'];
		$data_id = $encryption_obj->decode($encrypted_id);

        $encrypted_image_id = $_GET['image_id'];
		$data_image_id = $encryption_obj->decode($encrypted_image_id);

		$a_get_data = $class_obj->getData($data_id,DATABASE_TABLE_PREFIX.'product_images',$data_image_id);
        
		if(!empty($a_get_data)){
			$image_id = $a_get_data['image_id'];
			$product_name = $a_get_data['product_name'];
			$data_image = $a_get_data['data_image']; 
			$product_color = $a_get_data['product_color']; 
			$product_price = $a_get_data['product_price']; 
			$is_active = $a_get_data['is_active'];
		}
	}

    if(isset($_GET['data_id'])){
		$encrypted_id = $_GET['data_id'];
		$data_id = $encryption_obj->decode($encrypted_id);
		$a_get_data = $class_obj->getData($data_id,DATABASE_TABLE_PREFIX.'product_images',0); 
		if(!empty($a_get_data)){ 
			$product_name = $a_get_data['product_name']; 
		}
	}

    if(isset($_POST['data_submit'])){ 
        unset($_POST['data_submit']);
        $_POST['admin_id']  =   $admin_id; 
        $is_updated = $class_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'product_images',$_FILES);

        if($is_updated['status'] == 200){
            $_SESSION['notify_message'] = "Data ".$is_updated['msg']." successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-product-image.php?data_id=$encrypted_id");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_updated['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-product-image.php?data_id=$encrypted_id");
            exit();
        }
    }

    $a_all_data = $class_obj->getAllData($data_id,DATABASE_TABLE_PREFIX.'product_images');
 
    if(isset($_GET['delete_id']) || isset($_GET['file_path'])){
        $encrypted_admin_id = $encryption_obj->encode($_SESSION['admin_id']);
        //$full_image_path = FILE_ROOT_PATH.'/product_multiple_images/'.$encrypted_admin_id.'/'.$_GET['file_path']; 
        $full_image_path = $_GET['file_path'];
        
        $admin_user_id = $encryption_obj->decode($_GET['delete_id']);
        $is_deleted = $class_obj->deleteData($admin_user_id,DATABASE_TABLE_PREFIX.'product_images',$full_image_path);

        if($is_deleted['status'] == 200){
            $_SESSION['notify_message'] = $is_deleted['msg'];
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-product-image.php?data_id=$encrypted_id");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_deleted['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-product-image.php?data_id=$encrypted_id");
            exit();
        }   
    }
    if(isset($_GET['status_id'])){
        $admin_image_id = $encryption_obj->decode($_GET['status_id']);
        $current_status = $_GET['s'];
    
        if($current_status == 1){
            $current_status = 0;
        }else{
            $current_status = 1;
        }
        $is_status = $class_obj->changeStatus($admin_image_id,$current_status);

        if($is_status['status'] == 200){
            $_SESSION['notify_message'] = $is_status['msg'];
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-product-image.php?data_id=$encrypted_id");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_status['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/add-product-image.php?data_id=$encrypted_id");
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
                            ADD PRODUCT MORE IMAGES
                            <lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
                        </div>
						<hr> 
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="input-1">Product Name</label>
								<input type="text" class="form-control" id="input-1" placeholder="Enter Name" name="product_name" value="<?= $product_name; ?>" readonly>
							</div> 
							<div class="form-group">
								<label for="input-1">Product Image * </label> <br />
								<input type="file" name="data_image" class="form-control mb-1" onChange="filevalidation(1200,1200)" id="file-upload-size" required>
                                <span style="font-size:10px;">Preferred image size (1200 X 1200) px</span><br />
								<?php if(!empty($data_image)){ ?> 
									<img src="<?= $data_image; ?>" class="mt-2 ml-3" style="width:60px;height:60px;"/>
								<?php } ?>
							</div> 
                            <!-- <div class="form-group">
								<label for="input-1">Product Color (Optional)</label>
								<input type="color" class="form-control" id="input-1" placeholder="Enter Product Color" name="product_color" value="<?= $product_color; ?>" />
							</div> 
                            <div class="form-group">
								<label for="input-1">Product Price (Optional)</label>
								<input type="number" class="form-control" id="input-1" placeholder="Enter Product Price" name="product_price" value="<?= $product_price; ?>" />
							</div>  -->
							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox1" name="is_active" value="1" <?= ($is_active)?'checked':''; ?>/>
								<label for="user-checkbox1">Is Active</label>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" name="data_submit" class="btn btn-light px-5"><i class="icon-lock"></i> Submit</button>
								<input type="hidden" name="product_id" value="<?= $data_id; ?>">
								<input type="hidden" name="encrypted_product_id" value="<?= $encrypted_product_id; ?>">
								<input type="hidden" name="image_id" value="<?= $image_id; ?>">
								<input type="hidden" name="encrypted_admin_id" value="<?= $encrypted_admin_id; ?>">
							</div>
						</form>
					</div>
				</div>
			</div>  
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of Product Images</h5>
                        <?php if(isset($_SESSION['notify_message'])){ ?>
                        <div class="notification-div alert alert-<?= $_SESSION['notify_type']; ?> p-2">
                            <?= $_SESSION['notify_message']; ?>
                        </div>
                        <?php unset($_SESSION['notify_message']); }?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">product Name</th> 
                                        <th scope="col">product Image</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php      
                                        if(!empty($a_all_data)){
                                            $count = 0;
                                            foreach($a_all_data as $data_key=>$data_value){ 
                                            $count++;
                                            $image_id = $data_value['image_id'];
                                            $product_name = $data_value['product_name']; 
                                            $data_image = $data_value['data_image'];
                                            $is_active = $data_value['is_active'];

                                            if(!empty($data_image)){
                                                $a_file_path = explode('=',$data_image);
                                                $file_path = $a_file_path[count($a_file_path)-1];
                                            }else{ 
                                                $data_image = NO_IMAGE_URL;
                                                $file_path = '';
                                            }

                                            $encrypted_image_id = $encryption_obj->encode($image_id);

                                            $status_tag = 'fa-times text-danger custom-font-size';
                                            $status_title = 'Inactive';
                                            if($is_active){
                                                $status_tag = 'fa-check text-success custom-font-size';
                                                $status_title = 'Active';
                                            }
                                            if(empty($product_price)){
                                                $product_price   =   '-';
                                            }
                                            if(empty($product_color)){
                                                $product_color   =   'transparent';
                                            }
                                        ?>  
                                        <th scope="row"><?= $count; ?></th>
                                        <td><?= wordwrap($product_name,15,"<br>\n"); ?></td> 
                                        <td>
                                            <img src="<?= $data_image; ?>" style="width:40px;height:40px;"/>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL_ADMIN;?>/add-product-image.php?data_id=<?= $encrypted_id;?>&status_id=<?= $encrypted_image_id; ?>&s=<?= $is_active;?>">
                                                <i class="fas <?= $status_tag; ?>" title="<?= $status_title; ?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL_ADMIN;?>/add-product-image.php?data_id=<?= $encrypted_id;?>&image_id=<?= $encrypted_image_id; ?>">
                                                <i class="fas fa-edit mr-2 custom-edit-color-size" title="Edit"></i>
                                            </a>

                                            <a href="<?= SITE_URL_ADMIN;?>/add-product-image.php?data_id=<?= $encrypted_id;?>&delete_id=<?= $encrypted_image_id; ?>&file_path=<?= $file_path; ?>" onclick="return confirm('Are you sure you want to delete this data.')">
                                                <i class="fas fa-trash ml-3 custom-delete-color-size" title="Delete"></i>
                                            </a>
                                        </td> 
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr class="text-center">
                                        <th scope="row" colspan='5'>No Record.</th> 
                                    </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
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