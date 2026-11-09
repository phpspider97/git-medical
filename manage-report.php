<?php
    include("root.php"); 
    include(SITE_ROOT	.	"/includes/top.php");
    include(SITE_ROOT	.   "/classes/Report.php");
    include(SITE_ROOT	.   "/classes/Encryption.php");
    
    $encryption_obj = NEW Encryption();
    $report_obj = NEW Report();
    $encryption_obj = NEW Encryption();
    
    // Pagination
    $limit = 100; 
    $offset = 0;
    $page_number = 1;
    if(isset($_GET['page'])){
      $page_number = empty($_GET['page'])?1:$_GET['page'];
      $offset = ($page_number-1)*$limit;
    } 
    
    $a_all_data = $report_obj->getAllReportData($_SESSION['admin_id'],'lab_patient',LIMIT_DATA);
    
    $a_limit_data = $report_obj->getAllReportData($_SESSION['admin_id'],'lab_patient',$limit,$offset);
    
    if(isset($_GET['delete']) && isset($_GET['patient_data'])){   
        $page        = $_GET['page'];
        $patient_id  = $encryption_obj->decode($_GET['patient_data']);
        
        $is_delete = $report_obj->patientDataDelete($patient_id);
        if($is_delete){
            $_SESSION['notify_message'] = "Patient information and all reports deleted successful.";
            $_SESSION['notify_type'] = 'success';
        }
        ob_clean();				
        header("Location: ".SITE_URL."/manage-report.php?page=$page");
        exit();
    }
    
    ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>MANAGE REPORT (<span style="color:yellow"><?= count($a_all_data); ?></span>)</h5>
                    </div>
                    <?php if(isset($_SESSION['notify_message'])){ ?>
                    <div class="notification-div alert alert-success p-2 mt-4">
                        <?= $_SESSION['notify_message']; ?>
                    </div>
                    <?php unset($_SESSION['notify_message']); }?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width:30%">Patient Name</th>
                                        <th>Ref DR</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        if(!empty($a_limit_data)){ 
                                          foreach($a_limit_data as $data_key=>$data_value){ 
                                              $patient_id     =   $data_value['id'];
                                              $patient_name   =   $data_value['patient_name'];
                                              $ref_dr         =   $data_value['ref_dr'];
                                              $added_date     =   date('d M Y',strtotime($data_value['added_date'])); 
                                              $is_active      =   $data_value['is_active'];
                                              
                                              $encrypt_patient_id  = $encryption_obj->encode($patient_id);
                                          ?>
                                    <tr>
                                        <td><?= $data_key+1;?></td>
                                        <td><?= ucWords($patient_name);?></td>
                                        <td><?= ucWords($ref_dr);?></td>
                                        <td><?= $added_date; ?></td>
                                        <td>
                                            <a href="<?= SITE_URL;?>/add-report.php?patient_data=<?= $encrypt_patient_id ?>" class="hide-loader">
                                            <i class="fas fa-edit custom-edit-color-size mr-1" title="Edit Report"></i>
                                            </a>  
                                            &nbsp;
                                            <a href="<?= SITE_URL;?>/manage-report.php?delete=1&patient_data=<?= $encrypt_patient_id ?>&page=<?= $page_number; ?>" onclick="return confirm('Are you sure you want to delete this patient information ?');" class="hide-loader">
                                            <i class="fas fa-trash mr-1 custom-delete-color-size" title="Delete Report"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?= SITE_URL;?>/generate-invoice.php?patient_data=<?= $encrypt_patient_id ?>" target="_blank" class="hide-loader">
                                            <i class="fa-solid fa-file-invoice custom-edit-color-size" title="View Report"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php  } }else{ ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No record.</td>
                                    </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pagination-center mb-4">
                  <div class="pagination text-center"> 
                      <a href="?page=<?= $page_number-1; ?>">&laquo;</a>
                      <?php    
                          $number_of_page = ceil(count($a_all_data) / $limit); 
                          for($page = 1; $page<= $number_of_page; $page++){ 
                            $active_pagination = '';
                            if($page_number == $page){
                              $active_pagination = 'active'; 
                          }	
                      ?>	
                      <a href="?page=<?= $page; ?>" class="<?= $active_pagination;?>">  
                          <?= $page; ?>
                      </a>
                      <?php } ?> 
                      <a href="?page=<?= $page_number+1; ?>">&raquo;</a> 
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(SITE_ROOT	.	"/includes/bottom.php"); ?>