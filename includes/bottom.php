<!--Start footer-->
<footer class="footer">
      <div class="container">
        <div class="text-center">
          Admin Area <br /> Develop by <a href="https://thecoderjob.com/" target="_blank">www.thecoderjob.com</a>
        </div>
      </div>
    </footer>
	<!--End footer--> 
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
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
   <!-- <script src="<?= SITE_URL_ADMIN;?>/assets/js/jquery.min.js"></script> -->
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/popper.min.js"></script>
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/bootstrap.min.js"></script>
	
 <!-- simplebar js -->
  <script src="<?= SITE_URL_ADMIN;?>/assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <!-- <script src="<?= SITE_URL_ADMIN;?>/assets/js/jquery.loading-indicator.js"></script> -->
  <!-- Custom scripts -->
  <script src="<?= SITE_URL_ADMIN;?>/assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="<?= SITE_URL_ADMIN;?>/assets/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <!-- <script src="<?= SITE_URL_ADMIN;?>/assets/js/index.js"></script> -->
</body>
</html> 
<?php if($show_chart){ ?>
<script>
	var ctx = document.getElementById('chart1')?.getContext('2d'); 
     var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec"],
         datasets: [{
           label: 'Report Added',
           data: [<?= $total_report_upload_month_wise; ?>],
           backgroundColor: 'rgba(255, 255, 255, 0.45)',
           borderColor: "#f39c12",
           pointRadius :"0",
           borderWidth: 1
         }, 
         {
           label: 'Report Views',
           data: [<?= $total_order_month_wise; ?>],
           backgroundColor: "rgba(255, 255, 255, 0.25)",
           borderColor: "#16a085",
           pointRadius :"0",
           borderWidth: 3
         }
        ]
       },
     options: {
       maintainAspectRatio: false,
       legend: {
         display: false,
         labels: {
         fontColor: '#ddd',  
         boxWidth:40
         }
       },
       tooltips: {
         displayColors:false
       },	
       scales: {
         xAxes: [{
         ticks: {
           beginAtZero:true,
           fontColor: '#ddd'
         },
         gridLines: {
           display: true ,
           color: "rgba(221, 221, 221, 0.08)"
         },
         }],
          yAxes: [{
         ticks: {
           beginAtZero:true,
           fontColor: '#ddd'
         },
         gridLines: {
           display: true ,
           color: "rgba(221, 221, 221, 0.08)"
         },
         }]
        }
      }
     }); 
</script>	 
<?php } ?>
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
  filevalidation = (exact_height,exact_width) => {
      const file_data = document.getElementById('file-upload-size');
        if(exact_height != undefined){
          var img = new Image();
          img.onload = function(){
              var height = img.height;
              var width = img.width; 
              if(exact_height != height && exact_width != width){
                alert(`File upload dimentions are : ${exact_height} x ${exact_width}`);
                $('#file-upload-size').val("");
              } 
          } 
          img.src = window.URL.createObjectURL(file_data.files[0]);
        }
    
      if (file_data.files.length > 0) {
          for (var i = 0; i <= file_data.files.length - 1; i++) { 
              const fsize = file_data.files.item(i).size;
              const file = Math.round((fsize / 1024));
              if (file > 1048) {
                  alert("File size is too large, please select a file size less than 1 MB");
                  $('#file-upload-size').val("");
              }
          }
      }
  } 
  userFilevalidation = (exact_height,exact_width) => {
      const file_data = document.getElementById('user-file-upload-size'); 
      if(exact_height != undefined){
        var img = new Image();
        img.onload = function(){
            var height = img.height;
            var width = img.width; 
            if(exact_height != height && exact_width != width){
               alert(`File upload dimentions are : ${exact_height} x ${exact_width}`);
               $('#user-file-upload-size').val("");
            } 
        } 
        img.src = window.URL.createObjectURL(file_data.files[0]);
      }
        
      if (file_data.files.length > 0) {
          for (var i = 0; i <= file_data.files.length - 1; i++) { 
              const fsize = file_data.files.item(i).size;
              const file = Math.round((fsize / 1024));
              if (file > 1048) {
                  alert("File size is too large, please select a file size less than 1 MB");
                  $('#user-file-upload-size').val("");
              }
          }
      }
  } 
  jQuery(function ($) {
        // $('#submit-spin').show(); 
        // setTimeout(function(){ 
        //   $('#submit-spin').hide();
        // },3000);

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

  jQuery(function ($) {
      $('.body-color').on('mousemove',function(e){ 
          let body_color = $(this).val();
          $('.custom-body-color').removeClass('bg-theme1');
          $('.custom-body-color').css("background-color", body_color);
      })
      $('.menu-color').on('change',function(e){ 
          let body_color = $(this).val(); 
          $('.sidebar-menu').css("background-color", body_color);
      })
      $('.menu-nav-color').on('change',function(e){ 
          let body_color = $(this).val(); 
          $('.navbar').css("background-color", body_color);
      })
      $('.card-color').on('change',function(e){ 
          let body_color = $(this).val(); 
          $('.card').css("background-color", body_color);
      })
      $('.text-color').on('change',function(e){ 
          let body_color = $(this).val(); 
          $('.custom-body-color, label, span, i, div, a, button').css("color", body_color);
      })
    
    //   <?php if(!empty($get_setting_body_color)){ ?>
    //     $('.custom-body-color').removeClass('bg-theme1');
    //     $('.custom-body-color').css("background-color", "<?= $get_setting_body_color;?>");
    //   <?php } ?>
    //   <?php if(!empty($get_setting_menu_color)){ ?> 
    //     $('.sidebar-menu').css("background-color", "<?= $get_setting_menu_color;?>");
    //   <?php } ?>
    //   <?php if(!empty($get_setting_menu_nav_color)){ ?> 
    //     $('.navbar').css("background-color", "<?= $get_setting_menu_nav_color;?>");
    //   <?php } ?>
    //   <?php if(!empty($get_setting_card_color)){ ?> 
    //     $('.card').css("background-color", "<?= $get_setting_card_color;?>"); 
    //   <?php } ?>
    //   <?php if(!empty($get_setting_text_color)){ ?> 
    //     $('.custom-body-color, label, span, i, div, a, button').css("color", "<?= $get_setting_text_color;?>");
    //   <?php } ?> 
  });

  
</script>