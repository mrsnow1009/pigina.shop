<?php
	class Render_Controller {
		private $vars = array();
		private $view = '';

		public function __construct($path_view){
			$this->view = $path_view;
		}

		public function setVar($key,$value){
			$this->vars[$key] = $value;
		}

		public function getVar($key){
			if (isset($this->vars[$key]))
				return $this->vars[$key];
			return false;
		}

		public function renderTemplate(){
			extract($this->vars,EXTR_SKIP);
			if(file_exists($this->view)){
				// ob_start();
				include($this->view);
				// ob_get_clean(); 
			}else{
				die($this->view.' khong ton tai');
			}
		}
	}
?>