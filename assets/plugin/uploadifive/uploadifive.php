<?php

// error_reporting(E_ALL^E_NOTICE^E_WARNING);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
// error_reporting ( E_ALL );
// ini_set ( "display_errors", 1 );

// JQuery File Upload Plugin v1.4.1 by RonnieSan - (C)2009 Ronnie Garcia

//*Get Shop information and identifying it*/
$_LEVEL =   '../../../'; // Config path for domain config. Do not remove.
include($_LEVEL."config/identify.php");
include($_LEVEL."config/config_global.php");
/* cau hinh ngon ngu */
include($_LEVEL."language/global_lang_vn.php");
define('_LANG', serialize($LANG));

include($_LEVEL."config/define.php");
include($_LEVEL."classes/thumb.php");
include($_LEVEL."classes/method.php");


$folder= $_REQUEST['folder'];
if (!empty($_FILES)) {
	$_thumb= new thumb();
	//
	//Tao folder neu chua co
	$targetPath = $_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'. $_REQUEST['folder'];
	// Uncomment the following line if you want to make the directory if it doesn't exist
	$foldernew=str_replace('//','/',$targetPath);
	// print $foldernew;
	// mkdir($foldernew, 0777, true);
	if (!file_exists($foldernew)) {
	    mkdir($foldernew, 0777, true);
	}
	chmod($foldernew, 0777);

	if(_UPLOAD_BY_FTP){
		//Upload = FTP
		$arrFolder=preg_split('/'.str_replace("/","\/",_PATH_UPLOAD).'/i',$folder);
		$destination_file=$arrFolder[count($arrFolder)-1];

		$source_file = $_FILES['Filedata']['tmp_name'];
		$nameFile = $_FILES['Filedata']['name'];
		$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
		//print_r($destination_file.$nameFile);die();
		echo $targetFile;
		$_thumb->ftp_copy($source_file, 'upload/'.$destination_file.$nameFile);
		//
	}else{
		//Upload lenh php
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];

		echo $targetFile;
		move_uploaded_file($tempFile,$targetFile);
	}
}//If file co ton tai

?>