<?php
    include("root.php");
    if(!isset($_SESSION['member_id'])){
        ob_clean();				
        header("Location: ".SITE_URL."/login.php");
        exit();	
    }
    include(SITE_ROOT	.	"/includes/top.php");
    include(SITE_ROOT	.   "/classes/Report.php");
  
    $report_obj = NEW Report();

    $a_all_data = $report_obj->getAllReportData($_SESSION['member_id']);
    
    if(isset($_GET['delete']) && isset($_GET['patient_data'])){ 
        $encrypt_patient_id =  str_replace(' ','+',$_GET['patient_data']); 
        $patient_id  = openssl_decrypt($encrypt_patient_id, $ciphering, $decryption_key, $options, $decryption_iv);
        
        $is_delete = $report_obj->patientDataDelete($patient_id);
        if($is_delete){
            $_SESSION['notify_message'] = "Patient information and all reports deleted successful.";
            $_SESSION['notify_type'] = 'success';
       }
       ob_clean();				
        header("Location: ".SITE_URL."/manage_report.php");
        exit();
    }
    if(isset($_SESSION['notify_message'])){
        $notify_message = $_SESSION['notify_message'];
        $notify_type = $_SESSION['notify_type'];
        include("notify_me.php");
        unset($_SESSION['notify_message']);
        unset($_SESSION['notify_type']);
    }
?>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Manage report</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= SITE_URL;?>">Home</a></li>
                    <li class="breadcrumb-item active">Manage report</li>
                  </ol>
                </div> 
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Manage report</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
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
                            foreach($a_all_data as $data_key=>$data_value){ 
                                $patient_id = $data_value['id'];
                                $patient_name = $data_value['patient_name'];
                                $ref_dr = $data_value['ref_dr'];
                                $added_date = $data_value['added_date'];
                                $category_name = $data_value['category_name'];
                                $is_active = $data_value['is_active'];
                                
                                $encrypt_patient_id  = openssl_encrypt($patient_id, $ciphering, $decryption_key, $options, $decryption_iv);
                            ?>
                          <tr>
                            <td><?= $data_key+1;?></td>
                            <td><?= $patient_name;?></td>
                            <td><?= $ref_dr;?></td>
                            <td><?php
                                  $date=date_create("$added_date");
                                  echo date_format($date,"d-M-Y"); 
                              ?></td> 
                            <td>
                                <a href="<?= SITE_URL;?>/add_report.php?patient_data=<?= $encrypt_patient_id ?>"><i data-feather="edit"></i></a> &nbsp;&nbsp;
                                <a href="<?= SITE_URL;?>/manage_report.php?delete=1&patient_data=<?= $encrypt_patient_id ?>" onclick="return confirm('Are you sure you want to delete this patient information ?');">
                                    <i data-feather="trash-2"></i>
                                </a>
                                &nbsp;&nbsp;
                                <a href="<?= SITE_URL;?>/generate_invoice.php?patient_data=<?= $encrypt_patient_id ?>" target="_blank"><i data-feather="download"></i></a>
                            </td>
                          </tr>
                           <?php 
                            }
                           ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
             
          </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
<?php
  include(SITE_ROOT	.	"/includes/bottom.php");
?>  