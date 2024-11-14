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
    $page_title = $LANG['other-config'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_other','string');
	if ($action == 'add_other') {
		/* get post */
		$head_tag = $_method->_Post('head_tag','html');
		$body_tag = $_method->_Post('body_tag','html');
		$google_analytic = $_method->_Post('google_analytic','html');
		$google_adwords = $_method->_Post('google_adwords','html');
		$facebook_code_tracking = $_method->_Post('facebook_code_tracking','html');
		$facebook_adwords = $_method->_Post('facebook_adwords','html');
		$embed_livechat = $_method->_Post('embed_livechat','html');
		$javascript_other = $_method->_Post('javascript_other','html');

		$array_form = array(
			'head_tag'=>$head_tag,
			'body_tag'=>$body_tag,
			'google_analytic'=>$google_analytic,
			'google_adwords'=>$google_adwords,
			'facebook_code_tracking'=>$facebook_code_tracking,
			'facebook_adwords'=>$facebook_adwords,
			'embed_livechat'=>$embed_livechat,
			'javascript_other'=>$javascript_other
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

    	$_method->alert($error,_LINK_CONFIG_OTHER);
	}

	/* get detail */
	$head_tag = $db->getField(TBLCONFIG,'value','code','head_tag');
	if (!$head_tag) $head_tag = '';

	$body_tag = $db->getField(TBLCONFIG,'value','code','body_tag');
	if (!$body_tag) $body_tag = '';

	$google_analytic = $db->getField(TBLCONFIG,'value','code','google_analytic');
	if (!$google_analytic) $google_analytic = '';

	$google_adwords = $db->getField(TBLCONFIG,'value','code','google_adwords');
	if (!$google_adwords) $google_adwords = '';

	$facebook_code_tracking = $db->getField(TBLCONFIG,'value','code','facebook_code_tracking');
	if (!$facebook_code_tracking) $facebook_code_tracking = '';

	$facebook_adwords = $db->getField(TBLCONFIG,'value','code','facebook_adwords');
	if (!$facebook_adwords) $facebook_adwords = '';

	$embed_livechat = $db->getField(TBLCONFIG,'value','code','embed_livechat');
	if (!$embed_livechat) $embed_livechat = '';

	$javascript_other = $db->getField(TBLCONFIG,'value','code','javascript_other');
	if (!$javascript_other) $javascript_other = '';

?>