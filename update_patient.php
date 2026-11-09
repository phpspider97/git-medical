<?php
    include("root.php");  
    include(SITE_ROOT	.   "/classes/Report.php");
    include(SITE_ROOT	.   "/classes/Encryption.php"); 
      
    $encryption_obj = NEW Encryption();
    $report_obj = NEW Report(); 

    $connection2e3asda =  NEW Connection();
    $conn = $connection2e3asda->create_connection(); 
   
    $a_all_data = $report_obj->getAllReportData(5,'lab_patient',LIMIT_DATA);
    die('__1');
    if(!empty($a_all_data)){
      foreach($a_all_data as $data_key=>$data_value){ 
          $patient_id     =   $data_value['id'];
          $patient_age_sex   =   $data_value['patient_age_sex']; 
          $patient_name   =   explode('/',$data_value['patient_age_sex']); 
          $patient_age =  (isset($patient_name[0]))?(int) $patient_name[0]:0;
          $patient_sex = (isset($patient_name[1]))?$patient_name[1]:'';

          if(!empty($patient_sex)){
            $patient_sex =substr(strtolower($patient_sex), 0, 1);
            if($patient_sex == 'f'){
                $patient_sex ='female';
            }else{
              $patient_sex ='male';
            }
          } 
          $result = $conn->query("UPDATE lab_patient SET patient_age=$patient_age,patient_sex='$patient_sex' WHERE id='$patient_id'");

          if($result === TRUE){
              echo "$data_key => Done <br><br>";
          }else{ 
              echo "$data_key => Not Done <br><br>";
          }

          //echo $patient_id.'==> '. $patient_age.'---'.$patient_sex.'<br><br>';
      }
      die('__1');
    }