<?php 
  include("root.php");
  include(SITE_ROOT_ADMIN	.	"/classes/Admin.php");
  $admin_obj = NEW Admin();
  
  // authenticate code from Google OAuth Flow 
  if (isset($_GET['code'])) {
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      $client->setAccessToken($token['access_token']);
      
      // get profile info 
      $google_oauth = new Google_Service_Oauth2($client);
      $google_account_info = $google_oauth->userinfo->get();
      $email =  $google_account_info->email;
      $name =  $google_account_info->name;
  
      $_POST['admin_name'] = $name; 
      $_POST['admin_email'] = $email; 
      $is_login = $admin_obj->socialLogin($_POST,DATABASE_TABLE_PREFIX.'admin');
      if(!empty($is_login)){
        ob_clean();				
        header("Location: ".SITE_URL_ADMIN."/");
        exit();	
      }else{
        $notify_message = "Some technical issue login with social account.";
        $notify_type = "danger";
      }   
  }  
  
  $notify_message     =   '';
  $admin_name         =   '';
  $admin_email        =   '';
  $admin_shop_number  =   '';
  
  if(isset($_POST['data_submit'])){
    unset($_POST['data_submit']);
    $is_error     =   false;
    
    $password     =   $_POST['admin_password']; 
    $uppercase    =   preg_match('@[A-Z]@', $password);
    $lowercase    =   preg_match('@[a-z]@', $password);
    $number       =   preg_match('@[0-9]@', $password);
    $specialchars =   preg_match('@[^\w]@', $password);
  
    if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
        $_SESSION['notify_message'] =   "Your password is not strong.";
        $_SESSION['notify_type']    =   "danger";
        $admin_name                 =   $_POST['admin_name'];
        $admin_email                =   $_POST['admin_email']; 	
        $admin_shop_number          =   $_POST['admin_shop_number']; 	
        $is_error                   =   true;
    } 
    if(empty($_POST['is_agree'])){
        $_SESSION['notify_message'] =   "Please check the terms & conditions agreement.";
        $_SESSION['notify_type']    =   "danger";
        $admin_name                 =   $_POST['admin_name'];
        $admin_email                =   $_POST['admin_email'];
        $admin_shop_number          =   $_POST['admin_shop_number'];	
        $is_error                   =   true;
    } 
   
    if(empty($is_error)){
      $login_detail = $admin_obj->registartion($_POST,DATABASE_TABLE_PREFIX.'admin');
  
      if($login_detail['status'] == 200){
          $_SESSION['notify_message'] = $login_detail['msg'];
          $_SESSION['notify_type'] = "success";
          ob_clean();				
          header("Location: ".SITE_URL_ADMIN."/");
          exit();
      }else{
          $_SESSION['notify_message'] = $login_detail['msg'];
          $_SESSION['notify_type'] = "danger";
          $admin_name           =   $_POST['admin_name'];
          $admin_email          =   $_POST['admin_email'];
          $admin_shop_number    =   $_POST['admin_shop_number'];  
      }  
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
    <title>Registration Portal</title>
    <!-- loader-->
    <!-- <link href="<?= SITE_URL_ADMIN;?>/assets/css/pace.min.css" rel="stylesheet"/>
      <script src="<?= SITE_URL_ADMIN;?>/assets/js/pace.min.js"></script> -->
    <!--favicon-->
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
  <body class="bg-theme bg-theme7" style="
    background: #283c86;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #45a247, #283c86);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #45a247, #283c86); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  ">
    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
      <div class="loader-wrapper-outer">
        <div class="loader-wrapper-inner" >
          <div class="loader"></div>
        </div>
      </div>
    </div>
    <!-- end loader -->
    <!-- Start wrapper-->
    <div id="wrapper">
      <div class="card card-authentication1 mx-auto my-4">
        <div class="card-body">
          <div class="card-content p-2">
            <div class="text-center">
                <img src="<?= WEBSITE_ADMIN_LOGO; ?>" style="width:60%;z-index:1000;position:relative;" class="rotate1" alt="<?= WEBSITE_NAME; ?>">
            </div>
            <div class="card-title text-uppercase text-center py-3" style="font-size:27px;"> 
                <img src="./files/default_logo/board.png" style="width:140px;height:136px;margin-top:-4px;z-index:100">    
            </div> 
            <?php if(isset($_SESSION['notify_message'])){ ?>
            <div class="alert alert-<?= $_SESSION['notify_type']; ?> p-2">
              <?= $_SESSION['notify_message']; ?>
            </div>
            <?php unset($_SESSION['notify_message']); }?>
            <form method="POST" action="">
              <div class="form-group">
                <label for="exampleInputName" class="sr-only">Name</label>
                <div class="position-relative has-icon-right">
                  <input type="text" id="exampleInputName" name="admin_name" class="form-control input-shadow" placeholder="Enter Your Name" value="<?= $admin_name; ?>" required>
                  <div class="form-control-position">
                    <i class="icon-user"></i>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputName" class="sr-only">Mobile</label>
                <div class="position-relative has-icon-right">
                  <input type="number" id="exampleInputName" name="admin_shop_number" class="form-control input-shadow" placeholder="Enter Shop Number" value="<?= $admin_shop_number; ?>" required>
                  <div class="form-control-position">
                    <i class="icon-phone"></i>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmailId" class="sr-only">Email ID</label>
                <div class="position-relative has-icon-right">
                  <input type="email" id="exampleInputEmailId" name="admin_email" class="form-control input-shadow" placeholder="Enter Your Email ID" value="<?= $admin_email; ?>" required>
                  <div class="form-control-position">
                    <i class="icon-envelope-open"></i>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword" class="sr-only">Password</label>
                <div class="position-relative has-icon-right">
                  <input type="password" id="exampleInputPassword" name="admin_password" class="form-control input-shadow" placeholder="Choose Password" required>
                  <div class="form-control-position">
                    <i class="icon-lock"></i>
                  </div>
                  <span style="font-size:12px">Password must include <br /> - one upper case, <br /> - one special character, <br /> - one number <br /> -  At least 8 characters.
                </div>
              </div>
              <div class="form-group">
                <div class="icheck-material-white">
                  <input type="checkbox" id="user-checkbox" name="is_agree" value="1"/>
                  <label for="user-checkbox">I Agree With </label>
                  <a href="#" class="hide-loader" data-toggle="modal" data-target="#term_condition">Terms & Conditions</a>
                </div>
              </div>
              <button type="submit" name="data_submit" class="btn btn-light btn-block waves-effect waves-light">Sign Up</button>
              <!-- <div class="text-center mt-3">Sign Up With</div> -->
              <div class="form-row mt-2">
                <!-- <div class="form-group mb-0 col-6">
                  <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
                  </div> -->
                <div class="form-group mb-0 col-12 text-right d-none">
                  <!-- <a href="<?php //$client->createAuthUrl(); ?>">
                  <button type="button" class="btn btn-light btn-block">
                  <i class="fa fa-google"></i> Google
                  </button>
                  </a> -->
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card-footer text-center py-3">
          <p class="text-dark mb-0">
            Already have an account? <a href="login.php"> Sign In Here</a>
          </p>
        </div>
      </div>
      <!--Start Back To Top Button-->
      <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
      <!--End Back To Top Button-->
      <!--start color switcher-->
      <div class="right-sidebar d-none">
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
    </div>
    <!--wrapper-->
    <!-- Bootstrap core JavaScript-->
    <script src="<?= SITE_URL_ADMIN;?>/assets/js/jquery.min.js"></script>
    <script src="<?= SITE_URL_ADMIN;?>/assets/js/popper.min.js"></script>
    <script src="<?= SITE_URL_ADMIN;?>/assets/js/bootstrap.min.js"></script>
    <!-- sidebar-menu js -->
    <script src="<?= SITE_URL_ADMIN;?>/assets/js/sidebar-menu.js"></script>
    <!-- Custom scripts -->
    <script src="<?= SITE_URL_ADMIN;?>/assets/js/app-script.js"></script>
    <div class="modal fade" id="term_condition" tabindex="-1" role="dialog" aria-labelledby="term_condition" aria-hidden="true">
      <div class="modal-dialog modal-lg text-dark" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark" id="term_condition">Terms & Conditions</h5>
            <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12 modal-body" id="yt-player">
                  sdsdsd
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer"> 
            <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">
            Close
            </button> 
          </div>
        </div>
      </div>
    </div>
  </body>
  <style>
    #submit-spin {
          position:fixed;
          width:100%;
          left:0;right:0;top:0;bottom:0;
          background-color: rgba(255,255,255,0.7);
          z-index:9999;
          display:none;
      }

      @-webkit-keyframes spin {
          from {-webkit-transform:rotate(0deg);}
          to {-webkit-transform:rotate(360deg);}
      }

      @keyframes spin {
          from {transform:rotate(0deg);}
          to {transform:rotate(360deg);}
      }

      #submit-spin::after {
          content:'';
          display:block;
          position:absolute;
          left:48%;top:40%;
          width:40px;height:40px;
          border-style:solid;
          border-color:black;
          border-top-color:transparent;
          border-width: 4px;
          border-radius:50%;
          -webkit-animation: spin .8s linear infinite;
          animation: spin .8s linear infinite;
      }
  </style>
  <div id="submit-spin"></div>
  <script>
    jQuery(function ($) { 
          $('a').click(function(e){ 
              $('#submit-spin').show(); 
              if($(this).hasClass("hide-loader")){
                  setTimeout(function myStopFunction(){
                      $('#submit-spin').hide();
                  }, 200);
              }
          });
          $(':submit').click(function(e){
            $('#submit-spin').show(); 

            var fail   =   false; 
            $('form').find('select, textarea, input').each(function(){
                if(!$( this ).prop('required')){ 
                }else{
                    if(!$(this).val()){
                        fail  =   true; 
                    }
                }
            }); 
            if(fail){
                setTimeout(function myStopFunction(){
                    $('#submit-spin').hide();
                }, 600);
            }else{
                setTimeout(function myStopFunction(){
                    $('#submit-spin').hide(); 
                }, 60000);
            }
        });
    });
    
    setTimeout(function(){ 
        $('.notification-div').slideUp(400);
    },5000);
  </script>
</html>