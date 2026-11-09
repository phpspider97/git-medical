<?php
CLASS Admin extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
        $this->mail = $this->mail_configuration();
    } 
 
    public function addUpdateData($page_data,$table,$data_image){  
        $admin_id = $page_data['admin_id'];
        $admin_name = $page_data['admin_name'];
        $admin_email = $page_data['admin_email'];
        $admin_password = $page_data['admin_password'];
        
        //$admin_shop_type = $page_data['admin_shop_type'];
        $admin_shop_type_name = $page_data['admin_shop_type_name'];
        $admin_shop_name = $page_data['admin_shop_name'];
        $admin_shop_number = $page_data['admin_shop_number'];
        $admin_shop_zip_code = $page_data['admin_shop_zip_code'];
        $admin_shop_city = $page_data['admin_shop_city'];
        $admin_shop_state = $page_data['admin_shop_state'];
        $admin_shop_country = $page_data['admin_shop_country'];
        $admin_shop_address = $page_data['admin_shop_address'];
        $admin_about_shop = $page_data['admin_about_shop']; 
        $admin_facebook_link = $page_data['admin_facebook_link']; 
        $admin_instagram_link = $page_data['admin_instagram_link']; 
        $admin_youtube_link = $page_data['admin_youtube_link'];   
        $is_active = (isset($page_data['is_active']))?$page_data['is_active']:0;
 
        $encrypted_admin_id  =  $page_data['encrypted_admin_id'];
        $current_date_time = date('Y-m-d H:i:s');
  
        //Update password                
        if(!empty($admin_password)){                
            $admin_password = md5($admin_password);
            $this->conn->query("UPDATE web_admin SET admin_password='$admin_password' WHERE admin_id=$admin_id");
        } 

        $field_data =  "admin_name = '$admin_name',
                        admin_email = '$admin_email',
                        admin_shop_name = '$admin_shop_name',
                        admin_shop_number = '$admin_shop_number',
                        admin_shop_zip_code = '$admin_shop_zip_code',
                        admin_shop_city = '$admin_shop_city',
                        admin_shop_state = '$admin_shop_state',
                        admin_shop_country = '$admin_shop_country',
                        admin_shop_address = '$admin_shop_address',
                        admin_about_shop = '$admin_about_shop',
                        admin_facebook_link = '$admin_facebook_link',
                        admin_instagram_link = '$admin_instagram_link',
                        admin_youtube_link = '$admin_youtube_link',
                        is_active = '$is_active',
                        is_complete = 1";
 
        try{
            if(empty($admin_id)){
                $query_data = "INSERT INTO $table SET $field_data, created_at='$current_date_time'";
                $return_msg = 'added';
            }else{
                $query_data = "UPDATE $table SET $field_data, updated_at='$current_date_time' WHERE admin_id='$admin_id'";
                $return_msg = 'updated';
            }  
            if($this->conn->query($query_data)){
                if(empty($admin_id)){
                    $admin_id = $this->conn->insert_id;
                } 
                if(isset($data_image['data_image']['name']) && !empty($data_image['data_image']['name'])){
                    $file_name = $data_image['data_image']['name'];
                    $mime_type = $data_image['data_image']['type'];
                    $current_timestamp  =   time();

                    $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
                    $file_name = "admin-$admin_id-$encrypted_admin_id-$current_timestamp.$file_extension";
                    $temp_name = $data_image['data_image']['tmp_name'];

                    if(!file_exists(FILE_ROOT_PATH.'/shop_images/'.$encrypted_admin_id)){
                        mkdir(FILE_ROOT_PATH.'/shop_images/'.$encrypted_admin_id.'/');
                    }
                    $full_image_path = FILE_ROOT_PATH.'/shop_images/'.$encrypted_admin_id.'/'.$file_name;
                    $image_path = FILE_URL_PATH.'/shop_images/'.$encrypted_admin_id.'/'.$file_name;
                      
                    if(move_uploaded_file($temp_name, $full_image_path)){
                        $image_query_data = "UPDATE $table SET data_image='$image_path' WHERE admin_id='$admin_id'"; 
                        $this->conn->query($image_query_data);
                    }
                } 
                if(isset($data_image['user_image']['name']) && !empty($data_image['user_image']['name'])){
                    $file_name = $data_image['user_image']['name'];
                    $mime_type = $data_image['user_image']['type'];
                    $current_timestamp  =   time();
                     
                    $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
                    $file_name = "admin-$admin_id-$encrypted_admin_id.$file_extension-$current_timestamp";
                    $temp_name = $data_image['user_image']['tmp_name'];

                    if(!file_exists(FILE_ROOT_PATH.'/user_images/'.$encrypted_admin_id)){
                        mkdir(FILE_ROOT_PATH.'/user_images/'.$encrypted_admin_id.'/');
                    }
                    $full_image_path = FILE_ROOT_PATH.'/user_images/'.$encrypted_admin_id.'/'.$file_name;
                    $image_path = FILE_URL_PATH.'/user_images/'.$encrypted_admin_id.'/'.$file_name;
                       
                    if(move_uploaded_file($temp_name, $full_image_path)){
                        $image_query_data = "UPDATE $table SET user_image='$image_path' WHERE admin_id='$admin_id'"; 
                        $this->conn->query($image_query_data);
                    }
                }

                return [
                    "msg"=>$return_msg,
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
    
    public function getData($data_id,$table=DATABASE_TABLE_PREFIX.'admin'){
        try{
            $query_data = "SELECT * from $table WHERE admin_id='$data_id'";
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

    public function totalShopView($data_id,$table=DATABASE_TABLE_PREFIX.'admin'){
        try{ 
            $query_data = "SELECT admin_view FROM $table WHERE admin_id='$data_id' ";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $row = $result->fetch_assoc()['admin_view'];
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function updateShopView($data_id,$table=DATABASE_TABLE_PREFIX.'admin'){
        try{   
            $result = $this->conn->query("UPDATE $table SET admin_view=admin_view+1 WHERE admin_id='$data_id'");
            return true;
        }catch(Exception $e){
            return false;
        }
    }
     
    public function allTotalSaleRecord($added_by,$table=DATABASE_TABLE_PREFIX.'order'){
        try{  
            $query_data = "SELECT sum(order_product_quantity*order_product_price) as total_order FROM $table WHERE $table.order_to=$added_by AND order_delivery_status=1";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    if(!empty($row['total_order'])){
                        $return_data = $row['total_order'];
                    }else{
                        $return_data =  0;
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
     
    public function changeStatus($admin_id,$current_status,$table=DATABASE_TABLE_PREFIX.'admin'){ 
        try{   
            $result = $this->conn->query("UPDATE $table SET is_active=$current_status WHERE admin_id='$admin_id'");
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
  
    public function getShopType($added_by,$table=DATABASE_TABLE_PREFIX.'shop_type'){
        try{ 
            $query_data = "SELECT * FROM $table WHERE added_by='$added_by' OR added_by='1'";
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

    // Login area start
    public function registartion($page_data,$table){
        $is_exist = $this->checkAdminExist($page_data,$table); 
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
        $mail    =   $this->mail;
        $a_get_information_data['website_logo'] = WEBSITE_LOGO;
        $a_get_information_data['site_url'] = SITE_URL_ADMIN;
        $options = array(
            'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
            'content' => http_build_query($a_get_information_data)),
        ); 
        
        $stream = stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/vendor-register.php',false, $stream);
        try{  
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
            $query_data = "SELECT admin_id,admin_name,admin_email,is_super,is_complete FROM $table WHERE admin_email='$admin_email' AND admin_password='$admin_password' AND is_active=1";
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
        $is_exist = $this->checkAdminExist($page_data,$table); 
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
            return true;
        }
    }
 

    public function checkAdminExist($page_data,$table){
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

    public function forgetPassword($page_data,$table){ 
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

                if($this->sendForgetEmail($a_get_information_data)){
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
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/vendor-forget.php',false, $stream);
        try{ 
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

    public function totalFieldAdded($data_id,$table){
        try{  
            $query_data = "SELECT count(*) as total_field_added FROM $table WHERE added_by='$data_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $result->fetch_assoc()['total_field_added'];   
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