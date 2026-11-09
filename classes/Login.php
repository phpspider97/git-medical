<?php
CLASS Login extends Connection {
    protected $conn; 

    function __construct(){
        $this->conn = $this->create_connection();
        $this->mail = $this->mail_configuration();
    }

    public function registartion($page_data,$table){
        $is_exist = $this->checkUserExist($page_data,$table); 
        if(empty($is_exist)){
            $current_date       =   date('Y-m-d H:i:s');
            $admin_email        =   $page_data['admin_email'];
            $admin_name         =   $page_data['admin_name'];
            $admin_shop_number  =   $page_data['admin_shop_number'];
            $admin_password     =   md5($page_data['admin_password']);

            $field_data = "
                    admin_email='$admin_email', 
                    admin_name='$admin_name', 
                    admin_shop_number='$admin_shop_number', 
                    admin_password='$admin_password',  
                    created_at='$current_date',
                    is_active=1
                ";
            try{ 
                $query_data = "INSERT INTO $table SET $field_data";
                $this->conn->query($query_data);
                $admin_id = $this->conn->insert_id;
                if(!empty($admin_id)){
                    $_SESSION['admin_id']           =   $admin_id; 
                    $_SESSION['admin_name']         =   $admin_name; 
                    $_SESSION['admin_email']        =   $admin_email; 
                    $_SESSION['admin_shop_number']  =   $admin_shop_number; 
                    if($this->sendRegistrationEmail($page_data)){ 
                        return [
                            "msg"=>"Welcome <b><u>$admin_name</u></b> thanks for registration.<br /> Now choose your plan for upload product.",
                            "status"=>200
                        ];
                    }else{ 
                        return [
                            "msg"=>'Some issue to send email.',
                            "status"=>400
                        ];
                    }    
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
        }else{
            return [
                "msg"=>'This email already registered in our database.',
                "status"=>400
            ];
        } 
    }

    public function sendRegistrationEmail($a_get_information_data){ 
        return true;
        $mail    =   $this->mail;
        $a_get_information_data['website_logo'] = WEBSITE_LOGO;
        $a_get_information_data['site_url'] = SITE_URL_ADMIN;
        $options = [
            'http' => [
                            'method' => 'POST',
                            'content' => http_build_query($a_get_information_data)
                    ],
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        ]; 
        //pr($options);
        $stream = @stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/vendor-register.php',false, $stream);
        try{ 
            $mail->isHTML(true); 
            $mail->Subject = $a_get_information_data['admin_name'].' thanks for registration!! Check your credential details.';  
            $mail->Body    = $mail_template; 
            $a_mail_list = [$a_get_information_data['admin_email']];  
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
        $admin_email = $page_data['admin_email'];
        $admin_password = md5($page_data['admin_password']);
        try{ 
            $query_data = "SELECT admin_id,admin_name,admin_email,is_complete FROM $table WHERE admin_email='$admin_email' AND admin_password='$admin_password' AND is_active=1";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc();  
                return [
                    "msg"=>$return_data,
                    "status"=>200
                ]; 
            }else{ 
                return [
                    "msg"=>"Login credential not match.",
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

    public function socialLogin($page_data,$table){
        $is_exist = $this->checkUserExist($page_data,$table); 
        if(empty($is_exist)){
            $current_date = date('Y-m-d H:i:s');
            $admin_email = $page_data['admin_email'];
            $admin_name = $page_data['admin_name'];
            $admin_password =   "Vendor-".rand(10000,999999);
            $encrypt_admin_password =   md5($admin_password);

            $field_data = "
                    admin_email='$admin_email', 
                    admin_name='$admin_name', 
                    admin_password='$encrypt_admin_password',  
                    created_at='$current_date',
                    is_active=1
                ";
            try{
                $query_data = "INSERT INTO $table SET $field_data";
                $this->conn->query($query_data);
                $admin_id = $this->conn->insert_id;

                //add password
                $page_data['admin_password']  =   $admin_password;
                if($this->sendRegistrationEmail($page_data)){
                    $_SESSION['admin_id'] = $admin_id; 
                    $_SESSION['admin_name'] = $admin_name; 
                    $_SESSION['admin_email'] = $admin_email;
                    $_SESSION['is_complete'] = 0;  
                    return true;
                }else{
                    return false;
                }  
                return true;
            }catch(Exception $e){
                return false;
            }
        }else{
            $_SESSION['admin_id']       =   $is_exist['admin_id']; 
            $_SESSION['admin_name']     =   $is_exist['admin_name']; 
            $_SESSION['admin_email']    =   $is_exist['admin_email'];
            $_SESSION['is_complete']    =   $is_exist['is_complete']; 
            return true;
        }
    }
 

    public function checkUserExist($page_data,$table){
        try{ 
            $admin_email = $page_data['admin_email'];
            $query_data = "SELECT * FROM $table WHERE admin_email='$admin_email'";
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

    public function memberRegistartion($page_data,$table){
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
                return false;
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

    function encode( $string, $action = 'e' ) {
		// you may change these values to your own
		$secret_key = 'my_simple_secret_key';
		$secret_iv = 'my_simple_secret_iv';
	 
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		} 
		return $output;
	}

    public function getRandomProduct($added_by){
        try{ 
            $query_data = "SELECT * FROM web_product WHERE added_by='$added_by' LIMIT 3";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $count = -1;
                while($row = $result->fetch_assoc()){
                    $count++;
                    $return_data[] = $row;
                    $product_encrypt_id = $this->encode($row['product_id']); 
                    $return_data[$count]['product_encrypt_id'] = $product_encrypt_id;
                }
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
 
    public function memberLogin($page_data,$table){
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
    
    public function forgetPasswordAdmin($page_data,$table){ 
        $admin_email = $page_data['admin_email']; 
        try{
            $query_data = "SELECT admin_id,admin_name FROM $table WHERE admin_email='$admin_email'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $return_data = $result->fetch_assoc();
                $admin_id = $return_data['admin_id'];
                $admin_name = $return_data['admin_name'];
                $random_password    =   'Shop'.rand(1000,10000).'123@#';
                $encrypt_random_password = md5($random_password);
                $query_data = "UPDATE $table SET admin_password='$encrypt_random_password' WHERE admin_id='$admin_id'";
                $this->conn->query($query_data);
                
                $a_get_information_data['admin_name'] = $admin_name;
                $a_get_information_data['admin_email'] = $admin_email;
                $a_get_information_data['admin_password'] = $random_password;
                $a_get_information_data['site_url'] = SITE_URL; 
                $a_get_information_data['website_logo'] = WEBSITE_LOGO; 

                if($this->sendForgetEmailAdmin($a_get_information_data)){
                    return true;
                }else{
                    return false;
                } 
            }else{ 
                return false;;
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function sendForgetEmailAdmin($a_get_information_data){ 
        $mail    =   $this->mail;
        $options = array(
            'http' => array(
            'method' => 'POST',
            'content' => http_build_query($a_get_information_data)),
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        ); 
        $stream = @stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/vendor-forget.php',false, $stream);
        try{ 
            $mail->isHTML(true); 
            $mail->Subject = $a_get_information_data['admin_name'].' Your password update successfully. Check your new credential detail.'; 
            $mail->Body    = $mail_template; 
            $a_mail_list = [$a_get_information_data['admin_email']];  
            foreach($a_mail_list as $email){
                $mail->addBCC($email);
            } 
            $mail->send(); 
            return true;
        }catch (Exception $e) { 
            return false; 
        }
    }
       
    public function updateMemberProfile($page_data,$table){ 
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

        $field_data = "
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
                $query_data = "INSERT INTO $table SET $field_data ";
                $return_msg = 'added';
            }else{
                $query_data = "UPDATE $table SET $field_data, updated_at='$current_date_time' WHERE setting_id='$setting_id'";
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

    public function getSettingDetail($member_id,$table='blog_setting'){
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

    function __destruct(){
        $this->conn->close();
    }

} 