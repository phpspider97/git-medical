<?php
  include("root.php");
  include(SITE_ROOT	.	"/includes/authentication_top.php");
  include(SITE_ROOT	.	"/classes/Login_registration.php");

  $login_obj = NEW Login(); 
   $remember_member_email = '';
  $remember_member_password = '';
  if(isset($_POST['login_account'])){
    unset($_POST['login_account']);
    $is_login = $login_obj->login($_POST,'company_member');
    if(!empty($is_login)){
      ob_clean();				
      header("Location: ".SITE_URL."/");
      exit();	
    }else{
      $notify_message = "Your credential doesn't match.";
      $notify_type = "danger";
    }
    include("notify_me.php");
  }
  if(isset($_COOKIE['remember_member_email'])){  
        $remember_member_email = $_COOKIE['remember_member_email'];
        $remember_member_password = $_COOKIE['remember_member_password'];
    }
?>
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6"><img class="bg-img-cover bg-center" src="https://cdn.pixabay.com/photo/2014/07/06/09/46/microscope-385364_960_720.jpg" alt="The Coder Job"></div>
      <div class="col-xl-6 p-0">    
        <div class="login-card">
          <form class="theme-form login-form" method="POST" action="">
            <h4>Login</h4>
            <h6>Welcome back !! Log in to your account.</h6>
            <div class="form-group">
              <label>Email Address</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <input class="form-control" type="email" required="" name="member_email" placeholder="Test@gmail.com" value="<?= $remember_member_email; ?>">
              </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <input class="form-control" type="password" name="member_password" required="" placeholder="*********" value="<?= $remember_member_password; ?>"> 
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <input id="checkbox1" type="checkbox" name="remember_me" value="1">
                <label class="text-muted" for="checkbox1">Remember password</label>
              </div><a class="link" href="<?= SITE_URL;?>/forget_password.php">Forgot password?</a>
            </div>
            <div class="form-group">
              <button name="login_account" class="btn btn-primary btn-block" type="submit">Sign in</button>
            </div>
            <div class="login-social-title">                
              <h5>Don't have account?</h5>
            </div>
            <!--<div class="form-group">-->
            <!--  <ul class="login-social">-->
            <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>-->
            <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a></li>-->
            <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a></li>-->
            <!--    <li><a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram">                  </i></a></li>-->
            <!--  </ul>-->
            <!--</div>-->
            <p><a class="ms-2" href="<?= SITE_URL;?>/register.php">Create Account</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  include(SITE_ROOT	.	"/includes/authentication_bottom.php");
?>  