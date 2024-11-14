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
    $page_title = $LANG['robot-sitemap-config'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		'javascript:;' => $page_title,
	)));

	$robotstxt = _PHISICAL_PATH_ROOT.'robots.txt';
	$sitemapxml = _PHISICAL_PATH_ROOT.'sitemap.xml';

	/* get submit form */
	$action = $_method->_Post('act_robot_sitemap','string');
	if ($action == 'add_robot_sitemap') {
		/* get post */
		$robot_file = $_method->_Post('robot_file','html');
		$sitemap_file = $_method->_Post('sitemap_file','html');

		$error = '';
		if (is_writable($robotstxt)) {
			if (!$robotFile = fopen($robotstxt, 'w')) {
	         	$error .= $LANG['robot_file'].': '.$LANG['cannot_open_file'].' '.$robotstxt.'\n';
	    	}else{
		    	if (fwrite($robotFile, $robot_file) === FALSE) {
			        $error .= $LANG['robot_file'].': '.$LANG['cannot_write_to_file'].' '.$robotstxt.'\n';
			    }else{
			    	$error .= $LANG['robot_file'].': '. $LANG['update_success'].'\n';
			    }
	    	}
		    fclose($robotFile);
		}

		if (is_writable($sitemapxml)) {
			if (!$sitemapFile = fopen($sitemapxml, 'w')) {
	         	$error .= $LANG['sitemap_file'].': '.$LANG['cannot_open_file'].' '.$sitemapxml.'\n';
	    	}else{
		    	if (fwrite($sitemapFile, $sitemap_file) === FALSE) {
			        $error .= $LANG['sitemap_file'].': '.$LANG['cannot_write_to_file'].' '.$sitemapxml.'\n';
			    }else{
			    	$error .= $LANG['sitemap_file'].': '. $LANG['update_success'].'\n';
			    }
	    	}
		    fclose($sitemapFile);
		}

    	$_method->alert($error,_LINK_CONFIG_ROBOT_SITEMAP);
	}

	/* get detail file */
	if (is_file($robotstxt))
		$robot_file = file_get_contents($robotstxt, FILE_USE_INCLUDE_PATH);
	else
		$robot_file = '';

	if (is_file($sitemapxml))
		$sitemap_file = file_get_contents($sitemapxml, FILE_USE_INCLUDE_PATH);
	else
		$sitemap_file = '';

?>