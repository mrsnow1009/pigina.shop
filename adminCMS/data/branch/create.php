<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_BRANCH)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BRANCH):die(_PHISICAL_PATH_ADMIN_CONTROLLER_BRANCH.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");
    $webmaster_fullname = $Session->get("webmt_fullname");
    $webmaster_ID = $Session->get("webmtId");
    $webmaster_username = $Session->get("username_admin");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['branch'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG['branch'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_BRANCH_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-branch'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_branch','string');
	if ($action == 'add_branch') {
		/* get post */
		$lang = $_method->_Post('cbx_lang','string');
		$name = $_method->_Post('txt_name','string');
		$phone = $_method->_Post('txt_phone','string');
		$hotline = $_method->_Post('txt_hotline','string');
		$email = $_method->_Post('txt_email','string');
		$fax = $_method->_Post('txt_fax','string');
		$address = $_method->_Post('txt_address','string');
		$brand = $_method->_Post('txt_brand','string');
		$website = $_method->_Post('txt_website','string');
		$facebook = $_method->_Post('txt_facebook','string');
		$twitter = $_method->_Post('txt_twitter','string');
		$youtube = $_method->_Post('txt_youtube','string');
		$instagram = $_method->_Post('txt_instagram','string');
		$linkedin = $_method->_Post('txt_linkedin','string');
		$pinterest = $_method->_Post('txt_pinterest','string');
		$t_status = $_method->_Post('cbx_status','int');
		$embedgooglemap = $_method->_Post('txt_embedgooglemap','html');
		
		$t_index = $_method->_Post('txt_sort','int');

		/* kiem tra co id thi la update - ko co thi la add */
		$branch_controller = new branch_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($branch_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'lang'=>$lang,
				'name'=>$name,
				'phone'=>$phone,
				'email'=>$email,
				'address'=>$address,
				'website'=>$website,
				'facebook'=>$facebook,
				'twitter'=>$twitter,
				'youtube'=>$youtube,
				'instagram'=>$instagram,
				'linkedin'=>$linkedin,
				'pinterest'=>$pinterest,
				't_status'=>$t_status,
				'embedgooglemap'=>$embedgooglemap,
				't_index'=>$t_index,

				'created_date'=>strtotime('now'),
		        'updated_date'=>strtotime('now'),
				'created_by'=>$webmaster_ID,
				'updated_by'=>$webmaster_ID
			);
    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				'name'=>$name,
				'phone'=>$phone,
				'email'=>$email,
				'address'=>$address,
				'website'=>$website,
				'facebook'=>$facebook,
				'twitter'=>$twitter,
				'youtube'=>$youtube,
				'instagram'=>$instagram,
				'linkedin'=>$linkedin,
				'pinterest'=>$pinterest,
				't_status'=>$t_status,
				'embedgooglemap'=>$embedgooglemap,
				't_index'=>$t_index,

		        'updated_date'=>strtotime('now'),
				'updated_by'=>$webmaster_ID
			);
    	}
		$branch_controller->setDataForm($data_form);
    	$result = $branch_controller->update($id,$action_update);
    	if ($result) {

    		$_method->alert($LANG['save_successfully'],_LINK_BRANCH_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail branch */
	if ($id && $id > 0){
		$db  = new database();
		$branch_controller = new branch_controller();
		$branch_controller->setID($id);
		$detail = $branch_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_BRANCH_LIST);
    		die();
		}

		$cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),$detail->lang);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$txt_name = $detail->name;
		$txt_phone = $detail->phone;
		$txt_email = $detail->email;
		$txt_address = $detail->address;
		$txt_website = $detail->website;
		$txt_facebook = $detail->facebook;
		$txt_twitter = $detail->twitter;
		$txt_youtube = $detail->youtube;
		$txt_instagram = $detail->instagram;
		$txt_linkedin = $detail->linkedin;
		$txt_pinterest = $detail->pinterest;
		$txt_embedgooglemap = $detail->embedgooglemap;

		$txt_sort = $detail->t_index;

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

		$disabled_field = 'disabled="disabled"';

	}else{
		$branch_controller = new branch_controller();
		$txt_sort = $branch_controller->getIndexSort();

		$cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_BRANCH);

		$txt_name = '';
		$txt_phone = '';
		$txt_email = '';
		$txt_address = '';
		$txt_website = '';
		$txt_facebook = '';
		$txt_twitter = '';
		$txt_youtube = '';
		$txt_instagram = '';
		$txt_linkedin = '';
		$txt_pinterest = '';
		$txt_embedgooglemap = '';

		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

		$disabled_field = '';

	}

?>