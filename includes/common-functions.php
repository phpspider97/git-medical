<?php
	/* This function is used to change any kind of URL to a valid URL.*/
	function changeToValidURL($str)
	{
		$str	=	trim($str);
		$str	=	str_replace("'", '', $str);
		$str	=	str_replace('!', '', $str);
		$str	=	str_replace(':', '', $str);
		$str	=	str_replace('#', '', $str);
		$str	=	str_replace('.', '', $str);
		$str	=	str_replace(' - ', '-' , $str);
		$str	=	str_replace(' & ', '-' , $str);
		$str	=	str_replace(' / ', '-' , $str);
		$str	=	str_replace('/', '-' , $str);
		$str	=	str_replace(', ', '-' , $str);
		$str	=	str_replace(',', '-' , $str);
		$str	=	str_replace(' (', '-', $str);
		$str	=	str_replace(') ', '-', $str);
		$str	=	str_replace('  ', '-' , $str);
		$str	=	str_replace(' ', '-' , $str);
		$str	=	str_replace('(', '-', $str);
		$str	=	str_replace(')', '', $str);
		$str	=	str_replace("�", '', $str);
		$str	=	str_replace("�", '', $str);
		$str	=	str_replace("?", '', $str);
		$str	=	str_replace('"', '', $str);
		return strtolower($str);
	}
	//Function to remove special characters from the text
	function removedSpecialCharacters($str)
	{
		$str	=	str_replace("�","'",$str);
		$str	=	str_replace("�","<b>.</b>",$str);
		$str	=	str_replace("�","-",$str);
		$str	=	str_replace("�","...",$str);
		$str	=	str_replace('�','"',$str);
		$str	=	str_replace('�','"',$str); 
		$str	=	str_replace('�','-',$str);
		$str	=	str_replace('�','-',$str);
		$str	=	removeExtendedAscii($str);
		return $str;
	}

	function removeExtendedAscii($string)
	{
		$string = preg_replace('/[^(\x20-\x7F)]*/','', $string);
		return $string;
	}

	/*Function to return duration in min and secs*/
	function getTime($time)
	{
		$mins = 0; 
		$secs = 0;
		if($time >= 60)
		{
			$mins = floor($time/60);
			$secs = $time%60; 
		}
		else
		{
			$secs= $time; 
		}
		if(strlen($mins) < 2)
		{
			$mins	=	"0".$mins;
		}
		if(strlen($secs) < 2)
		{
			$secs	=	"0".$secs;
		}
		$text	=	$mins.":".$secs;

		return $text;
	}

	//Function show Date Format
	function showDate($date)
	{
		if($date != '0000-00-00')
		{
			return date("M d, Y",strtotime($date));
		}
		else
		{
			return false;
		}
	}

	//Preventing SQL Injection with MySQL and PHP
	function cleanQuery($string)
	{
		if(get_magic_quotes_gpc())  // prevents duplicate backslashes
		{
			$string = stripslashes($string);
		}
		if (phpversion() >= '4.3.0')
		{
			$string = mysql_real_escape_string($string);
		}
		else
		{
			$string = mysql_escape_string($string);
		}
		return $string;
	}


	/* Function to get substring of a string*/
	function getSubstring($name,$subStr)
	{
		if(strlen($name)>$subStr)
		{
			$name = substr($name,0,$subStr)."...";
		}
		return $name;
	}

	/* This function return encrypted form of passing parameter */
	function doEncrypt($param)
	{
		return base64_encode("%#$%_".$param."_$%#%");
	}
	
	/* This function return decrypted form of passing parameter */
	function doDecrypt($param)
	{
		$q			=	base64_decode($param);
		$a_emailId	=	explode("_",$q);
		return $a_emailId[1];
	}

	/*Returns the first Name of a members*/
	function getMemberFirstName($memberName)
	{
		$t_memberName =  ucwords(current(explode(" ",$memberName)));
		if(strlen($t_memberName)>=10)
		{
			$t_memberName	=	substr($t_memberName,0,10)."..";
		}
		return $t_memberName;
	}

	/*********************************************/
	/* Fonction: ImageCreateFromBMP              */
	/* This function is used to convert any image*/
	/* To BMP Image								 */
	/*********************************************/
 
	//Function to check valid url
	function isPath()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$refPath	= $_SERVER['HTTP_REFERER'];

			$refPath	= substr($refPath,strpos($refPath,".")+1);
			$refPath	= substr($refPath,0,strpos($refPath,"/"));
			$refPath	=	trim($refPath);

			if($refPath == "path10.local")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function pr($string){
		print_r('<pre>');
		print_r($string);
		print_r('</pre>');
		die('get_array');
	}
	
	function findexts($filename) 
	{ 
		 $exts=substr($filename,strrpos($filename,'.')+1);
		 /* $exts		=	@split("[/\\.]", $filename) ; 
		 $n			=	count($exts)-1; 
		 $exts		=	$exts[$n];  */

		 return $exts; 
	}
	
	function formatCalculateCanadianDollars($dollars)
	{
		$formatted = number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
		return $dollars < 0 ? "({$formatted})" : "{$formatted}";
	}
	
?>