<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY.' khong ton tai');
    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");
    $webmaster_fullname = $Session->get("webmt_fullname");
    $webmaster_ID = $Session->get("webmtId");
    $webmaster_username = $Session->get("username_admin");

	$_method = new method();
	$_thumb= new thumb();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['company'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG['company'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_COMPANY_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-company'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_company','string');
	if ($action == 'add_company') {
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
		$copyright = $_method->_Post('txt_copyright','string');
		$facebook = $_method->_Post('txt_facebook','string');
		$twitter = $_method->_Post('txt_twitter','string');
		$youtube = $_method->_Post('txt_youtube','string');
		$instagram = $_method->_Post('txt_instagram','string');
		$linkedin = $_method->_Post('txt_linkedin','string');
		$pinterest = $_method->_Post('txt_pinterest','string');
		$t_status = $_method->_Post('cbx_status','int');
		$embedgooglemap = $_method->_Post('txt_embedgooglemap','html');

		/* kiem tra co id thi la update - ko co thi la add */
		$company_controller = new company_controller();
    	if (!$id && _DEV_MODE === 1) {
    		$action_update = 'create';
    		$id = $db->getMaxID($company_controller->getTable(),'ID');

    		$logo = $_thumb->updateImages($id,_ARR_SIZE_LOGO_COMPANY,_PATH_UPLOAD_COMPANY,'file_url','logo/');
    		$logo_footer = $_thumb->updateImages($id,_ARR_SIZE_LOGO_FOOTER_COMPANY,_PATH_UPLOAD_COMPANY,'file_url_footer','footer/');
    		$logo_favicon = $_thumb->updateImages($id,_ARR_SIZE_FAVICON_COMPANY,_PATH_UPLOAD_COMPANY,'file_url_favicon','favicon/');

	    	$data_form=array(
	    		'ID'=>$id,
				'lang'=>$lang,
				'name'=>$name,
				'phone'=>$phone,
				'hotline'=>$hotline,
				'email'=>$email,
				'fax'=>$fax,
				'address'=>$address,
				'brand'=>$brand,
				'website'=>$website,
				'copyright'=>$copyright,
				'facebook'=>$facebook,
				'twitter'=>$twitter,
				'youtube'=>$youtube,
				'instagram'=>$instagram,
				'linkedin'=>$linkedin,
				'pinterest'=>$pinterest,
				't_status'=>$t_status,
				'embedgooglemap'=>$embedgooglemap,

				'logo'=>$logo,
				'logo_footer'=>$logo_footer,
				'logo_favicon'=>$logo_favicon,

				'created_date'=>strtotime('now'),
		        'updated_date'=>strtotime('now'),
				'created_by'=>$webmaster_ID,
				'updated_by'=>$webmaster_ID
			);
    	}else{
    		$action_update = 'update';

    		$logo = $_thumb->updateImages($id,_ARR_SIZE_LOGO_COMPANY,_PATH_UPLOAD_COMPANY,'file_url','logo/');
    		$logo_footer = $_thumb->updateImages($id,_ARR_SIZE_LOGO_FOOTER_COMPANY,_PATH_UPLOAD_COMPANY,'file_url_footer','footer/');
    		$logo_favicon = $_thumb->updateImages($id,_ARR_SIZE_FAVICON_COMPANY,_PATH_UPLOAD_COMPANY,'file_url_favicon','favicon/');

	    	$data_form=array(
				'name'=>$name,
				'phone'=>$phone,
				'hotline'=>$hotline,
				'email'=>$email,
				'fax'=>$fax,
				'address'=>$address,
				'brand'=>$brand,
				'website'=>$website,
				'copyright'=>$copyright,
				'facebook'=>$facebook,
				'twitter'=>$twitter,
				'youtube'=>$youtube,
				'instagram'=>$instagram,
				'linkedin'=>$linkedin,
				'pinterest'=>$pinterest,
				't_status'=>$t_status,
				'embedgooglemap'=>$embedgooglemap,

				'logo'=>$logo,
				'logo_footer'=>$logo_footer,
				'logo_favicon'=>$logo_favicon,

		        'updated_date'=>strtotime('now'),
				'updated_by'=>$webmaster_ID
			);
    	}
		$company_controller->setDataForm($data_form);
    	$result = $company_controller->update($id,$action_update);
    	if ($result) {

    		$_method->alert($LANG['save_successfully'],_LINK_COMPANY_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail company */
	if ($id && $id > 0){
		$db  = new database();
		$company_controller = new company_controller();
		$company_controller->setID($id);
		$detail = $company_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_COMPANY_LIST);
    		die();
		}

		$cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),$detail->lang);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$txt_name = $detail->name;
		$txt_phone = $detail->phone;
		$txt_hotline = $detail->hotline;
		$txt_email = $detail->email;
		$txt_fax = $detail->fax;
		$txt_address = $detail->address;
		$txt_brand = $detail->brand;
		$txt_website = $detail->website;
		$txt_copyright = $detail->copyright;
		$txt_facebook = $detail->facebook;
		$txt_twitter = $detail->twitter;
		$txt_youtube = $detail->youtube;
		$txt_instagram = $detail->instagram;
		$txt_linkedin = $detail->linkedin;
		$txt_pinterest = $detail->pinterest;
		$txt_embedgooglemap = $detail->embedgooglemap;

		$file_url = $detail->logo;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->logo)){
			$file_url = $detail->logo;
			if(!preg_match('/http:\/\//i', $file_url, $result) && !preg_match('/https:\/\//i', $file_url, $result)){
				$file_url = _ROOT_PATH_WEBSITE."/".$file_url;
			}
		}
		$file_url_footer = $detail->logo_footer;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->logo_footer)){
			$file_url_footer = $detail->logo_footer;
			if(!preg_match('/http:\/\//i', $file_url_footer, $result) && !preg_match('/https:\/\//i', $file_url_footer, $result)){
				$file_url_footer = _ROOT_PATH_WEBSITE."/".$file_url_footer;
			}
		}
		$file_url_favicon = $detail->logo_favicon;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->logo_favicon)){
			$file_url_favicon = $detail->logo_favicon;
			if(!preg_match('/http:\/\//i', $file_url_favicon, $result) && !preg_match('/https:\/\//i', $file_url_favicon, $result)){
				$file_url_favicon = _ROOT_PATH_WEBSITE."/".$file_url_favicon;
			}
		}

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

		$disabled_field = 'disabled="disabled"';

	}else{

		$cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_COMPANY);

		$txt_name = '';
		$txt_phone = '';
		$txt_hotline = '';
		$txt_email = '';
		$txt_fax = '';
		$txt_address = '';
		$txt_brand = '';
		$txt_website = '';
		$txt_copyright = '';
		$txt_facebook = '';
		$txt_twitter = '';
		$txt_youtube = '';
		$txt_instagram = '';
		$txt_linkedin = '';
		$txt_pinterest = '';
		$txt_embedgooglemap = '';

		$file_url = '';
		$file_url_footer = '';
		$file_url_favicon = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

		$disabled_field = '';

	}

	/* form upload thumb */
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	/* logo */
	$_FILE_LIB_logo = new FILE_LIB();
	$_FILE_LIB_logo->set_folderUpload(_PATH_UPLOAD_COMPANY.$thumb_id."/logo/");
	$_FILE_LIB_logo->set_defaultValue($file_url);
	$_FILE_LIB_logo->set_path('../');
	$form_upload_thumb = $_FILE_LIB_logo->showUploadThumb(); 
	/* logo-footer */
	$_FILE_LIB_logo_footer = new FILE_LIB();
	$_FILE_LIB_logo_footer->set_folderUpload(_PATH_UPLOAD_COMPANY.$thumb_id."/footer/");
	$_FILE_LIB_logo_footer->set_defaultValue($file_url_footer);
	$_FILE_LIB_logo_footer->set_path('../');
	$_FILE_LIB_logo_footer->set_urlFile('file_url_footer');
	$_FILE_LIB_logo_footer->set_divUpload('fileUpload_footer');
	$form_upload_thumb_footer = $_FILE_LIB_logo_footer->showUploadThumb(); 
	/* favicon */
	$_FILE_LIB_favicon = new FILE_LIB();
	$_FILE_LIB_favicon->set_folderUpload(_PATH_UPLOAD_COMPANY.$thumb_id."/favicon/");
	$_FILE_LIB_favicon->set_defaultValue($file_url_favicon);
	$_FILE_LIB_favicon->set_path('../');
	$_FILE_LIB_favicon->set_urlFile('file_url_favicon');
	$_FILE_LIB_favicon->set_divUpload('fileUpload_favicon');
	$form_upload_thumb_favicon = $_FILE_LIB_favicon->showUploadThumb(); 
?>