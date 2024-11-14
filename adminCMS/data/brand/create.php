<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_BRAND)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BRAND):die(_PHISICAL_PATH_ADMIN_CONTROLLER_BRAND.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");
    $webmaster_fullname = $Session->get("webmt_fullname");
    $webmaster_ID = $Session->get("webmtId");
    $webmaster_username = $Session->get("username_admin");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['brand'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG['brand'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_BRAND_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-brand'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_brand','string');
	if ($action == 'add_brand') {
		/* get post */
		$lang = $_method->_Post('cbx_lang','string');
		$title = $_method->_Post('txt_title','string');
		$t_status = $_method->_Post('cbx_status','int');
		$t_index = $_method->_Post('txt_sort','int');

		$intro = $_method->_Post('txt_intro','html');

		/* kiem tra co id thi la update - ko co thi la add */
		$brand_controller = new brand_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($brand_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'lang'=>$lang,
				'title'=>$title,
				'intro'=>$intro,
				't_status'=>$t_status,
				't_index'=>$t_index,

				'created_date'=>strtotime('now'),
		        'updated_date'=>strtotime('now'),
				'created_by'=>$webmaster_ID,
				'updated_by'=>$webmaster_ID
			);
    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				'lang'=>$lang,
				'title'=>$title,
				'intro'=>$intro,
				't_status'=>$t_status,
				't_index'=>$t_index,

		        'updated_date'=>strtotime('now'),
				'updated_by'=>$webmaster_ID
			);
    	}
		$brand_controller->setDataForm($data_form);
    	$result = $brand_controller->update($id,$action_update);
    	if ($result) {

    		$_method->alert($LANG['save_successfully'],_LINK_BRAND_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail brand */
	if ($id && $id > 0){
		$db  = new database();
		$brand_controller = new brand_controller();
		$brand_controller->setID($id);
		$detail = $brand_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_BRAND_LIST);
    		die();
		}

		$cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),$detail->lang);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$txt_title = $detail->title;
		$txt_intro = $detail->intro;

		$txt_sort = $detail->t_index;

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{
		$brand_controller = new brand_controller();
		$txt_sort = $brand_controller->getIndexSort();

		$cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_BRAND);

		$txt_title = '';
		$txt_intro = '';

		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

	}

?>