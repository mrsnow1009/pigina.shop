<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SIZE)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SIZE):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SIZE.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add-size-attribute'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-size-attribute'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_BRAND_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-brand'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_size','string');
	if ($action == 'add_size') {
		/* get post */
		$title_vn = $_method->_Post('txt_title_vn','string');
		$title_en = $_method->_Post('txt_title_en','string');
		$cbx_status = $_method->_Post('cbx_status','int');

		/* kiem tra co id thi la update - ko co thi la add */
		$size_controller = new size_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($size_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'title_vn'=>$title_vn,
				'title_en'=>$title_en,
				't_status'=>$cbx_status,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				'title_vn'=>$title_vn,
				'title_en'=>$title_en,
				't_status'=>$cbx_status,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$size_controller->setDataForm($data_form);
    	$result = $size_controller->update($id,$action_update);
    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_SIZE_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail delivery method */
	if ($id && $id > 0){
		$db  = new database();
		$size_controller = new size_controller();
		$size_controller->setID($id);
		$detail = $size_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_SIZE_LIST);
    		die();
		}

		$txt_title_vn = $detail->title_vn;
		$txt_title_en = $detail->title_en;
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{
		$size_controller = new size_controller();

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_SIZE);

		$txt_title_vn = '';
		$txt_title_en = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

	}

?>