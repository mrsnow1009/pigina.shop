<?php 
	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER.' khong ton tai');
	
    /* set - tieu de trang web */
    $page_title = $LANG[$act];
    
    /* define */
    $db = new database();

	/* set ID cua nguoi dang dang nhap */
    $webmaster_controller = new webmaster_controller();
	$webmaster_controller->setID($Session->get("webmtId"));

	/* xu ly action login */
    $txt_password_old = method::_Post("txt_password_old","string");
    $txt_password_new = method::_Post("txt_password_new","string");
    $txt_password_confirm = method::_Post("txt_password_confirm","string");
    $act_changePassword = method::_Post("act_changePassword","string");
    if ($act_changePassword == 'changePassword') {
        $result = $webmaster_controller->changePassword($txt_password_old,$txt_password_confirm);
        if ($result) {
            method::alert($LANG['change_password_completed'],_LINK_WEBMASTER_CHANGE_PASSWORD);
            die();
        }else{
            method::alert($LANG['error_try_again'],_LINK_WEBMASTER_CHANGE_PASSWORD);
            die();
        }
    }

?>