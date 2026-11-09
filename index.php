<?php
	  include("root.php");
	  include(SITE_ROOT_ADMIN	.	"/includes/top.php"); 
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php"); 
    include(SITE_ROOT_ADMIN	.   "/classes/Report.php"); 
    include(SITE_ROOT_ADMIN	.   "/classes/Admin.php"); 
    include(SITE_ROOT_ADMIN	.   "/classes/Order.php"); 
 
    $encryption_obj = NEW Encryption();  
    $report_obj = NEW Report();  
    $admin_obj = NEW Admin();  
    $order_obj = NEW Order();  
 
    $admin_id = $_SESSION['admin_id'];
   
    $total_field_view	=	$admin_obj->totalFieldAdded($admin_id,DATABASE_TABLE_PREFIX.'field'); 
    $total_report_view	=	$report_obj->totalReportView($admin_id,DATABASE_TABLE_PREFIX.'patient'); 
    $total_report_share_view	=	$report_obj->totalReportShareView($admin_id,DATABASE_TABLE_PREFIX.'patient'); 

    //$a_order_data	  =	$order_obj->graphRepresentation($admin_id,DATABASE_TABLE_PREFIX.'order');
    $a_order_data	  =	[];
    $a_report_data	=	$report_obj->reportUploaded($admin_id,DATABASE_TABLE_PREFIX.'report'); 
    $a_order_data	=	$report_obj->reportView($admin_id,DATABASE_TABLE_PREFIX.'patient'); 
    $total_report_data	=	$report_obj->getAllReportData($admin_id,'lab_patient',LIMIT_DATA); 

    $total_report_upload_month_wise = '';
    if(!empty($a_report_data)){
      $total_report_upload_month_wise = []; 
      foreach($a_report_data as $report_data){
        $selected_month = $report_data['selected_month'];
        $total_report_upload = $report_data['total_report_upload'];

        @$total_report_upload_month_wise[$selected_month]	=	$total_report_upload;
      }
      for($month = 1; $month < 13; $month++){
        if(!isset($total_report_upload_month_wise[$month])){
          $total_report_upload_month_wise[$month] = 0;
        } 
      }
      ksort($total_report_upload_month_wise);
      $total_report_upload_month_wise = implode(',',$total_report_upload_month_wise);
    }
    $total_order_month_wise = '';
    if(!empty($a_order_data)){
      $total_order_month_wise = []; 
      foreach($a_order_data as $order_data){
        $selected_month = $order_data['selected_month'];
        $order_report_quantity = $order_data['total_report_view'];

        @$total_order_month_wise[$selected_month]	+=	$order_report_quantity;
      }
      for($month = 1; $month < 13; $month++){
        if(!isset($total_order_month_wise[$month])){
          $total_order_month_wise[$month] = 0;
        } 
      }
      ksort($total_order_month_wise);
      $total_order_month_wise = implode(',',$total_order_month_wise);
    } 
    
    $show_chart = true;
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
                window.location.href = "<?= SITE_URL_ADMIN;?>";
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
                window.location.href = "<?= SITE_URL_ADMIN;?>";
            }
        }
      });
	} 
  </script>
  <div class="content-wrapper">
  <div class="container-fluid">
  <!--Start Dashboard Content-->

	<div class="card mt-3">
      <div class="card-content">
      <div class="row row-group m-0"> 
            
            <div class="col-12 col-lg-6 col-xl-6 front-notification-div">
              <a href="<?= SITE_URL_ADMIN;?>/edit-profile.php">
                <div class="card-body">
                  <h5 class="text-white mb-0"><i class="fa-solid fa-user-pen"></i> <span class="float-right"><i class="fa fa-info"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Edit Profile  
                    <span class="float-right"> <i class="fa-regular fa-hand-pointer"></i></span>
                  </p>
                </div>
              </a>
            </div> 
            <div class="col-12 col-lg-6 col-xl-6 front-notification-div">
              <a href="<?= SITE_URL_ADMIN;?>/add-field.php">
                <div class="card-body">
                  <h5 class="text-white mb-0"><i class="fa-solid fa-database"></i> <span class="float-right"><i class="fa fa-info"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                    <p class="mb-0 text-white small-font">
                      Add Field <span class="float-right"><i class="fa-regular fa-hand-pointer"></i></span>
                    </p>
                </div>
              </a>
            </div>
            <hr />
            
            <div class="col-12 col-lg-6 col-xl-6 front-notification-div">
              <a href="<?= SITE_URL_ADMIN;?>/add-report.php">
                <div class="card-body">
                  <h5 class="text-white mb-0"><i class="fa-solid fa-flask"></i> <span class="float-right"><i class="fa fa-info"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Add Report (<span style="color:yellow;"><?= count($total_report_data); ?></span>)
                    <span class="float-right"> <i class="fa-regular fa-hand-pointer"></i></span>
                  </p>
                </div>
              </a>
            </div> 

            <div class="col-12 col-lg-6 col-xl-6 front-notification-div">
              <a href="<?= SITE_URL_ADMIN;?>/add-setting.php">
                <div class="card-body">
                  <h5 class="text-white mb-0"><i class="fa-solid fa-gear"></i> <span class="float-right"><i class="fa fa-info"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Manage Report
                  <span class="float-right"> <i class="fa-regular fa-hand-pointer"></i></span>
                  </p>
                </div>
              </a>
            </div> 
        </div>
      </div>
  </div>  
	  
	<div class="row">
     <div class="col-12 col-lg-12 col-xl-12">
	    <div class="card">
		 <div class="card-header">REPORT DETAIL
		   <div class="card-action">
			 <div class="dropdown d-none">
			 <a href="<?= SITE_URL_ADMIN;?>/javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
			  <i class="icon-options"></i>
			 </a>
				<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="<?= SITE_URL_ADMIN;?>/javascript:void();">Action</a>
				<a class="dropdown-item" href="<?= SITE_URL_ADMIN;?>/javascript:void();">Another action</a>
				<a class="dropdown-item" href="<?= SITE_URL_ADMIN;?>/javascript:void();">Something else here</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?= SITE_URL_ADMIN;?>/javascript:void();">Separated link</a>
			   </div>
			  </div>
		   </div>
		 </div>
		 <div class="card-body">
		    <ul class="list-inline">
			  <li class="list-inline-item"><i class="fa fa-circle mr-2 text-warning"></i>Report Added</li>
			  <li class="list-inline-item"><i class="fa fa-circle mr-2 text-success"></i>Report Views</li>
			</ul>
			<div class="chart-container-1">
			  <canvas id="chart1"></canvas>
        <!-- <div id="container"></div> -->
			</div>
		 </div>
		 
		 <div class="row m-0 row-group text-center border-top border-light-3">
		   <div class="col-12 col-lg-4">
		     <div class="p-3">
		       <h5 class="mb-0"><?= $total_field_view; ?></h5>
			   <small class="mb-0">Field Added <span> <i class="fa fa-arrow-up"></i></span></small>
		     </div>
		   </div>
		   <div class="col-12 col-lg-4">
		     <div class="p-3">
		       <h5 class="mb-0"><?= $total_report_view; ?></h5>
			   <small class="mb-0">Report Visitor <span> <i class="fa fa-arrow-up"></i></span></small>
		     </div>
		   </div>
		   <div class="col-12 col-lg-4">
		     <div class="p-3">
		       <h5 class="mb-0"><?= $total_report_share_view; ?></h5>
			   <small class="mb-0">Total Share <span> <i class="fa fa-arrow-up"></i></span></small>
		     </div>
		   </div>
		 </div>
		 
		</div>
	 </div>
 
	</div>
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
		
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="<?= SITE_URL_ADMIN;?>/javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
   
<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>    