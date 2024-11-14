<?php
// error_reporting ( E_ALL );
// ini_set ( "display_errors", 1 );
$_LEVEL ='../';
include_once('config/config.php');
include_once(_PATH_DB_LOCAL_CLASS);
include_once(_PATH_METHOD_CLASS);

$_method = new method();

$quest		= $_method->_Request("q","string");
switch ($quest) {
	case 'check-email':
		$tb = $_method->_Request("tb","string");
		$email = $_method->_Request("email","string");
		switch ($tb) {
			case 'account':
				$db = new database();
				$has_email = $db->getField(TBLWEBMASTER,'ID','email',$email);
				if ($has_email === false)
					echo '{"flag":"false"}';
				else
					echo '{"flag":"true"}';
				break;
			default:
				# code...
				break;
		}
	
		break;

	case 'delWebmaster':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WEBMASTER);

        $_db = new database();
		$webmaster_controller = new webmaster_controller();

		$value = $_method->_Request("value","string");
		$r = $webmaster_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case 'forgot-password':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LOGIN);
		$login_controller = new login_controller();

		$email = $_method->_Request("email","string");
		$result = $login_controller->forgotpass($email);

		if ($result)
			echo '{"flag":"true"}';
		else
			echo '{"flag":"false"}';
		
		break;

	case 'active-category':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY);
		$category_controller = new category_controller();
		$_ARR_STATUS = unserialize(_ARR_STATUS);
        $_db = new database();

		$id = $_method->_Request("id","string");
        $current_status = $_db->getField($category_controller->getTable(),'t_status','ID',$id);
        $result = false;
        if ($current_status) {
	        if ($current_status != 1) {
	        	$category_controller->setDataForm(array('t_status'=>1));
				$current_status = 1;
	        }else{
	        	$category_controller->setDataForm(array('t_status'=>2));
				$current_status = 2;
	        }
        	$result = $category_controller->update($id,'update');
        }
        // $result = $category_controller->updateStatus($id);

		if ($result) echo '{"note":"'.$LANG['the_status_of_this_category_has_been_changed_to'].' '.strtoupper($_ARR_STATUS[$current_status]).'"}';
		else echo '{"note":"'.$LANG['error_try_again'].'"}';
		
		break;

	case 'remove-category':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY);
		file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
	    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
    	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO.' khong ton tai');

		$category_controller = new category_controller();

		$id = $_method->_Request("id","string");
        /* $_db = new database();
		$result = $_db->deleteRecord('delete from '.$category_controller->getTable().' where ID = '.$id); */

		/* lay tat ca danh muc con + danh muc current */
	    $jstree = new json_tree();
		$arr_cate = array_keys($jstree->_get_children($id,true,0));
		/* format tat ca danh muc thanh chuoi string */
		$str_cate = implode(',', $arr_cate);

		$result = $category_controller->DeleteRecord($str_cate);
		if ($result){
			/* update left right */
			$jstree->_reconstruct();

			echo '{"note":"'.$LANG['category_removed'].'"}';
		}else echo '{"note":"'.$LANG['error_try_again'].'"}';
		
		break;

	case 'html-option-cate':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY);
    	file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
        $_db = new database();
		$category_controller = new category_controller();
		$_NODE_MODULE = unserialize(_NODE_MODULE);

		$lang = $_method->_Request("lang","string");
		$node = $_method->_Request("node","string");
		$cate = $_method->_Request("cate","string");

		/* get cbx cate */
	    $root = $category_controller->getRootID_byLang($lang);
	    $filter = ' and code_module="'.$_NODE_MODULE[$node].'" ';
	    
	    $_tree_cate  = new _tree_struct($category_controller->getTable());
	    $arrCate = $_tree_cate->_get_children($root,true,0,$filter);
	    $arrStrCate = $category_controller->arrtree_mod($arrCate,$root,_LEVEL_CATE_ADMIN);
	    if (!$cate || $cate == 0) {
	    	$arr_disable = array();
	    	$cbx_parentid = 0;
	    }else{
			$arr_disable = $category_controller->getChildrentoID($cate);
            $cbx_parentid = $_db->getField($category_controller->getTable(),'parent_id','ID',$cate);
		}
	    $cbxCategory = $_method->combo_arr_without_current($arrStrCate,$cbx_parentid,$arr_disable);	
	    $cbxCategory = '<option value="">'.$LANG['choose_category'].'</option>'.$cbxCategory;

	    $objsmg = array('error'=>'false','html'=>$LANG['error_try_again']);
		if ($cbxCategory) $objsmg = array('error'=>'true','html'=>$cbxCategory);

		print json_encode($objsmg);
		
		break;

	case '_article_list':
		$node = $_method->_Request("node","string");
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$content_controller = new content_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'lang', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title', 'dt' => 2 ),
	        array( 'db' => 'cateid',  'dt' =>3 ),
	        array( 'db' => 'created_date',  'dt' =>4 ),
	        array( 'db' => 't_status',  'dt' =>5 ),
	        array( 'db' => 't_index',  'dt' =>6 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $content_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    $filter = '';
	    if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	        $date = $_POST['search']['value'];
	        $date = str_replace('/', '-', $date);
	        $d = DateTime::createFromFormat('d-m-Y', $date);
	        if ($d && $d->format('d-m-Y') == $date) {
	            // search theo ngay donate
	            $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	        } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	        }
	    }
	    $filter .= 'and type_art = "'.$node.'" '.$filter;
	    $content_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $content_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $content_controller->setStart(intval($_POST['start']));
	        $content_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $content_controller->count();
	    /* list record */
	    $list = $content_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $article = new stdClass();
	            $link_edit = _LINK_ARTICLE_CREATE.'&node='.$node.'&lang='.$list[$i]->lang.'&id='.$list[$i]->ID;
	            $title_cate = $_db->getField(TBLCATEGORY,'title','ID',$list[$i]->cateid);
				if (!$title_cate) {
					$link_cate = $LANG['unknow'];
				}else{
					$lang_cate = $_db->getField(TBLCATEGORY,'lang','ID',$list[$i]->cateid);
					$link_cate = '<a href="'._LINK_CATEGORY_CREATE.'&node=content&lang='.$lang_cate.'&id='.$list[$i]->cateid.'" class="text-decoration-none" title="'.$LANG['edit'].' '.$LANG['category'].'">'.$title_cate.'</a>';
				}

	            // $article->lang = $list[$i]->lang;
	            $article->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $article->title = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['edit'].' '.$LANG[$node].'">'.$list[$i]->title.'</a>';
	            $article->cateid = $link_cate;
	            $article->created_date =  date("d/m/Y",$list[$i]->created_date);
	            $article->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $article->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['edit'].' '.$LANG[$node].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delArticle\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $article;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'html-option-cate-article':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY);
    	file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
        $_db = new database();
		$category_controller = new category_controller();
		$_NODE_CONTENT = unserialize(_NODE_CONTENT);

		$lang = $_method->_Request("lang","string");
		$node = $_method->_Request("node","string");
		$cate = $_method->_Request("cate","string");

		/* get cbx cate */
		$category_controller = new category_controller();
	    $root = $category_controller->getRootID_byLang($lang);
	    $filter = ' and code_module="RSCMS" and code="'.$_NODE_CONTENT[$node].'" ';
	    
	    $_tree_cate  = new _tree_struct($category_controller->getTable());
	    $arrCate = $_tree_cate->_get_children($root,true,0,$filter);
	    $arrStrCate = $category_controller->arrtree_mod($arrCate,$root,_LEVEL_CATE_ADMIN);
		$cbxCategory = $_method->combo_arr($arrStrCate,$cate);

	    $cbxCategory = '<option value="">'.$LANG['choose_category'].'</option>'.$cbxCategory;

	    $objsmg = array('error'=>'false','html'=>$LANG['error_try_again']);
		if ($cbxCategory) $objsmg = array('error'=>'true','html'=>$cbxCategory);

		print json_encode($objsmg);
		
		break;

	case 'delArticle':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTENT);
	    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
    	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO.' khong ton tai');

        $_db = new database();
		$content_controller = new content_controller();

		$value = $_method->_Request("value","string");
		$r = $content_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;
	
	case 'check-product-code':
		$code = $_method->_Request("txt_code","string");
		$id = $_method->_Request("id","int");
		$_db = new database();
		if ($id && $id > 0) $has_code = $_db->getField(TBLPRODUCT,'ID','code',$code,' and ID <> '.$id.' ');
		else $has_code = $_db->getField(TBLPRODUCT,'ID','code',$code);
		if($has_code) {return print "false";}
		else  return  print "true" ;

		break;

	case '_product_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$product_controller = new product_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'lang', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'code', 'dt' => 2 ),
	        array( 'db' => 'title', 'dt' => 3 ),
	        array( 'db' => 'cateid',  'dt' =>4 ),
	        array( 'db' => 'price',  'dt' =>5 ),
	        array( 'db' => 'reduced_price',  'dt' =>6 ),
	        array( 'db' => 't_status',  'dt' =>7 ),
	        array( 'db' => 't_index',  'dt' =>8 ),
	        array( 'db' => 'reduced_price',  'dt' =>9 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $product_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $product_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $product_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $product_controller->setStart(intval($_POST['start']));
	        $product_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $product_controller->count();
	    /* list record */
	    $list = $product_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $product = new stdClass();
	            $link_edit = _LINK_PRODUCT_CREATE.'&lang='.$list[$i]->lang.'&id='.$list[$i]->ID;
	            $title_cate = $_db->getField(TBLCATEGORY,'title','ID',$list[$i]->cateid);
				if (!$title_cate) {
					$link_cate = $LANG['unknow'];
				}else{
					$lang_cate = $_db->getField(TBLCATEGORY,'lang','ID',$list[$i]->cateid);
					$link_cate = '<a href="'._LINK_CATEGORY_CREATE.'&node=product&lang='.$lang_cate.'&id='.$list[$i]->cateid.'" class="text-decoration-none" title="'.$LANG['update-category'].'">'.$title_cate.'</a>';
				}

	            // $product->lang = $list[$i]->lang;
	            $product->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $product->code = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-product'].'">'.$list[$i]->code.'</a>';
	            $product->title = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-product'].'">'.$list[$i]->title.'</a>';
	            $product->cateid = $link_cate;
	            $product->price = $_method->showCurrency($list[$i]->price,_CURRENCY);
	            $product->reduced_price = $_method->showCurrency($list[$i]->reduced_price,_CURRENCY);
	            // $product->created_date =  date("d/m/Y",$list[$i]->created_date);
	            $product->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $product->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-product'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delProduct\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $product;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;
	
	case 'html-option-cate-product':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CATEGORY);
    	file_exists(_PATH_TREE_CLASS)?include_once(_PATH_TREE_CLASS):die(_PATH_TREE_CLASS.' khong ton tai');
        $_db = new database();
		$category_controller = new category_controller();
		$_NODE_CONTENT = unserialize(_NODE_CONTENT);

		$lang = $_method->_Request("lang","string");
		$cate = $_method->_Request("cate","string");

		/* get cbx cate */
		$category_controller = new category_controller();
	    $root = $category_controller->getRootID_byLang($lang);
    	$filter = ' and code_module="RSPRODUCT" ';
	    
	    $_tree_cate  = new _tree_struct($category_controller->getTable());
	    $arrCate = $_tree_cate->_get_children($root,true,0,$filter);
	    $arrStrCate = $category_controller->arrtree_mod($arrCate,$root,_LEVEL_CATE_ADMIN);
		$cbxCategory = $_method->combo_arr($arrStrCate,$cate);

	    $cbxCategory = '<option value="">'.$LANG['choose_category'].'</option>'.$cbxCategory;

	    $objsmg = array('error'=>'false','html'=>$LANG['error_try_again']);
		if ($cbxCategory) $objsmg = array('error'=>'true','html'=>$cbxCategory);

		print json_encode($objsmg);
		
		break;

	case 'delProduct':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT);
	    // file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');
	    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
    	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO):die(_PHISICAL_PATH_ADMIN_CONTROLLER_SEO.' khong ton tai');
		file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY.' khong ton tai');

        $_db = new database();
		$product_controller = new product_controller();

		$value = $_method->_Request("value","string");
		$r = $product_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_banner_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER);
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$banner_controller = new banner_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'target', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'type', 'dt' => 2 ),
	        array( 'db' => 'title', 'dt' => 3 ),
	        array( 'db' => 'position',  'dt' =>4 ),
	        array( 'db' => 'cateid',  'dt' =>5 ),
	        array( 'db' => 't_status',  'dt' =>6 ),
	        array( 'db' => 't_index',  'dt' =>7 ),
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $banner_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $banner_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $banner_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $banner_controller->setStart(intval($_POST['start']));
	        $banner_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $banner_controller->count();
	    /* list record */
	    $list = $banner_controller->getList_Table();

	    $data = array();
	    if ($list) {
			$banner_group_controller = new banner_group_controller();
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $banner = new stdClass();
	            $link_edit = _LINK_BANNER_CREATE.'&id='.$list[$i]->ID;

	            $str_cate = trim($list[$i]->cateid,'@');
	           	$arr_cate = explode('@@', $str_cate);
	           	$html_cate = '';
	           	for ($c=0; $c < count($arr_cate); $c++) { 
	           		$title_cate = $_db->getField(TBLCATEGORY,'title','ID',$arr_cate[$c]);
	           		if ($title_cate) {
						$lang_cate = $_db->getField(TBLCATEGORY,'lang','ID',$arr_cate[$c]);
						$code_module_cate = $_db->getField(TBLCATEGORY,'code_module','ID',$arr_cate[$c]);
						if ($code_module_cate == 'RSPRODUCT') {
							$link_cate_href = _LINK_CATEGORY_CREATE.'&node=product&lang='.$lang_cate.'&id='.$arr_cate[$c];
						}elseif($code_module_cate == 'RSCMS'){
							$link_cate_href = _LINK_CATEGORY_CREATE.'&node=content&lang='.$lang_cate.'&id='.$arr_cate[$c];
						}else{
							$link_cate_href = 'javascript:;';
						}
						$html_cate .= '<a href="'.$link_cate_href.'" class="text-decoration-none d-block" title="'.$LANG['update-category'].'">- '.$title_cate.'</a>';
					}
	           	}
	   
	            $banner->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $banner->type = $list[$i]->type;
	            $banner->title = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-banner'].'">'.$list[$i]->title.'</a>';
	            $banner->position = $_db->getField($banner_group_controller->getTable(),'title','position',$list[$i]->position);
	            $banner->cateid = $html_cate;
	            $banner->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $banner->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-banner'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delBanner\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $banner;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'banner-size-value':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER);
    	file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP):die(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER_GROUP.' khong ton tai');
		$banner_controller = new banner_controller();
		$banner_group_controller = new banner_group_controller();

		$position = $_method->_Request("position","string");
		$banner_group_controller->setSqlFilter(' and position="'.$position.'"');
		$detail = $banner_group_controller->getDetail();
		
		$error = false;
		$width = 0;
		$height = 0;
		$readonly = 2;
		if ($detail) {
			$error = true;
			$width = $detail->width;
			$height = $detail->height;
			$readonly = (int)$detail->static;
		}

		$result = array(
	        "error" => $error,
	        "width" => $width,
	        "height" => $height,
	        "readonly" => $readonly
	    );
	    echo json_encode($result);

		break;
	
	case 'delBanner':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BANNER);
	    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
		file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_LIBRARY.' khong ton tai');

        $_db = new database();
		$banner_controller = new banner_controller();

		$value = $_method->_Request("value","string");
		$r = $banner_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_order_list':
		$node = $_method->_Request("node","string");
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER);
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_MEMBER);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$order_controller = new order_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'lang', 'dt' => 0),
	        array( 'db' => 'ID', 'dt' => 1),
	        array( 'db' => 'code', 'dt' => 2),
	        array( 'db' => 'fullname',  'dt' =>3),
	        array( 'db' => 'total',  'dt' =>4),
	        array( 'db' => 'date',  'dt' =>5),
	        array( 'db' => 't_status',  'dt' =>6),
	        array( 'db' => 't_index',  'dt' =>7)
	    );
	    // $selectField = DATATABLE_SQL::pluck($columns,'db');
	    // $order_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    $filter = '';
	    if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	        $search_value = $_POST['search']['value'];
	        $date = str_replace('/', '-', str_replace(' ', '', $search_value));
	        $d = DateTime::createFromFormat('d-m-Y', $date);
	        // getTimestamp
	        $filter_date = '';
	        if ($d && $d->format('d-m-Y') == $date) {
	    		/* search theo ngay dat hang */
	            $filter_date .= ' or (date >= '.$d->modify("midnight")->getTimestamp().' and date < '.$d->modify("+1 day")->getTimestamp().') ';
	        }

	        $filter = ' and (tb_order.code like "%'.$search_value.'%" or tb_buyer.fullname like "%'.$search_value.'%" or tb_buyer.phone like "%'.$search_value.'%" or tb_buyer.email like "%'.$search_value.'%" or tb_order.total like "%'.$search_value.'%" or tb_order.delivery_fee like "%'.$search_value.'%" '.$filter_date.') ';
            // $filter .= DATATABLE_SQL::filter($_POST,$columns);
	    }
	    $order_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    // if ($sort != '') $sort .= ', t_status asc, date desc ';
	    // else $sort .= ' order by t_status asc, date desc ';
	    $order_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $order_controller->setStart(intval($_POST['start']));
	        $order_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $order_controller->count_Table();
	    /* list record */
	    $list = $order_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE_ORDER = unserialize(_ARR_STATUS_BADGE_ORDER);
	        $member_controller = new member_controller();
	        for ($i=0; $i < $count; $i++) { 
	            $order = new stdClass();
	            $link_edit = _LINK_ORDER_DETAIL.'&id='.$list[$i]->ID;

 	            $order->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $order->code = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['detail'].' '.$LANG['order'].'">#'.$list[$i]->code.'</a>';

	            // $order->customer_code =  $list[$i]->customer_code;
	            // $member = $member_controller->setSqlFilter(' and code = "'.$order->customer_code.'"');
            	// $member = $member_controller->getDetail();
	            // if ($member) {
	            // 	$order->customer_code =  '<a href="'._LINK_MEMBER_CREATE.'&id='.$member->ID.'" class="text-decoration-none" title="'.$LANG['detail'].' '.$LANG['member'].'">'.$member->name.'</a>';;
	            // }
				$order->fullname = '<div><strong>'.$list[$i]->fullname.'</strong></div><div class="opacity-75">'.$list[$i]->phone.'</div><div class="opacity-75">'.$list[$i]->email.'</div>';
	            $order->total = '<span class="d-block">'.$_method->formatNumberToCurrency($list[$i]->total,_CURRENCY).'</span><span class="font-monospace opacity-75">('.$_method->formatNumberToCurrency($list[$i]->delivery_fee,_CURRENCY).')</span>';
	            $order->date = date("d/m/Y | H:i:s",$list[$i]->date);
	            $order->t_status = $_ARR_STATUS_BADGE_ORDER[$list[$i]->t_status];
	            $order->t_index = '<a href="'.$link_edit.'" class="badge text-bg-success" title="'.$LANG['detail'].' '.$LANG['order'].'"><i class="fa-regular fa-circle-info"></i></a>
	            	<a onclick="getDelRecord(\'delOrder\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $order;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'remove-order-product':
		$id = $_method->_Request("id","int");
        $warning = '';
		if ($id && $id > 0) {
			file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER.' khong ton tai');
    		file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL.' khong ton tai');
        	$order_detail_controller = new order_detail_controller();
    		$order_controller = new order_controller();
        	$_db = new database();

        	$orderID = $_db->getField($order_detail_controller->getTable(),'order_id','ID',$id);

        	/* delete record */
        	$result = $order_detail_controller->DeleteRecord($id);

        	/* update total order */
        	// $order_detail_controller->setSqlFilter('');
	        $total = $order_detail_controller->getTotal($orderID);
	        $order_controller->setDataForm(array('total'=>$total));
	        $errsql_total = $order_controller->update($orderID,'update');
	        if (!$errsql_total) {
	            $warning .= $LANG['error_order_total'];
	        }

        	if ($result) $error = 1;
        	else $error = 2;
		}else{
			$error = 2;
		}
		
		$objsmg = array('error'=>$error,'warning'=>$warning);
		print json_encode($objsmg);

		break;

	case 'delOrder':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER);

        $_db = new database();
    	$order_controller = new order_controller();

		$value = $_method->_Request("value","string");
		$r = $order_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case 'update-quantity-product':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL);

		$order_detail_controller = new order_detail_controller();
		
		$tid = $_method->_Request("tid","int");
		$quantity = $_method->_Request("quantity","int");
		
		$detail = $order_detail_controller->setID($tid);
		if($detail){
			if ($detail->quantity != $quantity) {
				$data_form=array(
					"quantity"=>$quantity
				);
				$order_detail_controller->setDataForm($data_form);
				$result = $order_detail_controller->update($tid,'update');
			}
		}else{
			$error = 'false';
			$html = $LANG['error_try_again'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);

		break;
	
	case '_unit_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_UNIT);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$unit_controller = new unit_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'lang', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title_vn', 'dt' => 2 ),
	        array( 'db' => 'title_en',  'dt' =>3 ),
	        array( 'db' => 't_status',  'dt' =>4 ),
	        array( 'db' => 't_index',  'dt' =>5 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $unit_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $unit_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $unit_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $unit_controller->setStart(intval($_POST['start']));
	        $unit_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $unit_controller->count();
	    /* list record */
	    $list = $unit_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $unit = new stdClass();
	            $link_edit = _LINK_UNIT_CREATE.'&id='.$list[$i]->ID;

	            // $unit->lang = $list[$i]->lang;
	            $unit->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $unit->title_vn = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-unit'].'">'.$list[$i]->title_vn.'</a>';
	            $unit->title_en = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-unit'].'">'.$list[$i]->title_en.'</a>';
	            // $unit->created_date =  date("d/m/Y",$list[$i]->created_date);
	            $unit->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $unit->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-unit'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delUnit\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $unit;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delUnit':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_UNIT);

        $_db = new database();
		$unit_controller = new unit_controller();

		$value = $_method->_Request("value","string");
		$r = $unit_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_deliverymethod_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_DELIVERYMETHOD);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$deliverymethod_controller = new deliverymethod_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'lang', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title_vn', 'dt' => 2 ),
	        array( 'db' => 'title_en',  'dt' =>3 ),
	        array( 'db' => 't_status',  'dt' =>4 ),
	        array( 'db' => 't_index',  'dt' =>5 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $deliverymethod_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $deliverymethod_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $deliverymethod_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $deliverymethod_controller->setStart(intval($_POST['start']));
	        $deliverymethod_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $deliverymethod_controller->count();
	    /* list record */
	    $list = $deliverymethod_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $deliverymethod = new stdClass();
	            $link_edit = _LINK_DELIVERYMETHOD_CREATE.'&id='.$list[$i]->ID;

	            // $deliverymethod->lang = $list[$i]->lang;
	            $deliverymethod->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $deliverymethod->title_vn = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-deliverymethod'].'">'.$list[$i]->title_vn.'</a>';
	            $deliverymethod->title_en = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-deliverymethod'].'">'.$list[$i]->title_en.'</a>';
	            // $deliverymethod->created_date =  date("d/m/Y",$list[$i]->created_date);
	            $deliverymethod->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $deliverymethod->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-deliverymethod'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delDeliveryMethod\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $deliverymethod;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delDeliveryMethod':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_DELIVERYMETHOD);

        $_db = new database();
		$deliverymethod_controller = new deliverymethod_controller();

		$value = $_method->_Request("value","string");
		$r = $deliverymethod_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_paymentmethod_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PAYMENTMETHOD);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$paymentmethod_controller = new paymentmethod_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'lang', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title_vn', 'dt' => 2 ),
	        array( 'db' => 'title_en',  'dt' =>3 ),
	        array( 'db' => 't_status',  'dt' =>4 ),
	        array( 'db' => 't_index',  'dt' =>5 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $paymentmethod_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $paymentmethod_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $paymentmethod_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $paymentmethod_controller->setStart(intval($_POST['start']));
	        $paymentmethod_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $paymentmethod_controller->count();
	    /* list record */
	    $list = $paymentmethod_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $paymentmethod = new stdClass();
	            $link_edit = _LINK_PAYMENTMETHOD_CREATE.'&id='.$list[$i]->ID;

	            // $paymentmethod->lang = $list[$i]->lang;
	            $paymentmethod->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $paymentmethod->title_vn = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-paymentmethod'].'">'.$list[$i]->title_vn.'</a>';
	            $paymentmethod->title_en = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-paymentmethod'].'">'.$list[$i]->title_en.'</a>';
	            // $paymentmethod->created_date =  date("d/m/Y",$list[$i]->created_date);
	            $paymentmethod->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $paymentmethod->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-paymentmethod'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delPaymentMethod\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $paymentmethod;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delPaymentMethod':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PAYMENTMETHOD);

        $_db = new database();
		$paymentmethod_controller = new paymentmethod_controller();

		$value = $_method->_Request("value","string");
		$r = $paymentmethod_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_template_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$template_controller = new template_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'ID', 'dt' => 0 ),
	        array( 'db' => 'name', 'dt' => 1 ),
	        array( 'db' => 'title',  'dt' =>2 ),
	        array( 'db' => 'lang',  'dt' =>3 ),
	        array( 'db' => 't_group',  'dt' =>4 ),
	        array( 'db' => 'mask',  'dt' =>5 ),
	        array( 'db' => 't_index',  'dt' =>6 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $template_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $template_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID asc ';
	    else $sort .= ' order by ID asc ';
	    $template_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $template_controller->setStart(intval($_POST['start']));
	        $template_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $template_controller->count();
	    /* list record */
	    $list = $template_controller->getList_Table();
	    // var_dump($list);

	    $data = array();
	    $_ARR_COLOR_LANG_BADGET = unserialize(_ARR_COLOR_LANG_BADGET);
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        for ($i=0; $i < $count; $i++) { 
	            $template = new stdClass();
	            $link_edit = _LINK_TEMPLATE_CREATE.'&id='.$list[$i]->ID;

	            $template->name = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-template'].'">'.$list[$i]->name.'</a>';
	            $template->title = $list[$i]->title;
	            $template->lang = $_ARR_COLOR_LANG_BADGET[$list[$i]->lang];
	            $template->t_group = $list[$i]->t_group;
	            $template->mask = $list[$i]->mask;

	            $delete = '';
	            if (_DEV_MODE === 1) {
					$delete = '<a onclick="getDelRecord(\'delTemplate\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';
	            }
	            $template->t_index = '<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-template'].'"><i class="fa-light fa-pen-to-square"></i></a>&nbsp;'.$delete;
 	    			
	            $data[] = $template;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delTemplate':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE);

		if (_DEV_MODE !== 1) {
			$objsmg = array('error'=>'false','html'=>$LANG['access_is_not_allowed']);
			print json_encode($objsmg);
			die();
		}

        $_db = new database();
		$template_controller = new template_controller();

		$value = $_method->_Request("value","string");
		$r = $template_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_company_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$company_controller = new company_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'ID', 'dt' => 0 ),
	        array( 'db' => 'name', 'dt' => 1 ),
	        array( 'db' => 'address', 'dt' => 2 ),
	        array( 'db' => 'lang',  'dt' =>3 ),
	        array( 'db' => 'fax',  'dt' =>5 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $company_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $company_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $company_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $company_controller->setStart(intval($_POST['start']));
	        $company_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $company_controller->count();
	    /* list record */
	    $list = $company_controller->getList_Table();

	    $data = array();
	    $_ARR_COLOR_LANG_BADGET = unserialize(_ARR_COLOR_LANG_BADGET);
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $company = new stdClass();
	            $link_edit = _LINK_COMPANY_CREATE.'&id='.$list[$i]->ID;

	            $company->name = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-company'].'">'.$list[$i]->name.'</a>';
	            $company->address = $list[$i]->address;
	            $company->lang = $_ARR_COLOR_LANG_BADGET[$list[$i]->lang];

	            $delete = '';
	            if (_DEV_MODE === 1) {
	            	$delete = '<a onclick="getDelRecord(\'delCompany\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';
	            }
	            $company->fax = '<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-company'].'"><i class="fa-light fa-pen-to-square"></i></a>&nbsp;'.$delete;

	            $data[] = $company;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;
	
	case 'delCompany':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY);
	    // file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');

        $_db = new database();
		$company_controller = new company_controller();

		$value = $_method->_Request("value","string");
		$r = $company_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_branch_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BRANCH);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$branch_controller = new branch_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'created_date', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'name', 'dt' => 2 ),
	        array( 'db' => 'address', 'dt' => 3 ),
	        array( 'db' => 'lang',  'dt' =>4 ),
	        array( 'db' => 't_index',  'dt' =>5 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $branch_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $branch_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $branch_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $branch_controller->setStart(intval($_POST['start']));
	        $branch_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $branch_controller->count();
	    /* list record */
	    $list = $branch_controller->getList_Table();

	    $data = array();
	    $_ARR_COLOR_LANG_BADGET = unserialize(_ARR_COLOR_LANG_BADGET);
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $branch = new stdClass();
	            $link_edit = _LINK_BRANCH_CREATE.'&id='.$list[$i]->ID;

	            $branch->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $branch->name = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-branch'].'">'.$list[$i]->name.'</a>';
	            $branch->address = $list[$i]->address;
	            $branch->lang = $_ARR_COLOR_LANG_BADGET[$list[$i]->lang];

	            $branch->t_index = '<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-branch'].'"><i class="fa-light fa-pen-to-square"></i></a>
	            	<a onclick="getDelRecord(\'delBranch\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $branch;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;
	
	case 'delBranch':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BRANCH);

        $_db = new database();
		$branch_controller = new branch_controller();

		$value = $_method->_Request("value","string");
		$r = $branch_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_brand_list':

		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BRAND);
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$brand_controller = new brand_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'created_date', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title', 'dt' => 2 ),
	        array( 'db' => 'created_by', 'dt' => 3 ),
	        array( 'db' => 't_status', 'dt' => 4 ),
	        array( 'db' => 'lang',  'dt' =>5 ),
	        array( 'db' => 't_index',  'dt' =>6 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $brand_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $brand_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $brand_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $brand_controller->setStart(intval($_POST['start']));
	        $brand_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $brand_controller->count();
	    /* list record */
	    $list = $brand_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	    	$_ARR_COLOR_LANG_BADGET = unserialize(_ARR_COLOR_LANG_BADGET);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
			$product_controller = new product_controller();
	        for ($i=0; $i < $count; $i++) { 
	            $brand = new stdClass();
	            $link_edit = _LINK_BRAND_CREATE.'&id='.$list[$i]->ID;

	            $brand->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $brand->title = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-brand'].'">'.$list[$i]->title.'</a>';
	            $brand->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $brand->lang = $_ARR_COLOR_LANG_BADGET[$list[$i]->lang];
	            // $brand->lang = 'vn';

				/* count product by brand */
				$product_controller->setSqlFilter(' and brand_id='.$list[$i]->ID);
				$brand->created_by = $product_controller->count();

	            $brand->t_index = '<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-brand'].'"><i class="fa-light fa-pen-to-square"></i></a>
	            	<a onclick="getDelRecord(\'delBrand\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $brand;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;
	
	case 'delBrand':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_BRAND);

        $_db = new database();
		$brand_controller = new brand_controller();

		$value = $_method->_Request("value","string");
		$r = $brand_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_color_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_COLOR);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$color_controller = new color_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'updated_by', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title_vn', 'dt' => 2 ),
	        array( 'db' => 'title_en',  'dt' =>3 ),
	        array( 'db' => 'code',  'dt' =>4 ),
	        array( 'db' => 't_status',  'dt' =>5 ),
	        array( 'db' => 'updated_date',  'dt' =>6 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $color_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $color_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $color_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $color_controller->setStart(intval($_POST['start']));
	        $color_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $color_controller->count();
	    /* list record */
	    $list = $color_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $color = new stdClass();
	            $link_edit = _LINK_COLOR_CREATE.'&id='.$list[$i]->ID;

	            // $color->lang = $list[$i]->lang;
	            $color->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $color->title_vn = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-color'].'">'.$list[$i]->title_vn.'</a>';
	            $color->title_en = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-color'].'">'.$list[$i]->title_en.'</a>';
	            $color->code = '<span class="badge me-2" style="background-color: '.$list[$i]->code.';width: 40px;">&nbsp;</span>'.$list[$i]->code;
	            $color->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $color->updated_date = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-color'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delColor\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $color;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delColor':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_COLOR);

        $_db = new database();
		$color_controller = new color_controller();

		$value = $_method->_Request("value","string");
		$r = $color_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_size_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SIZE);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$size_controller = new size_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'updated_by', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'title_vn', 'dt' => 2 ),
	        array( 'db' => 'title_en',  'dt' =>3 ),
	        array( 'db' => 't_status',  'dt' =>4 ),
	        array( 'db' => 'updated_date',  'dt' =>5 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $size_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $size_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $size_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $size_controller->setStart(intval($_POST['start']));
	        $size_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $size_controller->count();
	    /* list record */
	    $list = $size_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $size = new stdClass();
	            $link_edit = _LINK_SIZE_CREATE.'&id='.$list[$i]->ID;

	            // $size->lang = $list[$i]->lang;
	            $size->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $size->title_vn = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-size-attribute'].'">'.$list[$i]->title_vn.'</a>';
	            $size->title_en = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-size-attribute'].'">'.$list[$i]->title_en.'</a>';
	            $size->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $size->updated_date = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-size-attribute'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delSize\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $size;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delSize':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_SIZE);

        $_db = new database();
		$size_controller = new size_controller();

		$value = $_method->_Request("value","string");
		$r = $size_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_product_price_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT_PRICE);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$product_price_controller = new product_price_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 'updated_date', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'product_id', 'dt' => 2 ),
	        array( 'db' => 'color_id', 'dt' => 3 ),
	        array( 'db' => 'size_id',  'dt' =>4 ),
	        array( 'db' => 'price',  'dt' =>5 ),
	        array( 'db' => 'reduced_price',  'dt' =>6 ),
	        array( 'db' => 't_status',  'dt' =>7 ),
	        array( 'db' => 'updated_by',  'dt' =>8 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $product_price_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

        $filter = DATATABLE_SQL::filter($_POST,$columns);
	    $product_price_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $product_price_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $product_price_controller->setStart(intval($_POST['start']));
	        $product_price_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $product_price_controller->count();
	    /* list record */
	    $list = $product_price_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $product_price = new stdClass();
	            $link_edit = _LINK_PRODUCT_PRICE_CREATE.'&id='.$list[$i]->ID;

	            /* product */
	            $product_code = $_db->getField(TBLPRODUCT,'code','ID',$list[$i]->product_id);
	            $product_name = $_db->getField(TBLPRODUCT,'title','ID',$list[$i]->product_id);
	            $product_name_price = $_db->getField(TBLPRODUCT_PRICE,'title','ID',$list[$i]->ID);

	            $product_price->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            if ($product_name_price != '')
	            	$product_price->product_id = '<p><a title="'.$LANG['update-product-price'].'" href="'.$link_edit.'" class="text-decoration-none"><span class="text-muted">'.$product_code.' - '.$product_name.'</span>, '.$product_name_price.'</a></p>';
	            else
	            	$product_price->product_id = '<p><a title="'.$LANG['update-product-price'].'" href="'.$link_edit.'" class="text-decoration-none"><span class="text-muted">'.$product_code.' - '.$product_name.'</span></a></p>';

	            $product_price->price = $_method->showCurrency($list[$i]->price,_CURRENCY);
	            $product_price->reduced_price = $_method->showCurrency($list[$i]->reduced_price,_CURRENCY);

	            /* color */
	            $product_price->color_id = '';
	            if ($list[$i]->color_id > 0) {
		            $color_name = $_db->getField(TBLCOLOR,'title_vn','ID',$list[$i]->color_id);
		            if($color_name) {
		            	$color_code = $_db->getField(TBLCOLOR,'code','ID',$list[$i]->color_id);
		            	if(!$color_code || $color_code == '') $color_code = 'transparent';
		            	$product_price->color_id = '<span class="badge me-2" style="background-color: '.$color_code.';width: 40px;">&nbsp;</span>'.$color_name;
		            }
	            }

	            /* size */
	            $product_price->size_id = '';
	            if ($list[$i]->size_id > 0) {
	            	$product_price->size_id = $_db->getField(TBLSIZE,'title_vn','ID',$list[$i]->size_id);
	            }
	            
	            $product_price->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $product_price->updated_by = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-product-price'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delProductPrice\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $product_price;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delProductPrice':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT_PRICE);

        $_db = new database();
		$product_price_controller = new product_price_controller();

		$value = $_method->_Request("value","string");
		$r = $product_price_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_contact_form_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTACT_FORM);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$contactform_controller = new contactform_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 't_index', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'name', 'dt' => 2 ),
	        array( 'db' => 'phone',  'dt' =>3 ),
	        array( 'db' => 'created_date',  'dt' =>4 ),
	        array( 'db' => 't_status',  'dt' =>5 ),
	        array( 'db' => 'lang',  'dt' =>6 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $contactform_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $contactform_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $contactform_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $contactform_controller->setStart(intval($_POST['start']));
	        $contactform_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $contactform_controller->count();
	    /* list record */
	    $list = $contactform_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $contact_form = new stdClass();
	            $link_edit = _LINK_CONTACT_FORM_CREATE.'&id='.$list[$i]->ID;

	            // $contact_form->lang = $list[$i]->lang;
	            $contact_form->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $contact_form->name = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-contact-form'].'">'.$list[$i]->name.'</a>';
	            $contact_form->phone = $list[$i]->phone;
	            $contact_form->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $contact_form->created_date = date("d/m/Y | H:i:s",$list[$i]->created_date);
	            $contact_form->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-contact-form'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delContact_form\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $contact_form;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delContact_form':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_CONTACT_FORM);

        $_db = new database();
		$contactform_controller = new contactform_controller();

		$value = $_method->_Request("value","string");
		$r = $contactform_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_widget_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$widget_controller = new widget_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 't_index', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'w_code', 'dt' => 2 ),
	        array( 'db' => 'w_name',  'dt' =>3 ),
	        array( 'db' => 'w_max_item',  'dt' =>4 ),
	        array( 'db' => 'w_type',  'dt' =>5 ),
	        array( 'db' => 't_status',  'dt' =>6 ),
	        array( 'db' => 'lang',  'dt' =>7 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $widget_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $widget_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $widget_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $widget_controller->setStart(intval($_POST['start']));
	        $widget_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $widget_controller->count();
	    /* list record */
	    $list = $widget_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $widget = new stdClass();
	            $link_edit = _LINK_WIDGET_CREATE.'&id='.$list[$i]->ID;

	            $widget->ID = '<input class="form-check-input tb-checked-click" type="checkbox" value="'.$list[$i]->ID.'" id="tb-checked-item-'.$list[$i]->ID.'" name="tb-checked-item[]">';
	            $widget->w_code = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-widget'].'">'.$list[$i]->w_code.'</a>';
	            $widget->w_name = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-widget'].'">'.$list[$i]->w_name.'</a>';
	            $widget->w_max_item = $list[$i]->w_max_item;
	            $widget->w_type = $list[$i]->w_type;
	            $widget->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $widget->t_index = '
            		<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-widget'].'"><i class="fa-light fa-pen-to-square"></i></a>
 	    			<a onclick="getDelRecord(\'delWidget\','.$list[$i]->ID.')" href="javascript:;" class="badge text-bg-danger" title="'.$LANG['delete'].'"><i class="fa-light fa-trash-can"></i></a>';

	            $data[] = $widget;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;

	case 'delWidget':
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET);

        $_db = new database();
		$widget_controller = new widget_controller();

		$value = $_method->_Request("value","string");
		$r = $widget_controller->DeleteRecord($value);
		if (!$r) {
			$error = 'false';
			$html = $LANG['error_try_again'];
		}else{
			$error = 'true';
			$html = $LANG['deleted_successfully'];
		}

	    $objsmg = array('error'=>$error,'html'=>$html);

		print json_encode($objsmg);
		
		break;

	case '_widget_box_list':
		
		include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_WIDGET);
		include_once(_PATH_DATATABLE_SQL_CLASS);
		$widget_controller = new widget_controller();

		/* sql : select field */
	    $columns = array(
	        array( 'db' => 't_index', 'dt' => 0 ),
	        array( 'db' => 'ID', 'dt' => 1 ),
	        array( 'db' => 'w_name', 'dt' => 2 ),
	        array( 'db' => 'title',  'dt' =>3 ),
	        array( 'db' => 'position',  'dt' =>4 ),
	        array( 'db' => 't_status',  'dt' =>5 ),
	        array( 'db' => 'lang',  'dt' =>6 )
	    );
	    $selectField = DATATABLE_SQL::pluck($columns,'db');
	    $widget_controller->setSelectField(implode(',',DATATABLE_SQL::pluck($columns,'db')));

		/* sql : filter */
	    // $filter = '';
	    // if (isset($_POST['search']) && $_POST['search']['value'] != '') {
	    //     $date = $_POST['search']['value'];
	    //     $date = str_replace('/', '-', $date);
	    //     $d = DateTime::createFromFormat('d-m-Y', $date);
	    //     if ($d && $d->format('d-m-Y') == $date) {
	    //         /* search theo ngay donate */
	    //         $filter = ' and (created_date >= '.strtotime($date).' and created_date < '.strtotime('+1 day',strtotime($date)).') ';
	    //     } else {
	            $filter = DATATABLE_SQL::filter($_POST,$columns);
	    //     }
	    // }
	    $widget_controller->setSqlFilter($filter);

		/* sql : order by */
	    $sort = DATATABLE_SQL::order($_POST,$columns);
	    if ($sort != '') $sort .= ', ID desc ';
	    else $sort .= ' order by ID desc ';
	    $widget_controller->setSqlSort($sort);

		/* sql : limit record */
	    if (isset($_POST['start']) && $_POST['length'] != -1 ) {
	        $widget_controller->setStart(intval($_POST['start']));
	        $widget_controller->setLimit(intval($_POST['length']));
	    }

	    /* Total data set length */
	    $recordsTotal = $recordsFiltered = $widget_controller->count();
	    /* list record */
	    $list = $widget_controller->getList_Table();

	    $data = array();
	    if ($list) {
	        $_db = new database();
	        $count = count($list);
	        $_ARR_STATUS_BADGE = unserialize(_ARR_STATUS_BADGE);
	        for ($i=0; $i < $count; $i++) { 
	            $widget = new stdClass();
	            $link_edit = _LINK_WIDGET_BOX_CREATE.'&id='.$list[$i]->ID;

	            $widget->w_name = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-widget-box'].'">'.$list[$i]->w_name.'</a>';
	            $widget->title = '<a href="'.$link_edit.'" class="text-decoration-none" title="'.$LANG['update-widget-box'].'">'.$list[$i]->title.'</a>';
	            $widget->position = $list[$i]->position;
	            $widget->t_status = $_ARR_STATUS_BADGE[$list[$i]->t_status];
	            $widget->t_index = '<a href="'.$link_edit.'" class="badge text-bg-warning" title="'.$LANG['update-widget-box'].'"><i class="fa-light fa-pen-to-square"></i></a>';

	            $data[] = $widget;
	        }
	    }

	    $result_table = array(
	        "draw"            => $_POST['draw'],
	        "recordsTotal"    => $recordsTotal,
	        "recordsFiltered" => $recordsFiltered,
	        "data"            => $data
	    );
	    echo json_encode($result_table);
		
		break;




	default:
		
		break;
}
 ?>