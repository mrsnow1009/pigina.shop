<?php

class seo_controller {
	private $table = TBLSEO;
	private $_id;
	private $_data_form = array();

	private $_sql_filter = '';
	private $_selectField = '
		ID,
		code_module,
		nodeid,
		title,
		keywords,
		description
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

		isset($object['code_module']) ? $result->code_module = $object['code_module'] : $result->code_module = '';
		isset($object['title']) ? $result->title = $object['title'] : $result->title = '';
		isset($object['keywords']) ? $result->keywords = $object['keywords'] : $result->keywords = '';
		isset($object['description']) ? $result->description = $object['description'] : $result->description = '';
		isset($object['nodeid']) ? $result->nodeid = $object['nodeid'] : $result->nodeid = '';

		return $result;
	}

	/* them moi hoac cap nhat */
	public function update($id){
		$db = new database();
		if ($id != 0) {
			$result = $db->updateTable($this->table,$this->_data_form,' ID='.$id.' ');
		}else{
			$id = $db->getMaxID($this->table,'ID');
			$this->_data_form['ID'] = $id;
			$result = $db->insertTable($this->table,$this->_data_form);
		}

		$this->setID($id);

		return $result;
	}

	/* delete */
	function delete($id){
		$db = new database();
		// return $db->deleteRecord('delete from '.$this->table.' where ID = '.$id);
		return $db->deleteTable($this->table,array('ID'=>(int)$id));
	}
	/* delete */
	function deleteSEO($nodeid,$module){
		$db = new database();
		return $db->deleteTable($this->table,array('nodeid'=>(int)$nodeid,'code_module'=>$module));
	}
}
	
?>