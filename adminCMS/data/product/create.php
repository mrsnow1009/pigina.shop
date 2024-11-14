<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY.' khong ton tai');
    file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT):die(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT.' khong ton tai');
	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY.' khong ton tai');

    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');


	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$_thumb = new thumb();
	$db = new database();

    /* set - tieu de trang web */
    $page_title = $LANG['add-product'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-product'];

	/* get request in link */
	$lang = $_method->_Get('lang','string');

	/* get submit form */
	$action = $_method->_Post('act_product','string');
	if ($action == 'add_product') {
		/* get post */
		$cbx_cateid = $_method->_Post('cbx_cateid','int');
		$txt_title = $_method->_Post('txt_title','string');
		$txt_urlseo = $_method->_Post('txt_urlseo','string');
		$txt_url = $_method->_Post('txt_url','string');
		$txt_code = $_method->_Post('txt_code','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		$cbx_unit = $_method->_Post('cbx_unit','int');
		$cbx_brand = $_method->_Post('cbx_brand','int');
		$txt_intro = $_method->_Post('txt_intro','html');
		$txt_content = $_method->_Post('txt_content','html');
		$txt_sort = $_method->_Post('txt_sort','int');
		$txt_publish_date = $_method->_Post('txt_publish_date','string');
		if (!$txt_publish_date) {
			$txt_publish_date = 'now';
		}

		$txt_price = $_method->_Post('txt_price','string');
		$txt_price = (float)$txt_price;

		$txt_reduced_price = $_method->_Post('txt_reduced_price','string');
		if ($txt_reduced_price === '') {
			$txt_reduced_price = $txt_price;
		}else{
			$txt_reduced_price = (float)$txt_reduced_price;
		}

		/* format */
		$category_controller = new category_controller();
		$cbx_lang = $category_controller->getLangByID($cbx_cateid);
		if(!$cbx_lang){
			$cbx_lang = _LANG_ADMIN_DEFAULT;
		}
		$title_search = $_method->vietConvert($txt_title);
		$code_module = $db->getField($category_controller->getTable(),'code_module','ID',$cbx_cateid);


		/* kiem tra co id thi la update - ko co thi la add */
		$product_controller = new product_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($product_controller->getTable(),'ID');

    		if ($txt_code == '') $txt_code = $product_controller->createCode(array(_PREFIX_PRODUCT_CODE,substr($cbx_lang,0,1),$id));
    		$code_exit = $db->getField($product_controller->getTable(),'ID','code',$txt_code);
			if ($code_exit) $txt_code = $txt_code.'-'.$id;

    		$urlseo_exit = $db->getField($product_controller->getTable(),'ID','urlseo',$txt_urlseo);
			if ($urlseo_exit) $txt_urlseo = $txt_urlseo.'-'.$id;

			$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_PRODUCT,_PATH_UPLOAD_PRODUCT,'file_url');

	    	$data_form=array(
	    		'ID'=>$id,
	    		'code'=>$txt_code,
				'lang'=>$cbx_lang,
				'cateid'=>$cbx_cateid,
				'title'=>$txt_title,
				'title_search'=>$title_search,
				'urlseo'=>$txt_urlseo,
				'url'=>$txt_url,
				't_status'=>$cbx_status,
				'introduction'=>$txt_intro,
				'content'=>htmlspecialchars($txt_content,ENT_QUOTES),
				't_index'=>$txt_sort,
				"publish_date"=>strtotime($txt_publish_date),
				'price'=>$txt_price,
				'reduced_price'=>$txt_reduced_price,
				'unit_id'=>$cbx_unit,
				'brand_id'=>$cbx_brand,
				'imgURL'=>$imgURL,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

    		if ($txt_code == '') $txt_code = $product_controller->createCode(array(_PREFIX_PRODUCT_CODE,substr($cbx_lang,0,1),$id));
    		$code_exit = $db->getField($product_controller->getTable(),'ID','code',$txt_code,' and ID <> '.$id.' ');
			if ($code_exit) $txt_code = $txt_code.'-'.$id;

    		$urlseo_exit = $db->getField($product_controller->getTable(),'ID','urlseo',$txt_urlseo,' and ID <> '.$id);
			if ($urlseo_exit) $txt_urlseo = $txt_urlseo.'-'.$id;

			$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_PRODUCT,_PATH_UPLOAD_PRODUCT,'file_url');

	    	$data_form=array(
	    		'code'=>$txt_code,
				'lang'=>$cbx_lang,
				'cateid'=>$cbx_cateid,
				'title'=>$txt_title,
				'title_search'=>$title_search,
				'urlseo'=>$txt_urlseo,
				'url'=>$txt_url,
				't_status'=>$cbx_status,
				'introduction'=>$txt_intro,
				'content'=>htmlspecialchars($txt_content,ENT_QUOTES),
				't_index'=>$txt_sort,
				"publish_date"=>strtotime($txt_publish_date),
				'price'=>$txt_price,
				'reduced_price'=>$txt_reduced_price,
				'unit_id'=>$cbx_unit,
				'brand_id'=>$cbx_brand,
				'imgURL'=>$imgURL,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$product_controller->setDataForm($data_form);
    	$result = $product_controller->update($id,$action_update);

    	/* update slide */
    	$hdact = $_method->_Post('hdact','string');
		$temp_id = $_method->_Post('temp_id','int');
    	if($hdact == 'add_store_gallery'){
			$_library_controller = new library_controller();
			$_library_controller->setNodeID($product_controller->getID());
			$_library_controller->setPathUpload(_PATH_UPLOAD_PRODUCT_SLIDER);
			$_library_controller->setThumbArr(unserialize(_ARR_SIZE_SLIDER_PRODUCT));
			$_library_controller->setThumbIndex(_SLIDE_INDEX_PRODUCT);
			$_library_controller->updateForm($product_controller->getCodeModule(),$temp_id);
    	}

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
				'nodeid'=>$product_controller->getID(),
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
    		
    		$_method->alert($LANG['save_successfully'],_LINK_PRODUCT_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail product */
	if ($id && $id > 0){
		$category_controller = new category_controller();
		$product_controller = new product_controller();
		$product_controller->setID($id);
		$detail = $product_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_PRODUCT_LIST);
    		die();
		}

		$lang = $detail->lang;
		$listLang = $category_controller->getListLang();
		$cbxLang = $_method->combo_arr($listLang,$lang);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$txt_title = $detail->title;
		$txt_urlseo = $detail->urlseo;
		$txt_url = $detail->url;
		$txt_intro = $detail->introduction;
		$txt_content = htmlspecialchars_decode($detail->content);
		$txt_code = $detail->code;
		$cbx_cateid = $detail->cateid;
		$cbx_unit = $detail->unit_id;
		$cbx_brand = $detail->brand_id;
		$txt_sort = $detail->t_index;
		$txt_publish_date = date('d-m-Y',$detail->publish_date);

 		$txt_price = $_method->formatCurrency($detail->price);
		$txt_price_temp = $_method->showCurrency($detail->price,_CURRENCY); 

 		$txt_reduced_price = $_method->formatCurrency($detail->reduced_price);
		$txt_reduced_price_temp = $_method->showCurrency($detail->reduced_price,_CURRENCY);

		$file_url = $detail->imgURL;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->imgURL)){
			$file_url	=	$detail->imgURL;
			if(!preg_match('/http:\/\//i', $file_url, $result) && !preg_match('/https:\/\//i', $file_url, $result) && $file_url!=""){
				$file_url=_ROOT_PATH_WEBSITE."/".$file_url;
			}
		}

		/* start: get list image slide */
		$_library_controller = new library_controller();
		$_library_controller->setSqlFilter(' and nodeid = '.$id);
		$_library_controller->setSqlSort(' order by t_index asc ');
		$list_library = $_library_controller->getList();
		$html_library = $_library_controller->getList_html($list_library,_FLAG_PRODUCT_TITLE,_FLAG_PRODUCT_INTRO,_FLAG_PRODUCT_LINK,'slidethumnail_gallery[]');
		/* end: get list image slide */

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
		$product_controller = new product_controller();
		$category_controller = new category_controller();
		$listLang = $category_controller->getListLang();
		if(!$lang || in_array($lang, unserialize(_LANG_ARR))) $lang = _LANG_ADMIN_DEFAULT;

		$cbxLang = $_method->combo_arr($listLang,_LANG_ADMIN_DEFAULT);
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_PRODUCT);

		$txt_sort = $product_controller->getIndexSort();

		$txt_title = '';
		$txt_urlseo = '';
		$txt_url = '';
		$txt_content = '';
		$txt_intro = '';
		$txt_code = '';
		$cbx_cateid = 0;
		$cbx_unit = 0;
		$cbx_brand = 0;
		$txt_publish_date = date('d-m-Y');
		$txt_price = '';
		$txt_price_temp = '';
		$txt_reduced_price = '';
		$txt_reduced_price_temp = '';
		$file_url = '';
		$html_library = '';
		
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
    $filter = ' and code_module="RSPRODUCT" ';
    
    $_tree_cate  = new _tree_struct($category_controller->getTable());
    $arrCate = $_tree_cate->_get_children($root,true,0,$filter);
    $arrStrCate = $category_controller->arrtree_mod($arrCate,$root,_LEVEL_CATE_ADMIN);
	$cbxCategory = $_method->combo_arr($arrStrCate,$cbx_cateid);

	/* get cbx unit */
	$arrUnit = $db->getArrFieldID("select ID,title_vn from ".TBLUNIT." where 1 order by `title_vn` ASC ",array('ID','title_vn'));
	$cbxUnit = $_method->combo_arr($arrUnit,$cbx_unit);

	/* get cbx brand */
	$arrBrand = $db->getArrFieldID("select ID,title from ".TBLBRAND." where 1 order by `title` ASC ",array('ID','title'));
	$cbxBrand = $_method->combo_arr($arrBrand,$cbx_brand);

	/* form upload thumb */
	$_FILE_LIB = new FILE_LIB();
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	$_FILE_LIB->set_folderUpload(_PATH_UPLOAD_PRODUCT.$thumb_id."/");
	$_FILE_LIB->set_defaultValue($file_url);
	$_FILE_LIB->set_path('../');
	$form_upload_thumb = $_FILE_LIB->showUploadThumb(); 

	/* form upload slider */
	/* $temp_id : update library */
	$temp_id = $time_tmp;

	$_FILE_LIB = new FILE_LIB();
	$_FILE_LIB->set_folderUpload(_PATH_UPLOAD_PRODUCT_SLIDER.$thumb_id.'/');
	$_FILE_LIB->set_path('../');
	$_FILE_LIB->set_divUpload('fileSlide');
	$_FILE_LIB->set_maxFileUpload(_MAX_IMAGE_SLIDER_PRODUCT);
	$_FILE_LIB->set_urlFile('slidethumnail_gallery[]');
	$form_upload_slide_thumb = $_FILE_LIB->formUploadMultiFile(_FLAG_PRODUCT_TITLE,_FLAG_PRODUCT_INTRO,_FLAG_PRODUCT_LINK);

	/* id check exit */
	$check_id = $_method->_Get('id','int');
	if(!$check_id) $check_id = 0;
?>