<?php
 
CLASS Customer extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
    }  
      
    public function addUpdateData($page_data,$table){ 
        $member_id = $page_data['member_id'];
        $member_email = $page_data['member_email'];
        $member_password = $page_data['member_password'];
        $member_first_name = $page_data['member_first_name'];
        $member_last_name = $page_data['member_last_name'];
        $member_phone = $page_data['member_phone'];
        $member_address_1 = $page_data['member_address_1'];
        $member_address_2 = $page_data['member_address_2'];
        $member_country = $page_data['member_country'];
        $member_city = $page_data['member_city'];
        $member_state = $page_data['member_state'];
        $member_zip_code = $page_data['member_zip_code']; 
        $current_date_time = date('Y-m-d H:i:s');
        
        $field_data = "
                member_email='$member_email',  
                member_first_name='$member_first_name',
                member_last_name='$member_last_name',
                member_phone='$member_phone',
                member_address_1='$member_address_1',
                member_address_2='$member_address_2',
                member_country='$member_country',
                member_state='$member_state',
                member_city='$member_city',
                member_zip_code='$member_zip_code',  
                is_complete=1,
                is_active=1
            "; 
        if(!empty($member_password)){             
            $member_password = md5($member_password);
            $this->conn->query("UPDATE web_member SET member_password='$member_password' WHERE member_id=$member_id");
        }  
  
        try{
            if(empty($member_id)){
                $query_data = "INSERT INTO $table SET $field_data, created_at='$current_date_time'";
                $return_msg = 'added';
            }else{
                $query_data = "UPDATE $table SET $field_data, updated_at='$current_date_time' WHERE member_id='$member_id'";
                $return_msg = 'updated';
            } 
            if($this->conn->query($query_data)){   
                return true; 
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getAllFrontCustomerData($table=DATABASE_TABLE_PREFIX.'member'){
        try{ 
            $query_data = "SELECT * FROM $table"; 
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $count = -1;
                while($row = $result->fetch_assoc()) {
                    $count++;
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
 
    public function changeCustomerStatus($member_id,$current_status,$table=DATABASE_TABLE_PREFIX.'member'){ 
        try{   
            $result = $this->conn->query("UPDATE $table SET is_active=$current_status WHERE member_id='$member_id'");
            if($result === TRUE){
                return [
                    "msg"=>'Status Updated successfully!!',
                    "status"=>200
                ];
            }else{
                return [
                    "msg"=>explode(":",$this->conn->error)[0],
                    "status"=>400
                ];
            }
        }catch(Exception $e){
            return [
                "msg"=>$e->getMessage(),
                "status"=>400
            ];
        }     
    }

    // Member login area start
    public function checkCustomerExist($page_data,$table){
        try{ 
            $member_email = $page_data['member_email'];
            $query_data = "SELECT * FROM $table WHERE member_email='$member_email'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $result->fetch_assoc();   
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        } 
    }

    public function customerSocialLogin($page_data,$table){
        $is_exist = $this->checkCustomerExist($page_data,$table); 
        if(empty($is_exist)){
            $current_date               =   date('Y-m-d H:i:s');
            $member_email               =   $page_data['member_email'];
            $member_name                =   $page_data['member_name'];
            $member_password            =   "Customer-".rand(10000,999999);
            $encrypt_member_password    =   md5($member_password);

            $field_data = "
                    member_email='$member_email', 
                    member_first_name='$member_name', 
                    member_password='$encrypt_member_password',  
                    created_at='$current_date',
                    is_active=1
                ";
            try{
                 
                $query_data = "INSERT INTO $table SET $field_data";
                $this->conn->query($query_data);
                $member_id = $this->conn->insert_id;

                //add password
                $page_data['member_password']  =    $member_password; 
                $page_data['site_url']         =    SITE_URL;
                $page_data['website_logo']     =    WEBSITE_LOGO; 

                if($this->sendRegisterEmail($page_data)){
                    $_SESSION['member_id']      =   $member_id; 
                    $_SESSION['member_name']    =   $member_first_name; 
                    $_SESSION['member_email']   =   $member_email; 
                    return true;
                }else{
                    return false;
                }  
                return true;
            }catch(Exception $e){
                return false;
            }
        }else{
            $_SESSION['member_id']       =   $is_exist['member_id']; 
            $_SESSION['member_name']     =   $is_exist['member_first_name']; 
            $_SESSION['member_email']    =   $is_exist['member_email'];
            return true;
        }
    }

    public function registartion($page_data,$table){
        $member_email = $page_data['member_email'];
        $member_password = md5($page_data['member_password']);
        $member_first_name = $page_data['member_first_name'];
        $member_last_name = $page_data['member_last_name'];
        $member_phone = $page_data['member_phone'];
        $member_address_1 = $page_data['member_address_1'];
        $member_address_2 = $page_data['member_address_2'];
        $member_country = $page_data['member_country'];
        $member_city = $page_data['member_city'];
        $member_state = $page_data['member_state'];
        $member_zip_code = $page_data['member_zip_code'];
        $member_order_note = $page_data['member_order_note'];
        $is_member = (isset($page_data['is_member']))?$page_data['is_member']:0;
        $current_date = date('Y-m-d H:i:s');
        
        $field_data = "
                member_email='$member_email', 
                member_password='$member_password', 
                member_first_name='$member_first_name',
                member_last_name='$member_last_name',
                member_phone='$member_phone',
                member_address_1='$member_address_1',
                member_address_2='$member_address_2',
                member_country='$member_country',
                member_state='$member_state',
                member_city='$member_city',
                member_zip_code='$member_zip_code',
                member_order_note='$member_order_note',
                is_member='$is_member',
                created_at='$current_date',
                is_active=1,
                is_complete=1
            ";
           
        try{
            $query_data = "INSERT INTO $table SET $field_data";
            $this->conn->query($query_data);
            $member_id = $this->conn->insert_id;
            $_SESSION['member_id'] = $member_id; 
            $_SESSION['member_name'] = $member_first_name.' '.$member_last_name;
            $_SESSION['member_email'] = $member_email; 

            $a_get_information_data['member_name'] = $member_first_name.' '.$member_last_name;
            $a_get_information_data['member_email'] = $member_email;
            $a_get_information_data['member_password'] = $page_data['member_password'];
            $a_get_information_data['site_url'] = SITE_URL;
            $a_get_information_data['website_logo']  =   WEBSITE_LOGO; 

            if($this->sendRegisterEmail($a_get_information_data)){
                return 'Registration successfully!! <br /> Happy Shopping!!.';
            }else{
                return false;;
            } 
        }catch(Exception $e){
            return false;
        }
    }

    public function sendRegisterEmail($a_get_information_data){  
        $mail   =   $this->mail; 
        $options = array(
            'http' => array(
            'method' => 'POST',
            'content' => http_build_query($a_get_information_data)),
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        ); 
        $stream = @stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/customer-register.php',false, $stream);
        try{ 
            $mail->isHTML(true); 
            $mail->Subject = $a_get_information_data['member_name'].' Thanks for become our customer. Check your credential detail.'; 
            $mail->Body    = $mail_template; 
            $a_mail_list = [$a_get_information_data['member_email']];  
            foreach($a_mail_list as $email){
                $mail->addBCC($email);
            } 
            $mail->send(); 
            return true;
        }catch (Exception $e) {
            return false; 
        }
    }

    public function login($page_data,$table){
        $member_email = $page_data['member_email'];
        $member_password = md5($page_data['member_password']);
        try{ 
            $query_data = "SELECT member_id,member_first_name,member_last_name,member_email FROM $table WHERE member_email='$member_email' AND member_password='$member_password' AND is_active=1";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc(); 
                
                $member_name = $return_data['member_first_name'].' '.$return_data['member_last_name'];

                $_SESSION['member_id'] = $return_data['member_id'];
                $_SESSION['member_name'] = $return_data['member_first_name'].' '.$return_data['member_last_name']; 
                $_SESSION['member_email'] = $return_data['member_email']; 
                return "Welcome $member_name. Happy Shopping!!";
                return $return_data; 
            }else{
                $_SESSION['error_msg'] = "Login credential not match.";
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    } 

    public function forgetPassword($page_data,$table){ 
        $member_email = $page_data['member_email']; 
        try{
            $query_data = "SELECT member_id,member_first_name,member_last_name FROM $table WHERE member_email='$member_email'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc();
                $member_id = $return_data['member_id'];
                $member_first_name = $return_data['member_first_name'];
                $random_password    =   'Customer'.rand(1000,10000).'123@#';
                $encrypt_random_password = md5($random_password);
                $query_data = "UPDATE $table SET member_password='$encrypt_random_password' WHERE member_id='$member_id'";
                $this->conn->query($query_data);
                
                $a_get_information_data['member_name'] = $return_data['member_first_name'].' '.$return_data['member_last_name'];
                $a_get_information_data['member_email'] = $member_email;
                $a_get_information_data['member_password'] = $random_password;
                $a_get_information_data['site_url'] = SITE_URL;
                $a_get_information_data['website_logo'] = WEBSITE_LOGO;
                 
                if($this->sendForgetEmail($a_get_information_data)){
                    return true;
                }else{
                    return false;;
                }
            }else{
                return false;;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function sendForgetEmail($a_get_information_data){ 
        $mail    =   $this->mail;
        $options = array(
            'http' => array(
            'method' => 'POST',
            'content' => http_build_query($a_get_information_data)),
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        ); 
        $stream = @stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/customer-forget.php',false, $stream);
        try{ 
            $mail->isHTML(true); 
            $mail->Subject = $a_get_information_data['member_name'].' Your password changed successfully. Check your new password.'; 
            $mail->Body    = $mail_template; 
            $a_mail_list = [$a_get_information_data['member_email']];  
            foreach($a_mail_list as $email){
                $mail->addBCC($email);
            } 
            $mail->send(); 
            return true;
        }catch (Exception $e) {
            return false; 
        }
    }

    public function getMemberDetail($member_id,$table=DATABASE_TABLE_PREFIX.'member'){
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
 
    function __destruct(){
        $this->conn->close();
    }
} 