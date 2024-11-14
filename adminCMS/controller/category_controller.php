<?php

class category_controller {
	private $table = TBLCATEGORY;
	private $module = 'RSCATEGORY';
	private $_id;
	private $_data_form = array();

	private $_sql_filter = '';
	private $_sql_sort = '';
	private $_selectField = '
		ID,
		code,
		code_module,
		title,
		title_search,
		urlseo,
		t_status,
		position,
		`left`,
		`right`,
		level,
		parent_id,
		intro,
		description,
		imgURL,
		menu,
		url,
		lang,
		created_by,
		created_date,
		updated_date,
		updated_by
	';

	public function getID(){
		return $this->_id;
	}
	public function setID($id){
		$this->_id = $id;
	}

	public function getDataForm($data_form){
		return $this->_data_form;
	}
	public function setDataForm($data_form){
		$this->_data_form = $data_form;
	}

	public function setSelectField($selectField){
		$this->_selectField = $selectField;
	}
	public function setSqlFilter($sql_filter){
		$this->_sql_filter = $sql_filter;
	}
	public function setSqlSort($sql_sort){
		$this->_sql_sort = $sql_sort;
	}

	public function getTable(){
		return $this->table;
	}

	/* lay thong tin doi tuong */
	public function getDetail(){
		$db = new database();
		$sql=' select '.$this->_selectField.' from '.$this->table.' where  ID>0 ';
		if($this->_id != '')
			$sql .= ' and ID='.$this->_id.' ';
		if($this->_sql_filter != '')
			$sql .= ' '.$this->_sql_filter.' ';
		$db->query($sql);
		if($db->num_rows() <= 0) return false;
		$db->next_record();
		return $this->format_std($db->record);
	}

	/* format thong tin tai khoan ve dang doi tuong */
	private function format_std($object = array()){
		$result = new stdClass();
		$result->ID = $object['ID'];

		isset($object['code']) ? $result->code = $object['code'] : $result->code = '';
		isset($object['code_module']) ? $result->code_module = $object['code_module'] : $result->code_module = '';
		isset($object['title']) ? $result->title = $object['title'] : $result->title = '';
		isset($object['title_search']) ? $result->title_search = $object['title_search'] : $result->title_search = '';
		isset($object['urlseo']) ? $result->urlseo = $object['urlseo'] : $result->urlseo = '';
		isset($object['t_status']) ? $result->t_status = $object['t_status'] : $result->t_status = '';
		isset($object['position']) ? $result->position = $object['position'] : $result->position = '';
		isset($object['left']) ? $result->left = $object['left'] : $result->left = '';
		isset($object['right']) ? $result->right = $object['right'] : $result->right = '';
		isset($object['level']) ? $result->level = $object['level'] : $result->level = '';
		isset($object['parent_id']) ? $result->parent_id = $object['parent_id'] : $result->parent_id = '';
		isset($object['intro']) ? $result->intro = $object['intro'] : $result->intro = '';
		isset($object['description']) ? $result->description = $object['description'] : $result->description = '';
		isset($object['imgURL']) ? $result->imgURL = $object['imgURL'] : $result->imgURL = '';
		isset($object['menu']) ? $result->menu = $object['menu'] : $result->menu = '';
		isset($object['url']) ? $result->url = $object['url'] : $result->url = '';
		isset($object['lang']) ? $result->lang = $object['lang'] : $result->lang = '';
		isset($object['created_date']) ? $result->created_date = $object['created_date'] : $result->created_date = '';
		isset($object['created_by']) ? $result->created_by = $object['created_by'] : $result->created_by = '';
		isset($object['updated_date']) ? $result->updated_date = $object['updated_date'] : $result->updated_date = '';
		isset($object['updated_by']) ? $result->updated_by = $object['updated_by'] : $result->updated_by = '';

		return $result;
	}

	/* lay danh sach doi tuong */
	public function getList(){
		$db = new database();
		$sql=' select '.$this->_selectField.' from '.$this->table.' where 1 ';
		if($this->_sql_filter != '') $sql .= ' '.$this->_sql_filter.' ';

		$db->query($sql);
		if($db->num_rows() < 1) return false;
		$result = array();
		while ($db->next_record()){
            $result[] = $this->format_std($db->record);
        }
		return $result;
	}

	/* them moi hoac cap nhat */
	public function update($id,$action){
		$db = new database();

		if ($action == 'update') {
			$result = $db->updateTable($this->table,$this->_data_form,' ID='.$id.' ');
		}else{
			$result = $db->insertTable($this->table,$this->_data_form);
		}
		$this->setID($id);

		return $result;
	}
	/*================= Check Node ==================*
	 * Desc: ham kiem tra xem $node co con hay khong *
	 * return true/false *
	 * Parameter: $node la mot NodeID */
	public function exist_child($rootid){
		$db  = new database();
		$sql="select ID from ".$this->table." where `parent_id`=".$rootid." order by `position` ASC limit 0,1";
		$db->query($sql);	
		return $db->num_rows();
	}
	/* truyen id danh muc con de tra ve code lang cua danh muc do */
	public function getLangByID($id){
		$db = new database();
		$lang = $db->getField($this->table,'lang','ID',$id);
		return $lang;
	}
	/* lay ID root cua lang */
	public function getRootID_byLang($lang){
		$db = new database();
		$result = $db->getField($this->table,'ID','code',strtoupper($lang),' and code_module ="_LANGUAGE" ');
		return $result;
	}
	/* countID */
	public function countID($filter){
		$db = new database();
		$sql = '
			select count(ID) as coundID 
			from '.$this->table.'
			where 1
			'.$filter.'
		';
		return $db->getValue($sql,'coundID');
	}
	/* lay danh sach ngon ngu cua danh muc, retur array(id=>title) */
	public function getListLang(){
		$db=new database();
		$sql="	select code,title from ".$this->table."  where code_module ='_LANGUAGE' and level = 1 ";
		$sql .= $this->_sql_filter;
		$db->query($sql);
		if($db->num_rows()<=0) return false;
		$arrCate = array();
		while ($db->next_record()){
			$arrCate[strtolower($db->record['code'])]=$db->record['title'];
		}
		return $arrCate;
	}
	public function arrtree_mod($arr_cate,$idroot,$limitlevel=100){
		$level = 0;
		if (isset($arr_cate[$idroot]["level"])) {
			$level = $arr_cate[$idroot]["level"];
		}
		$levelPre = 0;
		if (isset($arr_cate[$idroot]["level"])) {
			$levelPre = $arr_cate[$idroot]["level"];
		}

		$titlePre="";
		$strTitle="";
		$arrTemp=array();
		$arrTitle=array();
		if (!$arr_cate) return $arrTemp;
		foreach($arr_cate as $key => $aCat){
			if( ($aCat['level'] - $level) <= $limitlevel){
				$IDcurr = $aCat['id'];
				if($levelPre < $aCat['level']){
					$arrTitle[]=$aCat['title'];
				}
				if($levelPre == $aCat['level']){
					unset($arrTitle[count($arrTitle)-1]);
					$arrTitle=array_values($arrTitle);
					$arrTitle[]=$aCat['title'];
				}
			
				$total=0;
				if($levelPre > $aCat['level']){
					if($aCat['level']==1) $arrTitle = array();
					else{
						$pr_l = 0;
						if(isset($arr_cate[$aCat['parent_id']])){
							$pr_l = $arr_cate[$aCat['parent_id']]["level"];
						}
						$arrTitle = array_values($arrTitle);
						$total = $levelPre - $pr_l;
						for($j=0;$j<$total;$j++){
							unset($arrTitle[count($arrTitle)-1]);
							$arrTitle=array_values($arrTitle);
						}
						$arrTitle[]=$aCat['title'];
					}
				}
				$strTitle =implode(" >> ",$arrTitle);
				if($strTitle != ''){
					$arrTemp[$IDcurr] = $strTitle;
				}else{
					$arrTemp[$IDcurr] = $aCat['title'];
				}
				$IDPre= $aCat['id'];
				$levelPre=$aCat['level'];
				$titlePre=$aCat['title'];
	        }
	    }
		return $arrTemp;
	}
	public function getIndexSort($filter = ''){
		$db = new database();
		return $db->returnOrdinals($this->table,$filter);
	}

	function update_status_children($nodeid,$t_status){
		$str = '';
		$_tree_cate  = new _tree_struct($this->table);
		$arr_cate = $_tree_cate->_get_children($nodeid,true,0);
		if(is_array($arr_cate)){ 
			$key = array_keys($arr_cate); 
			$str = implode(",",$key);
		}

		if($str != ''){
			$db = new database();
			$sql = "update ".$this->table." set `t_status`=".$t_status." where  `ID` in (".$str.")";
			$db->query($sql);
		}
	}

	/* get arr children to ID */
	public function getChildrentoID($id){
		$arr_disable = array();
	    if ($id >= 0) {
			$_tree_cate  = new _tree_struct($this->table);
			$arr_cate = $_tree_cate->_get_children($id,true);
			if (!$arr_cate) return $arr_disable;
			
			$maxlevel = $arr_cate[$id]["level"];
			foreach($arr_cate as $aCat){
				if($aCat['level'] >= $maxlevel) $arr_disable[] = $aCat['id'];
			}
	    }
	    return $arr_disable;
	}

	/* Update status */
	public function updateStatus($id){
		$db = new database();

		if ($id != 0) {
			$result = $db->updateTable($this->table,$this->_data_form,' ID='.$id.' ');
			return $result;
		}else{
			return false;
		}
	}
	
	function DeleteRecord($str_id){
		if($str_id=="") return false;
		$arrId=explode(",",$str_id);
		if(count($arrId)<0) return false;
		$db= new database();
		$seo_controller = new seo_controller();
		// $_LIBFILE_CORE=new LIBFILE_CORE();
		$_thumb = new thumb();
		
		for($i=0;$i<count($arrId);$i++){
			// $this->delWidget($id,$this->module_code); /* chua co widget */
			
			/* xoa file img */
			$pathimg = $db->getValue("select imgURL from ".$this->table." where ID =".$arrId[$i]." ","imgURL");	
			if($pathimg != '') $_thumb->del_File($pathimg);
			$rf = $this->Delete(_LEVEL_ADMIN._PATH_UPLOAD_CATEGORY.$arrId[$i]);/* delete folder */

			/* xoa file slide */
			// $_LIBFILE_CORE->delfileWithNodeID($arrId[$i],_LEVEL_ADMIN._PATH_UPLOAD_ARTICLES."slide/".$arrId[$i],$this->module_code);
			
			/* xoa file slide */
			$rs = $seo_controller->deleteSEO($arrId[$i],$this->module);
		}

		$result = $db->deleteRecord('delete from '.$this->table.' where ID in ('.implode(",",$arrId).')');
		return $result;	
	}

	/* delete folder */
	function Delete($path){
		if (is_dir($path) === true){
			$files = array_diff(scandir($path), array('.', '..'));
			foreach ($files as $file){
				$this->Delete(realpath($path) . '/' . $file);
			}
			return rmdir($path);
		}else if (is_file($path) === true){
			return unlink($path);
		}
		return false;
	}

	/* list cate in banner */
	function multi_arrsubtree($idrootarr,$current){
 		$count_arr = count($idrootarr);
 		$html_option = '';
 		for($i=0;$i<$count_arr;$i++){
 			$html_option .= $this->arrsubtree($idrootarr[$i],_LEVEL_CATE_ADMIN,$current);
		}
		return $html_option;
	}
	function arrsubtree($idroot,$limitlevel,$default_value){

		$db= new database();
		$_tree_cate  = new _tree_struct($this->table);
		$arr_cate = $_tree_cate->_get_children($idroot,true,0,'');

		$level = 0;
		if ($arr_cate[$idroot]["level"] != '') {
			$level = $arr_cate[$idroot]["level"];
		}

		$levelPre = $level;
		foreach($arr_cate as $key => $items){
			unset($arr_cate[$key]); break;
		}

		$str_option = '';
		foreach($arr_cate as $aCat){
			if( ($aCat['level'] - $level) <= $limitlevel ){
				
				$select = '';
				if(in_array($aCat['id'],$default_value[0]) || $default_value == $aCat['id']){
					$select = 'selected="selected"';
				}

				$child_id = $this->exist_child($aCat['id']);
				if( ($aCat['parent_id'] == $idroot && $child_id )){
					if ($levelPre > $aCat['level']) {
						$str_option .= '</optgroup>';
					}
					$str_option .= '<optgroup label="'.$aCat['title'].'">';
				}
				if( ($aCat['parent_id'] == $idroot && !$child_id )){
					if ($levelPre > $aCat['level']) {
						$str_option .= '</optgroup>';
					}
					$str_option .= '<optgroup label="'.$aCat['title'].'"></optgroup>';
				}
				if ($aCat['parent_id'] != $idroot) {
					$str_option .= '<option '.$select.' value="'.$aCat['id'].'">'.$aCat['title'].'</option>';
				}
				
				$levelPre = $aCat['level'];
			}
		}
		return $str_option;
	}
}
	
?>