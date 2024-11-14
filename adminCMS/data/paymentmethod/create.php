<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_PAYMENTMETHOD)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PAYMENTMETHOD):die(_PHISICAL_PATH_ADMIN_CONTROLLER_PAYMENTMETHOD.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['paymentmethod'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG['paymentmethod'];

	/* get submit form */
	$action = $_method->_Post('act_paymentmethod','string');
	if ($action == 'add_paymentmethod') {
		/* get post */
		$title_vn = $_method->_Post('txt_title_vn','string');
		$title_en = $_method->_Post('txt_title_en','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		$txt_sort = $_method->_Post('txt_sort','int');

		/* kiem tra co id thi la update - ko co thi la add */
		$paymentmethod_controller = new paymentmethod_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($paymentmethod_controller->getTable(),'ID');

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
		$paymentmethod_controller->setDataForm($data_form);
    	$result = $paymentmethod_controller->update($id,$action_update);
    	if ($result) {

    		$_method->alert($LANG['save_successfully'],_LINK_PAYMENTMETHOD_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail delivery method */
	if ($id && $id > 0){
		$db  = new database();
		$paymentmethod_controller = new paymentmethod_controller();
		$paymentmethod_controller->setID($id);
		$detail = $paymentmethod_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_PAYMENTMETHOD_LIST);
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
		$paymentmethod_controller = new paymentmethod_controller();

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_PAYMENTMETHOD);

		$txt_sort = $paymentmethod_controller->getIndexSort();

		$txt_title_vn = '';
		$txt_title_en = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

	}

?>