<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY.' khong ton tai');
    file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT.' khong ton tai');

    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$_thumb= new thumb();
	$_NODE_CONTENT = unserialize(_NODE_CONTENT);

	$node = $_method->_Get('node','string');
	if (!isset($_NODE_CONTENT[$node])) {
    	$_method->alert($LANG['page_does_not_exist'],_LINK_DASHBOARD);
    	die();
	}

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG[$node];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG[$node];


	/* get submit form */
	$action = $_method->_Post('act_article','string');
	if ($action == 'add_article') {
		/* get post */
		$cbx_cateid = $_method->_Post('cbx_cateid','int');
		$txt_title = $_method->_Post('txt_title','string');
		$txt_urlseo = $_method->_Post('txt_urlseo','string');
		$txt_url = $_method->_Post('txt_url','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		$txt_intro = $_method->_Post('txt_intro','html');
		$txt_content = $_method->_Post('txt_content','html');
		$txt_sort = $_method->_Post('txt_sort','int');
		$txt_type_art = $_method->_Post('txt_type_art','string');
		$txt_publish_date = $_method->_Post('txt_publish_date','string');
		// $txt_publish_date = str_replace('/', '-', $_method->_Post('txt_publish_date','string'));
		if (!$txt_publish_date) {
			$txt_publish_date = 'now';
		}

		/* format */
		$db  = new database();
		$category_controller = new category_controller();
		$cbx_lang = $category_controller->getLangByID($cbx_cateid);
		if(!$cbx_lang){
			$cbx_lang = _LANG_ADMIN_DEFAULT;
		}
		$title_search = $_method->vietConvert($txt_title);
		$code_module = $db->getField($category_controller->getTable(),'code_module','ID',$cbx_cateid);

		/* kiem tra co id thi la update - ko co thi la add */
		$content_controller = new content_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($content_controller->getTable(),'ID');

    		$urlseo_exit = $db->getField($content_controller->getTable(),'ID','urlseo',$txt_urlseo);
			if ($urlseo_exit) $txt_urlseo = $txt_urlseo.'-'.$id;

			$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_ARTICLE,_PATH_UPLOAD_ARTICLE,'file_url');

	    	$data_form=array(
	    		'ID'=>$id,
				'lang'=>$cbx_lang,
				'cateid'=>$cbx_cateid,
				'title'=>$txt_title,
				'title_search'=>$title_search,
				'urlseo'=>$txt_urlseo,
				'url'=>$txt_url,
				't_status'=>$cbx_status,
				'intro'=>$txt_intro,
				'content'=>htmlspecialchars($txt_content,ENT_QUOTES),
				't_index'=>$txt_sort,
				'type_art'=>$txt_type_art,
				"publish_date"=>strtotime($txt_publish_date),
				'imgURL'=>$imgURL,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

    		$urlseo_exit = $db->getField($content_controller->getTable(),'ID','urlseo',$txt_urlseo,' and ID <> '.$id);
			if ($urlseo_exit) $txt_urlseo = $txt_urlseo.'-'.$id;

			$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_ARTICLE,_PATH_UPLOAD_ARTICLE,'file_url');
			
	    	$data_form=array(
				'lang'=>$cbx_lang,
				'cateid'=>$cbx_cateid,
				'title'=>$txt_title,
				'title_search'=>$title_search,
				'urlseo'=>$txt_urlseo,
				'url'=>$txt_url,
				't_status'=>$cbx_status,
				'intro'=>$txt_intro,
				'content'=>htmlspecialchars($txt_content,ENT_QUOTES),
				't_index'=>$txt_sort,
				'type_art'=>$txt_type_art,
				"publish_date"=>strtotime($txt_publish_date),
				'imgURL'=>$imgURL,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$content_controller->setDataForm($data_form);
    	$result = $content_controller->update($id,$action_update);
    	if ($result) {

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
				$metaDescription = trim(htmlspecialchars_decode($txt_intro)).' '.trim(strip_tags(htmlspecialchars_decode($txt_content)));
			$data_form_seo = array(
				'nodeid'=>$content_controller->getID(),
				'title'=> $metaTitle,
				'keywords'=> $metaKeywords,
				'description'=> $metaDescription,
				'code_module'=> $code_module
			);
			$exit_seo = $db->getField($seo_controller->getTable(),'ID','nodeid',$id,' and code_module = "'.$code_module.'" ');
			if (!$exit_seo) $exit_seo = 0;
			$seo_controller->setDataForm($data_form_seo);
	    	$result_seo = $seo_controller->update($exit_seo);
	    	if (!$result_seo) echo 'Error! Update Seo';
    		
    		$_method->alert($LANG['save_successfully'],_LINK_CONTENT_LIST.'&node='.$node);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail content */
	if ($id && $id > 0){
		$db  = new database();
		$category_controller = new category_controller();
		$content_controller = new content_controller();
		$content_controller->setID($id);
		$detail = $content_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_CONTENT_LIST.'&node='.$node);
    		die();
		}

		$lang = $detail->lang;
		$listLang = $category_controller->getListLang();
		$cbxLang = $_method->combo_arr($listLang,$lang);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$txt_title = $detail->title;
		$txt_urlseo = $detail->urlseo;
		$txt_url = $detail->url;
		$txt_intro = $detail->intro;
		$txt_content = htmlspecialchars_decode($detail->content);
		$cbx_cateid = $detail->cateid;
		$txt_sort = $detail->t_index;
		$txt_type_art = $detail->type_art;
		$txt_publish_date = date('d-m-Y',$detail->publish_date);

		$file_url = $detail->imgURL;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->imgURL)){
			$file_url	=	$detail->imgURL;
			if(!preg_match('/http:\/\//i', $file_url, $result) && !preg_match('/https:\/\//i', $file_url, $result)){
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
		$code_module = $db->getField($category_controller->getTable(),'code_module','ID',$cbx_cateid);
		$seo_controller = new seo_controller();
		$seo_controller->setSqlFilter(' and nodeid = '.$id.' and code_module = "'.$code_module.'" ');
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
		$content_controller = new content_controller();
		$category_controller = new category_controller();
		$listLang = $category_controller->getListLang();
		if(!$lang || in_array($lang, unserialize(_LANG_ARR))) $lang = _LANG_ADMIN_DEFAULT;

		$cbxLang = $_method->combo_arr($listLang,_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_CONTENT);

		$txt_sort = $content_controller->getIndexSort();

		$txt_title = '';
		$txt_urlseo = '';
		$txt_url = '';
		$txt_content = '';
		$txt_intro = '';
		$cbx_cateid = 0;
		$txt_type_art = $node;
		$txt_publish_date = date('d/m/Y');
		$file_url = '';
		
		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");

		/* get seo */
		$metaTitle = '';
		$metaKeywords = '';
		$metaDescription = '';
	}

	/* get cbx cate */
	$code_module = "RSCMS";
	$category_controller = new category_controller();
    $root = $category_controller->getRootID_byLang($lang);
    $filter = ' and code_module="'.$code_module.'" and code="'.$_NODE_CONTENT[$node].'" ';
    
    $_tree_cate  = new _tree_struct($category_controller->getTable());
    $arrCate = $_tree_cate->_get_children($root,true,0,$filter);
    $arrStrCate = $category_controller->arrtree_mod($arrCate,$root,_LEVEL_CATE_ADMIN);
	$cbxCategory = $_method->combo_arr($arrStrCate,$cbx_cateid);

	/* form upload thumb */
	$_FILE_LIB = new FILE_LIB();
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	$_FILE_LIB->set_folderUpload(_PATH_UPLOAD_ARTICLE.$thumb_id."/");
	$_FILE_LIB->set_defaultValue($file_url);
	$_FILE_LIB->set_path('../');
	$form_upload_thumb = $_FILE_LIB->showUploadThumb(); 
?>