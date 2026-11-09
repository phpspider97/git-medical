<!DOCTYPE html>
<html>
<head>
<title>Apki Shops Vendor Registration</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">
    @import url("http://assets.commerce.nikecloud.com/ncss/0.17/dotcom/desktop/css/ncss.en-us.min.css");
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
    ul{list-style: outside; margin-left: 20px; padding-left: 0;}
    a { text-decoration: underline; }
    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {
        .body-header {
            padding: 0 0 !important;
        } 
        
        .body-text {
            padding:  30px 0 !important;
        }
        
        .footer-content{
        	padding: 17px 40px 19px 28px !important;
        }
        
        /* ALLOWS FOR FLUID TABLES */
        .wrapper {
          width: 100% !important;
        	max-width: 100% !important;
        }
        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo{
        	padding: 30px 28px !important;
        }
        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }
        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }
        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }
        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }
        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }
        .no-padding {
          padding: 0 !important;
        }
        .section-padding {
          padding: 34px 28px 50px 28px !important;
        }
        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }
        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }
    }
    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
    .a[href] {
        color: #000000 !important;
    }
    a {
        color: #000000 !important;
        text-decoration:none;
    }
</style>
</head>
<?php 
    $website_logo     =   'https://cdn.pixabay.com/photo/2016/12/20/05/24/store-1919713_960_720.png';
    $admin_email      =   'phpspider97@gmail.com';
    $admin_password   =   'Admin123@#';
    $site_url         =   'https://apkishops.com';

    if(isset($_POST) && !empty($_POST)){ 
    $website_logo     =   $_POST['website_logo'];
    $admin_email      =   $_POST['admin_email'];
    $admin_password   =   $_POST['admin_password'];
    $site_url         =   $_POST['site_url'];
    }

    $background_color = "background: #283c86;background: -webkit-linear-gradient(to right, #45a247, #283c86);background: linear-gradient(to right, #45a247, #283c86); ";
    $button_color = 'background:#218c74;border:1px solid black'; 
    $bottom_background_color = 'background: #283c86;background: -webkit-linear-gradient(to right, #45a247, #283c86);background: linear-gradient(to right, #45a247, #283c86);border-top:2px dotted black';
?>
<body style="margin: 0 !important; padding: 0 !important;">
    
<!-- HIDDEN PREHEADER TEXT -->
<div style="display: block; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    This is where the email preview text should go. 
</div>

<!-- HEADER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#ffffff" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="wrapper">
                <tr>
                    <td align="left" valign="top" style=" height:35px; border-bottom:3px solid; border-bottom-color:#000000; padding-left:50px; padding-top:36px; padding-bottom:36px;" class="logo">
                        <img alt="Apki Shops Logo" src="<?= $website_logo; ?>" width="175" height="34" style="display:block;font-size:18px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; line-height:20px; border=0"/>
                    
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 0px 0px 25px 0px;" class="section-padding">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <!-- BODY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="body-header" align="left" style="color:#161616;font-style:normal;font-size:24px;font-weight:normal;font-family:'Nike TG','Helvetica Neue',Helvetica,Arial,sans-serif;font-stretch:normal;letter-spacing:.6px;line-height:24px;margin:0px;text-transform:uppercase;padding: 32px 50px 0px 50px; background-color:#ffffff;" class="padding">Thanks for registration!!</td>
                                        </tr>
                                        <tr>
                                            <td class="body-text" align="left" style="font-size:14px;color:#161616;line-height:24px;letter-spacing:0px;font-family:Helvetica; padding: 30px 50px 30px 50px;" class="padding">
                                                Email : <b><?= $admin_email; ?></b><br />
                                                Password : <b><?= $admin_password; ?></b><br /><br />
                                                <a href="<?= $site_url; ?>/login.php" style="background-color:#597eb6;color:white !important;padding:8px;text-decoration:none;">
                                                  <b>Click to login</b>
                                                </a>
                                                <br><br>
                                                Please do not reply to this email.  
                                            </td>
                                        </tr>    
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
            <tr>
            <td align="center" valign="top" width="500">
            <![endif]-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:#ffffff;height:96px;border-top:2px solid;border-top-color:#dddddd;max-width: 600px;" class="responsive-table">
                <tr>
                    <td class="footer-content" align="left" style="background-color:#ffffff;height:96px;border-top:2px solid;border-top-color:#dddddd; width:241px; padding: 17px 50px 0px 50px; font-family:Helvetica; font-size:10px;line-height:20px;letter-spacing:0;color:#8d8d8d;">
                        Please contact us if you have any questions: 
                        <br>
                            <strong>INDIA:&nbsp;</strong> <a style="color:#8d8d8d;text-decoration:underline;" href="mailto:apkishops@gmail.com">apkishops@gmail.com</a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
</body>
</html>