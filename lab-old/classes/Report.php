<?php

CLASS Report extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
    } 

    public function addUpdateReport($post_data,$table,$service_image,$encrypted_member_id){
       // print_r($post_data);
        $added_by = $post_data['added_by'];
        $patient_id = $post_data['patient_id'];

        // Patient detail
        $patient_name = $post_data['patient_name'];
        $patient_mobile = $post_data['patient_mobile'];
        $patient_dob = $post_data['patient_dob'];
        $patient_address = $post_data['patient_address'];
        $lab_number = $post_data['lab_number'];
        $patient_age_sex = $post_data['patient_age_sex'];
        $ref_dr = $post_data['ref_dr'];
        $added_date = $post_data['added_date'];

        if(empty($patient_id)){
            $query_data = "INSERT INTO lab_patient SET patient_name='$patient_name',patient_mobile='$patient_mobile',patient_dob='$patient_dob',patient_address='$patient_address',patient_age_sex='$patient_age_sex',ref_dr='$ref_dr',added_date='$added_date',added_by='$added_by'";
            $this->conn->query($query_data); 
            $patient_id = $this->conn->insert_id; 
        }else{
            $query_data = "UPDATE lab_patient SET patient_name='$patient_name',patient_mobile='$patient_mobile',patient_dob='$patient_dob',patient_address='$patient_address',patient_age_sex='$patient_age_sex',ref_dr='$ref_dr',added_date='$added_date' WHERE id='$patient_id' ";
            $this->conn->query($query_data); 
        }
        //print_r($post_data['heamatology']); die;
        foreach($post_data['heamatology'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 1; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['serology'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
             
            $report_type = 2; 
            if(!empty($report_result)){
                $new_report_result = $post_data['serology_value'][$report_field_key].'/'.$report_result;
                
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$new_report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$new_report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['biochemistry'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 3; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['renalfunctiontest'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 4; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['lipidprofile'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 5; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['liverfunctiontest'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 6; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['widaltest'] as $report_field_key=>$a_report_result){
           $report_result = implode(',',$a_report_result);
            //echo "<pre>"; print_r($post_data['widaltest']); die;
           // $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',array_keys($a_report_result)[0])[1];
            //echo $add_status; die('1');
            $report_type = 7;
            //echo $add_status;
            if(!empty($report_result) && $report_result != ',,,,,'){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field_key',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field_key' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }

            // foreach($a_report_result as $key_data=>$report_result_value){
            //     $report_field = explode('|',$key_data)[0];
            //     $add_status = explode('|',$key_data)[1]; 
            //     //echo $report_result; die;
            //     if(!empty($report_result)){
            //         if($add_status == "insert"){
            //             $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field_key',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
            //             $return_msg = 'added';
            //         }else{
            //             $current_date_time = date('Y-m-d H:i:s');
            //             $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field_key' AND patient_id='$patient_id' AND report_type='$report_type'";
            //             $return_msg = 'updated';
            //         }
            //         $this->conn->query($query_data);
            //     }
            // }
        }
        
        foreach($post_data['electrolyte'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 8; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['gtt'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 9; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['urine'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 10; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['stool'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 11; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['semen'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 12; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['thyroid'] as $report_field_key=>$report_result){
            $report_field = explode('|',$report_field_key)[0];
            $add_status = explode('|',$report_field_key)[1];
            $report_type = 13; 
            if(!empty($report_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_report SET report_type='$report_type',report_field='$report_field',report_result='$report_result',added_by='$added_by',patient_id='$patient_id'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_report SET report_result='$report_result', updated_at='$current_date_time' WHERE report_field='$report_field' AND patient_id='$patient_id' AND report_type='$report_type'";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        return $return_msg;
    }

    public function addUpdateField($post_data,$table,$service_image,$encrypted_member_id){ 
       // print_r($post_data); die;
        $added_by = $post_data['added_by'];  
         
        foreach($post_data['heamatology_investigation'] as $a_report_field_key=>$heamatology_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $heamatology_result = $post_data['heamatology_result'][$a_report_field_key];
            $heamatology_unit = $post_data['heamatology_unit'][$a_report_field_key];
            $heamatology_value = $post_data['heamatology_value'][$a_report_field_key];  
            if(!empty($heamatology_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=1,investigation='$heamatology_investigation',result='$heamatology_result',unit='$heamatology_unit',value='$heamatology_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$heamatology_investigation',result='$heamatology_result',unit='$heamatology_unit',value='$heamatology_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        } 
        
        foreach($post_data['serology_result'] as $a_report_field_key=>$serology_result){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
             
            $serology_value = $post_data['serology_value'][$a_report_field_key];
            
            if(!empty($serology_result)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=2,investigation='0',result='$serology_result',unit='0',value='$serology_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='0',result='$serology_result',unit='0',value='$serology_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        foreach($post_data['biochemistry_investigation'] as $a_report_field_key=>$biochemistry_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $biochemistry_result = $post_data['biochemistry_result'][$a_report_field_key];
            $biochemistry_unit = $post_data['biochemistry_unit'][$a_report_field_key];
            $biochemistry_value = $post_data['biochemistry_value'][$a_report_field_key];  
            if(!empty($biochemistry_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=3,investigation='$biochemistry_investigation',result='$biochemistry_result',unit='$biochemistry_unit',value='$biochemistry_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$biochemistry_investigation',result='$biochemistry_result',unit='$biochemistry_unit',value='$biochemistry_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        } 
        
        foreach($post_data['renalfunctiontest_investigation'] as $a_report_field_key=>$renalfunctiontest_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $renalfunctiontest_result = $post_data['renalfunctiontest_result'][$a_report_field_key];
            $renalfunctiontest_unit = $post_data['renalfunctiontest_unit'][$a_report_field_key];
            $renalfunctiontest_value = $post_data['renalfunctiontest_value'][$a_report_field_key];  
            if(!empty($renalfunctiontest_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=4,investigation='$renalfunctiontest_investigation',result='$renalfunctiontest_result',unit='$renalfunctiontest_unit',value='$renalfunctiontest_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$renalfunctiontest_investigation',result='$renalfunctiontest_result',unit='$renalfunctiontest_unit',value='$renalfunctiontest_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['lipidprofile_investigation'] as $a_report_field_key=>$lipidprofile_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $lipidprofile_result = $post_data['lipidprofile_result'][$a_report_field_key];
            $lipidprofile_unit = $post_data['lipidprofile_unit'][$a_report_field_key];
            $lipidprofile_value = $post_data['lipidprofile_value'][$a_report_field_key];  
            if(!empty($lipidprofile_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=5,investigation='$lipidprofile_investigation',result='$lipidprofile_result',unit='$lipidprofile_unit',value='$lipidprofile_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$lipidprofile_investigation',result='$lipidprofile_result',unit='$lipidprofile_unit',value='$lipidprofile_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['liverfunctiontest_investigation'] as $a_report_field_key=>$liverfunctiontest_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $liverfunctiontest_result = $post_data['liverfunctiontest_result'][$a_report_field_key];
            $liverfunctiontest_unit = $post_data['liverfunctiontest_unit'][$a_report_field_key];
            $liverfunctiontest_value = $post_data['liverfunctiontest_value'][$a_report_field_key];  
            if(!empty($liverfunctiontest_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=6,investigation='$liverfunctiontest_investigation',result='$liverfunctiontest_result',unit='$liverfunctiontest_unit',value='$liverfunctiontest_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$liverfunctiontest_investigation',result='$liverfunctiontest_result',unit='$liverfunctiontest_unit',value='$liverfunctiontest_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
          
        foreach($post_data['electrolyte_investigation'] as $a_report_field_key=>$electrolyte_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $electrolyte_result = $post_data['electrolyte_result'][$a_report_field_key];
            $electrolyte_unit = $post_data['electrolyte_unit'][$a_report_field_key];
            $electrolyte_value = $post_data['electrolyte_value'][$a_report_field_key];  
            if(!empty($electrolyte_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=8,investigation='$electrolyte_investigation',result='$electrolyte_result',unit='$electrolyte_unit',value='$electrolyte_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$electrolyte_investigation',result='$electrolyte_result',unit='$electrolyte_unit',value='$electrolyte_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }   
        
        foreach($post_data['gtt_investigation'] as $a_report_field_key=>$gtt_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $gtt_result = $post_data['gtt_result'][$a_report_field_key];
            $gtt_unit = $post_data['gtt_unit'][$a_report_field_key];
            $gtt_value = $post_data['gtt_value'][$a_report_field_key];  
            if(!empty($gtt_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=9,investigation='$gtt_investigation',result='$gtt_result',unit='$gtt_unit',value='$gtt_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$gtt_investigation',result='$gtt_result',unit='$gtt_unit',value='$gtt_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        } 
        
        foreach($post_data['urine_investigation'] as $a_report_field_key=>$urine_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $urine_result = $post_data['urine_result'][$a_report_field_key];
            $urine_unit = $post_data['urine_unit'][$a_report_field_key];
            $urine_value = $post_data['urine_value'][$a_report_field_key];  
            if(!empty($urine_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=10,investigation='$urine_investigation',result='$urine_result',unit='$urine_unit',value='$urine_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$urine_investigation',result='$urine_result',unit='$urine_unit',value='$urine_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        } 
        
        foreach($post_data['stool_investigation'] as $a_report_field_key=>$stool_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $stool_result = $post_data['stool_result'][$a_report_field_key];
            $stool_unit = $post_data['stool_unit'][$a_report_field_key];
            $stool_value = $post_data['stool_value'][$a_report_field_key];  
            if(!empty($stool_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=11,investigation='$stool_investigation',result='$stool_result',unit='$stool_unit',value='$stool_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$stool_investigation',result='$stool_result',unit='$stool_unit',value='$stool_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['semen_investigation'] as $a_report_field_key=>$semen_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $semen_result = $post_data['semen_result'][$a_report_field_key];
            $semen_unit = $post_data['semen_unit'][$a_report_field_key];
            $semen_value = $post_data['semen_value'][$a_report_field_key];  
            if(!empty($semen_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=12,investigation='$semen_investigation',result='$semen_result',unit='$semen_unit',value='$semen_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$semen_investigation',result='$semen_result',unit='$semen_unit',value='$semen_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        }
        
        foreach($post_data['thyroid_investigation'] as $a_report_field_key=>$thyroid_investigation){
            $id = explode('|',$a_report_field_key)[0];
            $report_field_key = explode('|',$a_report_field_key)[1];
            $add_status = explode('|',$a_report_field_key)[2]; 
            
            $thyroid_result = $post_data['thyroid_result'][$a_report_field_key];
            $thyroid_unit = $post_data['thyroid_unit'][$a_report_field_key];
            $thyroid_value = $post_data['thyroid_value'][$a_report_field_key];  
            if(!empty($thyroid_investigation)){
                if($add_status == "insert"){
                    $query_data = "INSERT INTO lab_field SET report_type=13,investigation='$thyroid_investigation',result='$thyroid_result',unit='$thyroid_unit',value='$thyroid_value',added_by='$added_by'";
                    $return_msg = 'added';
                }else{
                    $current_date_time = date('Y-m-d H:i:s');
                    $query_data = "UPDATE lab_field SET investigation='$thyroid_investigation',result='$thyroid_result',unit='$thyroid_unit',value='$thyroid_value',updated_at='$current_date_time' WHERE id='$id' AND added_by='$added_by' ";
                    $return_msg = 'updated';
                }
                $this->conn->query($query_data);
            }
        } 

        return $return_msg;
    }
    
    public function getFieldData($added_by){
        try{
            $query_data = "SELECT * FROM lab_field WHERE added_by='$added_by' OR added_by=0";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $return_data[$row['report_type']][] = $row;  
                }
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
    
    public function getReportData($patient_id){
        try{
            $query_data = "SELECT report_result,report_type,report_field FROM lab_report WHERE patient_id='$patient_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $report_type = $row['report_type'];
                    $report_field = $row['report_field'];

                    $return_data[$report_type][$report_field] = $row['report_result'];
                }
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function getReportTypeName($report_type_id){
        $a_report_type = [
          1=>'Heamatology',
          'Serology',
          'Bio-chemistry',
          'Renal function test',
          'lipid profile',
          'liver function test',
          'Widal test',
          'ELECTROLYTES',
          'G.T.T',
          'URINE EXAMINATION',
          'STOOL EXAMINATION',
          'SEMEN EXAMINATION',
          'THYROID FUNCTION TESTS'
        ];
        return $a_report_type[$report_type_id];
    }
    
    public function getReportFieldName($report_field,$report_type,$added_by_member=''){
        $added_by = $_SESSION['member_id'];
        if(empty($added_by)){
            $added_by = $added_by_member;
        }  
        try{
            $query_data = "SELECT * FROM lab_field WHERE (added_by='$added_by' or added_by=0) AND report_type='$report_type' ORDER BY id ASC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $count = -1;
                while($row = $result->fetch_assoc()){
                    $count++;
                    if($report_type == 2){ 
                        if($report_field == $count){
                            return $investigation = $row['result'].'@'.$row['unit'].'@'.$row['value'];
                        }
                    }else{
                        if($report_field == $count && $report_type != 7){
                            return $investigation = $row['investigation'].'@'.$row['unit'].'@'.$row['value'];
                        } 
                    } 
                } 
            }else{ 
                if( $report_type == 7){ 
                    if($report_field == 1){
                        return $investigation = '"Typhy" H';
                    }elseif($report_field == 2){
                        return $investigation = '"Para Typhy" AH';
                    }elseif($report_field == 3){
                        return $investigation = '"Para Typhy" BH';
                    }else{
                        return $investigation = '"Typhy" O';
                    } 
                } 
            }
        }catch(Exception $e){
            return false;
        }
    }
    
    public function getBreifReportData($patient_id,$added_by){
        try{
            $query_data = "SELECT report_result,report_type,report_field FROM lab_report WHERE patient_id='$patient_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $report_type = $row['report_type'];
                    $report_field = $row['report_field'];
                    $report_type_name = $this->getReportTypeName($report_type);
                    $report_field_name = $this->getReportFieldName($report_field,$report_type,$added_by);
                     
                    if($report_type == 2){
                        $val = 0;
                        $unit = 0;
                        if(!empty($row['report_result'])){
                            $val = explode('/', $row['report_result'])[0];
                            $unit = explode('/', $row['report_result'])[1]; 
                            if(!empty($report_field_name)){
                                $a_report_field_name = explode('@',$report_field_name); 
                                foreach($a_report_field_name as $sero_key => $val_serology){ 
                                    if($sero_key == 1){
                                        $new_result_value  .=  '@'.$unit;
                                    }elseif($sero_key == 2){
                                        $new_result_value  .=  '@'.$val_serology;
                                    }else{
                                        $new_result_value = $val_serology;
                                    }
                                } 
                            }  
                        }
                        $return_data[$report_type_name][$new_result_value] = $val;
                    }else{
                        $return_data[$report_type_name][$report_field_name] = $row['report_result'];
                    } 
                } 
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
    
    public function getLabData($lab_id){
        try{
            $query_data = "SELECT * FROM lab_member WHERE member_id='$lab_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $return_data[] = $row;  
                }
                return $return_data[0];
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
     
    public function getAddedByID($patient_id){
        try{
            $query_data = "SELECT added_by FROM lab_report WHERE patient_id='$patient_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    return $row['added_by'];  
                } 
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getPatientData($member_id,$patient_id,$table='lab_report'){
        try{
            $query_data = "SELECT * FROM lab_patient WHERE id='$patient_id' ";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc();
                $return_data['get_report_data'] = $this->getReportData($return_data['id']);
                $return_data['get_breif_report_data'] = $this->getBreifReportData($return_data['id'],$member_id);
                $return_data['get_lab_data'] = $this->getLabData($return_data['added_by']);
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getAllReportData($member_id,$table='lab_patient'){
        try{
            $query_data = "SELECT * FROM $table WHERE added_by='$member_id' ORDER BY id DESC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $return_data[] = $row;
                } 
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getAllApiServiceData($table='company_service'){
        try{
            $query_data = "SELECT * FROM $table WHERE is_active=1 order by service_id DESC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data[] = $row;
                }
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
  
    public function patientDataDelete($patient_id){
        $this->conn->query("DELETE FROM lab_patient WHERE id='$patient_id'");
        $is_delete = $this->conn->query("DELETE FROM lab_report WHERE patient_id='$patient_id'");
        if($is_delete){
            return true;
        }
    }
    
    public function deleteReportField($send_data){ 
        $field_id = $send_data['deleteData']; 
        try{
            $query_data = "DELETE FROM lab_field WHERE id='$field_id'";
            $result = $this->conn->query($query_data);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    
    function __destruct(){
        $this->conn->close();
    }

} 