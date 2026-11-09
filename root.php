<?php 
	ob_start();
	session_start();  
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0); 

	require_once __DIR__ . '/security/license.php';


	if(strstr($_SERVER['HTTP_HOST'],'testreport.in')){
		DEFINE("SITE_ROOT"		    ,	$_SERVER['DOCUMENT_ROOT']);
		DEFINE("SITE_URL"		    ,	"http://testreport.in"); 

		DEFINE("SITE_ROOT_ADMIN"	,	$_SERVER['DOCUMENT_ROOT']);
		DEFINE("SITE_URL_ADMIN"		,	"http://testreport.in");
		DEFINE("SITE_URL_ADMIN_GOOGLE"		,	"https://testreport.in");
		   
		DEFINE("FILE_ROOT_PATH"	    ,	$_SERVER['DOCUMENT_ROOT']."/files");
		DEFINE("FILE_URL_PATH"		,	"http://testreport.in/files"); 

		DEFINE("SITE_ROOT_GOOGLE"   ,	'/home/d8ouyzxnuef4/public_html/apkishops.com');

		//Database configuration
			DEFINE("DATABASE_USERNAME"	,	"lab_report_user");
			DEFINE("DATABASE_PASSWORD"	,	"Admin123@#");
			DEFINE("DATABASE_NAME"		,	"lab_report");
			DEFINE("DATABASE_TABLE_PREFIX"	,	"lab_");
		//Database configuration
		
	}else{
		DEFINE("SITE_ROOT"		    ,	$_SERVER['DOCUMENT_ROOT'].'/testreport.in');
		DEFINE("SITE_URL"		    ,	"http://localhost:8888/testreport.in");

		DEFINE("SITE_ROOT_ADMIN"	,	$_SERVER['DOCUMENT_ROOT']."/testreport.in");
		DEFINE("SITE_URL_ADMIN"		,	"http://localhost:8888/testreport.in"); 

		DEFINE("FILE_ROOT_PATH"	    ,	$_SERVER['DOCUMENT_ROOT']."/testreport.in/files");
		DEFINE("FILE_URL_PATH"		,	"http://localhost:8888/testreport.in/files"); 

		DEFINE("SITE_ROOT_GOOGLE"   ,	$_SERVER['DOCUMENT_ROOT'].'/ecommerse');

		DEFINE("SITE_URL_ADMIN_GOOGLE"		,	"http://localhost:8888/testreport.in");

		//Database configuration
			DEFINE("DATABASE_USERNAME"	,	"root");
			DEFINE("DATABASE_PASSWORD"	,	"root");
			DEFINE("DATABASE_NAME"		,	"lab_report_bains");
			DEFINE("DATABASE_TABLE_PREFIX"	,	"lab_");
		//Database configuration

	}  

	//Mail configuration
		DEFINE("MAIL_USERNAME"	,	"neelbhardwaj97@gmail.com");
		DEFINE("MAIL_PASSWORD"	,	"howguf3eysvsdzk332uw");
		DEFINE("MAIL_SET_FROM"	,	"neelbhardwaj97@gmail.com");
		DEFINE("MAIL_BCC"		,	"neelbhardwaj97@gmail.com");
	//Mail configuration

	include(SITE_ROOT_ADMIN		.	"/classes/Connection.php");
	include(SITE_ROOT			.	"/includes/common-functions.php");  
	date_default_timezone_set('Asia/Calcutta');

 
	// For admin section
	include(SITE_ROOT_ADMIN	.	"/classes/Setting.php");
	$setting_obj = NEW Setting();
	$a_get_data = $setting_obj->getData(1);
	
	if(!empty($a_get_data)){
		$is_active          = $a_get_data['is_active'];
		$get_setting_body_color = 0; 
		$get_setting_menu_color = 0;  
		$get_setting_menu_nav_color = 0;  
		$get_setting_card_color = 0;  
		$get_setting_text_color = 0;
		$get_data_image = '';
		$setting_website_name = 'Default Name';
		
		if(!empty($is_active)){
			$get_setting_body_color     = $a_get_data['setting_body_color']; 
			$get_setting_menu_color     = $a_get_data['setting_menu_color']; 
			$get_setting_menu_nav_color = $a_get_data['setting_menu_nav_color']; 
			$get_setting_card_color     = $a_get_data['setting_card_color']; 
			$get_setting_text_color     = $a_get_data['setting_text_color'];
			$setting_website_name       = $a_get_data['setting_website_name'];
			$get_data_image             = $a_get_data['data_image'];
		}else{ 
			$get_setting_body_color     = '#b2bec3';  
			$get_setting_menu_color     = '#474b4f'; 
			$get_setting_menu_nav_color = '#474b4f'; 
			$get_setting_card_color     = 'rgba(0,0,0,.3)';  
			$get_setting_text_color     = '#fdfcfc'; 
		} 
		
		if(!empty($get_data_image)){
			$website_logo = $get_data_image;  
		}else{
			$website_logo = FILE_URL_PATH.'/default_logo/logo.png';
		}
	}else{
		$website_logo = FILE_URL_PATH.'/default_logo/logo.png';
	}
	$website_logo = FILE_URL_PATH.'/default_logo/logo.png';
	// For admin section

	//Website configuration
		DEFINE("NO_IMAGE_URL"		,	"https://cdn.pixabay.com/photo/2013/04/01/21/30/photo-99135_960_720.png");
		DEFINE("WEBSITE_LOGO"		,	$website_logo);
		DEFINE("WEBSITE_ADMIN_LOGO"	,	$website_logo);
		DEFINE("WEBSITE_MAIL_LOGO"	,	$website_logo);
		DEFINE("WEBSITE_NAME"		,	$setting_website_name); 
		DEFINE("BREADCRUM_IMAGE"	,	"https://cdn.pixabay.com/photo/2011/06/29/15/27/wood-8196_960_720.jpg");
		DEFINE("LIMIT_DATA"	,	1000000000000);
	//Website configuration

	//Google configuration
		DEFINE("CLIENT_ID"		,	"666569476015-r2dq8a32cla63322l9tjo7igi5n80o7jhvpj.apps.googleusercontent.com");
		DEFINE("CLIENT_SECRET"	,	"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lU"); 
		DEFINE("REDIRECT_URI"	,	SITE_URL_ADMIN_GOOGLE."/login.php"); 
	//Google configuration
?> 