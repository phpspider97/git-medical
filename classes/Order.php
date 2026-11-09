<?php 
CLASS Order extends Connection {
    protected $conn;
    public $mail;  
    function __construct(){
        $this->conn = $this->create_connection(); 
        $this->mail = $this->mail_configuration(); 
    } 

    public function addUpdateData($page_data,$table,$order_status,$is_cod=0,$order_note=''){
        $member_id = $page_data['member_id'];
        $a_cart_information = $page_data['cart_info']; 
        //pr($page_data);
        try{
            $a_order_id = [];
            $order_ids = 0;
            foreach($a_cart_information as $cart_info){
                $product_id = $cart_info['product_id'];
                $encrypted_product_id = $cart_info['encrypted_product_id'];
                $product_added_by = $cart_info['product_added_by'];
                $product_name = $cart_info['product_name'];
                $product_price = $cart_info['product_price'];
                $product_variation_id = @$cart_info['product_variation_id'];
                $product_variation_name = @$cart_info['product_variation_name'];
                $product_attribute_name = @$cart_info['product_attribute_name'];
                $product_quantity = $cart_info['product_quantity'];
                $product_image = $cart_info['product_image'];
                $is_insert = $cart_info['is_insert'];
                $current_date_time = date('Y-m-d H:i:s');

                $field_data =  "order_by = '$member_id',
                order_to = '$product_added_by',
                order_product_id = '$product_id', 
                order_product_name='$product_name',
                order_product_quantity='$product_quantity',
                order_product_price='$product_price',
                order_variation_id='$product_variation_id',
                order_variation_name='$product_variation_name',
                order_attribute_name='$product_attribute_name',
                order_product_image='$product_image',
                order_status='$order_status',
                is_cod='$is_cod',
                order_note='$order_note',
                created_at='$current_date_time'";

                if(empty($is_insert)){
                    $query_data = "INSERT INTO $table SET $field_data";
                    $this->conn->query($query_data);
                    $order_id = $this->conn->insert_id;
                    $a_order_id[] =  $order_id;
                } 

                $_SESSION['cart_info'][$encrypted_product_id] = [ 
                    'product_price'         =>      $product_price,
                    'encrypted_product_id'  =>      $encrypted_product_id,
                    'product_id'            =>      $product_id,
                    'product_name'          =>      $product_name,
                    'product_quantity'      =>      $product_quantity,
                    'product_added_by'      =>      $product_added_by,
                    'product_image'         =>      $product_image,
                    'is_insert'             =>      1,
                    'member_id'             =>      (isset($_SESSION['member_id']))?$_SESSION['member_id']:0
                ];
            }
            if(isset($a_order_id) && !empty($a_order_id)){
                $order_ids = implode(',',$a_order_id);
            }
            return $order_ids;
        }catch(Exception $e){
            return false; 
        } 
    } 
    public function updateOrderDetail($razorpay_payment_id,$table,$order_status,$order_id,$all_payment_response_data=''){
        $member_id  =   $_SESSION['member_id'];
        $current_date_time = date('Y-m-d H:i:s');
        try{  
            $this->conn->query("UPDATE web_order SET order_status='$order_status',razorpay_payment_id='$razorpay_payment_id',all_payment_response_data='$all_payment_response_data',updated_at='$current_date_time' WHERE order_by='$member_id' AND order_id in ($order_id) ");     
            return true;
    
        }catch(Exception $e){
            return false;
        } 
    }

    public function getAllData($added_by,$table=DATABASE_TABLE_PREFIX.'order'){
        try{ 
            $where_clause   = '';
            if($added_by != 1){
                $where_clause   =   " WHERE $table.order_to=$added_by";
            }
            $query_data = "SELECT $table.*,web_member.member_email,web_member.member_phone,web_member.member_first_name,web_member.member_last_name,web_member.member_address_1 FROM $table INNER JOIN web_member on $table.order_by = web_member.member_id $where_clause ORDER BY $table.order_id DESC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data[] = $row;
                }
                return $return_data;
            }else{ 
                return [];
            }
        }catch(Exception $e){
            return false;
        }
    } 

   
    public function getAllReturnData($added_by,$table=DATABASE_TABLE_PREFIX.'order_return'){
        try{ 
            $where_clause   = '';
            if($added_by != 1){
                $where_clause   =   " WHERE $table.admin_id=$added_by";
            }
            $query_data = "SELECT $table.*,web_member.member_email,web_member.member_phone,web_member.member_first_name,web_member.member_last_name,web_member.member_address_1,web_order.*,web_return_condition.condition_name,web_admin.admin_name FROM $table INNER JOIN web_member on $table.member_id = web_member.member_id INNER JOIN web_admin on $table.admin_id = web_admin.admin_id INNER JOIN web_order on $table.order_id=web_order.order_id LEFT JOIN web_return_condition on $table.condition_id=web_return_condition.condition_id $where_clause ORDER BY $table.order_id DESC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data[] = $row;
                }
                return $return_data;
            }else{ 
                return [];
            }
        }catch(Exception $e){
            return false;
        }
    }
    
    public function getAllCancelData($added_by,$table=DATABASE_TABLE_PREFIX.'order_cancel'){
        try{ 
            $where_clause   = '';
            if($added_by != 1){
                $where_clause   =   " WHERE $table.admin_id=$added_by";
            }
            $query_data = "SELECT $table.*,web_member.member_email,web_member.member_phone,web_member.member_first_name,web_member.member_last_name,web_member.member_address_1,web_order.*,web_admin.admin_name FROM $table INNER JOIN web_member on $table.member_id = web_member.member_id INNER JOIN web_admin on $table.admin_id = web_admin.admin_id INNER JOIN web_order on $table.order_id = web_order.order_id $where_clause ORDER BY $table.order_id DESC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data[] = $row;
                }
                return $return_data;
            }else{ 
                return [];
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function allCustomerOrderData($table=DATABASE_TABLE_PREFIX.'order'){
        try{ 
            $query_data = "SELECT $table.*,web_member.member_email,web_member.member_phone,web_member.member_first_name,web_member.member_last_name,web_member.member_address_1,web_member.member_address_2,web_admin.admin_name as added_by_name FROM $table INNER JOIN web_member on $table.order_by = web_member.member_id INNER JOIN web_admin on web_admin.admin_id=$table.order_to ORDER BY $table.order_id DESC";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data[] = $row;
                }
                return $return_data;
            }else{ 
                return [];
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function getCustomerOrderData($added_by,$table=DATABASE_TABLE_PREFIX.'order'){
        try{ 
            $query_data = "SELECT $table.*,web_admin.admin_shop_name,web_admin.admin_shop_address,web_admin.admin_shop_number,web_admin.admin_email,web_admin.admin_name,web_product.product_tag,web_product.category_id,web_product.product_return_day FROM $table INNER JOIN web_admin on $table.order_to = web_admin.admin_id INNER JOIN web_product on $table.order_product_id = web_product.product_id WHERE $table.order_by='$added_by' ORDER BY $table.order_id DESC";
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
     
    public function graphRepresentation($added_by,$table){
        try{ 
            $query_data = "SELECT *,month(created_at) as selected_month FROM $table WHERE order_to in ($added_by)";
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
    public function productUploaded($added_by,$table){
        try{ 
            $query_data = "SELECT count(*) as total_product_upload,month(created_at) as selected_month FROM $table WHERE added_by in ($added_by) AND is_active='1' GROUP BY selected_month";
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

    public function totalRecord($added_by,$table=DATABASE_TABLE_PREFIX.'product'){
        try{ 
            $query_data = "SELECT count(*) as total_data FROM $table WHERE admin_id in ($added_by) ";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data = $row['total_data'];
                }
                return (!empty($return_data))?$return_data:0;
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
    public function totalProductView($data_id,$table=DATABASE_TABLE_PREFIX.'product'){
        try{ 
            $query_data = "SELECT sum(product_view) as product_view FROM $table WHERE added_by='$data_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $row = $result->fetch_assoc()['product_view'];
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function totalProductShareView($data_id,$table=DATABASE_TABLE_PREFIX.'product'){
        try{ 
            $query_data = "SELECT sum(product_whatsapp_share+product_facebook_share) as total_product_share FROM $table WHERE added_by='$data_id' ";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $row = $result->fetch_assoc()['total_product_share'];
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function allCustomerTotalRecord($table=DATABASE_TABLE_PREFIX.'product'){
        try{ 
            $query_data = "SELECT count(*) as total_data FROM $table ";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data = $row['total_data'];
                }
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
 
    public function allTotalSaleRecord($added_by,$table=DATABASE_TABLE_PREFIX.'order'){
        try{ 
            $where_clause   = '';
            if($added_by != 1){
                $where_clause   =   " $table.order_to=$added_by AND";
            }
            $query_data = "SELECT sum(order_product_quantity*order_product_price) as total_order FROM $table WHERE $where_clause order_delivery_status=1";
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

    public function orderMailToCustomer($order_id_data,$only_get_data=false){
        $mail = $this->mail; 
        $a_order_mail_data = $this->getOrderMailData($order_id_data);
        
        foreach($a_order_mail_data as $count=>$product_data){
            $product_encrypt_id = $this->encode($a_order_mail_data[$count]['order_product_id']);
            $admin_encrypt_id = $this->encode($a_order_mail_data[$count]['admin_id']);
            $a_order_mail_data[$count]['product_encrypt_id'] = $product_encrypt_id;
            $a_order_mail_data[$count]['admin_encrypt_id'] = $admin_encrypt_id;
            $a_order_mail_data[$count]['site_url'] = SITE_URL; 
            $a_order_mail_data[$count]['website_logo'] = WEBSITE_LOGO;
            if(empty($only_get_data)){
                $this->orderMailToVendor($a_order_mail_data[$count]);
            } 
        }  
        
        if(!empty($only_get_data)){
            return $a_order_mail_data;
        }

        $options = array(
            'http' => array(
            'method' => 'POST',
            'content' => http_build_query($a_order_mail_data)),
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        ); 
        $stream = @stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/order-to-customer.php',false, $stream);

        try{ 
            $mail->isHTML(true); 
            $mail->Subject = $a_order_mail_data[0]['member_first_name'].' Thanks for shopping. Your order review detail.';
            $mail->Body    = $mail_template; 
            $a_mail_list = [$a_order_mail_data[0]['member_email']];  
            foreach($a_mail_list as $email){
                $mail->addBCC($email);
            }
            $mail->send();
            return true;
        }catch (Exception $e) {
            return false; 
        }
    }
     
    public function orderMailToVendor($a_order_mail_data){
        $mail = $this->mail;
        $options = array(
            'http' => array(
            'method' => 'POST',
            'content' => http_build_query($a_order_mail_data)),
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        );
        $stream = @stream_context_create($options);
        $mail_template = @file_get_contents(SITE_URL.'/smt-mail/templates/order-to-vendor.php',false, $stream);
            
        try{
            $mail->isHTML(true);
            $mail->Subject = $a_order_mail_data['admin_name'].' you have new order.';
            $mail->Body    = $mail_template;
            $a_mail_list = [$a_order_mail_data['admin_email']];
            foreach($a_mail_list as $email){
                $mail->addBCC($email);
            }
            $mail->send();
            return true;
        }catch (Exception $e) {
            return false;
        }
    }

    public function getOrderMailData($added_by,$table=DATABASE_TABLE_PREFIX.'order'){
        try{ 
            $query_data = "SELECT * FROM $table LEFT JOIN web_admin on web_admin.admin_id=$table.order_to INNER JOIN web_member on web_member.member_id=$table.order_by INNER JOIN web_product on web_product.product_id=$table.order_product_id WHERE $table.order_id in ($added_by)";
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

    public function changeStatus($brand_id,$current_status,$table=DATABASE_TABLE_PREFIX.'brand'){  
        return $this->conn->query("UPDATE $table SET is_active=$current_status WHERE brand_id='$brand_id'");
    }
    public function cancelOrder($order_data,$table){
        $order_id       =   $order_data['order_id'];
        $member_id      =   $order_data['member_id'];
        $cancel_reason  =   $order_data['cancel_reason'];
        $admin_id       =   $order_data['admin_id'];
        $product_id     =   $order_data['product_id'];
        
        $field_data =   "order_id='$order_id',
                        cancel_reason='$cancel_reason',
                        member_id='$member_id',
                        admin_id='$admin_id',
                        product_id='$product_id'";
        try{ 
            $this->conn->query("INSERT INTO $table SET $field_data");
            $this->conn->query("UPDATE web_order SET order_delivery_status=2 WHERE order_id=$order_id");
            return $order_id = $this->conn->insert_id; 
        }catch(Exception $e){
            return false;
        }
    }
    public function returnOrder($order_data,$table){
        $order_id           =   $order_data['order_id'];
        $member_id          =   $order_data['member_id'];
        $condition_id       =   $order_data['condition_id'];
        $other_condition    =   $order_data['other_condition'];
        $admin_id           =   $order_data['admin_id'];
        $product_id         =   $order_data['product_id'];
        
        if($condition_id == 'other'){
            $condition_id   =   0;
        }
        $field_data =   "order_id='$order_id',
                        condition_id='$condition_id',
                        other_condition='$other_condition',
                        member_id='$member_id',
                        admin_id='$admin_id',
                        product_id='$product_id'";
        try{ 
            $this->conn->query("INSERT INTO $table SET $field_data");
            $this->conn->query("UPDATE web_order SET order_delivery_status=3 WHERE order_id=$order_id");
            return $order_id = $this->conn->insert_id; 
        }catch(Exception $e){
            return false;
        }
    }

    public function deliverOrder($order_data,$table){
        $order_id           =   $order_data['order_id'];
        $member_id          =   $order_data['member_id']; 
        $admin_id           =   $order_data['admin_id'];
        $product_id         =   $order_data['product_id'];
      
        try{    
            if($this->checkPickUpExist($order_data)){ 
                $this->conn->query("UPDATE web_order SET order_delivery_status=5 WHERE order_id=$order_id");
                return $order_id = $this->conn->insert_id; 
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function createShipToken(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "email": "phpspider97@gmail.com",
            "password": "Admin123@#"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response,true)['token'];
    }

    public function checkPickUpExist($order_data){
        $ship_token = $this->createShipToken();
        $admin_id = $order_data['admin_id'];
        try{ 
            $query_data = "SELECT web_admin.*,web_country.name as admin_country_name,web_state.name as admin_state_name,web_city.name as admin_city_name FROM web_admin INNER JOIN web_country on web_admin.admin_shop_country=web_country.id INNER JOIN web_state on web_admin.admin_shop_state=web_state.id INNER JOIN web_city on web_admin.admin_shop_city=web_city.id WHERE web_admin.admin_id='$admin_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($row['is_pickup_registered'] == 1){
                    if($this->createPickUpOrder($order_data,$ship_token)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if($this->createPickUpAddress($row)){
                        $this->conn->query("UPDATE web_admin SET is_pickup_registered=1 WHERE admin_id='$admin_id'");
                        if($this->createPickUpOrder($order_data,$ship_token)){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            } 
        }catch(Exception $e){
            return false;
        }
    }

    public function createPickUpOrder($order_data,$ship_token){
        $order_id           =   $order_data['order_id'];
        $member_id          =   $order_data['member_id']; 
        $admin_id           =   $order_data['admin_id'];
        $product_id         =   $order_data['product_id'];
         
        $query_data = "SELECT web_order.*,web_admin.*,web_member.*,web_product.*,web_country.name as member_country_name,web_state.name as member_state_name,web_city.name as member_city_name FROM web_order LEFT JOIN web_admin on web_admin.admin_id=web_order.order_to INNER JOIN web_member on web_member.member_id=web_order.order_by INNER JOIN web_product on web_product.product_id=web_order.order_product_id INNER JOIN web_country on web_member.member_country=web_country.id INNER JOIN web_state on web_member.member_state=web_state.id INNER JOIN web_city on web_member.member_city=web_city.id WHERE web_order.order_id in ($order_id)";
        $result = $this->conn->query($query_data);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $return_data[] = $row;
            } 
        }else{ 
            $return_data = [];
        }
        
        $return_data = $return_data[0];
        if(!empty($return_data)){
            $admin_name = $return_data['admin_name'];

            $member_first_name = $return_data['member_first_name'];
            $member_last_name = $return_data['member_last_name'];
            $member_address_1 = $return_data['member_address_1'];
            $member_address_2 = $return_data['member_address_2'];
            $member_country = $return_data['member_country_name'];
            $member_city = $return_data['member_city_name'];
            $member_state = $return_data['member_state_name'];
            $member_zip_code = $return_data['member_zip_code'];
            $member_email = $return_data['member_email'];
            $member_phone = $return_data['member_phone'];

            $order_product_name = $return_data['order_product_name'];
            $product_sku = $return_data['product_sku'];
            $order_product_quantity = $return_data['order_product_quantity'];
            $order_product_price = $return_data['order_product_price'];
        }
        //pr($return_data);
        $order_id = 5000+$order_id;
        $pick_location = 5000+$admin_id;
        $current_data = date('Y-m-d H:i:s');

        $send_data = [
            "order_id" => "$order_id",
            "order_date" => $current_data,
            "pickup_location" => "$pick_location",
            "channel_id" => "",
            "comment" => "Reseller: $admin_name",
            "billing_customer_name" => $member_first_name,
            "billing_last_name" => $member_last_name,
            "billing_address" => $member_address_1,
            "billing_address_2" => $member_address_2,
            "billing_city" => $member_city,
            "billing_pincode" => $member_zip_code,
            "billing_state" => $member_state,
            "billing_country" => $member_country,
            "billing_email" => $member_email,
            "billing_phone" => $member_phone,
            "shipping_is_billing" => true,
            "shipping_customer_name" => $member_first_name .' '.$member_last_name,
            "shipping_last_name" => $member_last_name,
            "shipping_address" => $member_address_1,
            "shipping_address_2" => $member_address_2,
            "shipping_city" => $member_city,
            "shipping_pincode" => $member_zip_code,
            "shipping_country" => $member_country,
            "shipping_state" => $member_state,
            "shipping_email" => $member_email,
            "shipping_phone" => $member_phone,
            "order_items" => [
                [
                    "name" => $order_product_name,
                    "sku" => $product_sku,
                    "units" => $order_product_quantity,
                    "selling_price" => $order_product_price,
                    "discount" => "",
                    "tax" => "",
                    "hsn" => rand(10000,2000000)
                ]
            ],
            "payment_method" => "COD",
            "shipping_charges" => 0,
            "giftwrap_charges" => 0,
            "transaction_charges" => 0,
            "total_discount" => 0,
            "sub_total" => $order_product_price,
            "length" => 10,
            "breadth" => 15,
            "height" => 20,
            "weight" => 0.5
        ];
        //pr($send_data);
        $encode_send_data = json_encode($send_data);
     
        try{   
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $encode_send_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer $ship_token"
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $data = $response; 
            $this->conn->query("INSERT INTO web_delivery_track SET delivery_record='$data',order_id='$order_id'");
            return true;
 
        }catch(Exception $e){
            return false;
        }
    }

    public function createPickUpAddress($admin_data,$ship_token){
        $admin_id = $admin_data['admin_id'];
        $admin_name = $admin_data['admin_name'];
        $admin_email = $admin_data['admin_email'];
        $admin_shop_number = $admin_data['admin_shop_number'];
        $admin_shop_address = $admin_data['admin_shop_address'];
        $admin_shop_city = $admin_data['admin_city_name'];
        $admin_shop_state = $admin_data['admin_state_name'];
        $admin_shop_country = $admin_data['admin_country_name'];
        $admin_shop_zip_code = $admin_data['admin_shop_zip_code'];
         
        $pick_location = 5000+$admin_id;

        $send_data = [
            "pickup_location" => "$pick_location",
            "name" => $admin_name,
            "email" => $admin_email,
            "phone" => $admin_shop_number,
            "address" => $admin_shop_address,
            "address_2" => $admin_shop_address,
            "city" => $admin_shop_city,
            "state" => $admin_shop_state,
            "country" => $admin_shop_country,
            "pin_code" => $admin_shop_zip_code
        ];
        $encode_send_data = json_encode($send_data);
     
        try{  
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/settings/company/addpickup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "$encode_send_data",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $ship_token"
            ),
            )); 
            $response = curl_exec($curl);
            curl_close($curl); 
            return true; 
        }catch(Exception $e){
            return false;
        }
    }


    public function acceptOrder($order_data,$table){
        $order_id           =   $order_data['order_id'];
        $member_id          =   $order_data['member_id']; 
        $admin_id           =   $order_data['admin_id'];
        $product_id         =   $order_data['product_id'];
      
        try{  
            $this->conn->query("UPDATE web_order SET is_accept_defective_order=1 WHERE order_id=$order_id");
            return $order_id = $this->conn->insert_id; 
        }catch(Exception $e){
            return false;
        }
    }

    function __destruct(){
        $this->conn->close();
    }
} 