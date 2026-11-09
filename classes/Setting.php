<?php
CLASS Setting extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
    }  

    public function addUpdateData($page_data,$table,$data_image){  
        $setting_id = $page_data['setting_id']; 
        $setting_body_color = $page_data['setting_body_color']; 
        $setting_menu_color = $page_data['setting_menu_color']; 
        $setting_menu_nav_color = $page_data['setting_menu_nav_color']; 
        $setting_card_color = $page_data['setting_card_color']; 
        $setting_text_color = $page_data['setting_text_color']; 
        $setting_website_name = $page_data['setting_website_name']; 
        $setting_about = $page_data['setting_about']; 
        $is_active = (isset($page_data['is_active']))?$page_data['is_active']:0;  
        $is_report_header = (isset($page_data['is_report_header']))?$page_data['is_report_header']:0;  

        $added_by = $page_data['admin_id'];
        $encrypted_admin_id  =  $page_data['encrypted_admin_id'];
        $current_date_time = date('Y-m-d H:i:s');

        $setting_body_color = ($setting_body_color == '#000000')?'':$setting_body_color;
        $setting_menu_color = ($setting_menu_color == '#000000')?'':$setting_menu_color;
        $setting_menu_nav_color = ($setting_menu_nav_color == '#000000')?'':$setting_menu_nav_color;
        $setting_card_color = ($setting_card_color == '#000000')?'':$setting_card_color;
        $setting_text_color = ($setting_text_color == '#000000')?'':$setting_text_color;

        $field_data =  "setting_body_color = '$setting_body_color',
                        setting_menu_color = '$setting_menu_color',
                        setting_menu_nav_color = '$setting_menu_nav_color',
                        setting_card_color = '$setting_card_color',
                        setting_text_color = '$setting_text_color',
                        setting_website_name = '$setting_website_name',
                        setting_about = '$setting_about',
                        is_active = '$is_active', 
                        is_report_header = '$is_report_header', 
                        added_by='$added_by'";

        try{
            if(empty($setting_id)){
                $query_data = "INSERT INTO $table SET $field_data, created_at='$current_date_time'";
                $return_msg = 'added';
            }else{
                $query_data = "UPDATE $table SET $field_data, updated_at='$current_date_time' WHERE setting_id='$setting_id'";
                $return_msg = 'updated';
            }
            if($this->conn->query($query_data)){
                if(empty($setting_id)){
                    $setting_id = $this->conn->insert_id;
                }
                if(isset($data_image['data_image']['name']) && !empty($data_image['data_image']['name'])){
                    
                    $file_name = $data_image['data_image']['name'];
                    $mime_type = $data_image['data_image']['type'];
                    $current_timestamp  =   time();
                    $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
                    $file_name = "brand-$setting_id-$encrypted_admin_id-$current_timestamp.$file_extension";
                    $temp_name = $data_image['data_image']['tmp_name'];
                     
                    if(!file_exists(FILE_ROOT_PATH.'/setting_images/'.$encrypted_admin_id)){
                        mkdir(FILE_ROOT_PATH.'/setting_images/'.$encrypted_admin_id.'/');
                    }
                    $full_image_path = FILE_ROOT_PATH.'/setting_images/'.$encrypted_admin_id.'/'.$file_name;
                    $image_path = FILE_URL_PATH.'/setting_images/'.$encrypted_admin_id.'/'.$file_name;
                     
                    if(move_uploaded_file($temp_name, $full_image_path)){
                        $image_query_data = "UPDATE $table SET data_image='$image_path' WHERE setting_id='$setting_id'"; 
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

    public function getData($data_id,$table=DATABASE_TABLE_PREFIX.'setting'){
        try{
            $query_data = "SELECT * FROM $table WHERE added_by='$data_id'";
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
      
    function __destruct(){
        $this->conn->close();
    }
} 