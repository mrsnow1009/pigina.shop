<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY.' khong ton tai');
    file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP):die(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP.' khong ton tai');
	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY.' khong ton tai');

    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');


	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	// $_thumb= new thumb();

    /* set - tieu de trang web */
    $page_title = $LANG['add-banner'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-banner'];

	/* get submit form */
	$action = $_method->_Post('act_banner','string');
	if ($action == 'add_banner') {
		/* get post */
		$cbx_status = $_method->_Post('cbx_status','int');
		$cbx_cateid = $_method->_Post('cbx_cateid','array');
		$txt_title = $_method->_Post('txt_title','string');
		$cbxPosition = $_method->_Post('cbxPosition','string');
		$txt_width = $_method->_Post('txt_width','int');
		$txt_height = $_method->_Post('txt_height','int');
		$txt_url = $_method->_Post('txt_url','string');
		$cbxTarget = $_method->_Post('cbxTarget','string');
		$rad_type = $_method->_Post('rad_type','string');
		$txt_script = $_method->_Post('txt_script','html');
		$txt_sort = $_method->_Post('txt_sort','int');

		$started_date = $_method->_Post('started_date','string');
		if ($started_date) $started_date = strtotime($started_date);
		else $started_date = 0;

		$expired_date = $_method->_Post('expired_date','string');
		if ($expired_date) $expired_date = strtotime($expired_date);
		else $expired_date = 0;

		// $value_cateid = '';
		if($cbx_cateid){
			// foreach ($cbx_cateid as &$value) $value_cateid .= 'c'.$value.'#';
			$cbx_cateid = '@'.implode('@@',$cbx_cateid).'@';
		}

		/* kiem tra co id thi la update - ko co thi la add */
		$db = new database();
		$banner_controller = new banner_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($banner_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				't_status'=>$cbx_status,
				'cateid'=>$cbx_cateid,
				'title'=>$txt_title,
				'position'=>$cbxPosition,
				'width'=>$txt_width,
				'height'=>$txt_height,
				'target'=>$cbxTarget,
				'script'=>$txt_script,
				'url'=>$txt_url,
				'type'=>$rad_type,
				'started_date'=>$started_date,
				'expired_date'=>$expired_date,
				't_index'=>$txt_sort,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);

    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				't_status'=>$cbx_status,
				'cateid'=>$cbx_cateid,
				'title'=>$txt_title,
				'position'=>$cbxPosition,
				'width'=>$txt_width,
				'height'=>$txt_height,
				'target'=>$cbxTarget,
				'script'=>$txt_script,
				'url'=>$txt_url,
				'type'=>$rad_type,
				'started_date'=>$started_date,
				'expired_date'=>$expired_date,
				't_index'=>$txt_sort,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}

		$banner_controller->setDataForm($data_form);
    	$result = $banner_controller->update($id,$action_update);

    	/* update slide */
    	$hdact = $_method->_Post('hdact','string');
		$temp_id = $_method->_Post('temp_id','int');
    	if($hdact == 'add_store_gallery'){
    		$_ARR_THUMB_INDEX_BANNER = unserialize(_ARR_THUMB_INDEX_BANNER);
			$_library_controller = new library_controller();
			$_library_controller->setNodeID($banner_controller->getID());
			$_library_controller->setPathUpload(_PATH_UPLOAD_BANNER);
			$_library_controller->setThumbArr(unserialize(_ARR_SIZE_SLIDER_BANNER));
			$_library_controller->setThumbIndex($_ARR_THUMB_INDEX_BANNER[$cbxPosition]);
			$_library_controller->updateForm($banner_controller->getCodeModule(),$temp_id);
    	}

    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_BANNER_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail product */
	$db  = new database();
	$banner_controller = new banner_controller();
	$banner_group_controller = new banner_group_controller();
	$category_controller = new category_controller();
	if ($id && $id > 0){
		$banner_controller->setID($id);
		$detail = $banner_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_BANNER_LIST);
    		die();
		}

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$root_all = $db->getField($category_controller->getTable(),'ID','code','_ROOT',' and code_module = "ROOT" ');
		if (!$root_all) $_method->alert($LANG['error_try_again']);
		preg_match_all('/\d+/i', ''.$detail->cateid.'', $cbx_cateid);
	   	$cbx_cateid = $category_controller->multi_arrsubtree(array($root_all),$cbx_cateid);

		$txt_title = $detail->title;

		$listBannerGroup = $db->getArrFieldID("Select position,title from ".$banner_group_controller->getTable()." where 1 order by `ID` ASC ",array('position','title'));
		$cbxPosition = method::combo_arr($listBannerGroup,$detail->position);

		$banner_group_controller->setSqlFilter(' and position="'.$detail->position.'"');
		$detail_banner_group = $banner_group_controller->getDetail();
		$txt_width = 0;
		$txt_height = 0;
		$readonly_size = '';
		if ($detail_banner_group) {
			$txt_width = $detail_banner_group->width;
			$txt_height = $detail_banner_group->height;
			if ($detail_banner_group->static == 1) $readonly_size = 'readonly="readonly"';
		}

		$cbxTarget = $_method->combo_arr(unserialize(_TARGET_BANNER),$detail->target);

		$txt_url = $detail->url;
		$txt_type = $detail->type;
		$rad_type = $_method->radio_array(unserialize(_TYPE_BANNER),'rad_type',$txt_type);
		$txt_script = $detail->script;

		/* start: get list image slide */
		$_library_controller = new library_controller();
		$_library_controller->setSqlFilter(' and nodeid = '.$id);
		$_library_controller->setSqlSort(' order by t_index asc ');
		$list_library = $_library_controller->getList();
		$html_library = $_library_controller->getList_html($list_library,_FLAG_BANNER_TITLE,_FLAG_BANNER_INTRO,_FLAG_BANNER_LINK,'slidethumnail_gallery[]');
		/* end: get list image slide */
		
		if ($detail->started_date == 0) $started_date = '';
		else $started_date = date('d-m-Y',$detail->started_date);
		if ($detail->expired_date == 0) $expired_date = '';
		else $expired_date = date('d-m-Y',$detail->expired_date);

		$txt_sort = $detail->t_index;

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_BANNER);

		$root_all = $db->getField($category_controller->getTable(),'ID','code','_ROOT',' and code_module = "ROOT" ');
		if (!$root_all) $_method->alert($LANG['error_try_again']);
	   	$cbx_cateid = $category_controller->multi_arrsubtree(array($root_all),array(array()));

		$txt_title = '';

		$listBannerGroup = $db->getArrFieldID("Select position,title from ".$banner_group_controller->getTable()." where 1 order by `ID` ASC ",array('position','title'));
		$cbxPosition = method::combo_arr($listBannerGroup,_GROUP_DEFAULT_BANNER);

		$banner_group_controller->setSqlFilter(' and position="'._GROUP_DEFAULT_BANNER.'"');
		$detail_banner_group = $banner_group_controller->getDetail();
		$txt_width = 0;
		$txt_height = 0;
		$readonly_size = '';
		if ($detail_banner_group) {
			$txt_width = $detail_banner_group->width;
			$txt_height = $detail_banner_group->height;
			if ($detail_banner_group->static == 1) $readonly_size = 'readonly="readonly"';
		}

		$cbxTarget = $_method->combo_arr(unserialize(_TARGET_BANNER),_TARGET_DEFAULT_BANNER);

		$txt_url = '';
		$txt_type = _TYPE_DEFAULT_BANNER;
		$rad_type = $_method->radio_array(unserialize(_TYPE_BANNER),'rad_type',$txt_type);
		$txt_script = '';

		$html_library = '';

		// $expired_date = $started_date = date('d - m - Y');
		$expired_date = $started_date = '';

		$txt_sort = $banner_controller->getIndexSort();

		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");
	}

	/* form upload thumb */
	/* $thumb_id : form upload thumb */
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	/* $temp_id : update library */
	$temp_id = $time_tmp;

	$_FILE_LIB = new FILE_LIB();
	$_FILE_LIB->set_folderUpload(_PATH_UPLOAD_BANNER.$thumb_id."/");
	$_FILE_LIB->set_path('../');
	$_FILE_LIB->set_divUpload('fileSlide');
	$_FILE_LIB->set_maxFileUpload(_MAX_IMAGE_SLIDER_BANNER);
	$_FILE_LIB->set_urlFile('slidethumnail_gallery[]');
	$form_upload_slide_thumb = $_FILE_LIB->formUploadMultiFile(_FLAG_BANNER_TITLE,_FLAG_BANNER_INTRO,_FLAG_BANNER_LINK);
	// $form_upload_slide_thumb = $_FILE_LIB->formUploadMultiFile($id,1,1,1); 

?>