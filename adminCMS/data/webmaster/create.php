<?php 
	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER.' khong ton tai');
	$db = new database();

	/* get session dang nhap */
	$webmt_level = $Session->get("webmt_level");

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['account'];


	$_method = new method();

    $rid = $_method->_Get('id','int');
    $action = $_method->_Post('act_account','string');
    if ($action && $action == 'account'){

    	$username = $_method->_Post('txt_username','string');
    	$email = $_method->_Post('txt_email','string');
    	$fullname = $_method->_Post('txt_fullname','string');
    	$phone = $_method->_Post('txt_phone','string');
    	$address = $_method->_Post('txt_address','string');
    	$level = $_method->_Post('cbx_level','string');
    	$t_status = $_method->_Post('cbx_status','int');

    	/* kiem tra co id thi la update - ko co thi la add */
    	if (!$rid) {
    		$rid = 0;
	    	$data_form=array(
				'username'=>$username,
				'email'=>$email,
				'fullname'=>$fullname,
				'phone'=>$phone,
				'address'=>$address,
				'level'=>$level,
				't_status'=>$t_status,
				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
	    	$data_form=array(
				'fullname'=>$fullname,
				'phone'=>$phone,
				'address'=>$address,
				'level'=>$level,
				't_status'=>$t_status,
		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}

    	$webmaster_controller = new webmaster_controller();
		$webmaster_controller->setID($rid);
		$webmaster_controller->setDataForm($data_form);
    	$result = $webmaster_controller->update($rid);

    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_WEBMASTER_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
    }

    /* kiem tra co id thi là update - ko co thi la add */
    $id = $_method->_Get('id','int');
    if ($id && $id > 0){
	    /* set - tieu de trang web */
	    $page_title = $LANG['update'].' '.$LANG['account'];

	    /* disabled username and email */
		$disabled = 'disabled="disabled"';
        
		$webmaster_controller = new webmaster_controller();
		$webmaster_controller->setID($id);
		/* data form */
		$data_webmaster = $webmaster_controller->getDetail();
		if (!$data_webmaster) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_WEBMASTER_LIST);
	        die();
		}

		$txt_username = $data_webmaster->username;
		$txt_email = $data_webmaster->email;
		$txt_fullname = $data_webmaster->fullname;
		$txt_phone = $data_webmaster->phone;
		$txt_address = $data_webmaster->address;

		$created_date = date('d - m - Y | H:i:s',$data_webmaster->created_date);
		$updated_date = date('d - m - Y | H:i:s',$data_webmaster->updated_date);
		$created_by = $db->getField(TBLWEBMASTER, 'fullname', 'ID', $data_webmaster->created_by);
		$updated_by = $db->getField(TBLWEBMASTER, 'fullname', 'ID', $data_webmaster->updated_by);

		if ($webmt_level == 'root' && $data_webmaster->ID == $Session->get("webmtId")) {
			/* la root va cap nhat cua minh -> disable : admin + staff */
			$html_level = $_method->html_option(unserialize(_LEVEL_WEBMASTER),$data_webmaster->level,array('admin','staff'));
		}else if ($webmt_level == 'root' && $data_webmaster->ID != $Session->get("webmtId")) {
			/* la root va cap nhat nguoi khac -> disable : root */
			$html_level = $_method->html_option(unserialize(_LEVEL_WEBMASTER),$data_webmaster->level,array('root'));
		}else if ($webmt_level == 'admin' && $data_webmaster->ID == $Session->get("webmtId")) {
			/* la admin va cap nhat cua minh -> disable : root + staff */
			$html_level = $_method->html_option(unserialize(_LEVEL_WEBMASTER),$data_webmaster->level,array('root','staff'));
		}else{
			/* la admin va cap nhat nguoi khac -> disable : root + admin */
			/* la staff -> disable : root + admin */
			$html_level = $_method->html_option(unserialize(_LEVEL_WEBMASTER),$data_webmaster->level,array('root','admin'));
		}

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS_WEBMASTER),$data_webmaster->t_status);

    }else{
		$disabled = '';

    	$txt_username = '';
		$txt_email = '';
		$txt_fullname = '';
		$txt_phone = '';
		$txt_address = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

		if ($webmt_level == 'root') {
			/* la root -> disable : root */
			$html_level = $_method->html_option(unserialize(_LEVEL_WEBMASTER),'staff',array('root'));
		}else if($webmt_level == 'admin') {
			/* la admin -> disable : root + admin */
			$html_level = $_method->html_option(unserialize(_LEVEL_WEBMASTER),'staff',array('root','admin'));
		}else{
			/* la staff -> khong co quyen them tai khoan */
			$_method->alert($LANG['access_denied'],_LINK_WEBMASTER_LIST); // xong xuoi thi chinh duong link nay tro ve trang thong tin ca nhan
            die();
		}

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS_WEBMASTER),1);
    }
?>