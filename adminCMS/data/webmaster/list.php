<?php  
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

    /* set - tieu de trang web */
    $page_title = $LANG['webmaster'];

	$webmaster_controller = new webmaster_controller();
	$webmaster_controller->setSelectField('ID, fullname, email, created_date, t_status');
	if ($webmt_level == 'root') {
		$webmaster_controller->setSqlFilter(' and (level = "admin" or level = "staff") ');
	}elseif ($webmt_level == 'admin') {
		$webmaster_controller->setSqlFilter(' and level = "staff" ');
	}
	
	$list = $webmaster_controller->getList();
	$html_list = '';
	$_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	if ($list) {
		foreach ($list as $key => $value) {
			$html_list .= '
				<tr>
					<td><input class="form-check-input tb-checked-click" type="checkbox" value="'.$value->ID.'" id="tb-checked-item-'.$value->ID.'" name="tb-checked-item[]"></td>
		    		<td><a href="'._LINK_WEBMASTER_CREATE.'&id='.$value->ID.'" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].'">'.$value->fullname.'</a></td>
		    		<td>'.$value->email.'</td>
		    		<td>'.date('d-m-Y | H:i:s',$value->created_date).'</td>
		    		<td>'.$_ARR_STATUS_BADGE[$value->t_status].'</td>
		    		<td>
		    			<a href="'._LINK_WEBMASTER_CREATE.'&id='.$value->ID.'" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].'"><i class="fa-light fa-pen-to-square"></i></a>
		    			<a onclick="resetPassword('.$value->ID.')" href="javascript:;" class="badge text-bg-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['reset_password'].'"><i class="fa-light fa-paper-plane"></i></a>
		    			<a onclick="getDelRecord(\'delWebmaster\','.$value->ID.')" href="javascript:;" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>
		    		</td>
	    		</tr>
			';
		}
	}
?>