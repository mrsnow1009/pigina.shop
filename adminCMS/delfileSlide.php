<?php
	 // Config path for domain config. Do not remove.
	$_LEVEL = '../';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');
    file_exists(_PATH_DB_LOCAL_CLASS)?include_once(_PATH_DB_LOCAL_CLASS):die(_PATH_DB_LOCAL_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
    file_exists(_PATH_METHOD_CLASS)?include_once(_PATH_METHOD_CLASS):die(_PATH_METHOD_CLASS.' khong ton tai');
	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY.' khong ton tai');
	
	$_thumb = new thumb();
	$_method = new method();

	$path = $_method->_Request("path","string");
	$id = $_method->_Request("id","int");
	
	$path = $_thumb->getPathReal(html_entity_decode(urldecode($path)));
	$_thumb->del_File($path,_UPLOAD_BY_FTP);
	if($id){
		$_library_controller = new library_controller();
		$result = $_library_controller->DeleteRecord($id);
	}
?>