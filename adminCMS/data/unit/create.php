<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_UNIT)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_UNIT):die(_PHISICAL_PATH_ADMIN_CONTROLLER_UNIT.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$db = new database();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['unit'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG['unit'];

	/* get submit form */
	$action = $_method->_Post('act_unit','string');
	if ($action == 'add_unit') {
		/* get post */
		$title_vn = $_method->_Post('txt_title_vn','string');
		$title_en = $_method->_Post('txt_title_en','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		$txt_sort = $_method->_Post('txt_sort','int');

		/* kiem tra co id thi la update - ko co thi la add */
		$unit_controller = new unit_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($unit_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'title_vn'=>$title_vn,
				'title_en'=>$title_en,
				't_status'=>$cbx_status,
				't_index'=>$txt_sort,

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
				't_index'=>$txt_sort,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$unit_controller->setDataForm($data_form);
    	$result = $unit_controller->update($id,$action_update);
    	if ($result) {

    		$_method->alert($LANG['save_successfully'],_LINK_UNIT_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail unit */
	if ($id && $id > 0){
		$db  = new database();
		$unit_controller = new unit_controller();
		$unit_controller->setID($id);
		$detail = $unit_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_UNIT_LIST);
    		die();
		}

		$txt_title_vn = $detail->title_vn;
		$txt_title_en = $detail->title_en;
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);
		$txt_sort = $detail->t_index;

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{
		$unit_controller = new unit_controller();

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_UNIT);

		$txt_sort = $unit_controller->getIndexSort();

		$txt_title_vn = '';
		$txt_title_en = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

	}

?>