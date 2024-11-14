<?php  
    // file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT.' khong ton tai');

	/* get session dang nhap */
    // $webmt_level = $Session->get("webmt_level");

	$_method = new method();
	$_NODE_CONTENT = unserialize(_NODE_CONTENT);

	/* get request in link */
    $node = $_method->_Get('node','string');
	if (!isset($_NODE_CONTENT[$node])) {
    	$_method->alert($LANG['page_does_not_exist'],_LINK_DASHBOARD);
    	die();
	}

    /* set - tieu de trang web */
    $page_title = $LANG['list'].' '.$LANG[$node];

	// $content_controller = new content_controller();
	// $content_controller->setSqlFilter(' and type_art = "'.$node.'" ');
	// $list = $content_controller->getList();
	// $html_list = '';
	// $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	// if ($list) {
	// 	$db  = new database();
	// 	foreach ($list as $key => $value) {
	// 		$link_edit = _LINK_ARTICLE_CREATE.'&node='.$node.'&lang='.$value->lang.'&id='.$value->ID;
	// 		$title_cate = $db->getField(TBLCATEGORY,'title','ID',$value->cateid);
	// 		if (!$title_cate) {
	// 			$link_cate = $LANG['unknow'];
	// 		}else{
	//			$lang_cate = $db->getField(TBLCATEGORY,'lang','ID',$list[$i]->cateid);
	// 			$link_cate = '<a href="'._LINK_CATEGORY_CREATE.'&node=content&lang='.$lang_cate.'&id='.$value->cateid.'" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].' '.$LANG['category'].'">'.$title_cate.'</a>';
	// 		}
	// 		$html_list .= '
	// 			<tr>
	// 				<td></td>
	// 				<td><input class="form-check-input tb-checked-click" type="checkbox" value="'.$value->ID.'" id="tb-checked-item-'.$value->ID.'" name="tb-checked-item[]"></td>
	// 				<td><a href="'.$link_edit.'" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].' '.$LANG[$node].'">'.$value->title.'</a></td>
	//         		<td>'.$link_cate.'</td>
	//         		<td>'.date('d/m/Y | H:i:s',$value->created_date).'</td>
	// 	    		<td>'.$_ARR_STATUS_BADGE[$value->t_status].'</td>
	//         		<td>
	//         			<a href="'.$link_edit.'" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].' '.$LANG[$node].'"><i class="fa-light fa-pen-to-square"></i></a>
	// 	    			<a href="#" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>
	//         		</td>
	//     		</tr>
	// 		';
	// 	}
	// }
?>