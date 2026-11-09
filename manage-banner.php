<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	
	include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Banner.php");
      
    $encryption_obj = NEW encryption();
    $class_obj = NEW Banner();
      
    $a_all_data = $class_obj->getAllData($_SESSION['admin_id'],DATABASE_TABLE_PREFIX.'banner');
    if(isset($_GET['delete_id']) && isset($_GET['file_path'])){
        $encrypted_admin_id = $encryption_obj->encode($_SESSION['admin_id']);
        //$full_image_path = FILE_ROOT_PATH.'/banner_images/'.$encrypted_admin_id.'/'.$_GET['file_path']; 
        $full_image_path = $_GET['file_path'];
        
        $admin_user_id = $encryption_obj->decode($_GET['delete_id']);
        $is_deleted = $class_obj->deleteData($admin_user_id,DATABASE_TABLE_PREFIX.'banner',$full_image_path);

        if($is_deleted['status'] == 200){
            $_SESSION['notify_message'] = $is_deleted['msg'];
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-banner.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_deleted['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-banner.php");
            exit();
        } 
    }
    if(isset($_GET['status_id'])){
        $admin_banner_id = $encryption_obj->decode($_GET['status_id']);
        $current_status = $_GET['s'];
    
        if($current_status == 1){
            $current_status = 0;
        }else{
            $current_status = 1;
        }
        $is_status = $class_obj->changeStatus($admin_banner_id,$current_status);

        if($is_status['status'] == 200){
            $_SESSION['notify_message'] = $is_status['msg'];
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-banner.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_status['msg'];
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-banner.php");
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
                            List of Banner
                            <lable class="pull-right mb-3">
                                <a href="<?= SITE_URL_ADMIN;?>/add-brand.php" class="btn btn-light btn-sm" style="margin-top: -11px;">
									<i class="fa-solid fa-arrow-left"></i> Add BANNER 
								</a>
                            </lable>
                        </h5>
                        <?php if(isset($_SESSION['notify_message'])){ ?>
                        <div class="notification-div alert alert-success p-2">
                            <?= $_SESSION['notify_message']; ?>
                        </div>
                        <?php unset($_SESSION['notify_message']); }?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Banner Name</th>
                                        <th scope="col">Banner Image</th>
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
                                            $banner_id = $data_value['banner_id'];
                                            $banner_name = $data_value['banner_name'];
                                            $data_image = $data_value['data_image'];
                                            $is_active = $data_value['is_active'];

                                            if(!empty($data_image)){
                                                $a_file_path = explode('=',$data_image);
                                                $file_path = $a_file_path[count($a_file_path)-1];
                                            }else{ 
                                                $data_image = NO_IMAGE_URL;
                                            }

                                            $encrypted_id = $encryption_obj->encode($banner_id);

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
                                            <?= $banner_name; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $data_image; ?>" style="width:40px;height:40px;"/>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL_ADMIN;?>/manage-banner.php?status_id=<?= $encrypted_id; ?>&s=<?= $is_active;?>">
                                                <i class="fas <?= $status_tag; ?>" title="<?= $status_title; ?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL_ADMIN;?>/add-banner.php?data_id=<?= $encrypted_id; ?>">
                                                <i class="fas fa-edit mr-2 custom-edit-color-size" title="Edit"></i>
                                            </a>

                                            <a href="<?= SITE_URL_ADMIN;?>/manage-banner.php?delete_id=<?= $encrypted_id; ?>&file_path=<?= $file_path; ?>" onclick="return confirm('Are you sure you want to delete this data.')">
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