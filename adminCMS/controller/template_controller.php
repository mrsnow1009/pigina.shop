<?php

class template_controller {
	private $table = TBLTEMPLATE;
	private $_id;
	private $_data_form = array();

	private $_start = 0;
	private $_limit = 0;

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		name,
		title,
		content,
		code,
		t_group,
		lang,
		t_status,
		mask,
		t_index,
		updated_date,
		updated_by
	';
	
	public function getTable(){
		return $this->table;
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

		isset($object['name']) ? $result->name = $object['name'] : $result->name = '';
		isset($object['title']) ? $result->title = $object['title'] : $result->title = '';
		isset($object['content']) ? $result->content = $object['content'] : $result->content = '';
		isset($object['code']) ? $result->code = $object['code'] : $result->code = '';
		isset($object['t_group']) ? $result->t_group = $object['t_group'] : $result->t_group = '';
		isset($object['lang']) ? $result->lang = $object['lang'] : $result->lang = '';
		isset($object['t_status']) ? $result->t_status = $object['t_status'] : $result->t_status = '';
		isset($object['mask']) ? $result->mask = $object['mask'] : $result->mask = '';
		isset($object['t_index']) ? $result->t_index = $object['t_index'] : $result->t_index = '';
		isset($object['updated_date']) ? $result->updated_date = $object['updated_date'] : $result->updated_date = '';
		isset($object['updated_by']) ? $result->updated_by = $object['updated_by'] : $result->updated_by = '';

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
	
	public function getIndexSort($filter = ''){
		$db = new database();
		return $db->returnOrdinals($this->table,$filter);
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

			$arrMembers[] = $objMember;
		}
		return $arrMembers;
	}

	function DeleteRecord($str_id){
		if($str_id=="") return false;
		$arrId=explode(",",$str_id);
		if(count($arrId)<0) return false;
		$db= new database();

		$result = $db->deleteRecord('delete from '.$this->table.' where ID in ('.implode(",",$arrId).')');
		return $result;	
	}

}
	
?>