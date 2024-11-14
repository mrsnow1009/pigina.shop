<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CONFIG)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONFIG):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CONFIG.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");
    $webmaster_fullname = $Session->get("webmt_fullname");
    $webmaster_ID = $Session->get("webmtId");
    $webmaster_username = $Session->get("username_admin");

	$_method = new method();
	$db  = new database();

    /* set - tieu de trang web */
    $page_title = $LANG['smtp-config'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_smtp','string');
	if ($action == 'add_smtp') {
		/* get post */
		$smtp_hostname = $_method->_Post('smtp_hostname','string');
		$smtp_port = (int)$_method->_Post('smtp_port','int');
		$smtp_mail = $_method->_Post('smtp_mail','string');
		$smtp_password = $_method->_Post('smtp_password','string');
		$smtp_auth = $_method->_Post('smtp_auth','int');
		if (!$smtp_auth || $smtp_auth == 0) $smtp_auth = 2;

		$mail_contact = $_method->_Post('mail_contact','string');
		$mail_order = $_method->_Post('mail_order','string');

		$array_form = array(
			'smtp_hostname'=>$smtp_hostname,
			'smtp_port'=>$smtp_port,
			'smtp_mail'=>$smtp_mail,
			'smtp_password'=>$smtp_password,
			'smtp_auth'=>$smtp_auth,
			'mail_contact'=>$mail_contact,
			'mail_order'=>$mail_order
		);

		$config_controller = new config_controller();
		$error = '';
		foreach ($array_form as $key => $value) {
			$result = false;
			if ($value) {
				$id = $db->getField(TBLCONFIG,'ID','code',$key);
				if ($id) {
					$config_controller->setDataForm(array('value'=>$value));
					$result = $config_controller->update($id,'update');
				}else{
					$id = $db->getMaxID(TBLCONFIG,'ID');
					$data_form = array(
						'ID'=>$id,
						'code'=>$key,
						'value'=>$value);
					$config_controller->setDataForm($data_form);
					$result = $config_controller->update($id,'create');
				}
			}
			if ($result)
				$error .= $LANG[$key].': '.$LANG['update_success'].'\n';
			else
				$error .= $LANG[$key].': '.$LANG['update_failure'].'\n';
		}

    	$_method->alert($error,_LINK_CONFIG_SMTP);
	}

	/* get detail smtp */
	$smtp_hostname = $db->getField(TBLCONFIG,'value','code','smtp_hostname');
	if (!$smtp_hostname) $smtp_hostname = '';

	$smtp_port = $db->getField(TBLCONFIG,'value','code','smtp_port');
	if (!$smtp_port) $smtp_port = 25;

	$smtp_mail = $db->getField(TBLCONFIG,'value','code','smtp_mail');
	if (!$smtp_mail) $smtp_mail = '';

	$smtp_password = $db->getField(TBLCONFIG,'value','code','smtp_password');
	if (!$smtp_password) $smtp_password = '';

	$smtp_auth = $db->getField(TBLCONFIG,'value','code','smtp_auth');
	if (!$smtp_auth) $smtp_auth = '';

	$mail_contact = $db->getField(TBLCONFIG,'value','code','mail_contact');
	if (!$mail_contact) $mail_contact = '';

	$mail_order = $db->getField(TBLCONFIG,'value','code','mail_order');
	if (!$mail_order) $mail_order = '';

?>