<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=no;user-scalable=0;"/>
    <meta name="description" content="SHARMA LAB">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?= SITE_URL;?>/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= SITE_URL;?>/assets/images/favicon.png" type="image/x-icon">
    <title><?= $_SESSION['member_first_name'] .' '. $_SESSION['member_last_name'] .' | '. $_SESSION['member_name'];?></title>
    <!-- Google font-->
    
    <script>
        localStorage.setItem("Console/Mode", "collapse");
        localStorage.setItem("page-wrapper", "horizontal-wrapper");
        localStorage.setItem("NavigationWidth", 240);
        localStorage.setItem("page-body-wrapper", "horizontal-menu"); 
    </script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/prism.css">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/whether-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/dropzone.css">

    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/datatables.css">

    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/bootstrap.css">
    <!-- App css-->
     
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/style.css">
    
    <link id="color" rel="stylesheet" href="<?= SITE_URL;?>/assets/css/color-2.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL;?>/assets/css/responsive.css">  
    
    <script src="<?= SITE_URL;?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="<?= SITE_URL;?>/assets/js/notify/notify-script.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    
    <script> 
        $(document).ready(function(){
          $("#field_form").on("submit", function(){ 
            $("#pageloader").fadeIn();
          });
        }); 
    </script>
    <style>
    #float{
    position: relative;
    -webkit-animation: floatBubble 2s infinite;
        -webkit-animation-direction:alternate;
     }
    @-webkit-keyframes floatBubble{
     from{
        top:0;
        -webkit-animation-timing-function: ease-in;
      }
       to {
          top: 10px;
          -webkit-animation-timing-function: ease-out;
       }
    }
    #pageloader{
      background: rgba( 191, 93, 10, 0.8 );
      display: none;
      height: 100%;
      position: fixed;
      width: 100%;
      z-index: 9999;
    }
    
    #pageloader img{
      left: 50%;
      margin-left: -32px;
      margin-top: -32px;
      position: absolute;
      top: 50%;
    }
    </style>
  </head>
  <?php
    //include(SITE_ROOT	.	"/classes/Dashboard.php");
    //$top_content = NEW Dashboard();
    $total_like = 0;
    $total_share = 0;
    $total_comment = 0;
    $combine_share = [];
    $total_like = $combine_share['total_like'];
    $total_share = $combine_share['total_share'];
    $total_comment = $combine_share['total_comment'];
  ?>
  <body class="dark-only loading">
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    
    <div id="pageloader">
       <img src="https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif" alt="processing..." style="height:100px;width:100px"/>
    </div>

    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <!--<div class="logo-wrapper"><a href="<?= SITE_URL;?>"><img src="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_960_720.png" style='width:100%;height:35px;'></a></div>-->
            <!--<div class="dark-logo-wrapper"><a href="<?= SITE_URL;?>"><img src="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_960_720.png" style='width:100%;height:35px;'></a></div>-->
            <!--<div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>-->
            <div class="dark-logo-wrapper d-none d-md-block">
                <a href="<?= SITE_URL;?>">
              <img class="img-fluid rotate linear infinite" src="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_960_720.png" alt="" style="width:85%;height:35px;" id="float">
              </a>
            </div>
            <div class="dark-logo-wrapper d-md-none">
                <a href="<?= SITE_URL;?>">
              <img class="img-fluid rotate linear infinite" src="https://cdn.pixabay.com/photo/2013/07/13/01/07/chemistry-155121_960_720.png" alt="" style="width:40px;height:45px;" id="float">
              </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
          </div>
          <div class="left-menu-header col">
            <ul>
              <!--<li>-->
              <!--  <form class="form-inline search-form">-->
              <!--    <div class="search-bg"><i class="fa fa-search"></i>-->
              <!--      <input class="form-control-plaintext" placeholder="Search here.....">-->
              <!--    </div>-->
              <!--  </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>-->
              <!--</li>-->
            </ul>
          </div>
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <!-- <li class="onhover-dropdown">
                <div class="bookmark-box"><i data-feather="star"></i></div>
                <div class="bookmark-dropdown onhover-show-div">
                  <div class="form-group mb-0">
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                      <input class="form-control" type="text" placeholder="Search for bookmark...">
                    </div>
                  </div>
                  <ul class="m-t-5">
                    <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="inbox"></i>Email<span class="pull-right"><i data-feather="star"></i></span></li>
                  </ul>
                </div>
              </li> -->
              <!-- <li class="onhover-dropdown">
                <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                <ul class="notification-dropdown onhover-show-div">
                  <li>
                    <p class="f-w-700 mb-0">You have 1 Notifications<span class="pull-right badge badge-primary badge-pill">4</span></p>
                  </li>
                  <li class="noti-primary">
                    <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span>
                      <div class="media-body">
                        <p>No Notification </p><span>10 minutes ago</span>
                      </div>
                    </div>
                  </li> 
                </ul>
              </li>
              <li>
                <div class="mode"><i class="fa fa-moon-o"></i></div>
              </li>
              <li class="onhover-dropdown"><i data-feather="message-square"></i>
                <ul class="chat-dropdown onhover-show-div">
                  <li>
                    <div class="media"><img class="img-fluid rounded-circle me-3" src="<?= SITE_URL;?>/assets/images/user/4.jpg" alt="">
                      <div class="media-body"><span>Ain Chavez</span>
                        <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                      </div>
                      <p class="f-12">32 mins ago</p>
                    </div>
                  </li>
                   
                  <li class="text-center"> <a class="f-w-700" href="javascript:void(0)">See All</a></li>
                </ul>
              </li> -->
              <li class="onhover-dropdown p-0">
                <button class="btn btn-primary-light" type="button"><a href="<?= SITE_URL;?>/log_out.php"><i data-feather="log-out"></i>Log out</a></button>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a>
              <?php if(!isset($_SESSION['member_image_path']) && empty($_SESSION['member_image_path']) ){?>
              <div class=" d-none d-md-block">
                <img class="img-90 rounded-circle" src="<?= SITE_URL;?>/assets/images/dashboard/1.png" alt="" style="border-radius:200px;height:85px;width:80px;">
                </div>
                <img class="img-90 rounded-circle  d-md-none" src="<?= SITE_URL;?>/assets/images/dashboard/1.png" alt="" style="border-radius:200px;height:40px;width:40px;">
              <?php } else {  ?>
              <div class=" d-none d-md-block">
                <img class="img-90 rounded-circle" src="<?= $_SESSION['member_image_path'];?>" alt="" style="border-radius:200px;height:85px;width:80px;">
                </div>
                <img class="img-90 rounded-circle d-md-none" src="<?= $_SESSION['member_image_path'];?>" alt="" style="border-radius:200px;height:40px;width:40px;">
              <?php } ?>
            <div class="badge-bottom mt-6"><span class="badge badge-primary">You Pic</span></div><a href="<?= SITE_URL;?>/edit_profile.php">
              <h6 class="mt-3 f-14 f-w-600"><?= $_SESSION['member_name']; ?></h6></a>
            <p class="mb-0 font-roboto">Welcome in admin area </p>
            <!-- <ul>
              <li><span><span class="counter"><?= $total_like??0; ?></span></span>
                <p><a href="#">Like</a></p>
              </li>
              <li><span><span class="counter"><?= $total_share??0; ?></span></span>
                <p><a href="#">Share</a></p>
              </li>
              <li><span><span class="counter"><?= $total_comment??0; ?></span></span>
                <p><a href="#">Comments </a></p>
              </li>
            </ul> -->
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                        <h6>General Info</h6>
                        </div>
                    </li>
                   
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?= SITE_URL;?>">
                          <i data-feather="airplay"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?= SITE_URL;?>/edit_profile.php">
                          <i data-feather="user"></i><span>Edit Profile</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?= SITE_URL;?>/change_password.php">
                          <i data-feather="database"></i><span>Change Password</span>
                        </a>
                    </li>
                    <!-- <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>
                        <ul class="nav-submenu menu-content">
                        <li><a href="index.html">Default</a></li>
                        <li><a href="dashboard-02.html">Ecommerce</a></li>
                        </ul>
                    </li> -->
                   
                    
                    <li class="sidebar-main-title">
                        <div>
                        <h6>Report Data</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?= SITE_URL;?>/add_field.php">
                        <i data-feather="layers"></i><span>Add Field</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?= SITE_URL;?>/add_report.php">
                        <i data-feather="layers"></i><span>Add Report</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?= SITE_URL;?>/manage_report.php">
                            <i data-feather="corner-down-right"></i><span>Manage Report</span>
                        </a>
                    </li>

                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>