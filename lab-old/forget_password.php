<?php
  include("root.php");
  include(SITE_ROOT	.	"/includes/authentication_top.php");
  include(SITE_ROOT	.	"/classes/Login_registration.php");

  $login_obj = NEW Login();

  if(isset($_POST['reset_password'])){
    unset($_POST['reset_password']);
    $is_exist = $login_obj->checkUserExist($_POST,'blog_member');
    if(!empty($is_exist)){
      $notify_message = "Password send in your submitted email!!";
      $notify_type = "success";
    }else{
      $notify_message = "This email is not in our database.";
      $notify_type = "danger";
    }
    include("notify_me.php");
  }
?>
     

<section>         
  <div class="container-fluid p-0"> 
    <div class="row m-0">
      <div class="col-12 p-0">    
        <div class="login-card">              
          <div class="login-main"> 
            <form class="theme-form login-form" method="POST" action="">
              <h4 class="mb-3">Reset Your Password</h4>

              <div class="form-group">
                <label>Your registered email</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                  <input class="form-control" type="email" required="" name="member_email" placeholder="your_email@gmail.com">
                </div>
              </div>
              <div class="form-group">
                <button name="reset_password" class="btn btn-primary btn-block" type="submit">Submit</button>
              </div>
              <p>Already have an password?<a class="ms-2" href="<?= SITE_URL;?>/login.php">Sign in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  include(SITE_ROOT	.	"/includes/authentication_bottom.php");
?>  