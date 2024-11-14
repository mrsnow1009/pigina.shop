<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTACT_FORM)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTACT_FORM):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTACT_FORM.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add-contact-form'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-contact-form'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_BRAND_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-contact-form'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_contact_form','string');
	if ($action == 'add_contact_form') {
		/* get post */
		$txt_name = $_method->_Post('txt_name','string');
		$txt_phone = $_method->_Post('txt_phone','string');
		$txt_email = $_method->_Post('txt_email','string');
		$txt_subject = $_method->_Post('txt_subject','string');
		$txt_message = $_method->_Post('txt_message','html');
		$cbx_status = $_method->_Post('cbx_status','int');

		/* kiem tra co id thi la update - ko co thi la add */
		$contactform_controller = new contactform_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($contactform_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'name'=>$txt_name,
				'phone'=>$txt_phone,
				'email'=>$txt_email,
				'subject'=>$txt_subject,
				'message'=>$txt_message,
				't_status'=>$cbx_status,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				'name'=>$txt_name,
				'phone'=>$txt_phone,
				'email'=>$txt_email,
				'subject'=>$txt_subject,
				'message'=>$txt_message,
				't_status'=>$cbx_status,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$contactform_controller->setDataForm($data_form);
    	$result = $contactform_controller->update($id,$action_update);
    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_CONTACT_FORM_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail delivery method */
	if ($id && $id > 0){
		$db  = new database();
		$contactform_controller = new contactform_controller();
		$contactform_controller->setID($id);
		$detail = $contactform_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_CONTACT_FORM_LIST);
    		die();
		}

		$txt_name = $detail->name;
		$txt_phone = $detail->phone;
		$txt_email = $detail->email;
		$txt_subject = $detail->subject;
		$txt_message = $detail->message;
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS_CONTACT_FORM),$detail->t_status);

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		if ($detail->created_by) $created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		else $created_by = '';
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{
		$contactform_controller = new contactform_controller();

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS_CONTACT_FORM),_STATUS_DEFAULT_CONTACT_FORM);

		$txt_name = '';
		$txt_phone = '';
		$txt_email = '';
		$txt_subject = '';
		$txt_message = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

	}

?>