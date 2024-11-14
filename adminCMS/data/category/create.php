<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY.' khong ton tai');
    file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO.' khong ton tai');

    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$_thumb= new thumb();
	$_NODE_MODULE = unserialize(_NODE_MODULE);

    /* set - tieu de trang web */
    $page_title = $LANG['create-category'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-category'];

	/* get request in link */
	$lang = $_method->_Get('lang','string');

	$node = $_method->_Get('node','string');
	if (!isset($_NODE_MODULE[$node])) {
		$_method->alert($LANG['page_does_not_exist'],_LINK_DASHBOARD);
    	die();
	}


	/* get submit form */
	$action = $_method->_Post('act_cate','string');
	if ($action == 'add_cate') {
		/* get post */
		// $cbx_lang = $_method->_Post('cbx_lang','string');
		$cbx_parentid = $_method->_Post('cbx_parentid','int');
		$txt_title = $_method->_Post('txt_title','string');
		$txt_urlseo = $_method->_Post('txt_urlseo','string');
		$txt_url = $_method->_Post('txt_url','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		// $txt_intro = $_method->_Post('txt_intro','html');
		$txt_content = $_method->_Post('txt_content','html');
		$checkMenu = $_method->_Post('checkMenu','array');
		$txt_sort = $_method->_Post('txt_sort','int');

		/* format */
		$db  = new database();
		$category_controller = new category_controller();
		$cbx_lang = $category_controller->getLangByID($cbx_parentid);
		if(!$cbx_lang){
			$cbx_lang = _LANG_ADMIN_DEFAULT;
		}
		$title_search = $_method->vietConvert($txt_title);
		$code = $db->getField($category_controller->getTable(),'code','ID',$cbx_parentid);
		$code_module = $db->getField($category_controller->getTable(),'code_module','ID',$cbx_parentid);
		if($checkMenu) $checkMenu = implode(",",$checkMenu);
		else $checkMenu = '';

		/* kiem tra co id thi la update - ko co thi la add */
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($category_controller->getTable(),'ID');

    		$urlseo_exit = $db->getField($category_controller->getTable(),'ID','urlseo',$txt_urlseo);
			if ($urlseo_exit) $txt_urlseo = $txt_urlseo.'-'.$id;

			$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_CATEGORY,_PATH_UPLOAD_CATEGORY,'file_url');

	    	$data_form=array(
	    		'ID'=>$id,
				'code'=>$code,
				'code_module'=>$code_module,
				'lang'=>$cbx_lang,
				'parent_id'=>$cbx_parentid,
				'title'=>$txt_title,
				'title_search'=>$title_search,
				'urlseo'=>$txt_urlseo,
				'url'=>$txt_url,
				't_status'=>$cbx_status,
				// 'intro'=>$txt_intro,
				'description'=>htmlspecialchars($txt_content,ENT_QUOTES),
				'menu'=>$checkMenu,
				'position'=>$txt_sort,
				'imgURL'=>$imgURL,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

    		$urlseo_exit = $db->getField($category_controller->getTable(),'ID','urlseo',$txt_urlseo,' and ID <> '.$id);
			if ($urlseo_exit) $txt_urlseo = $txt_urlseo.'-'.$id;

			$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_CATEGORY,_PATH_UPLOAD_CATEGORY,'file_url');

	    	$data_form=array(
				'lang'=>$cbx_lang,
				'parent_id'=>$cbx_parentid,
				'title'=>$txt_title,
				'title_search'=>$title_search,
				'urlseo'=>$txt_urlseo,
				'url'=>$txt_url,
				't_status'=>$cbx_status,
				// 'intro'=>$txt_intro,
				'description'=>htmlspecialchars($txt_content,ENT_QUOTES),
				'menu'=>$checkMenu,
				'position'=>$txt_sort,
				'imgURL'=>$imgURL,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		// $category_controller->setID($id);
		$category_controller->setDataForm($data_form);
    	$result = $category_controller->update($id,$action_update);
    	if ($result) {
    		/* update left right */
	    	$jstree = new json_tree();
			$jstree->_reconstruct();

			/* update seo */
			$seo_controller = new seo_controller();
			$metaTitle = $_method->_Post('metaTitle','string');
			$metaKeywords = $_method->_Post('metaKeywords','string');
			$metaDescription = $_method->_Post('metaDescription','string');
			if ($metaTitle == '') 
				$metaTitle = $txt_title;
			if ($metaKeywords == '') 
				$metaKeywords = strtolower($txt_title).', '.strtolower($_method->vietConvert($txt_title));
			if ($metaDescription == '') 
				$metaDescription = trim(strip_tags(htmlspecialchars_decode($txt_content)));
			$data_form_seo = array(
				'nodeid'=>$category_controller->getID(),
				'title'=> $metaTitle,
				'keywords'=> $metaKeywords,
				'description'=> $metaDescription,
				'code_module'=> 'RSCATEGORY'
			);
			$exit_seo = $db->getField($seo_controller->getTable(),'ID','nodeid',$id,' and code_module = "RSCATEGORY" ');
			if (!$exit_seo) $exit_seo = 0;
			$seo_controller->setDataForm($data_form_seo);
	    	$result_seo = $seo_controller->update($exit_seo);
	    	if (!$result_seo) echo 'Error! Update Seo';
    		
    		$_method->alert($LANG['save_successfully'],_LINK_CATEGORY_LIST.'&node='.$node);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail category */
	if ($id && $id > 0){
		$db  = new database();
		$category_controller = new category_controller();
		$category_controller->setID($id);
		$detail = $category_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_CATEGORY_LIST.'&node='.$node);
    		die();
		}

		$lang = $detail->lang;
		$listLang = $category_controller->getListLang();
		$cbxLang = $_method->combo_arr($listLang,$lang);

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$menu = explode(',', $detail->menu);
		$checkMenu = $_method->checkbox_array(unserialize(_ARR_MENU_CONFIG),'checkMenu',$menu,0);

		$txt_title = $detail->title;
		$txt_urlseo = $detail->urlseo;
		$txt_url = $detail->url;
		$txt_content = htmlspecialchars_decode($detail->description);
		$cbx_parentid = $detail->parent_id;
		$txt_sort = $detail->position;
		
		$file_url = $detail->imgURL;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->imgURL)){
			$file_url	=	$detail->imgURL;
			if(!preg_match('/http:\/\//i', $file_url, $result) && !preg_match('/https:\/\//i', $file_url, $result) && $file_url!=""){
				$file_url=_ROOT_PATH_WEBSITE."/".$file_url;
			}
		}

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);

		// file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER.' khong ton tai');
		// $webmaster_controller = new webmaster_controller();
		// $created_by = $db->getField($webmaster_controller->getTable(),'fullname','ID',$detail->created_by);
		// $updated_by = $db->getField($webmaster_controller->getTable(),'fullname','ID',$detail->updated_by);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);


		/* get seo */
		$seo_controller = new seo_controller();
		$seo_controller->setSqlFilter(' and nodeid = '.$id.' and code_module = "RSCATEGORY" ');
		$seo_detail = $seo_controller->getDetail();
		if ($seo_detail) {
			$metaTitle = $seo_detail->title;
			$metaKeywords = $seo_detail->keywords;
			$metaDescription = $seo_detail->description;
		}else{
			$metaTitle = '';
			$metaKeywords = '';
			$metaDescription = '';
		}

	}else{
		$category_controller = new category_controller();
		$listLang = $category_controller->getListLang();
		if(!$lang || in_array($lang, unserialize(_LANG_ARR))) $lang = _LANG_ADMIN_DEFAULT;

		$cbxLang = $_method->combo_arr($listLang,_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_CATEGORY);
		$checkMenu = $_method->checkbox_array(unserialize(_ARR_MENU_CONFIG),'checkMenu',array(),0);

		$txt_sort = $category_controller->getIndexSort();

		$txt_title = '';
		$txt_urlseo = '';
		$txt_url = '';
		$txt_content = '';
		$cbx_parentid = 0;
		$file_url = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

		/* get seo */
		$metaTitle = '';
		$metaKeywords = '';
		$metaDescription = '';
	}

	/* get cbx cate */
	$category_controller = new category_controller();
    $root = $category_controller->getRootID_byLang($lang);
    $filter = ' and code_module="'.$_NODE_MODULE[$node].'" ';
    
    $_tree_cate  = new _tree_struct($category_controller->getTable());
    $arrCate = $_tree_cate->_get_children($root,true,0,$filter);
    $arrStrCate = $category_controller->arrtree_mod($arrCate,$root,_LEVEL_CATE_ADMIN);
    if (!$id || $id == 0) {
    	$arr_disable = array();
    }else{
		$arr_disable = $category_controller->getChildrentoID($id);
	}
    $cbxCategory = $_method->combo_arr_with_disabled($arrStrCate,$cbx_parentid,$arr_disable);	

    /* form upload thumb */
	$_FILE_LIB = new FILE_LIB();
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	$_FILE_LIB->set_folderUpload(_PATH_UPLOAD_CATEGORY.$thumb_id."/");
	$_FILE_LIB->set_defaultValue($file_url);
	$_FILE_LIB->set_path('../');
	$form_upload_thumb = $_FILE_LIB->showUploadThumb(); 
?>