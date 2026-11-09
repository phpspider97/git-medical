<?php
  include("root.php");
  include(SITE_ROOT	.	"/includes/authentication_top.php");
  include(SITE_ROOT	.	"/classes/Login_registration.php");

  $login_obj = NEW Login();

  if(isset($_POST['create_account'])){
    //$random_password = "FS_".rand(1000,100000);
    $_POST['member_password'] = md5($_POST['member_password']);
    unset($_POST['create_account']);
    $is_inserted = $login_obj->registartion($_POST,'lab_member');
    if(!empty($is_inserted)){
      $notify_message = "Registration successful. Please check email for login.";
      $notify_type = "success";
    }else{
      $notify_message = "Some server error.";
      $notify_type = "danger";
    }
    include("notify_me.php");
    ob_clean();				
    header("Location: ".SITE_URL."/edit_profile.php");
    exit();
  }
?>
<script>
$(document).ready(function()
{
$('#pwd').keyup(function(){
    if($('#pwd').val()){
        $('#strength_message').show()
        $('#password_msg').show()
        $('#strength_message').html(checkStrength($('#pwd').val()))
        
        var error = "Password must use a combination " + 
      "of these:<br />I. Atleast 1 upper case letters (A – Z)" + 
      "<br />II. Lower case letters (a – z)<br />III." + 
      " Atleast 1 number (0 – 9)<br />IV.Atleast 1 " + 
      " non-alphanumeric symbol (e.g. @ ‘$%£!’) <br />IV. Minimum 6 character";
      
      $('#password_msg').html(error)
      
    }else{
         $('#strength_message').hide()
         $('#password_msg').html('')
    }
}) 
function checkStrength(password){
    var strength = 0
    if (password.length < 6) { 
        $('#strength_message').removeClass()
        $('#strength_message').addClass('alert alert-danger')
        return 'Too short' 
    }
    
    if (password.length > 7) strength += 1
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    if (strength < 2 ){
        $('#strength_message').removeClass()
        $('#strength_message').addClass('alert alert-danger')
        return 'Weak'   
    }
    else if (strength == 2 ){
        $('#strength_message').removeClass()
        $('#strength_message').addClass('alert alert-warning') 
        $("#is_disabled").prop("disabled", null); 
        $('#password_msg').hide()
        return 'Good'  
    }else{
        $('#strength_message').removeClass()
        $('#strength_message').addClass('alert alert-success') 
         $("#is_disabled").prop("disabled", null);
        $('#password_msg').hide()
        return 'Strong'
    }
}
});
</script>
<section>         
  <div class="container-fluid p-0"> 
    <div class="row m-0">
      <div class="col-xl-6"><img class="bg-img-cover bg-center" src="https://cdn.pixabay.com/photo/2014/07/06/09/46/microscope-385364_960_720.jpg" alt="The Coder Job"></div>
      <div class="col-xl-6 p-0"> 
        <div class="login-card">
          <form class="theme-form login-form" method="POST" action="">
            <h4>Create your account</h4>
            <h6>Enter your personal details to create account</h6>
            <div class="form-group">
              <label>Your Name</label>
              <div class="small-group">
                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                  <input class="form-control" type="text" required="" name="member_first_name" placeholder="First Name">
                </div>
                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                  <input class="form-control" type="text" required="" name="member_last_name" placeholder="Last Name">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                <input class="form-control" type="email" required="" name="member_email" placeholder="Test@gmail.com">
              </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <input class="form-control" type="password" name="member_password" required="" id="pwd" placeholder="*********">
                <div class="show-hide"><span class="show"></span></div>
              </div> 
                <div id="strength_message" style="width:100%;height:auto;margin-top:10px;"></div>
                <div id="password_msg" class="text-danger"></div>
            </div>
            <!-- <div class="form-group">
              <div class="checkbox">
                <input id="checkbox1" type="checkbox" name="is_agree">
                <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy                   </span></label>
              </div>
            </div> -->
            <div class="form-group">
              <button name="create_account" class="btn btn-primary btn-block" type="submit" id="is_disabled" disabled>Create Account</button>
            </div>
            <div class="login-social-title">                
              <h5>Sign in with</h5>
            </div>
            <!--<div class="form-group">-->
            <!--  <ul class="login-social">-->
            <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>-->
            <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a></li>-->
            <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a></li>-->
            <!--    <li><a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram">                  </i></a></li>-->
            <!--  </ul>-->
            <!--</div>-->
            <p>Already have an account?<a class="ms-2" href="<?= SITE_URL;?>/login.php">Sign in</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  include(SITE_ROOT	.	"/includes/authentication_bottom.php");
?>   