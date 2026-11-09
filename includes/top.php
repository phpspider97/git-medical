<?php
if(!isset($_SESSION['admin_id'])){
  ob_clean();				
  header("Location: ".SITE_URL_ADMIN."/login.php");
  exit();	
}else{
  $current_url = explode('/',$_SERVER['REQUEST_URI']);
  $current_url = $current_url[count($current_url)-1];

  if($current_url != 'edit-profile.php'){
    if($_SESSION['is_complete'] != 1){
      ob_clean();				
      header("Location: ".SITE_URL_ADMIN."/edit-profile.php");
      exit();	
    }
  }
}
$show_chart = false; 
$is_super_admin = 0;
if(isset($_SESSION['is_super_admin'])){
  $is_super_admin = $_SESSION['is_super_admin'];
} 

?>
<style>
  .card{
    border:1px dashed white !important;  
  }
  </style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?= WEBSITE_NAME; ?> || Admin Panel</title>
  <!-- loader-->
  <!-- <link href="<?= SITE_URL_ADMIN;?>/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/pace.min.js"></script> -->
  <!--favicon--> 
  <link rel="icon" href="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_1280.png" type="image/x-icon">
  <!-- Vector CSS -->
  <!-- <link href="<?= SITE_URL_ADMIN;?>/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/> -->
  <!-- simplebar CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?= SITE_URL_ADMIN;?>/assets/css/app-style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head> 
<body class="bg-theme bg-theme71 custom-body-color" style="

background: #44A08D;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #093637, #44A08D);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #093637, #44A08D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


">
 
<!-- Start wrapper-->
 <div id="wrapper">
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="<?= SITE_URL_ADMIN;?>">
        <img src="<?= $website_logo; ?>" class="logo-icon" alt="<?= WEBSITE_NAME; ?>" style="width:50%">
       <!-- <h5 class="logo-text">Apki Shops</h5> -->
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol"> 
      <li>&nbsp;</li>
      <li>
        <a href="<?= SITE_URL_ADMIN;?>/index.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <!-- <li>
        <a href="<?= SITE_URL;?>" target="_blank" class="hide-loader">
          <i class="zmdi zmdi-account-circle"></i> <span>View Front</span>
        </a>
      </li> -->
      <li>  
        <a href="<?= SITE_URL_ADMIN;?>/edit-profile.php">
          <i class="zmdi zmdi-face"></i> <span>Edit Profile <sub class="text-menu-title-custom">(Step 1)</sub></span>
        </a>
      </li> 
        <li>
          <a href="<?= SITE_URL_ADMIN;?>/add-field.php">
            <i class="zmdi zmdi-invert-colors"></i> <span>Add Field <sub class="text-menu-title-custom">(Step 2)</sub></span>
          </a>
        </li>
        <li data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven" id="accordion">
          <a href="#" class="hide-loader">
            <i class="fa-solid fa-caret-down"></i> <span>Report</span> 
          </a>
        </li> 
        <div id="collapseSeven" class="collapse sub-menu-custom show" aria-labelledby="headingOne" data-parent="#accordion"> 
          <li>
            <a href="<?= SITE_URL_ADMIN ?>/add-report.php">
              <i class="fa-regular fa-hand-point-right fa-beat-fade"></i> <span>Add Report <sub class="text-menu-title-custom">(Step 3)</sub></span>
            </a>
          </li> 
          <li>
            <a href="<?= SITE_URL_ADMIN ?>/manage-report.php">
              <i class="fa-regular fa-hand-point-right fa-beat-fade"></i> <span>Manage Report</span>
            </a>
          </li> 
        </div>
 
        <li class="sidebar-header">Optional Settings</li>
        <!-- <li>
            <a href="<?= SITE_URL_ADMIN;?>/add-banner.php">
              <i class="zmdi zmdi-chart-donut text-success"></i> <span>Add Banner</span>
            </a>
        </li>  -->
        <li> 
            <a href="<?= SITE_URL_ADMIN;?>/add-setting.php">
              <i class="zmdi zmdi-chart-donut text-info"></i> <span>Add Setting <sub class="text-menu-title-custom">(Optional)</sub></span>
            </a>
        </li>   
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu hide-loader hide-loader" href="<?= SITE_URL_ADMIN;?>/javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item d-none">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="<?= SITE_URL_ADMIN;?>/javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect notification" href="<?= SITE_URL_ADMIN;?>/contact.php" title="Contact Customer Detail">
        <i class="fa fa-phone rotate1"></i> 
        <?php if(!empty($total_contact_notification_data)){ ?>
          <span class="call-notification-badge"><?= $total_contact_notification_data; ?></span>
        <?php } ?>
      </a>
    </li>
    <li class="nav-item d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect notification" href="<?= SITE_URL_ADMIN;?>/newletter.php" title="News Letter Email Detail">
        <i class="fa fa-envelope-open-o rotate1"></i>
        <?php if(!empty($total_news_letter_notification_data)){ ?>
          <span class="notification-badge"><?= $total_news_letter_notification_data; ?></span>
        <?php } ?>
      </a>
    </li>
    <li class="nav-item d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect notification" href="<?= SITE_URL_ADMIN;?>/order.php" title="Order Detail">
      <i class="fa fa-bell-o rotate1"></i>
      <?php if(!empty($total_order_notification_data)){ ?>
          <span class="notification-badge"><?= $total_order_notification_data; ?></span>
      <?php } ?>
    </a>
    </li>
    <li class="nav-item dropdown-lg d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="<?= SITE_URL_ADMIN;?>/javascript:void();">
      <i class="fa fa-bell-o"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>  
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret hide-loader" data-toggle="dropdown" href="<?= SITE_URL_ADMIN;?>/">
        <span class="user-profile">
          <img src="https://cdn.pixabay.com/photo/2012/04/13/21/07/user-33638_960_720.png" class="img-circle" alt="<?= WEBSITE_NAME; ?>">
        </span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="<?= SITE_URL_ADMIN;?>/edit-profile.php">
           <div class="media">
             <!-- <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div> -->
            <div class="media-body">
            <h6 class="mt-2 user-title"> Welcome <?= $_SESSION['admin_name']; ?></h6> 
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li> 
        <li class="dropdown-item">
            <a href="<?= SITE_URL_ADMIN;?>/logout.php"><i class="icon-power mr-2"></i> Logout </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>