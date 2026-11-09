<?php

CLASS Login extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
    } 

    public function registartion($registration_data,$table){
        
    // $query_data = "SELECT * FROM lab_field WHERE added_by='1'";
    // $result = $this->conn->query($query_data);
    // if($result->num_rows > 0){
    //     while($row = $result->fetch_assoc()){
    //         $return_data[] = $row;
    //     } 
    //     foreach($return_data as $k=>$field_data){
    //       //print_r($field_data['value']); die; 
    //         $added_by = 0;
    //         $report_type = $field_data['report_type'];
    //         $investigation = $field_data['investigation'];
    //         $result = $field_data['result'];
    //         $unit = $field_data['unit'];
    //         $value = $field_data['value'];
            
    //         $query_data = "INSERT INTO lab_field SET added_by=0,report_type='$report_type',investigation='$investigation',result='$result',unit='$unit',value='$value' ";
    //         $this->conn->query($query_data);
            
    //     }
    //     print_r($return_data); die; 
    // } 
            
            
        $a_field_data = array_keys($registration_data);
        $a_value_data = array_values($registration_data);
        if(!empty($a_field_data)){
            $field_data =  implode(',',$a_field_data);
        }
        if(!empty($a_value_data)){
            $value_data =  implode("','",$a_value_data);
        }
        try{
            $query_data = "INSERT INTO $table ($field_data) VALUES ('$value_data')";
            $this->conn->query($query_data);
            $last_id = $this->conn->insert_id; 
            
            $_SESSION['member_id'] = $last_id; 
            $_SESSION['member_first_name'] = $registration_data['member_first_name'];
            $_SESSION['member_last_name'] = $registration_data['member_last_name'];
            $_SESSION['member_email'] = $registration_data['member_email']; 
            
            $to = $registration_data['member_email'];
            $subject = "Thanks for become the family member of test report.";
            $txt = "Thanks for register !! Help the people with new digital world. <br />
            <a href='www.testreport.in'>Test Report</a>";
            $headers = "From: testreposrt@contact.com" . "\r\n" .
            "CC: neelbhardwaj97@gmai.com";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            mail($to,$subject,$txt,$headers);

                
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function login($registration_data,$table){
        $member_email = $registration_data['member_email'];
        $member_password = md5($registration_data['member_password']);
        $remember_me = $registration_data['remember_me'];
        try{
            $query_data = "SELECT member_id,member_first_name,member_last_name,member_email,image_path FROM lab_member WHERE member_email='$member_email' AND member_password='$member_password'"; 
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc();
                $member_id = $return_data['member_id'];
                $member_name = $return_data['member_first_name'].' '.$return_data['member_last_name'];

                $_SESSION['member_id'] = $member_id;
                $_SESSION['member_name'] = $member_name;
                $_SESSION['member_first_name'] = $return_data['member_first_name'];
                $_SESSION['member_last_name'] = $return_data['member_last_name'];
                $_SESSION['member_email'] = $return_data['member_email'];
                $_SESSION['member_image_path'] = $return_data['image_path'];
                
                if(!empty($remember_me)){
                    $expire_time = 1*30*24*3600; // 1 month
                    setcookie('remember_member_email', $member_email, time() + $expire_time, "/");
                    setcookie('remember_member_password', $registration_data['member_password'], time() + $expire_time, "/");
                }
                
                return true;
            }else{
                $_SESSION['error_msg'] = "Login credential not match.";
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function checkUserExist($registration_data,$table){
        $member_email = $registration_data['member_email']; 
        try{
            $query_data = "SELECT member_id FROM $table WHERE member_email='$member_email'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc();
                $member_id = $return_data['member_id'];
                $member_name = $return_data['member_first_name'].' '.$return_data['member_last_name'];
 
                $random_password = md5('FS-'.rand(1000,10000));
                $query_data = "UPDATE $table SET member_password='$random_password' WHERE member_id='$member_id'";
                $this->conn->query($query_data);

                // Send email for forget password.
                // $headers = "MIME-Version: 1.0" . "\r\n";
                // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // $headers .= 'From: <webmaster@example.com>' . "\r\n";
                // $headers .= 'Cc: myboss@example.com' . "\r\n";
                // mail($to,$subject,$message,$headers);

                return true;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function updateProfile($registration_data,$table,$member_image,$encrypted_member_id){
        $member_id = $registration_data['member_id']; 
        $member_display_name = $registration_data['member_display_name'];
        $member_lab_number = $registration_data['member_lab_number'];
        $member_address = $registration_data['member_address'];
        $member_phone = $registration_data['member_phone'];
        $member_display_name = $registration_data['member_display_name'];
        $member_first_name = $registration_data['member_first_name']; 
        $member_last_name = $registration_data['member_last_name']; 
        $member_email = $registration_data['member_email']; 
        $member_bio = $registration_data['member_bio']; 
       
        try{
            $query_data = "UPDATE $table SET 
            member_display_name='$member_display_name', 
            member_first_name='$member_first_name', 
            member_last_name='$member_last_name', 
            member_email='$member_email', 
            member_bio='$member_bio',
            member_address='$member_address',
            member_lab_number='$member_lab_number',
            member_phone='$member_phone',
            is_active=1
            WHERE member_id='$member_id'";
            if($this->conn->query($query_data)){
                // Code for image upload
                if(isset($member_image['member_image']['name']) && !empty($member_image['member_image']['name'])){
                    $file_name = $member_image['member_image']['name'];
                    $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
                    $file_name = 'main_'.$encrypted_member_id.'.'.$file_extension;
                    $temp_name = $member_image['member_image']['tmp_name'];
                    $full_image_path = FILE_ROOT_PATH.'/member-images'.'/'.$file_name;
                    $image_path = FILE_URL_PATH.'/member-images'.'/'.$file_name;

                    if(move_uploaded_file($temp_name, $full_image_path)){
                        $member_query_data = "UPDATE $table SET image_path='$image_path' WHERE member_id='$member_id'";
                        $this->conn->query($member_query_data);
                    }
                }

                $_SESSION['member_first_name'] = $member_first_name; 
                $_SESSION['member_last_name'] = $member_last_name; 
                $_SESSION['member_email'] = $member_email; 
                $_SESSION['member_image_path'] = $image_path; 

                return "updated";
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getMemberDetail($member_id,$table='lab_member'){
        try{
            $query_data = "SELECT * FROM $table WHERE member_id='$member_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $return_data = $result->fetch_assoc();
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function changePassowrd($registration_data,$table){
        $member_id = $registration_data['member_id'];
        $old_password = md5($registration_data['old_password']); 
        $new_password = md5($registration_data['new_password']); 
        
        try{
            $query_data = "SELECT member_id FROM $table WHERE member_password='$old_password'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $query_data = "UPDATE $table SET
                member_password='$new_password'
                WHERE member_id='$member_id'";
                if($this->conn->query($query_data)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function websiteSetting($registration_data,$table,$added_by,$logo_image,$encrypted_member_id){
        $setting_id = $registration_data['setting_id'];
        $setting_name = $registration_data['setting_name'];
        $setting_email = $registration_data['setting_email'];
        $setting_title = $registration_data['setting_title'];
        $setting_keyword = $registration_data['setting_keyword'];
        $setting_description = $registration_data['setting_description'];
        $current_date_time = date('Y-m-d H:i:s');

        $fields_data = "
                setting_name='$setting_name', 
                setting_email='$setting_email', 
                setting_title='$setting_title',
                setting_keyword='$setting_keyword', 
                setting_description='$setting_description',
                added_by='$added_by',
                is_active=1
            ";

        try{
            if(empty($setting_id)){
                $query_data = "INSERT INTO $table SET $fields_data ";
                $return_msg = 'added';
            }else{
                $query_data = "UPDATE $table SET $fields_data, updated_at='$current_date_time' WHERE setting_id='$setting_id'";
                $return_msg = 'updated';
            }
            if($this->conn->query($query_data)){
                // Code for image upload
                if(empty($setting_id)){
                    $setting_id = $this->conn->insert_id;
                }
                if(isset($logo_image['logo_image']['name']) && !empty($logo_image['logo_image']['name'])){
                    $file_name = $logo_image['logo_image']['name'];
                    $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
                    $file_name = 'main_'.$encrypted_member_id.'.'.$file_extension;
                    $temp_name = $logo_image['logo_image']['tmp_name'];
                    $full_image_path = FILE_ROOT_PATH.'/website_setting/'.'/'.$file_name;
                    $image_path = FILE_URL_PATH.'/website_setting/'.'/'.$file_name;

                    if(move_uploaded_file($temp_name, $full_image_path)){
                        $member_query_data = "UPDATE $table SET image_path='$image_path' WHERE setting_id='$setting_id'";
                        $this->conn->query($member_query_data);
                    }
                }
                return $return_msg;
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getSettingDetail($member_id,$table='company_setting'){
        try{
            $query_data = "SELECT * FROM $table WHERE added_by='$member_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $return_data = $result->fetch_assoc();
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getApiMemberDetail($table='company_member'){
        try{
            $query_data = "SELECT * FROM $table";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $return_data = $result->fetch_assoc();
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    function __destruct(){
        $this->conn->close();
    }

} 