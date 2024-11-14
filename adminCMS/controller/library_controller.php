<?php

class library_controller {
	private $table = TBLLIBRARY;
	private $_id;
	private $_data_form = array();
	private $_LANG;

	private $_start = 0;
	private $_limit = 0;

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		nodeid,
		code_module,
		source,
		title,
		intro,
		link,
		t_index,
		created_date,
		created_by
	';

	function __construct($arrVal=array()){
		$this->_LANG = unserialize(_LANG);
	}
	
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

	private $thumb_arr;
	private $thumb_index;
	private $path_upload;
	private $node_id;

	function setThumbArr($thumb_arr){
		$this->thumb_arr = $thumb_arr;
	}
	function setThumbIndex($thumb_index){
		$this->thumb_index = $thumb_index;
	}
	function setPathUpload($path_upload){
		$this->path_upload = $path_upload;
	}
	function setNodeID($node_id){
		$this->node_id = $node_id;
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

		isset($object['nodeid']) ? $result->nodeid = $object['nodeid'] : $result->nodeid = '';
		isset($object['code_module']) ? $result->code_module = $object['code_module'] : $result->code_module = '';
		isset($object['title']) ? $result->title = $object['title'] : $result->title = '';
		isset($object['source']) ? $result->source = $object['source'] : $result->source = '';
		isset($object['intro']) ? $result->intro = $object['intro'] : $result->intro = '';
		isset($object['link']) ? $result->link = $object['link'] : $result->link = '';
		isset($object['t_index']) ? $result->t_index = $object['t_index'] : $result->t_index = '';
		isset($object['created_date']) ? $result->created_date = $object['created_date'] : $result->created_date = '';
		isset($object['created_by']) ? $result->created_by = $object['created_by'] : $result->created_by = '';

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
		
		// for($i=0;$i<count($arrId);$i++){
			
			/* xoa file img */
			// $pathimg = $db->getValue("select imgURL from ".$this->table." where ID =".$arrId[$i]." ","imgURL");	
			// if($pathimg != '') $_thumb->del_File($pathimg);
			// $rf = $this->Delete(_LEVEL_ADMIN.$this->path_upload.$arrId[$i]);/* delete folder */

			/* xoa file slide */
			// $this->delfileWithNodeID($arrId[$i],_LEVEL_ADMIN.$this->path_upload.$arrId[$i],$this->module_code);
		// }

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

	/* xoa record trong tlblibrary theo nodeid */
	function delWithNodeId($nodeid,$module,$folder = ''){
		$db = new database();
		/* xoa folder slide */
		if($folder != '') {
			$_thumb= new thumb();
			$_thumb->deleteDirectory($folder);
		}
		/* xoa record */
		$data_form = array(
			'nodeid'=>$nodeid,
			'code_module'=>$module
		);
		$result = $db->deleteTable($this->table,$data_form);
	}

	function updateForm($code_module,$temp_id){
		$title = method::_Post('title','array');
		$intro = method::_Post('intro','array');
		$link = method::_Post('linkUrl','array');
		$file_url = method::_Post("slidethumnail_gallery","array");

		$_thumb= new thumb();
		$db = new database();
		$Session = new Session();

		$pathdes  = _PHISICAL_PATH_ROOT.$this->path_upload.$this->node_id."/";

		if ($temp_id != 0) {
			/* add */
			$path_tmp = _PHISICAL_PATH_ROOT.$this->path_upload.$temp_id."/";
			/* doi ten /{datastring}/ thanh /{id}/ */
			if(is_dir($path_tmp) && !is_dir($pathdes)) {
				rename($path_tmp, $pathdes);
			}
		}
		/* tao folder /{id}/ */
		$_thumb->create_folder($pathdes);
		@chmod($pathdes,0777);

		if($file_url && is_array($file_url) && count($file_url) > 0){
			$count_file = count($file_url);
			for ($i=0; $i < $count_file; $i++) { 
				$file_url[$i] = trim($file_url[$i]);

				if($temp_id != 0){
					$file_url[$i] = str_replace($temp_id,$this->node_id,$file_url[$i]);
				}

				$paththumb = $_thumb->getPathReal($file_url[$i]);
				$filepath = str_replace(_PHISICAL_PATH_ROOT,"",$file_url[$i]);
				$check_id_exist = $db->getField($this->table,'ID','source',$filepath);

				if(!$check_id_exist){
					/* add watermark */
					/*$_ARRAY_WATERMARK = unserialize(_ARRAY_WATERMARK);
					if ($_ARRAY_WATERMARK['status'] == 1) {
						$_thumb->watermark_image_no_bg(
							$paththumb,$_ARRAY_WATERMARK['path_img'],
							$_ARRAY_WATERMARK['marginRight'],
							$_ARRAY_WATERMARK['marginBottom'],
							$_ARRAY_WATERMARK['quality'],
							$_ARRAY_WATERMARK['opacity']);
					}*/
					$_thumb->create_scaled_image($paththumb, array("upload_dir"=>$pathdes,"arr_size"=>$this->thumb_arr,"index_thumb"=>$this->thumb_index));

				    $name_file = basename($file_url[$i]);
				    if (!file_exists($pathdes.$name_file)){
					    copy($file_url[$i], $pathdes.$name_file);
					    if (file_exists($paththumb)) {
					    	unlink($paththumb);
					    }
				    }
					    
				    $fileid = $db->getMaxID($this->getTable(),'ID');
				    $this->_data_form = array(
				        "ID"=>$fileid,
				        "nodeid"=>$this->node_id,
				        "code_module"=>$code_module,
				        /* "source"=>$filepath, */
				        "source"=>$this->path_upload.$this->node_id."/".$name_file,
				        "title"=>htmlentities($title[$i],ENT_QUOTES,'UTF-8'),
				        "intro"=>nl2br(htmlentities($intro[$i], ENT_QUOTES, 'UTF-8')),
				        "link"=>$link[$i],
				        "t_index"=>$i,
				        "created_date"=>strtotime("now"),
				        "created_by"=>$Session->get("webmtId")
				    );
				    $result = $db->insertTable($this->table,$this->_data_form,1);
				}else{
					$this->_data_form = array(
				        "title"=>htmlentities($title[$i],ENT_QUOTES,'UTF-8'),
				        "intro"=>nl2br(htmlentities($intro[$i], ENT_QUOTES, 'UTF-8')),
				        "link"=>$link[$i],
				        "t_index"=>$i
			        );

			        $result = $db->updateTable($this->table,$this->_data_form,' ID='.$check_id_exist.' ');
				}
			}
		}
	}

	function getList_html($list,$flag_title,$flag_intro,$flag_link,$nameTag_inputFile = 'slidethumnail_gallery[]'){
		$result = '';
		if ($list) {
			$count = count($list);
			for ($i=0; $i < $count; $i++) { 
				$field_title = $field_intro = $field_link = '';
				if($flag_title == 1) $field_title .='<input type="text" name="title[]" id="title_image_gallery" class="form-control mb-1" placeholder="'.$this->_LANG['title'].'" value="'.$list[$i]->title.'"> ';
				if($flag_intro == 1) $field_intro .='<textarea class="form-control mb-1" rows="2" name="intro[]" placeholder="'.$this->_LANG['introduction'].'">'.$list[$i]->intro.'</textarea> ';
				if($flag_link == 1) $field_link .='<input type="text" id="linkUrl" class="form-control mb-1" name="linkUrl[]" placeholder="'.$this->_LANG['link_for_image'].'" value="'.$list[$i]->link.'"> ';

				$link_source = _ROOT_PATH_WEBSITE.'/'.$list[$i]->source;
				$physical_source = _PHISICAL_PATH_ROOT.$list[$i]->source;

				$result .= '
					<div class="list_image col-lg-2 col-sm-3 col-6">
						<div class="img-wrap mb-1">
							<span id="'.$list[$i]->ID.'" value="'.$link_source.'" onclick = "delImageSlide($(this));" class="close">&times;</span>
							<img style="width:100%;" src="'.$link_source.'">\
						</div>
						'.$field_title.$field_intro.$field_link.'
		                <input type="hidden" value="'.$physical_source.'" name="'.$nameTag_inputFile.'" >
	                </div>
				';
			}
		}
		return $result;
	}
	
}
	
?>