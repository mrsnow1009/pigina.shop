<?php
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY.' khong ton tai');
    file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');

	/* get session dang nhap */
    $webmt_level = $Session->get("webmt_level");

    /* set - tieu de trang web */
    $page_title = $LANG['category-list'];

	$category_controller = new category_controller();
	$db = new database();

	/* lay danh sach danh muc theo node */
	$_method = new method();
	$node = $_method->_Get('node','string');
	switch ($node){
		case "content":
			$code_module = "RSCMS";
			$filter = " and code_module='".$code_module."' OR code_module='_LANGUAGE' ";
			$root = true;
			$rootid = 1;

			$_TREE  = new json_tree($category_controller->getTable(),array());
			$arr_combine = $_TREE->_get_children($rootid,true,0,$filter,"");
			if ($arr_combine) {
				$arr_cate = array_values($arr_combine);
			}else{
				$arr_cate = array();
			}

		break;
		case "product":
			$code_module = "RSPRODUCT";
			$filter = " and code_module='".$code_module."' OR code_module='_LANGUAGE' ";

			$root = true;
			$rootid = 1;

			$_TREE  = new json_tree($category_controller->getTable(),array());
			$arr_combine = $_TREE->_get_children($rootid,true,0,$filter,"");
			if ($arr_combine) {
				$arr_cate = array_values($arr_combine);
			}else{
				$arr_cate = array();
			}
		break;
		case "RSGALLERY":
			$code_module = "RSGALLERY";
			$where = method::check_show_root($code);
			$filter = " and code_module='".$code."' OR code_module='_LANGUAGE' ";
			$get_root = true;
			$rootID = 1;

			include_once(_PHISICAL_CLASS_PATH."class.tree.php");
			include_once(CATALOGS);
			$_CATALOGS = new CATALOGS;
			$add_fields=array();
			$_TREE  = new json_tree("tblcate",$add_fields);
			$arr_cate=array_values($_TREE->_get_children($rootID,true,0,$filter,""));
			$list_catalog = $_CATALOGS->_listCate($arr_cate,$get_root,$rootID);
		break;
		case "RSMEMBER":
			$code_module = "RSMEMBER";
			$where = method::check_show_root($code);
			$filter = " and code_module='".$code."' OR code='member' OR code_module='_LANGUAGE' ";

			$get_root = true;
			$rootID = 1;

			include_once(_PHISICAL_CLASS_PATH."class.tree.php");
			include_once(CATALOGS);
			$_CATALOGS = new CATALOGS;
			$add_fields=array();
			$_TREE  = new json_tree("tblcate",$add_fields);
			$arr_cate=array_values($_TREE->_get_children($rootID,true,0,$filter,""));
			$list_catalog = $_CATALOGS->_listCate($arr_cate,$get_root,$rootID);
		break;
		case "RSTOURNAMENT":
			$code_module = "RSTOURNAMENT";
			$where = method::check_show_root($code);
			$filter = " and code_module='".$code."' OR code='tournament' OR code_module='_LANGUAGE' ";

			$get_root = true;
			$rootID = 1;

			include_once(_PHISICAL_CLASS_PATH."class.tree.php");
			include_once(CATALOGS);
			$_CATALOGS = new CATALOGS;
			$add_fields=array();
			$_TREE  = new json_tree("tblcate",$add_fields);
			$arr_cate=array_values($_TREE->_get_children($rootID,true,0,$filter,""));
			$list_catalog = $_CATALOGS->_listCate($arr_cate,$get_root,$rootID);
		break;
		default:
			header('Location: '._LINK_DASHBOARD);
        	die();
		break;
	}

	/* tao tree_html danh sach danh muc */
	$_ARR_STATUS = unserialize(_ARR_STATUS);
	$_ARR_FLAG_LANG = unserialize(_ARR_FLAG_LANG);
	$_ARR_LANG_TEXT = unserialize(_ARR_LANG_TEXT);
	$_ARR_STATUS_COLOR_CLASS = unserialize(_ARR_STATUS_COLOR_CLASS);
	$level = 0;
	$_SYSTEM_VAR = unserialize(_SYSTEM_VAR);
	$html_tree ='';
	$total=count($arr_cate);
	if($root) $start = 0; else $start =1;
	$aCatNext = null;
	$levelNext = null;
	$levelPre = null;
	$level = '';
	$close_div = 0;

	for($i=$start;$i<$total;$i++){

		$aCat = $arr_cate[$i];

		/* neu co cate_next thi set cate_next. khong co thi cho bang null */
		if(isset($arr_cate[$i+1])){
			$aCatNext = $arr_cate[$i+1];
		}else{
			$aCatNext = null;
		}
		/* neu co cate_prev thi set cate_prev. khong co thi cho bang null */
		if ($i-1 < 0) {
			$aCatPre = null;
		}else{
			$aCatPre = $arr_cate[$i-1];
		}
		/* neu co cate_next thi set level_next. khong co thi bang 0 */
		if(isset($aCatNext['level'])){
			$levelNext = $aCatNext['level'];
		}else{
			$levelNext = null;
		}
		/* neu co cate_prev thi set level_prev. khong co thi bang 0 */
		if(isset($aCatPre['level'])){
			$levelPre = $aCatPre['level'];
		}else{
			$levelPre = null;
		}
		/* set level_current */
		$levelCurr = $aCat['level'];

		/* set link edit */
		$cate_edit_url = _LINK_CATEGORY_CREATE.'&node='.$node.'&lang='.$aCat['lang'].'&id='.$aCat['id'];
		/* set title + status + edit + delete */
		$htmlTitle = '<a class="cate-title" href="'.$cate_edit_url.'" title="'.$aCat['title'].'">'.$aCat['title'].'</a>';
		$htmlStatus = '<a id="status_'.$aCat['id'].'" onclick="activeCate('.$aCat['id'].')" class="cate-attr cate-status d-none d-md-block '.$_ARR_STATUS_COLOR_CLASS[$aCat['t_status']].'" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$_ARR_STATUS[$aCat['t_status']].'"><i class="fa-regular fa-circle-check"></i></i></a>';
		$htmlEdit = '<a class="cate-attr cate-edit badge text-bg-warning" href="'.$cate_edit_url.'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['edit'].'"><i class="fa-regular fa-pen-to-square"></i></a>';
		$htmlDelete = '<a onclick="removeCate('.$aCat['id'].')" class="cate-attr cate-remove badge text-bg-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$LANG['delete'].'"><i class="fa-regular fa-trash-can"></i></i></a>';
		$htmlFlag = '<a class="cate-attr cate-flag d-none d-md-block" href="'.$cate_edit_url.'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$_ARR_LANG_TEXT[$aCat['lang']].'"><img src="'.$_ARR_FLAG_LANG[$aCat['lang']].'" alt="'.$_ARR_LANG_TEXT[$aCat['lang']].'"></a>';

		// if (_DEV_MODE != 1) {
			$coundID = $db->getValue("
				select count(ID) as coundID
				from ".$category_controller->getTable()."
				where code = '".$aCat['code']."'
				and `lang` = '".$aCat['lang']."'
			","coundID");
			if ($coundID == 1 || $aCat['level'] < 3) {
				$htmlDelete = '';
			}
		// }

		/* !prev_cate + !next_cate : chi co 1 danh muc */
		if ((!isset($levelPre) || $levelPre == null) && (!isset($levelNext) || $levelNext == null)) {
			$html_tree .= '
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
				</div>
			';
		}
		/* neu !prev_cate + next_cate  : danh muc dau tien */
		if ((!isset($levelPre) || $levelPre == null) && $levelNext != null) {
			$html_tree .= '
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
			$close_div = $close_div + 1;
		}
		/* neu prev_cate + !next_cate + (level_prev = level_curr) : danh muc cuoi cung + phia truoc la danh muc anh em */
		if ($levelPre != null && (!isset($levelNext) || $levelNext == null) && $levelPre == $levelCurr) {
			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
			$close_div_temp = $close_div;
			for ($d=0; $d < $close_div_temp; $d++) {
				$html_tree .= '
					</div>
				';
				$close_div = $close_div - 1;
			}
		}
		/* neu prev_cate + !next_cate + (level_prev < level_curr) : danh muc cuoi cung + phia truoc la danh muc cha */
		if ($levelPre != null && (!isset($levelNext) || $levelNext == null) && $levelPre < $levelCurr) {
			$html_tree .= '
				<div class="sub-cate">
					<div>
						'.$htmlTitle.'
						'.$htmlFlag.'
						'.$htmlStatus.'
						'.$htmlEdit.'
						'.$htmlDelete.'
			';
			$close_div = $close_div + 2;
			$close_div_temp = $close_div;
			for ($d=0; $d < $close_div_temp; $d++) {
				$html_tree .= '
					</div>
				';
				$close_div = $close_div - 1;
			}
		}
		/* neu prev_cate + !next_cate + (level_prev > level_curr) : danh muc cuoi cung + phia truoc la danh muc con */
		if ($levelPre != null && (!isset($levelNext) || $levelNext == null) && $levelPre > $levelCurr) {
			$sub_level = (int)$levelPre - (int)$levelCurr;
			for ($d=0; $d < $sub_level; $d++) {
				$html_tree .= '
						</div>
					</div>
				';
				$close_div = $close_div - 2;
			}

			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
			$html_tree .= '
				</div>
			';
			$close_div = $close_div - 1;
		}
		/* neu prev_cate + next_cate + (level_prev = level_curr = level_next) : danh muc 1-1-1 */
		if (isset($levelPre) && isset($levelNext) && $levelPre == $levelCurr && $levelCurr == $levelNext) {
			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
		}
		/* neu prev_cate + next_cate + (level_prev < level_curr = level_next) : danh muc 1-2-2 */
		if (isset($levelPre) && isset($levelNext) && $levelPre < $levelCurr && $levelCurr == $levelNext) {
			$html_tree .= '
				<div class="sub-cate">
					<div>
						'.$htmlTitle.'
						'.$htmlFlag.'
						'.$htmlStatus.'
						'.$htmlEdit.'
						'.$htmlDelete.'
			';
			$close_div = $close_div + 2;
		}
		/* neu prev_cate + next_cate + (level_prev > level_curr = level_next) : danh muc 2-1-1 */
		if (isset($levelPre) && isset($levelNext) && $levelPre > $levelCurr && $levelCurr == $levelNext) {
			$sub_level = (int)$levelPre - (int)$levelCurr;
			for ($d=0; $d < $sub_level; $d++) {
				$html_tree .= '
						</div>
					</div>
				';
				$close_div = $close_div - 2;
			}

			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
		}
		/* neu prev_cate + next_cate + (level_prev = level_curr > level_next) : danh muc 2-2-1 */
		if (isset($levelPre) && isset($levelNext) && $levelPre == $levelCurr && $levelCurr > $levelNext) {
			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
		}
		/* neu prev_cate + next_cate + (level_prev = level_curr < level_next) : danh muc 1-1-2*/
		if (isset($levelPre) && isset($levelNext) && $levelPre == $levelCurr && $levelCurr < $levelNext) {
			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';

		}
		/* neu prev_cate + next_cate + (level_prev < level_curr < level_next) : danh muc 1-2-3 */
		if (isset($levelPre) && isset($levelNext) && $levelPre < $levelCurr && $levelCurr < $levelNext) {
			$html_tree .= '
				<div class="sub-cate">
					<div>
						'.$htmlTitle.'
						'.$htmlFlag.'
						'.$htmlStatus.'
						'.$htmlEdit.'
						'.$htmlDelete.'
			';
			$close_div = $close_div + 2;

		}
		/* neu prev_cate + next_cate + (level_prev > level_curr > level_next) : danh muc 3-2-1 */
		if (isset($levelPre) && isset($levelNext) && $levelPre > $levelCurr && $levelCurr > $levelNext) {
			$sub_level = (int)$levelPre - (int)$levelCurr;
			for ($d=0; $d < $sub_level; $d++) {
				$html_tree .= '
						</div>
					</div>
				';
				$close_div = $close_div - 2;
			}

			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
		}
		/* neu prev_cate + next_cate + (level_prev < level_curr > level_next) : danh muc 1-2-1 */
		if (isset($levelPre) && isset($levelNext) && $levelPre < $levelCurr && $levelCurr > $levelNext) {
			$html_tree .= '
				<div class="sub-cate">
					<div>
						'.$htmlTitle.'
						'.$htmlFlag.'
						'.$htmlStatus.'
						'.$htmlEdit.'
						'.$htmlDelete.'
			';
			$close_div = $close_div + 2;
		}
		/* neu prev_cate + next_cate + (level_prev > level_curr < level_next) : danh muc 2-1-2 */
		if (isset($levelPre) && isset($levelNext) && $levelPre > $levelCurr && $levelCurr < $levelNext) {
			$sub_level = (int)$levelPre - (int)$levelCurr;
			for ($d=0; $d < $sub_level; $d++) {
				$html_tree .= '
						</div>
					</div>
				';
				$close_div = $close_div - 2;
			}
			$html_tree .= '
				</div>
				<div>
					'.$htmlTitle.'
					'.$htmlFlag.'
					'.$htmlStatus.'
					'.$htmlEdit.'
					'.$htmlDelete.'
			';
		}
	}

?>