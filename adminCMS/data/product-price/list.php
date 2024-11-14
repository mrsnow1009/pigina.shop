<?php  
    // file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT):die(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT.' khong ton tai');

	/* get session dang nhap */
    // $webmt_level = $Session->get("webmt_level");

    /* set - tieu de trang web */
    $page_title = $LANG['list-product'];

	// $_method = new method();
	// $product_controller = new product_controller();
	// $list = $product_controller->getList();
	// $html_list = '';
	// $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	// if ($list) {
	// 	$db  = new database();
	// 	foreach ($list as $key => $value) {
	// 		$link_edit = _LINK_PRODUCT_CREATE.'&lang='.$value->lang.'&id='.$value->ID;
	// 		$title_cate = $db->getField(TBLCATEGORY,'title','ID',$value->cateid);
	// 		if (!$title_cate) {
	// 			$link_cate = $LANG['unknow'];
	// 		}else{
	// 			$link_cate = '<a href="'._LINK_CATEGORY_CREATE.'&node=product&lang=vn&id='.$value->cateid.'" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].' '.$LANG['category'].'">'.$title_cate.'</a>';
	// 		}
	// 		$html_list .= '
	// 			<tr>
	// 				<td><input class="form-check-input tb-checked-click" type="checkbox" value="'.$value->ID.'" id="tb-checked-item-'.$value->ID.'" name="tb-checked-item[]"></td>
	// 				<td><a href="'.$link_edit.'" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].' '.$LANG['product'].'">'.$value->title.'</a></td>
	//         		<td>'.$link_cate.'</td>
	//         		<td>'.$_method->showCurrency($value->price,_CURRENCY).'</td>
	//         		<td>'.date('d-m-Y | H:i:s',$value->created_date).'</td>
	// 	    		<td>'.$_ARR_STATUS_BADGE[$value->t_status].'</td>
	//         		<td>
	//         			<a href="'.$link_edit.'" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].' '.$LANG['product'].'"><i class="fa-light fa-pen-to-square"></i></a>
	// 	    			<a href="#" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>
	//         		</td>
	//     		</tr>
	// 		';
	// 	}
	// }
?>