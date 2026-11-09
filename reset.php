<?php 
  include("root.php"); 
  include(SITE_ROOT_ADMIN	.	"/classes/Login.php"); 
	$login_obj = NEW Login(); 
  
	if(isset($_POST['data_submit'])){
        unset($_POST['data_submit']); 
        $is_updated = $login_obj->forgetPasswordAdmin($_POST,DATABASE_TABLE_PREFIX.'admin');
        
        if(!empty($is_updated)){
            $_SESSION['notify_message'] = "Your credential changed successfully. Please check your enter email for new credential. <br /><br /> If not recieved with in 1-2 minute then also check spam section.";
            $_SESSION['notify_type'] = "success";
            ob_clean();	 
			      header("Location: ".SITE_URL_ADMIN."/reset.php");
            exit();
        }else{
            $_SESSION['notify_message'] = "Enter email not in our database or some technical issue.";
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/reset.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Reset password</title>
  <!-- loader-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/pace.min.js"></script>
  <link rel="icon" href="https://cdn.pixabay.com/photo/2016/12/20/05/24/store-1919713_960_720.png" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="height-100v d-flex align-items-center justify-content-center">
	<div class="card card-authentication1 mb-0">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="card-title text-uppercase pb-2">Reset Password</div>
		    <p class="pb-2">Please enter your email address. You will receive a new password via email.</p>
          <?php if(isset($_SESSION['notify_message'])){ ?>
						<div class="notification-div alert alert-<?= ($_SESSION['notify_type'] == 'success')?'success':'danger'?> p-2"><?= $_SESSION['notify_message']; ?></div>
					<?php unset($_SESSION['notify_message']); unset($_SESSION['notify_type']); }?>	
		    <form method="POST" action="">
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Email Address</label>
			   <div class="position-relative has-icon-right">
				  <input type="email" name="admin_email" id="exampleInputEmailAddress" class="form-control input-shadow" placeholder="Email Address" required />
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			 
			  <button type="submit" name="data_submit" class="btn btn-light btn-block mt-3">Reset Password</button>
			 </form>
		   </div>
		  </div>
		   <div class="card-footer text-center py-3">
		    <p class="text-dark mb-0">Return to the <a href="<?= SITE_URL_ADMIN;?>/login.php"> Sign In</a></p>
		  </div>
	     </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/jquery.min.js"></script>
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/popper.min.js"></script>
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/app-script.js"></script>
  
	
</body>
</html>
