<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add-widget'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-widget'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_BRAND_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-widget'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_widget','string');
	if ($action == 'add_widget') {
		/* get post */
		$cbx_lang = $_method->_Post('cbx_lang','string');
		$txt_module_code = $_method->_Post('txt_module_code','string');
		$txt_w_type = $_method->_Post('txt_w_type','string');
		$txt_w_code = $_method->_Post('txt_w_code','string');
		$txt_w_name = $_method->_Post('txt_w_name','string');
		$txt_position = $_method->_Post('txt_position','string');

		$txt_w_max_item = $_method->_Post('txt_w_max_item','int');
		$txt_w_filter_sql = $_method->_Post('txt_w_filter_sql','string');

		$txt_sort = $_method->_Post('txt_sort','int');
		$cbx_status = $_method->_Post('cbx_status','int');

		/* kiem tra co id thi la update - ko co thi la add */
		$widget_controller = new widget_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($widget_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'module_code'=>$txt_module_code,
				'w_code'=>$txt_w_code,
				'w_type'=>$txt_w_type,
				'w_name'=>$txt_w_name,
				'w_max_item'=>$txt_w_max_item,
				'w_filter_sql'=>$txt_w_filter_sql,
				't_status'=>$cbx_status,
				't_index'=>$txt_sort,
				'position'=>$txt_position,
				'lang'=>$cbx_lang,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				'module_code'=>$txt_module_code,
				'w_code'=>$txt_w_code,
				'w_type'=>$txt_w_type,
				'w_name'=>$txt_w_name,
				'w_max_item'=>$txt_w_max_item,
				'w_filter_sql'=>$txt_w_filter_sql,
				't_status'=>$cbx_status,
				't_index'=>$txt_sort,
				'position'=>$txt_position,
				'lang'=>$cbx_lang,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$widget_controller->setDataForm($data_form);
    	$result = $widget_controller->update($id,$action_update);
    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_WIDGET_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail delivery method */
	if ($id && $id > 0){
		$db  = new database();
		$widget_controller = new widget_controller();
		$widget_controller->setID($id);
		$detail = $widget_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_WIDGET_LIST);
    		die();
		}

		$cbxLang = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),$detail->lang);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);
		$cbxType = $_method->combo_arr(unserialize(_ARR_WIDGET_TYPE),$detail->w_type);
		$cbxModuleCode = $_method->combo_arr(unserialize(_ARR_MODULE),$detail->module_code);

		$txt_w_code = $detail->w_code;
		$txt_w_type = $detail->w_type;
		$txt_w_name = $detail->w_name;
		$txt_w_max_item = $detail->w_max_item;
		$txt_w_filter_sql = $detail->w_filter_sql;
		$txt_sort = $detail->t_index;
		$txt_position = $detail->position;

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		if ($detail->created_by) $created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		else $created_by = '';
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{
		$widget_controller = new widget_controller();

		$cbxLang = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_WIDGET);
		$cbxType = $_method->combo_arr(unserialize(_ARR_WIDGET_TYPE),_ARR_WIDGET_TYPE_DEFAULT);
		$cbxModuleCode = $_method->combo_arr(unserialize(_ARR_MODULE),_ARR_WIDGET_MODULE_DEFAULT);

		$txt_w_code = '';
		$txt_w_type = '';
		$txt_w_name = '';
		$txt_w_max_item = '';
		$txt_w_filter_sql = '';
		$txt_sort = $widget_controller->getIndexSort();
		$txt_position = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

	}

?>