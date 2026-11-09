<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	
	include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Product.php");
      
    $encryption_obj = NEW Encryption();
    $product_obj = NEW Product();
     
    $a_all_data = $product_obj->getAllData($_SESSION['admin_id'],DATABASE_TABLE_PREFIX.'product');
    if(isset($_GET['delete_id']) || isset($_GET['file_path'])){
        $encrypted_admin_id = $encryption_obj->encode($_SESSION['admin_id']);
        $full_image_path = FILE_ROOT_PATH.'/product_images/'.$encrypted_admin_id.'/'.$_GET['file_path']; 
        //$full_image_path = $_GET['file_path']; 
        
        $admin_user_id = $encryption_obj->decode($_GET['delete_id']);
        $is_deleted = $product_obj->deleteData($admin_user_id,DATABASE_TABLE_PREFIX.'product',$full_image_path);

        if($is_deleted['status'] == 200){
            $_SESSION['notify_message'] = $is_deleted['msg'];
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-product.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_deleted['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-product.php");
            exit();
        }  
    }
    if(isset($_GET['status_id'])){
        $admin_product_id = $encryption_obj->decode($_GET['status_id']);
        $current_status = $_GET['s'];
    
        if($current_status == 1){
            $current_status = 0;
        }else{
            $current_status = 1;
        }
        $is_status = $product_obj->changeStatus($admin_product_id,$current_status);

        if($is_status['status'] == 200){
            $_SESSION['notify_message'] = $is_status['msg'];
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-product.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_status['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-product.php");
            exit();
        }  
    }
?>
<div class="content-wrapper">
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            LIST OF PRODUCTS
                            <lable class="pull-right mb-3">
                                <a href="<?= SITE_URL_ADMIN;?>/add-product.php" class="btn btn-light btn-sm" style="margin-top: -11px;">
									<i class="fa-solid fa-arrow-left"></i> Add PRODUCT 
								</a>
                            </lable>
                        </h5>
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
                                            $product_id = $data_value['product_id'];
                                            $product_name = wordwrap($data_value['product_name'],35,"<br>\n");
                                            $data_image = $data_value['data_image'];
                                            $is_active = $data_value['is_active']; 

                                            if(!empty($data_image)){
                                                $a_file_path = explode('=',$data_image);
                                                $file_path = $a_file_path[count($a_file_path)-1];
                                            }else{ 
                                                $file_path  =   '';
                                                $data_image =   NO_IMAGE_URL;
                                            } 
                                            $encrypted_id = $encryption_obj->encode($product_id);

                                            $status_tag = 'fa-times text-danger custom-font-size';
                                            $status_title = 'Inactive';
                                            if($is_active){
                                                $status_tag = 'fa-check text-success custom-font-size';
                                                $status_title = 'Active';
                                            }
                                        ?>  
                                        <th scope="row">
                                            <?= $count; ?>
                                        </th>
                                        <td>
                                            <?= $product_name; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $data_image; ?>" style="width:40px;height:40px;"/>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL_ADMIN;?>/manage-product.php?status_id=<?= $encrypted_id; ?>&s=<?= $is_active;?>">
                                                <i class="fas <?= $status_tag; ?>" title="<?= $status_title; ?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL_ADMIN;?>/add-product.php?data_id=<?= $encrypted_id; ?>">
                                                <i class="fas fa-edit custom-edit-color-size" title="Edit"></i>
                                            </a>

                                            <a href="<?= SITE_URL_ADMIN;?>/manage-product.php?delete_id=<?= $encrypted_id; ?>&file_path=<?= $file_path; ?>" onclick="return confirm('Are you sure you want to delete this data.')">
                                                <i class="fas fa-trash ml-3 custom-delete-color-size" title="Delete"></i>
                                            </a>

                                            <a href="<?= SITE_URL_ADMIN;?>/add-product-image.php?data_id=<?= $encrypted_id; ?>">
                                                <i class="fas fa-upload ml-3 custom-edit-color-size" title="Upload Product Image"></i>
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