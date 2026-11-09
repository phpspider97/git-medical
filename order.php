<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Order.php");
    include_once(SITE_ROOT_ADMIN	.   "/classes/Contact.php"); 
        
    $contact_obj = NEW Contact(); 
    $encryption_obj = NEW encryption();
    $class_obj = NEW Order();
     
    $a_all_data	=	$class_obj->getAllData($_SESSION['admin_id'],DATABASE_TABLE_PREFIX.'order');  
    $contact_obj->updateAllNoReadData(" WHERE order_to=".$_SESSION['admin_id'],DATABASE_TABLE_PREFIX.'order');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script> 
    function acceptDefectiveOrder(order_data){  
      let is_accept_check = $('.is_accept_check').is(":checked")
      if(is_accept_check === false){
          alert('Please check defective order checkbox.')
          return
      }else{    
        $('#submit-spin').show();
      }
      let send_data	=	{
        order_data : order_data,
      }
      $.ajax({
        type:'POST',
        url:'<?= SITE_URL_ADMIN;?>/ajax/is-accept-order.php',
        data:send_data,
        success:function(response){ 
            if(response != ''){
                alert('Your accept defective order status updated successfully. Courier person will contact you as soon as possible.')
                window.location.href = "<?= SITE_URL_ADMIN;?>/order.php";
            }
        }
      });
	} 

	function deliverOrder(order_data){  
      let is_deliver_check = $('.is_deliver_check').is(":checked")
      if(is_deliver_check === false){
          alert('Please check is order delivery checkbox.')
          return
      }else{    
        $('#submit-spin').show();
      }
      let send_data	=	{
        order_data : order_data,
      }
      $.ajax({
        type:'POST',
        url:'<?= SITE_URL_ADMIN;?>/ajax/delivered-order.php',
        data:send_data,
        success:function(response){  
            if(response != ''){
                alert('Your order delivered status updated successfully. Courier person will contact you as soon as possible.')
                window.location.href = "<?= SITE_URL_ADMIN;?>/order.php";
            }
        }
      });
	} 
</script>
<div class="content-wrapper">
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ORDER LIST</h5>
                        <?php if(isset($_SESSION['notify_message'])){ ?>
                        <div class="notification-div alert alert-success p-2">
                            <?= $_SESSION['notify_message']; ?>
                        </div>
                        <?php unset($_SESSION['notify_message']); }?>
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                            <tr> 
                                <th>Order By</th>
                                <th>Order Image</th>
                                <th>Order Product</th>
                                <th>Order Date</th>
                                <th>Quantity</th>
                                <th>Order Status</th>
                                <th>Order Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php      
                                if(!empty($a_all_data)){
                                    $count = 0; 
                                    foreach($a_all_data as $data_key=>$data_value){ 
                                        $count++;
                                        $a_order_informaton = [];
                                        if($count>500){ continue; }
                                        $order_id = $data_value['order_id'];
                                        $order_status = $data_value['order_status'];
                                        $order_by = $data_value['order_by'];
                                        $order_product_name = wordwrap($data_value['order_product_name'],25,"<br>\n"); 
                                        $order_product_quantity = $data_value['order_product_quantity'];
                                        $order_product_price = $data_value['order_product_price'];
                                        $order_product_image = $data_value['order_product_image'];
                                        $member_name = $data_value['member_first_name'].' '.$data_value['member_last_name'];
                                        $member_email = $data_value['member_email'];
                                        $member_phone = $data_value['member_phone'];
                                        $member_address = $data_value['member_address_1'];
                                        $created_at = $data_value['created_at'];
                                        $product_variation_name = $data_value['order_variation_name'];
                                        $product_attribute_name = $data_value['order_attribute_name'];
                                        $is_accept_defective_order = $data_value['is_accept_defective_order'];
                                        
                                        $variation_detail   =   '';
                                        if(!empty($product_variation_name) && !empty($product_attribute_name)){
                                            $variation_detail   =   "<br/><b> $product_attribute_name - ( $product_variation_name )</b>";
                                        }

                                        if(empty($order_product_image)){
                                            $order_product_image = NO_IMAGE_URL;
                                        }

                                        $order_delivery_status =    $data_value['order_delivery_status'];
                                        $is_cod                =    $data_value['is_cod'];
                                        $payment_type          =   (empty($is_cod))?'online':'COD';
                                        if($order_delivery_status == 1){
                                            $background_color   =   'bg-success';
                                            $display_button     =   'none'; 
                                            $order_delivery_status  = 'delivered';
                                            $display_accept_button  = 'none';
                                        }elseif($order_delivery_status == 2){
                                            $background_color   =   'bg-danger';
                                            $display_button     =   'none'; 
                                            $order_delivery_status  = 'cancel';
                                            $display_accept_button  = 'block';
                                        }elseif($order_delivery_status == 3){
                                            $background_color   =   'bg-warning';
                                            $display_button     =   'none'; 
                                            $order_delivery_status  = 'return';
                                            $display_accept_button  = 'block';
                                        }elseif($order_delivery_status == 4){
                                            $background_color   =   'bg-info';
                                            $display_button     =   'block'; 
                                            $order_delivery_status  = 'pending';
                                            $display_accept_button  = 'none';
                                        }else{ 
                                            $background_color   =   'bg-primary';
                                            $display_button     =   'none'; 
                                            $order_delivery_status  = 'processing';
                                            $display_accept_button  = 'none';
                                        }

                                        $accept_text  =   '';
                                        if(!empty($is_accept_defective_order)){
                                            $accept_text  =   "(You accept <b>$order_delivery_status</b> order request.)";
                                            $display_accept_button  = 'none';
                                        }
            
                                        $a_order_informaton['order_id'] = $data_value['order_id'];
                                        $a_order_informaton['member_id'] = $data_value['order_by'];
                                        $a_order_informaton['admin_id'] = $data_value['order_to'];
                                        $a_order_informaton['product_id'] = $data_value['order_product_id'];
                                        $a_order_informaton = json_encode($a_order_informaton);

                                        $encrypted_order_id = $encryption_obj->encode($order_id);
                                ?> 
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#exampleModal<?= $count; ?>">
                                        <u><?= $member_name; ?></u>
                                    </a>
                                </td>
                                <td><img src="<?= $order_product_image; ?>" style="width:40px;height:40px;"/></td>
                                <td><?= $order_product_name; ?> <?= $variation_detail; ?></td> 
                                <td><?= $created_at; ?></td>
                                <td><?= $order_product_quantity; ?></td>
                                <td class="text-center"> <?= ucWords($order_delivery_status); ?> <br /> <?= $payment_type; ?> (<?= $order_status; ?>)</td>
                                <td>&#8377;<?= $order_product_price; ?></td>
                                <td>&#8377;<?= $order_product_quantity*$order_product_price; ?></td> 
                                <td class="text-center">
                                    <a href="<?= SITE_URL_ADMIN;?>/print-invoice.php?print_order_id=<?= $encrypted_order_id; ?>" target="_blank">
                                        <i class="fa-solid fa-file-invoice"></i>
                                    </a>
                                </td>  
                            </tr>
                            <div class="modal fade" id="exampleModal<?= $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg text-dark" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Buyer Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">
                                                        Buyer Name :
                                                    </div>
                                                    <div class="col-md-7">
                                                        <?= $member_name; ?>
                                                    </div>
                                                    <hr />
                                                    <div class="col-md-5 font-weight-bold">
                                                        Buyer Phone :
                                                    </div>
                                                    <div class="col-md-7">
                                                        <?= $member_phone; ?>
                                                    </div>
                                                    <hr />
                                                    <div class="col-md-5 font-weight-bold">
                                                        Buyer Email :
                                                    </div>
                                                    <div class="col-md-7">
                                                        <?= $member_email; ?>
                                                    </div>
                                                    <hr />
                                                    <div class="col-md-5 font-weight-bold">
                                                        Buyer Address :
                                                    </div>
                                                    <div class="col-md-7">
                                                        <?= $member_address; ?>
                                                    </div> 
                                                    <hr />
                                                    <div class="col-md-5 font-weight-bold">
                                                        Order Delivery Status :
                                                    </div>
                                                    <div class="col-md-7">
                                                        <b><?= ucWords($order_delivery_status); ?></b> <?= $accept_text; ?>
                                                    </div> 
                                                    <hr /> 
                                                    <div class="col-md-5 font-weight-bold" style="display:<?= $display_accept_button; ?>">
                                                        <input type="checkbox" name="is_accept_defective_order" value="1" id="group1" class="ml-5 is_accept_check"> 
                                                    </div>
                                                    <div class="col-md-7" style="display:<?= $display_accept_button; ?>">
                                                    <label for="group1" class="text-dark">Is Accept (<?= ucWords($order_delivery_status); ?>) Order</lable>
                                                    </div> 
                                                    <hr /> 
                                                    <div class="col-md-5 font-weight-bold <?= $background_color; ?> p-1" style="display:<?= $display_button; ?>">
                                                        <input type="checkbox" name="order_delivery_status" value="1" id="group2" class="ml-5 is_deliver_check"> 
                                                    </div> 
                                                    <div class="col-md-7 text-dark <?= $background_color; ?> p-1" style="display:<?= $display_button; ?>"> 
                                                        <label for="group2" class="text-dark ml-2">Is order Delivered?</label>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success submit_order_delivery_status" data-dismiss="modal" style="display:<?= $display_accept_button; ?>" onClick='acceptDefectiveOrder(<?= $a_order_informaton; ?>)'>
                                            Accept
                                            </button> 
                                            <button type="button" class="btn btn-success submit_order_delivery_status" data-dismiss="modal" style="display:<?= $display_button; ?>" onClick='deliverOrder(<?= $a_order_informaton; ?>)'>
                                            Delivered
                                            </button> 
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            Close
                                            </button> 
                                        </div>
                                        </div>
                                    </div>
                                </div>  
                            <?php } }else{ ?>
                                <tr class="text-center">
                                    <td colspan='9'>No Order.</td>
                                </tr>
                                <?php } ?>
            
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="overlay toggle-menu"></div> 
    </div> 
</div>  
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>