<?php

class webmaster_controller {
	private $table = TBLWEBMASTER;
	private $_webMTID;
	private $_username;
	private $_email;
	private $_data_form = array();

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		username,
		password,
		fullname,
		phone,
		email,
		address,
		avatar,
		level,
		t_status,
		module_access,
		permit_access,
		salt,
		created_by,
		created_date,
		updated_date,
		updated_by
	';

	public function getID(){
		return $this->_webMTID;
	}
	public function setID($id){
		$this->_webMTID = $id;
	}

	public function getUsername(){
		return $this->_username;
	}
	public function setUsername($username){
		$this->_username = $username;
	}

	public function getEmail(){
		return $this->_email;
	}
	public function setEmail($email){
		$this->_email = $email;
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

	/* lay thong tin tai khoan theo username, email, ID */
	public function getDetail(){
		$db = new database();
		$sql=' select '.$this->_selectField.' from '.$this->table.' where  ID>0 ';
		if($this->_username != '')
			$sql .=' and username="'.$this->_username.'" ';
		if($this->_email != '')
			$sql .= ' and email="'.$this->_email.'" ';
		if($this->_webMTID != '')
			$sql .= ' and ID='.$this->_webMTID.' ';
		if($this->_sql_filter != '')
			$sql .= ' '.$this->_sql_filter.' ';

		$db->query($sql);
		if($db->num_rows() <= 0) return false;
		$db->next_record();
		return $this->format_std($db->record);
	}

	/* format thong tin tai khoan ve dang doi tuong */
	private function format_std($accountDetail = array()){
		$result = new stdClass();
		$result->ID = $accountDetail['ID'];

		isset($accountDetail['username']) ? $result->username = $accountDetail['username'] : $result->username = '';
		isset($accountDetail['password']) ? $result->password = $accountDetail['password'] : $result->password = '';
		isset($accountDetail['fullname']) ? $result->fullname = $accountDetail['fullname'] : $result->fullname = '';
		isset($accountDetail['phone']) ? $result->phone = $accountDetail['phone'] : $result->phone = '';
		isset($accountDetail['email']) ? $result->email = $accountDetail['email'] : $result->email = '';
		isset($accountDetail['address']) ? $result->address = $accountDetail['address'] : $result->address = '';
		isset($accountDetail['avatar']) ? $result->avatar = $accountDetail['avatar'] : $result->avatar = '';
		isset($accountDetail['level']) ? $result->level = $accountDetail['level'] : $result->level = '';
		isset($accountDetail['t_status']) ? $result->t_status = $accountDetail['t_status'] : $result->t_status = '';
		isset($accountDetail['module_access']) ? $result->module_access = $accountDetail['module_access'] : $result->module_access = '';
		isset($accountDetail['permit_access']) ? $result->permit_access = $accountDetail['permit_access'] : $result->permit_access = '';
		isset($accountDetail['salt']) ? $result->salt = $accountDetail['salt'] : $result->salt = '';
		isset($accountDetail['created_date']) ? $result->created_date = $accountDetail['created_date'] : $result->created_date = '';
		isset($accountDetail['created_by']) ? $result->created_by = $accountDetail['created_by'] : $result->created_by = '';
		isset($accountDetail['updated_date']) ? $result->updated_date = $accountDetail['updated_date'] : $result->updated_date = '';
		isset($accountDetail['updated_by']) ? $result->updated_by = $accountDetail['updated_by'] : $result->updated_by = '';

		return $result;
	}

	/* doi mat khau cua tai khoan */
	public function changePassword($password_old,$password_new){
		$Session = new Session();
		$db = new database();

		$password_current = $db->getField($this->table, 'password', 'ID', $this->_webMTID);
		$salt = $db->getField($this->table, 'salt', 'ID', $this->_webMTID);

		if(md5(md5($password_old).$salt) != $password_current) return false;
	
		$salt = method::get_random_string(3);
		$password_current_new = md5(md5($password_new).$salt);
		$data_form=array(
			'password'=>$password_current_new,
			'salt'=>$salt,
			'updated_date'=>time(),
			'updated_by'=>$this->_webMTID
		);
		$result = $db->updateTable($this->table,$data_form,' ID='.$this->_webMTID.' ');

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