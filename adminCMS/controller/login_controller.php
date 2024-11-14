<?php

	class login_controller {
		private $_LANG;
		function __construct(){
			$this->_LANG			= unserialize(_LANG);
		}

		public function checklogin(){
			$Session = new Session();
			$username_admin  = $Session->get('username_admin');
			$webmtId		 = $Session->get('webmtId');
		
			if($username_admin =='' || $webmtId == 0)
				return false;
			else
				return true;	
		}
		/* danh nhap */
		public function login($txt_username,$txt_password){
			if ($txt_username == '' || $txt_password == '') return false;

			$webmaster_controller = new webmaster_controller();
			$webmaster_controller->setUsername($txt_username);
			$account = $webmaster_controller->getDetail();
			if(!isset ($account)) return false;
			if($account->password==md5(md5($txt_password).$account->salt) ){
				if(((int)$account->t_status) != 1) return 'error_status';
				
				$Session = new Session();
				$Session->set('username_admin',$account->username);
				$Session->set('webmt_email', $account->email);
				$Session->set('webmt_fullname',$account->fullname);
				$Session->set('webmtId',$account->ID);
				$Session->set('module_access',$account->module_access);
				$Session->set('permit_access',$account->permit_access);
				$Session->set('webmt_level',$account->level);

				return true;
			} 
			else return false;
		}
		/* forgot reset password*/
		public function forgotpass($email){

			$db = new database();
		
			$salt = $db->getField(TBLWEBMASTER, 'salt', 'email', $email);
			if(!$salt ) return false;
			else{
				/*Reset Password lai*/
			    $username           = $db->getField(TBLWEBMASTER, 'username', 'email', $email);
				// $salt 				= $idexist;
				$pass_rd 			= method::get_random_string(8);	/* tao mat khau moi cho nguoi dung */
				$new_password 		= md5(md5($pass_rd).$salt);/* Luu chuoi password duoc ma hoa bang md5 vao database */
				$data_form = array('password'=>$new_password);
				$result = $db->updateTable(TBLWEBMASTER,$data_form,' email="'.$email.'" ');
				if($result){
				    /*Send password moi qua email cho nguoi dung*/
				    $Subject= $this->_LANG['fp_subject']." - "._SERVER_NAME."";
				    $bodymail="
						<p>".$this->_LANG['hello'].",<br/></p>
						<p>".$this->_LANG['fp_content_1']."</p>
						<p>".$this->_LANG['fp_content_2']." "._ROOT_PATH_ADMIN."index.php</p>
						<p>".$this->_LANG['username'].": ".$username."</p>
						<p>".$this->_LANG['password'].":  ".$pass_rd."</p>
						<p>".$this->_LANG['fp_content_3']."</p>
						<p>".$this->_LANG['fp_content_4']."<br/></p>
						<p>"._SERVER_NAME."</p>
				        
				    ";
					return method::sendMail($email, $Subject, $bodymail,"");		    
				}
			}
			
		}
	}
	
?>