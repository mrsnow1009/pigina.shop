<?php

class order_buyer_controller {
	private $table = TBLORDER_BUYER;
	private $_id;
	private $_data_form = array();

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		order_id,
		fullname,
		phone,
		email,
		address
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

	/* lay thong tin ID hoac sql_filter */
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

	/* format thong tin ve dang doi tuong */
	private function format_std($object = array()){
		$result = new stdClass();
		$result->ID = $object['ID'];
		
		isset($object['order_id']) ? $result->order_id = $object['order_id'] : $result->order_id = '';
		isset($object['fullname']) ? $result->fullname = $object['fullname'] : $result->fullname = '';
		isset($object['phone']) ? $result->phone = $object['phone'] : $result->phone = '';
		isset($object['email']) ? $result->email = $object['email'] : $result->email = '';
		isset($object['address']) ? $result->address = $object['address'] : $result->address = '';

		return $result;
	}

	/* lay danh sach thong tin */
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