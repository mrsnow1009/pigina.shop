<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET.' khong ton tai');
    file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$_thumb= new thumb();
	$db  = new database();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add-widget-box'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update-widget-box'];
	else{
		$_method->alert($LANG['page_does_not_exist'],_LINK_WIDGET_BOX_LIST);
		die();
	}

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		_LINK_BRAND_LIST.'&lang='._LANG_ADMIN_DEFAULT => $LANG['list-widget-box'],
		'javascript:;' => $page_title,
	)));

	/* get submit form */
	$action = $_method->_Post('act_widget_box','string');
	if ($action == 'add_widget_box') {
		/* get post */
		$txt_w_name = $_method->_Post('txt_w_name','string');
		$cbx_status = $_method->_Post('cbx_status','int');
		$txt_title = $_method->_Post('txt_title','string');
		$txt_position = $_method->_Post('txt_position','string');
		$txt_intro = $_method->_Post('txt_intro','string');
		$txt_content = $_method->_Post('txt_content','html');
		$txt_link_1 = $_method->_Post('txt_link_1','string');
		$txt_link_2 = $_method->_Post('txt_link_2','string');

		$imgURL = $_thumb->updateImages($id,_ARR_SIZE_THUMB_WIDGET,_PATH_UPLOAD_WIDGET,'file_url','/');
		$imgURL_bg = $_thumb->updateImages($id,_ARR_SIZE_THUMB_WIDGET_BG,_PATH_UPLOAD_WIDGET,'file_url_bg','bg/');

		/* list_id */
		$w_max_item = $db->getField(TBLWIDGET,'w_max_item','ID',$id);
		$arr_item = array();
		if ($w_max_item > 0) {
			$item_id_arr = $_method->_Post('item_id','array');
			$item_qty_arr = $_method->_Post('item_qty','array');
			if (is_array($item_id_arr) && is_array($item_qty_arr)) {

				/* 0. get array: Lay 2 mang item va so thu tu */
				// print_r($item_id_arr);echo '<br>';
				// print_r($item_qty_arr);echo '<br>';echo '<br>';

				/* 1. reverse: dao nguoc 2 mang. buoc tu 1 den 4 la de lay uu tien object xuat hien truoc nhat */
				$item_id_arr = array_reverse($item_id_arr);
				$item_qty_arr = array_reverse($item_qty_arr);
				// echo 'reverse';echo '<br>';
				// print_r($item_id_arr);echo '<br>';
				// print_r($item_qty_arr);echo '<br>';echo '<br>';

				/* 2. combine: gop 2 mang voi nhau, key nao xuat hien sau se duoc uu tien, remove double object */
				$array_combine = array_combine($item_id_arr,$item_qty_arr);
				// echo 'combine';echo '<br>';
				// print_r($array_combine);echo '<br>';echo '<br>';

				/* 3. split key - value: tach thanh 2 mang item va so thu tu */
				$item_id_arr = array_keys($array_combine);
				$item_qty_arr = array_values($array_combine);
				// echo 'split key - value';echo '<br>';
				// print_r($item_id_arr);echo '<br>';
				// print_r($item_qty_arr);echo '<br>';echo '<br>';

				/* 4. reverse: dao nguoc 2 mang. */
				$item_id_arr = array_reverse($item_id_arr);
				$item_qty_arr = array_reverse($item_qty_arr);
				// echo 'reverse';echo '<br>';
				// print_r($item_id_arr);echo '<br>';
				// print_r($item_qty_arr);echo '<br>';echo '<br>';

				/* 5. combine: gop 2 mang voi nhau, remove double object */
				$array_combine = array_combine($item_id_arr,$item_qty_arr);
				// echo 'combine';echo '<br>';
				// print_r($array_combine);echo '<br>';echo '<br>';

				/* 6. asort: sap xem value theo thu tu tang dan */
				asort($array_combine,SORT_NUMERIC);
				// echo 'asort';echo '<br>';
				// print_r($array_combine);echo '<br>';echo '<br>';

				/* 7. get key: lay mang key la cac object */
				$arr_item = array_keys($array_combine);
				// echo 'get key';echo '<br>';
				// print_r($arr_item);echo '<br>';echo '<br>';

				/* 8. remove empty: xoa cac gia tri empty */
				$arr_item = array_filter($arr_item);
				// echo 'remove empty';echo '<br>';
				// print_r($arr_item);echo '<br>';echo '<br>';

				/* 9.remove double */
				// $arr_item = array_unique($arr_item);
				// echo 'remove double';echo '<br>';
				// print_r($arr_item);echo '<br>';echo '<br>';
			}
		}
		$arr_item_str = implode('@', $arr_item);

		/* kiem tra co id thi la update - ko co thi la add */
		$widget_controller = new widget_controller();
    	$data_form=array(
			'w_name'=>$txt_w_name,
			't_status'=>$cbx_status,
			'title'=>$txt_title,
			'position'=>$txt_position,
			'intro'=>$txt_intro,
			'content'=>htmlspecialchars($txt_content,ENT_QUOTES),
			'link_1'=>$txt_link_1,
			'link_2'=>$txt_link_2,
			'imgURL'=>$imgURL,
			'imgURL_bg'=>$imgURL_bg,
			'item_id'=>$arr_item_str,

	        "updated_date"=>strtotime("now"),
			"updated_by"=>$Session->get("webmtId")
		);
		$widget_controller->setDataForm($data_form);

    	$result = $widget_controller->update($id,'update');
    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_WIDGET_BOX_CREATE.'&id='.$id);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail delivery method */
	$widget_controller = new widget_controller();
	$widget_controller->setID($id);
	$detail = $widget_controller->getDetail();
	if (!$detail) {
		$_method->alert($LANG['page_does_not_exist'],_LINK_WIDGET_BOX_LIST);
		die();
	}

	$cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),$detail->t_status);

	$txt_w_name = $detail->w_name;
	$txt_title = $detail->title;
	$txt_intro = $detail->intro;
	$txt_content = htmlspecialchars_decode($detail->content);
	$txt_position = $detail->position;
	$txt_link_1 = $detail->link_1;
	$txt_link_2 = $detail->link_2;

	$file_url = $detail->imgURL;
	if(is_file(_PHISICAL_PATH_ROOT.$detail->imgURL)){
		$file_url = $detail->imgURL;
		if(!preg_match('/http:\/\//i', $file_url, $result) && !preg_match('/https:\/\//i', $file_url, $result)){
			$file_url = _ROOT_PATH_WEBSITE."/".$file_url;
		}
	}

	$file_url_bg = $detail->imgURL_bg;
	if(is_file(_PHISICAL_PATH_ROOT.$detail->imgURL_bg)){
		$file_url_bg = $detail->imgURL_bg;
		if(!preg_match('/http:\/\//i', $file_url_bg, $result) && !preg_match('/https:\/\//i', $file_url_bg, $result)){
			$file_url_bg = _ROOT_PATH_WEBSITE."/".$file_url_bg;
		}
	}

	$created_date = date('d - m - Y | H:i:s',$detail->created_date);
	$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
	if ($detail->created_by) $created_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->created_by);
	else $created_by = '';
	$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	/* form upload thumb */
	$time_tmp = time();
	$thumb_id = $id;
	if (!$id || $id == 0) {
		$thumb_id = $time_tmp;
	}else{
		$time_tmp = 0;
	}
	/* imgURL */
	$_FILE_LIB_imgURL = new FILE_LIB();
	$_FILE_LIB_imgURL->set_folderUpload(_PATH_UPLOAD_WIDGET.$thumb_id."/");
	$_FILE_LIB_imgURL->set_defaultValue($file_url);
	$_FILE_LIB_imgURL->set_path('../');
	$form_upload_thumb = $_FILE_LIB_imgURL->showUploadThumb(); 
	/* imgURL_bg */
	$_FILE_LIB_imgURL_bg = new FILE_LIB();
	$_FILE_LIB_imgURL_bg->set_folderUpload(_PATH_UPLOAD_WIDGET.$thumb_id."/bg/");
	$_FILE_LIB_imgURL_bg->set_defaultValue($file_url_bg);
	$_FILE_LIB_imgURL_bg->set_path('../');
	$_FILE_LIB_imgURL_bg->set_urlFile('file_url_bg');
	$_FILE_LIB_imgURL_bg->set_divUpload('fileUpload_bg');
	$form_upload_thumb_bg = $_FILE_LIB_imgURL_bg->showUploadThumb(); 

	/* list item */
	$_ARR_MODULE_TABLE = unserialize(_ARR_MODULE_TABLE);
	$w_max_item = $detail->w_max_item;
	$module_code = $detail->module_code;
	$w_filter_sql = $detail->w_filter_sql;
	$w_type = $detail->w_type;
	$w_code = $detail->w_code;

	$item_id_arr = explode("@", $detail->item_id);

	if ($w_type) {
		switch ($w_type) {
			case 'category':
				$list_item_sql = 'select ID, title
					from '.TBLCATEGORY.'
					where 1
					and code_module = "'.$module_code.'"
					and `level` > 2
					'.$w_filter_sql.'
					order by ID asc';
				break;
			
			default:
				$list_item_sql = 'select ID, title
					from '.$_ARR_MODULE_TABLE[$module_code].'
					where 1
					'.html_entity_decode($w_filter_sql).'
					order by created_date desc';
				break;
		}
		$arr_item = $db->getArrFieldID($list_item_sql,array('ID','title'));

		$tbody_widget = '';
		if ($w_max_item && $w_max_item > 0) {
			for ($i=0; $i < $w_max_item; $i++) { 

				$stt = $i + 1;
				if(!isset($item_id_arr[$i]) || !$item_id_arr[$i]){
					$item_id = 0;
				}else{
					$item_id = $item_id_arr[$i];
				}
				$tbody_widget .= '
					<tr>
						<td class="text-center">'.$stt.'</td>
						<td>
							<select name="item_id[]" class="form-control cbx_select2">
								<option value="0">'.$LANG['choose'].'</option>
							   	'.$_method->combo_arr($arr_item,$item_id).'
							</select>
						</td>
						<td><input type="number" name="item_qty[]" class="form-control text-center" value="'.$stt.'" /></td>
					</tr>';
			}
		}
	}



?>