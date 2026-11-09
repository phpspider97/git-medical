<?php 
    include("root.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Login.php");
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");

    $login_obj = NEW Login();
    $encryption_obj = NEW encryption(); 
    
    //require_once SITE_ROOT_GOOGLE.'/library/google/vendor/autoload.php';
      //http://localhost:8880/collections/lab/login.php
      //echo REDIRECT_URI; die;
    // create Client Request to access Google API 
    // $client = new Google_Client();
    // $client->setClientId(CLIENT_ID);
    // $client->setClientSecret(CLIENT_SECRET);
    // $client->setRedirectUri(REDIRECT_URI);
    // $client->addScope("email");
    // $client->addScope("profile");
    
    // authenticate code from Google OAuth Flow 
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
        
        // get profile info 
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        //pr($google_account_info);
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
    
        $_POST['admin_name'] = $name; 
        $_POST['admin_email'] = $email; 
        $is_login = $login_obj->socialLogin($_POST,'lab_admin');
        if(!empty($is_login)){ 
          ob_clean();				
          header("Location: ".SITE_URL_ADMIN."/");
          exit();	
        }else{ 
          $notify_message = "Some technical issue login with social account.";
          $notify_type = "danger";
        }   
    }  
    
    $notify_message = '';
    if(isset($_POST['data_submit'])){
      unset($_POST['data_submit']);
      $login_detail = $login_obj->login($_POST,'lab_admin');
      if($login_detail['status'] == 200){
          $_SESSION['is_super_admin'] = $login_detail['msg']['is_super']; 
          $_SESSION['admin_id'] = $login_detail['msg']['admin_id']; 
          $_SESSION['admin_name'] = $login_detail['msg']['admin_name']; 
          $_SESSION['admin_email'] = $login_detail['msg']['admin_email'];
          $_SESSION['admin_shop_number'] = $login_detail['msg']['admin_shop_number'];
          $_SESSION['is_complete'] = $login_detail['msg']['is_complete']; 
          $encrypted_admin_id	= $encryption_obj->encode($login_detail['msg']['admin_id']);
          $_SESSION['encrypt_admin_id'] = $encrypted_admin_id;
          
          
          if(!empty($_POST['remember_me'])){
              $expire_time = 1*30*24*3600; // 1 month
              setcookie('remember_member_email', $_POST['admin_email'], time() + $expire_time, "/");
              setcookie('remember_member_password', $_POST['admin_password'], time() + $expire_time, "/");
          }else{
            setcookie("remember_member_email","",time()-3600);
            setcookie("remember_member_password","",time()-3600);
          }
          ob_clean();				
          if(empty($login_detail['msg']['is_super'])){
            header("Location: ".SITE_URL_ADMIN."/");
          }else{
            header("Location: ".SITE_URL_ADMIN."/super-index.php");
          }
          exit();	
      }else{ 
          $_SESSION['notify_message'] = $login_detail['msg'];
          $_SESSION['notify_type'] = "danger";
          ob_clean();				
          header("Location: ".SITE_URL_ADMIN."/login.php");
          exit();
      } 
    
      // if(!empty($login_detail['admin_id'])){
      //   $_SESSION['is_super_admin'] = $login_detail['is_super']; 
      //   $_SESSION['admin_id'] = $login_detail['admin_id']; 
      //   $_SESSION['admin_name'] = $login_detail['admin_name']; 
      //   $_SESSION['admin_email'] = $login_detail['admin_email']; 
      //   $_SESSION['is_complete'] = $login_detail['is_complete']; 
      //   $encrypted_admin_id	= $encryption_obj->encode($login_detail['admin_id']);
      //   $_SESSION['encrypt_admin_id'] = $encrypted_admin_id;
        
      //   if(!empty($_POST['remember_me'])){
      //       $expire_time = 1*30*24*3600; // 1 month
      //       setcookie('remember_member_email', $_POST['admin_email'], time() + $expire_time, "/");
      //       setcookie('remember_member_password', $_POST['admin_password'], time() + $expire_time, "/");
      //   }else{
      //     setcookie("remember_member_email","",time()-3600);
      //     setcookie("remember_member_password","",time()-3600);
      //   }
      //   ob_clean();				
      //   if(empty($login_detail['is_super'])){
      //     header("Location: ".SITE_URL_ADMIN."/");
      //   }else{
      //     header("Location: ".SITE_URL_ADMIN."/super-index.php");
      //   }
      //   exit();	
      // }else{
      //   $notify_message = "Your credential doesn't match.";
      //   $notify_type = "danger";
      // } 
    }
    $admin_email      =   '';
    $admin_password   =   '';
    $is_checked       =   ''; 
    if(isset($_COOKIE['remember_member_email'])){
        $admin_email      =   $_COOKIE['remember_member_email'];
        $admin_password   =   $_COOKIE['remember_member_password']; 
        $is_checked       =   'checked'; 
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Test Report || Add Report Online.</title>
        <meta name="description" content="Apki shops || Sell product online and make happy clients.">
        <meta name="keywords" content="Shopping, Online Shop, Cheap Price, Best Product">
        
        <meta property="og:url" content="https://apkishops.com/admin/login.php">
        <meta property="og:title" content="Apki shops login area || Add Your Shop Online.">
        <meta property="og:description" content="Apki shops || Sell product online and make happy clients.">
        <meta property="og:type" content="website">
        <meta property="og:image" content="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_1280.png">
        <meta property="og:image:secure_url" content="https://apkishops.com/">
        
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        
        <!-- loader-->
        <!--<link href="<?= SITE_URL_ADMIN;?>/assets/css/pace.min.css" rel="stylesheet"/>-->
        <!--<script src="assets/js/pace.min.js"></script>-->
        <!--favicon-->
        <link rel="icon" href="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_1280.png" type="image/x-icon">
        <!-- Bootstrap core CSS-->
        <link href="<?= SITE_URL_ADMIN;?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- animate CSS-->
        <link href="<?= SITE_URL_ADMIN;?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
        <!-- Icons CSS-->
        <link href="<?= SITE_URL_ADMIN;?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Style-->
        <link href="<?= SITE_URL_ADMIN;?>/assets/css/app-style.css" rel="stylesheet"/>
    </head>
    <body class="bg-theme bg-theme111" style="
    
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
            <div class="loader-wrapper">
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <!-- <br /><br /><br /> -->
            <div class="card card-authentication1 mx-auto my-5" style="
            
            background: #134E5E;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #71B280, #134E5E);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #71B280, #134E5E); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


border-top:4px solid orange;

">
                <div class="card-body">
                    <div class="card-content p-2">
                        <div class="text-center">
                            <img src="<?= WEBSITE_ADMIN_LOGO; ?>" style="width:60%;z-index:1000;position:relative;" class="rotate1" alt="<?= WEBSITE_NAME; ?>">
                        </div>
                        <div class="card-title text-uppercase text-center py-3" style="font-size:27px;"> 
                            <img src="./files/default_logo/board.png" style="width:140px;height:136px;margin-top:-4px;z-index:100">    
                        </div>
                        <?php if(isset($_SESSION['notify_message'])){ ?>
                        <div class="notification-div alert alert-<?= $_SESSION['notify_type']; ?> p-2">
                            <?= $_SESSION['notify_message'];?>
                        </div>
                        <?php unset($_SESSION['notify_message']); } ?>
                        <form method="POST" action="">
                            <div class="form-group d-none-1">
                                <label for="exampleInputUsername" class="sr-only">Email</label>
                                <div class="position-relative has-icon-right">
                                    <input type="text" id="exampleInputUsername" class="form-control input-shadow" placeholder="Enter Username" name="admin_email" value="<?= $admin_email; ?>" required>
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-none-1">
                                <label for="exampleInputPassword" class="sr-only">Password</label>
                                <div class="position-relative has-icon-right">
                                    <input type="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Enter Password" name="admin_password" value="<?= $admin_password; ?>" required>
                                    <div class="form-control-position">
                                        <i class="icon-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6 d-none-1">
                                    <div class="icheck-material-white">
                                        <input type="checkbox" id="user-checkbox" name="remember_me" value="1" <?= $is_checked; ?>/>
                                        <label for="user-checkbox">Remember me</label>
                                    </div>
                                </div>
                                <div class="form-group col-6 text-right d-none-1">
                                    <a href="<?= SITE_URL_ADMIN;?>/reset.php">Reset Password</a>
                                </div>
                            </div>
                            <button type="submit" name="data_submit" class="btn btn-light btn-block d-none-1">Sign In</button>
                            <!-- <div class="text-center mt-3">Sign In With</div> -->
                            <div class="form-row mt-2 mb-5">
                                <!-- <div class="form-group mb-0 col-6">
                                    <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
                                    </div> --> 
                                <div class="form-group mb-0 col-12 text-right mt-3">
                                    <a href="<?= $client->createAuthUrl(); ?>">
                                    <button type="button" class="btn btn-light btn-block" style="font-size:20px;border:1px dashed white;">
                                        <!--<i class="fa fa-google text-warning"></i> -->
                                        <img src="https://cdn.pixabay.com/photo/2015/12/11/11/43/google-1088004_960_720.png" style="height:35px;width:35px;"> Login
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-center py-3 d-none-1">
                    <p class="text-dark mb-0">Do not have an account? <a href="<?= SITE_URL_ADMIN;?>/register.php"> Sign Up</a></p>
                </div>
            </div>
            <!--Start Back To Top Button-->
            <a href="<?= SITE_URL_ADMIN;?>/javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
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
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- sidebar-menu js -->
        <script src="assets/js/sidebar-menu.js"></script>
        <!-- Custom scripts -->
        <script src="assets/js/app-script.js"></script>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script>
            jQuery(function ($) {
                  $('a').click(function(e){ 
                      $('#submit-spin').show(); 
                      if($(this).hasClass("hide-loader")){
                          setTimeout(function myStopFunction(){
                              $('#submit-spin').hide();
                          }, 600);
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
    </body>
</html>