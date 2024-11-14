<?php

class company_controller {
	private $table = TBLCOMPANY;
	private $_id;
	private $_data_form = array();

	private $_start = 0;
	private $_limit = 0;

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		t_status,
		name,
		address,
		copyright,
		brand,
		logo,
		logo_footer,
		logo_favicon,
		website,
		fax,
		hotline,
		phone,
		email,
		facebook,
		twitter,
		youtube,
		instagram,
		linkedin,
		pinterest,
		embedgooglemap,
		lang,
		created_by,
		created_date,
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

		isset($object['t_status']) ? $result->t_status = $object['t_status'] : $result->t_status = '';
		isset($object['name']) ? $result->name = $object['name'] : $result->name = '';
		isset($object['address']) ? $result->address = $object['address'] : $result->address = '';
		isset($object['copyright']) ? $result->copyright = $object['copyright'] : $result->copyright = '';
		isset($object['brand']) ? $result->brand = $object['brand'] : $result->brand = '';
		isset($object['logo']) ? $result->logo = $object['logo'] : $result->logo = '';
		isset($object['logo_footer']) ? $result->logo_footer = $object['logo_footer'] : $result->logo_footer = '';
		isset($object['logo_favicon']) ? $result->logo_favicon = $object['logo_favicon'] : $result->logo_favicon = '';
		isset($object['website']) ? $result->website = $object['website'] : $result->website = '';
		isset($object['fax']) ? $result->fax = $object['fax'] : $result->fax = '';
		isset($object['hotline']) ? $result->hotline = $object['hotline'] : $result->hotline = '';
		isset($object['phone']) ? $result->phone = $object['phone'] : $result->phone = '';
		isset($object['email']) ? $result->email = $object['email'] : $result->email = '';
		isset($object['facebook']) ? $result->facebook = $object['facebook'] : $result->facebook = '';
		isset($object['twitter']) ? $result->twitter = $object['twitter'] : $result->twitter = '';
		isset($object['youtube']) ? $result->youtube = $object['youtube'] : $result->youtube = '';
		isset($object['instagram']) ? $result->instagram = $object['instagram'] : $result->instagram = '';
		isset($object['linkedin']) ? $result->linkedin = $object['linkedin'] : $result->linkedin = '';
		isset($object['pinterest']) ? $result->pinterest = $object['pinterest'] : $result->pinterest = '';
		isset($object['embedgooglemap']) ? $result->embedgooglemap = $object['embedgooglemap'] : $result->embedgooglemap = '';
		isset($object['lang']) ? $result->lang = $object['lang'] : $result->lang = '';
		isset($object['created_date']) ? $result->created_date = $object['created_date'] : $result->created_date = '';
		isset($object['created_by']) ? $result->created_by = $object['created_by'] : $result->created_by = '';
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
		// $_thumb = new thumb();
		
		for($i=0;$i<count($arrId);$i++){
			/* xoa file img */
			// $pathimg = $db->getValue("select imgURL from ".$this->table." where ID =".$arrId[$i]." ","imgURL");	
			// if($pathimg != '') $_thumb->del_File($pathimg);
			$rf = $this->Delete(_LEVEL_ADMIN._PATH_UPLOAD_COMPANY.$arrId[$i]);/* delete folder */
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

}
	
?>