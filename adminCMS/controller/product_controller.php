<?php

class product_controller {
	private $table = TBLPRODUCT;
	private $module = 'RSPRODUCT';
	private $_id;
	private $_data_form = array();

	private $_start = 0;
	private $_limit = 0;

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		cateid,
		t_status,
		code,
		title,
		title_search,
		urlseo,
		url,
		imgURL,
		introduction,
		content,
		price,
		reduced_price,
		unit_id,
		brand_id,
		t_index,
		most_view,
		lang,
		publish_date,
		created_by,
		created_date,
		updated_date,
		updated_by
	';
	
	public function getTable(){
		return $this->table;
	}
	public function getCodeModule(){
		return $this->module;
	}

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
	public function setLimit($limit){
		$this->_limit = $limit;
	}
	public function setStart($start){
		$this->_start = $start;
	}

	/* lay thong tin bai viet ID hoac sql_filter */
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

		isset($object['cateid']) ? $result->cateid = $object['cateid'] : $result->cateid = '';
		isset($object['t_status']) ? $result->t_status = $object['t_status'] : $result->t_status = '';
		isset($object['code']) ? $result->code = $object['code'] : $result->code = '';
		isset($object['title']) ? $result->title = $object['title'] : $result->title = '';
		isset($object['title_search']) ? $result->title_search = $object['title_search'] : $result->title_search = '';
		isset($object['urlseo']) ? $result->urlseo = $object['urlseo'] : $result->urlseo = '';
		isset($object['url']) ? $result->url = $object['url'] : $result->url = '';
		isset($object['imgURL']) ? $result->imgURL = $object['imgURL'] : $result->imgURL = '';
		isset($object['introduction']) ? $result->introduction = $object['introduction'] : $result->introduction = '';
		isset($object['content']) ? $result->content = $object['content'] : $result->content = '';
		isset($object['price']) ? $result->price = $object['price'] : $result->price = '';
		isset($object['reduced_price']) ? $result->reduced_price = $object['reduced_price'] : $result->reduced_price = '';
		isset($object['unit_id']) ? $result->unit_id = $object['unit_id'] : $result->unit_id = '';
		isset($object['brand_id']) ? $result->brand_id = $object['brand_id'] : $result->brand_id = '';
		isset($object['t_index']) ? $result->t_index = $object['t_index'] : $result->t_index = '';
		isset($object['most_view']) ? $result->most_view = $object['most_view'] : $result->most_view = '';
		isset($object['lang']) ? $result->lang = $object['lang'] : $result->lang = '';
		isset($object['publish_date']) ? $result->publish_date = $object['publish_date'] : $result->publish_date = '';
		isset($object['created_date']) ? $result->created_date = $object['created_date'] : $result->created_date = '';
		isset($object['created_by']) ? $result->created_by = $object['created_by'] : $result->created_by = '';
		isset($object['updated_date']) ? $result->updated_date = $object['updated_date'] : $result->updated_date = '';
		isset($object['updated_by']) ? $result->updated_by = $object['updated_by'] : $result->updated_by = '';

		return $result;
	}

	/* lay danh sach thong tin tai khoan */
	public function getList(){
		$db = new database();
		$sql=' select '.$this->_selectField.' from '.$this->table.' where 1 ';
		if($this->_sql_filter != '') $sql .= ' '.$this->_sql_filter.' ';
		if($this->_sql_sort != '') $sql .= ' '.$this->_sql_sort.' ';

		$db->query($sql);
		if($db->num_rows() < 1) return false;
		$result = array();
		while ($db->next_record()){
            $result[] = $this->format_std($db->record);
        }
		return $result;
	}

	/* them moi hoac cap nhat */
	public function update($id,$action='create'){
		$db = new database();
		
		if ($action == 'update') {
			$result = $db->updateTable($this->table,$this->_data_form,' ID='.$id.' ');
		}else{
			$result = $db->insertTable($this->table,$this->_data_form);
		}
		$this->setID($id);

		return $result;
	}
	
	public function getIndexSort($filter = ''){
		$db = new database();
		return $db->returnOrdinals($this->table,$filter);
	}

	public function createCode($arrString){
		return strtoupper(implode('', $arrString));
	}

	/* count : record */
	public function count(){
	    $db= new database();
		$sql=" select COUNT(ID) as count_id from ".$this->table." where 1 ";
		if($this->_sql_filter!="") $sql .=$this->_sql_filter;
		// var_dump($sql);
		$db->query($sql);
		if($db->num_rows()<=0) return 0;
		$db->next_record();
		return $db->record['count_id'];
	}

	/* list : datatable */
	function getList_Table(){
	    $db= new database();
		$sql="
			select ".$this->_selectField."
			from ".$this->table." 
		 	where 1 ";

		if($this->_sql_filter!="") $sql .= " ".$this->_sql_filter;
		$sql .= " ".$this->_sql_sort;
		if($this->_limit>0) $sql .=" limit ".$this->_start.",".$this->_limit;
		
		// var_dump($sql);
		$db->query($sql);
		if($db->num_rows()<=0) return false;

		$arrMembers = array();
		$arr_key = explode(',', $this->_selectField);
		while($db->next_record()){
			$objMember = new stdClass();

			foreach ($arr_key as $value) {
				$objMember->{$value} = $db->record[$value];
			}

			// $objMember->ID = $db->record['ID'];
			// $objMember->title = $db->record['title'];
			// $objMember->info = $db->record['info'];
			// $objMember->donate = $db->record['donate'];
			// $objMember->d_date = $db->record['d_date'];

			$arrMembers[] = $objMember;
		}
		return $arrMembers;
	}

	function DeleteRecord($str_id){
		if($str_id=="") return false;
		$arrId=explode(",",$str_id);
		if(count($arrId)<0) return false;
		$db= new database();
		$seo_controller = new seo_controller();
		$_library_controller = new library_controller();
		$_thumb = new thumb();
		
		for($i=0;$i<count($arrId);$i++){
			// $this->delWidget($id,$this->module_code); /* chua co widget */
			
			/* xoa file img */
			$pathimg = $db->getValue("select imgURL from ".$this->table." where ID =".$arrId[$i]." ","imgURL");	
			if($pathimg != '') $_thumb->del_File($pathimg);
			$rf = $this->Delete(_LEVEL_ADMIN._PATH_UPLOAD_PRODUCT.$arrId[$i]);/* delete folder */

			/* xoa file slide */
			$_library_controller->delWithNodeId($arrId[$i],$this->module,_LEVEL_ADMIN._PATH_UPLOAD_PRODUCT_SLIDER.$arrId[$i]);
			
			/* xoa seo */
			$rs = $seo_controller->deleteSEO($arrId[$i],$this->module);
		}

		/* xoa product - price */
		$result_p = $db->deleteRecord('delete from '.TBLPRODUCT_PRICE.' where product_id in ('.implode(",",$arrId).')');

		/* xoa product */
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
}
	
?>