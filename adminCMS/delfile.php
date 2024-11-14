<?php
	 // Config path for domain config. Do not remove.
	$_LEVEL = '../';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
    file_exists(_PATH_METHOD_CLASS)?include_once(_PATH_METHOD_CLASS):die(_PATH_METHOD_CLASS.' khong ton tai');
	$_thumb = new thumb();
	$_method = new method();
	
	$path = $_method->_Request("path","string");
	$path = $_thumb->getPathReal(html_entity_decode (urldecode($path)));

	$root_path = dirname($path."/");

	if(count(scandir($root_path))>3){
		$_thumb->del_File($path,_UPLOAD_BY_FTP);	
	}else{
	    $_thumb->deleteDirectory($root_path);
	}

?>