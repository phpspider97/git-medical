<?php
  include("root.php");
  if(!isset($_SESSION['member_id'])){
      ob_clean();				
      header("Location: ".SITE_URL."/login.php");
      exit();	
  }
  // Dashboard class in top
  include(SITE_ROOT	.	"/includes/top.php");
  include(SITE_ROOT	.	"/classes/Dashboard.php");
   $dashboard_content = NEW Dashboard();
   $dashboard_data = $dashboard_content->dashboardData($_SESSION['member_id']);
?>
<!-- Page Sidebar Ends-->
<br><br><br>
<div class="page-body mt-5">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>General</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= SITE_URL;?>">Home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                  </ol>
                </div>
                <!--<div class="col-sm-6">-->
                  <!-- Bookmark Start-->
                <!--  <div class="bookmark">-->
                <!--    <ul>-->
                <!--      <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>-->
                <!--      <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>-->
                <!--      <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>-->
                <!--      <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>-->
                <!--      <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>-->
                <!--        <form class="form-inline search-form">-->
                <!--          <div class="form-group form-control-search">-->
                <!--            <input type="text" placeholder="Search..">-->
                <!--          </div>-->
                <!--        </form>-->
                <!--      </li>-->
                <!--    </ul>-->
                <!--  </div>-->
                  <!-- Bookmark Ends-->
                <!--</div>-->
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
              <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="database"></i></div>
                      <div class="media-body"><span class="m-0">Report</span>
                        <h4 class="mb-0 counter"><?= $dashboard_data['total_patient']; ?></h4><i class="icon-bg" data-feather="database"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-xl-3 col-lg-3" onclick="location.href='<?= SITE_URL;?>/manage_report.php';" style="cursor:pointer">
                <div class="card o-hidden border-0">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                      <div class="media-body"><span class="m-0">View Report List</span>
                        <h4 class="mb-0 counter1">
                            -
                        <i class="icon-bg" data-feather="shopping-bag"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-xl-3 col-lg-3" onclick="location.href='<?= SITE_URL;?>/edit_profile.php';" style="cursor:pointer">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Edit Lab Profile</span>
                        <h4 class="mb-0 counter1">
                            -
                        </h4>
                        <i class="icon-bg" data-feather="edit"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-xl-3 col-lg-3" onclick="location.href='<?= SITE_URL;?>/add_field.php';" style="cursor:pointer">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="database"></i></div>
                      <div class="media-body"><span class="m-0">Add Field</span>
                        <h4 class="mb-0 counter1"> 
                           -
                        </h4>
                        <i class="icon-bg" data-feather="database"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
<?php
  include(SITE_ROOT	.	"/includes/bottom.php");
?>  