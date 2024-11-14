<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE):die(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");
    $webmaster_fullname = $Session->get("webmt_fullname");

	$_method = new method();

	/* get request in link */
	$lang = $_method->_Get('lang','string');

    /* set - tieu de trang web */
    $page_title = $LANG['add'].' '.$LANG['template'];
	$id = $_method->_Get('id','int');
	if($id && $id > 0) $page_title = $LANG['update'].' '.$LANG['template'];

	/* get submit form */
	$action = $_method->_Post('act_template','string');
	if ($action == 'add_template') {
		/* get post */
		$txt_name = $_method->_Post('txt_name','string');
		$txt_title = $_method->_Post('txt_title','string');
		$txt_content = $_method->_Post('txt_content','html');

		/* kiem tra co id thi la update - ko co thi la add */
		$template_controller = new template_controller();
    	if (!$id) {
    		$action_update = 'create';
    		$id = $db->getMaxID($template_controller->getTable(),'ID');

	    	$data_form=array(
	    		'ID'=>$id,
				'name'=>$txt_name,
				'title'=>$txt_title,
				'content'=>htmlspecialchars($txt_content,ENT_QUOTES),

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}else{
    		$action_update = 'update';

	    	$data_form=array(
				'name'=>$txt_name,
				'title'=>$txt_title,
				'content'=>htmlspecialchars($txt_content,ENT_QUOTES),

		        "updated_date"=>strtotime("now"),
				"updated_by"=>$Session->get("webmtId")
			);
    	}
		$template_controller->setDataForm($data_form);
    	$result = $template_controller->update($id,$action_update);
    	if ($result) {
    		$_method->alert($LANG['save_successfully'],_LINK_TEMPLATE_LIST);
    		die();
    	}else{
    		$_method->alert($LANG['error_try_again']);
    	}
	}

	/* get detail template */
	if ($id && $id > 0){
		$db  = new database();
		$template_controller = new template_controller();
		$template_controller->setID($id);
		$detail = $template_controller->getDetail();
		if (!$detail) {
			$_method->alert($LANG['page_does_not_exist'],_LINK_TEMPLATE_LIST);
    		die();
		}

		$txt_lang = $detail->lang;
		$cbx_code = $detail->code;
		$cbx_group = $detail->t_group;
		$cbx_mask = $detail->mask;
		$txt_name = $detail->name;
		$txt_title = $detail->title;
		$txt_content = htmlspecialchars_decode($detail->content);

		$updated_date = date('d - m - Y | H:i:s',$detail->updated_date);
		$updated_by = $db->getField(TBLWEBMASTER,'fullname','ID',$detail->updated_by);

	}else{
		$_method->alert($LANG['page_does_not_exist'],_LINK_TEMPLATE_LIST);
    	die();
		// $template_controller = new template_controller();

		// $cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS),_STATUS_DEFAULT_template);

		// $txt_sort = $template_controller->getIndexSort();

		// $txt_title_vn = '';
		// $txt_title_en = '';
		
		// $created_date = $updated_date = date('d - m - Y | H:i:s');
		// $created_by = $updated_by = $Session->get("webmt_fullname");

	}

	$keywordsTemplate = $_method->keywordsTemplate(unserialize(_ARR_HELP_TEMPLATE));
	$keywordsTemplate_Order = $_method->keywordsTemplate(unserialize(_ARR_HELP_ORDER_TEMPLATE));
	$keywordsTemplate_Member = $_method->keywordsTemplate(unserialize(_ARR_HELP_MEMBER_TEMPLATE));

?>