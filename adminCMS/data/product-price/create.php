<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT_PRICE)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT_PRICE):die(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT_PRICE.' khong ton tai');

    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$_thumb = new thumb();
	$db = new database();

    /* set - tieu de trang web */
    $page_title = $LANG['add-product-price'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-product-price'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_PRODUCT_PRICE_LIST => $LANG['list-product-price'],
		'javascript:;' => $page_title,
	)));

	/* get request in link */
	$lang = $_method->_Get('lang','string');

	/* get submit form */
	$action = $_method->_Post('act_product_price','string');
	if ($action == 'add_product_price') {
		/* get post */
		$txt_title = $_method->_Post('txt_title','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		$cbx_product = $_method->_Post('cbx_product','int');
		$cbx_color = $_method->_Post('cbx_color','int');
		$cbx_size = $_method->_Post('cbx_size','int');

		$txt_price = $_method->_Post('txt_price','string');
		$txt_price = (float)$txt_price;

		$txt_reduced_price = $_method->_Post('txt_reduced_price','string');
		if ($txt_reduced_price === '') {
			$txt_reduced_price = $txt_price;
		}else{
			$txt_reduced_price = (float)$txt_reduced_price;
		}

		/* kiem tra co id thi la update - ko co thi la add */
		$product_price_controller = new product_price_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($product_price_controller->getTable(),'ID');

    		$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_PRODUCT_VERSION,_PATH_UPLOAD_PRODUCT_VERSION,'file_url');

	    	$data_form=array(
	    		'ID'=>$id,
				't_status'=>$cbx_status,
				'product_id'=>$cbx_product,
				'color_id'=>$cbx_color,
				'size_id'=>$cbx_size,
				'title'=>$txt_title,
				'price'=>$txt_price,
				'reduced_price'=>$txt_reduced_price,
				'imgURL'=>$txt_imgURL,

				"created_date"=>strtotime("now"),
		        "updated_date"=>strtotime("now"),
				"created_by"=>$Session->get("webmtId"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

    		$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_PRODUCT_VERSION,_PATH_UPLOAD_PRODUCT_VERSION,'file_url');

	    	$data_form=array(
				't_status'=>$cbx_status,
				'product_id'=>$cbx_product,
				'color_id'=>$cbx_color,
				'size_id'=>$cbx_size,
				'title'=>$txt_title,
				'price'=>$txt_price,
				'reduced_price'=>$txt_reduced_price,
				'imgURL'=>$imgURL,

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$product_price_controller->setDataForm($data_form);
    	$result = $product_price_controller->update($id,$action_update);

    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_PRODUCT_PRICE_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail product */
	if ($id && $id > 0){
		$product_price_controller = new product_price_controller();
		$product_price_controller->setID($id);
		$detail = $product_price_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_PRODUCT_PRICE_LIST);
    		die();
		}

		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

		$cbx_product = $detail->product_id;
		$cbx_color = $detail->color_id;
		$cbx_size = $detail->size_id;
		$txt_title = $detail->title;

		$file_url = $detail->imgURL;
		if(is_file(_PHISICAL_PATH_ROOT.$detail->imgURL)){
			$file_url	=	$detail->imgURL;
			if(!preg_match('/http:\/\//i', $file_url, $result) && !preg_match('/https:\/\//i', $file_url, $result) && $file_url!=""){
				$file_url=_ROOT_PATH_WEBSITE."/".$file_url;
			}
		}

 		$txt_price = $_method->formatCurrency($detail->price);
		$txt_price_temp = $_method->showCurrency($detail->price,_CURRENCY); 

 		$txt_reduced_price = $_method->formatCurrency($detail->reduced_price);
		$txt_reduced_price_temp = $_method->showCurrency($detail->reduced_price,_CURRENCY);

		$created_date = date('d - m - Y | H:i:s',$detail->created_date);
		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);


	}else{
		$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_PRODUCT_PRICE);

		$cbx_product = 0;
		$cbx_color = 0;
		$cbx_size = 0;
		$txt_title = '';
		$file_url = '';

		$txt_price = '';
		$txt_price_temp = '';
		$txt_reduced_price = '';
		$txt_reduced_price_temp = '';

		$created_date = $updated_date = date('d - m - Y | H:i:s');
		$created_by = $updated_by = $Session->get("webmt_fullname");
	}

	/* get cbx product */
	$arrProduct = $db->getArrFieldID("select ID,CONCAT(code,' - ',title) as name from ".TBLPRODUCT." where 1 and t_status=1 order by `code` ASC ",array('ID','name'));
	$cbxProduct = $_method->combo_arr($arrProduct,$cbx_product);

	/* get cbx color */
	$arrColor = $db->getArrFieldID("select ID,title_vn from ".TBLCOLOR." where 1 and t_status=1 order by `title_vn` ASC ",array('ID','title_vn'));
	$cbxColor = $_method->combo_arr($arrColor,$cbx_color);

	/* get cbx size */
	$arrSize = $db->getArrFieldID("select ID,title_vn from ".TBLSIZE." where 1 and t_status=1 order by `title_vn` ASC ",array('ID','title_vn'));
	$cbxSize = $_method->combo_arr($arrSize,$cbx_size);

	/* form upload thumb */
	$_FILE_LIB = new FILE_LIB();
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	$_FILE_LIB->set_folderUpload(_PATH_UPLOAD_PRODUCT_VERSION.$thumb_id."/");
	$_FILE_LIB->set_defaultValue($file_url);
	$_FILE_LIB->set_path('../');
	$form_upload_thumb = $_FILE_LIB->showUploadThumb(); 

?>