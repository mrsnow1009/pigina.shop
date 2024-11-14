<?php

class order_detail_controller {
	private $table = TBLORDER_DETAIL;
	private $_id;
	private $_data_form = array();

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		order_id,
		product_id,
		product_price_id,
		color,
		size,
		product_name,
		price,
		reduced_price,
		quantity
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
		isset($object['product_id']) ? $result->product_id = $object['product_id'] : $result->product_id = '';
		isset($object['product_price_id']) ? $result->product_price_id = $object['product_price_id'] : $result->product_price_id = '';
		isset($object['color']) ? $result->color = $object['color'] : $result->color = '';
		isset($object['size']) ? $result->size = $object['size'] : $result->size = '';
		isset($object['product_name']) ? $result->product_name = $object['product_name'] : $result->product_name = '';
		isset($object['price']) ? $result->price = $object['price'] : $result->price = '';
		isset($object['reduced_price']) ? $result->reduced_price = $object['reduced_price'] : $result->reduced_price = '';
		isset($object['quantity']) ? $result->quantity = $object['quantity'] : $result->quantity = '';

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

	/* lay tong tien cua 1 don hang */
	public function getTotal($order_id){
		$db = new database();
		$sql=' select sum(reduced_price * quantity) as total from '.$this->table.' where 1 and order_id='.$order_id;
		if($this->_sql_filter != '') $sql .= ' '.$this->_sql_filter.' ';

		$db->query($sql);
		if($db->num_rows() < 1) return 0;
		$db->next_record();
		return $db->record['total'];
	}

	/* lay tong $field cua 1 don hang */
	public function getTotalbyField($order_id,$field = 'quantity'){
		$db = new database();
		$sql=' select sum('.$field.') as total from '.$this->table.' where 1 and order_id='.$order_id;
		if($this->_sql_filter != '') $sql .= ' '.$this->_sql_filter.' ';

		$db->query($sql);
		if($db->num_rows() < 1) return 0;
		$db->next_record();
		return $db->record['total'];
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
		$arrId = explode(",",$str_id);
		if(count($arrId)<0) return false;
		$db = new database();
		
		$result = $db->deleteRecord('delete from '.$this->table.' where ID in ('.implode(",",$arrId).')');
		return $result;	
	}

}
	
?>