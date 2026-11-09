<?php
	ob_start();
	session_start();
	error_reporting(E_ALL);
	error_reporting(1);
	ini_set("display_errors",0);

    if(strstr($_SERVER['HTTP_HOST'],'testreport.in')){
		define("SITE_ROOT"		,	$_SERVER['DOCUMENT_ROOT'].'/lab');
		define("SITE_URL"		,	"http://testreport.in/lab");
		
		define("IMAGE_ROOT_PATH"	,	SITE_ROOT."/files/images");
		define("IMAGE_URL_PATH"		,	SITE_URL."/files/images");

		define("FILE_ROOT_PATH"	,	SITE_ROOT."/files");
		define("FILE_URL_PATH"		,	SITE_URL."/files");
		
	}else{
		define("SITE_ROOT"		,	$_SERVER['DOCUMENT_ROOT']."/collections/sharma_lab");
		define("SITE_URL"		,	"http://localhost:8880/collections/sharma_lab");

		define("IMAGE_ROOT_PATH"	,	SITE_ROOT."/files/images");
		define("IMAGE_URL_PATH"		,	SITE_URL."/files/images");

		define("FILE_ROOT_PATH"	,	SITE_ROOT."/files");
		define("FILE_URL_PATH"		,	SITE_URL."/files");
	}
	include(SITE_ROOT	.	"/classes/Connection.php");
	
	// For encryption and decryption
	$ciphering      =   "AES-128-CTR"; 
	$iv_length      =    openssl_cipher_iv_length($ciphering); 
	$options        =    0; 
	$encryption_iv  =   '1234567891011121'; 
	$encryption_key =   "NeelmaniTestReport";
	$decryption_key =   "NeelmaniTestReport"; 
	$decryption_iv  =   '1234567891011121'; 
?>