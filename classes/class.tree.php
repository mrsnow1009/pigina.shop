<?php
class _tree_struct {
	// Structure table and fields 
	protected $table = "";
	private $db;
	
	protected $fields	= array(
			"id"		=> false,
			"position"	=> false,
			"left"		=> false,
			"right"		=> false,
			"level"		=> false,
			"code"		=> false,
			"code_module"=> false,
			"title"		=> false,
			"title_search"		=> false,
			"url"		=> false,
			"urlseo"	=> false,
			"menu"		=> false,
			"imgURL"	=> false,
			"parent_id"	=> false,
			"lang"		=> false,
			"created_by"		=> false,
			"created_date"		=> false,
			"updated_date"		=> false,
			"updated_by"		=> false
		);
/* $arrConfig: la mang cau hinh mac dinh danh cho jQuery Tree*/	
protected $arrConfig = array("nameTree"=>"treeView",
						"url"=>"processTree.php",
					   	"rootid"=>1,
					   	"plugins"=>array("themes",
										 "json_data",
										 "ui",
										 "crrm",
										 "cookies",
										 "dnd",
										"search",
										"types",
										"hotkeys",
										"contextmenu"
										),
					   "search"=>true,
					   "create"=>true,
					   "move"=>true,
					   "rename"=>true,
					   "del"=>true,
					   "copy"=>true,
					   "openall"=>true,
				       "check_root"=>false,
					   "action_checked"=>"", //function javascript duoc goi khi action checked tai check box
					   "action_click"=>"", //function javascript duoc goi khi action click tai check box(checked va unchecked deu dc)
					   "loaded_action"=>"",
					   "func_build_tree"=>"get_children",//Ten function build tree
					   "func_delete_node"=>"remove_node",//Dinh nghia lai function xoa node,remove_node: la function mac dinh cua he thong
					   "filtercate"=>"",
					   "maxlevel"=>0
					   
					   
					   );
	
	// Constructor
	function __construct($table = "tblcategory", $fields = array()) {
		$this->table = $table;
		if(count($fields)) {
			$this->fields=$fields;
		}
		foreach($this->fields as $k => &$v) {
			$v = $k; 
		}
		
		$this->db = new database();
	}
	
	function _get_code(){
		return $this->arrConfig["filtercate"];
	}
	function _get_node($id) {
		//if(isset($this->fields["id"]))
		$this->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["id"]."` = ".(int) $id);
		if($this->db->num_rows()==0) return false;
		$this->db->next_record();
		return $this->db->nf() === 0 ? false : $this->db->get_row("assoc");
	}
	//Lay arr cate duoc config lam menu
	/*function _get_menu($status=1,$lang=""){
		$strfilter = '';
	    $this->dbmenu = new db_local;
		$filter="";
		if($status>0)$filter=" and `status`=1 ";
		if($lang!="")$filter .=" and lang='".$lang."' ";
		$filter .=$strfilter;
		
		
		
		$this->dbmenu->query("SELECT ID,`menu` FROM `".$this->table."` WHERE  `type`=1 ".$filter." ORDER BY `".$this->fields["position"]."` ASC");
		$arrmenu=array();
		//_NAVIGATION_MENU
		$arrmenu1=array();
		//_VERTICAL_MENU
		$arrmenu2=array();
		//_BOTTOM_MENU
		$arrmenu3=array();
		//_QUICK_MENU
		$arrmenu4=array();
		//_QUICK_MENU
		$arrmenu5=array();
		
		$_ARR_MENU_KEY=array_keys(unserialize(_ARR_MENU_CONFIG));
		if($this->dbmenu->num_rows()==0) return false;
		while($this->dbmenu->next_record()) {
			$idmenuroot=$this->dbmenu->record['ID'];
			$styleMenu=$this->dbmenu->record['menu'];
			$arrmenu=explode(",",$styleMenu);
			
			
			
			if(in_array(1,$arrmenu)){
				$arrmenu1[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status));
			}
			if(in_array(2,$arrmenu)){
				$arrmenu2[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status));
			}
			if(in_array(3,$arrmenu)){
				$arrmenu3[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status));
			}
			if(in_array(4,$arrmenu)){
				$arrmenu4[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status));
			}
			if(in_array(5,$arrmenu)){
				$arrmenu5[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status));
			}
			
			
			
		}
		//print_r($arrmenu5);
		
		$allmenu=array($arrmenu1,$arrmenu2,$arrmenu3,$arrmenu4,$arrmenu5);
		return $allmenu;
		
	}*/
	function _get_menu($rootlang,$status,$codelang){
		//if($status!="")
		//print "\n".$codelang.":\n";
		$arrallmenu=$this->_get_children($rootlang, true,$status,"  ");
		
		$position = array();
	
		if (!$arrallmenu) {
			return array();
		}
		foreach ($arrallmenu as $key => $row){
			//print $key.":";print_r($arr);print "\n";
			$position[$key] = $row['position'];
			
		}
		
//		ksort($key_array);
		
 		array_multisort($position, SORT_ASC, $arrallmenu);
// 		$arrallmenu = array_combine($key_array, array_values($arrallmenu));
		$temp=array();
		foreach($arrallmenu as $items){
			$temp[$items["id"]]=$items;
			
		}
		/////////////
		$arrallmenu=$temp;
		//print_r($temp);
		$arrmenu=array();
		//_NAVIGATION_MENU
		$arrmenu1=array();
		//_VERTICAL_MENU
		$arrmenu2=array();
		//_BOTTOM_MENU
		$arrmenu3=array();
		//_QUICK_MENU
		$arrmenu4=array();
		//_QUICK_MENU
		$arrmenu5=array();
		$arrmenu6=array();
		$arrmenu7=array();
		
		$_ARR_MENU_KEY=array_keys(unserialize(_ARR_MENU_CONFIG));
		
		foreach($arrallmenu as $key => $item_menu  ){
			//print_r($item_menu);
			$idmenuroot=$key;
			
			$styleMenu=$item_menu['menu'];
			$arrmenu=explode(",",$styleMenu);
			
			
			
			if(in_array(1,$arrmenu)){
				$arrmenu1[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			//	$arrmenu1[$idmenuroot]=$item_menu['title'];
			} 
			if(in_array(2,$arrmenu)){
				$arrmenu2[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			}
			if(in_array(3,$arrmenu)){
				$arrmenu3[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			}
			if(in_array(4,$arrmenu)){
				$arrmenu4[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			}
			if(in_array(5,$arrmenu)){
				$arrmenu5[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			}
			
			if(in_array(6,$arrmenu)){
			    $arrmenu6[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			}
			
			if(in_array(7,$arrmenu)){
				$arrmenu7[$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status,"",$codelang));
			}
			
			
		}
		
		//print_r($arrmenu2);
		$allmenu=array($arrmenu1,$arrmenu2,$arrmenu3,$arrmenu4,$arrmenu5,$arrmenu6,$arrmenu7);
		return $allmenu;
		
	}
	
	
	function getMenuNoSet($root){
		$this->dbmenu = new db_local;
		$status=1;
		$filter="";
		$filter=" and `status`=1 ";
		$this->dbmenu->query("SELECT ID,`menu` FROM `".$this->table."` WHERE parent_id='".$root."'  ".$filter." ORDER BY `".$this->fields["position"]."` ASC");
		$arrmenu=array();
		
		
	
		if($this->dbmenu->num_rows()==0) return false;
		while($this->dbmenu->next_record()) {
			$idmenuroot=$this->dbmenu->record['ID'];
			$styleMenu=$this->dbmenu->record['menu'];
			
			
			$arrmenu1[1][$idmenuroot]=array_values($this->_get_children($idmenuroot, true,$status));
			
			
			
		}
		//print_r($arrmenu5);
		
		
		return $arrmenu1;
	}
	function _get_children($id, $recursive = false,$status=0,$strfilter='',$codelang="") {
		$children = array();
		$filter="";
		if($status>0)$filter=" and `status`=1 ";
		$filter .=$strfilter;
		
		if($recursive) {
			$node = $this->_get_node($id);
			if (!$node) return false;
			$this->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["left"]."` >= ".(int) $node[$this->fields["left"]]." AND `".$this->fields["right"]."` <= ".(int) $node[$this->fields["right"]]." ".$filter." ORDER BY `".$this->fields["left"]."` ASC");
		} else {
			$this->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["parent_id"]."` = ".(int) $id."  ".$filter." ORDER BY `".$this->fields["position"]."` ASC");
		}
		if($this->db->num_rows()==0) return false;
		
		while($this->db->next_record()){
			$code_module = '';
			$urlcate = '';
			if(isset($this->fields["code_module"]))
			$code_module=$this->db->f($this->fields["code_module"]);
			if(isset($this->fields["url"]))
			$urlcate=$this->db->f($this->fields["url"]);

			if($code_module!="RSMENU" && !preg_match('/http:\/\//i', $urlcate, $result) && !preg_match('/https:\/\//i', $urlcate, $result)){
				$urlseo = '';
				if(isset($this->fields["url"]))
					$urlcate =$this->db->f($this->fields["url"]);
				if(isset($this->fields["urlseo"]))
					$urlseo  =$this->db->f($this->fields["urlseo"]);
				if(isset($this->fields["id"]))
					$idcate  =$this->db->f($this->fields["id"]);
				if(isset($this->fields["code"]))
					$code    =$this->db->f($this->fields["code"]);
				
				if($urlseo=="")$urlseo=$idcate;
				
				if($urlcate=="" && $code_module!="RSMENU"){
					$path_cate= method::pathweb(array("module"=>method::convert_module($code_module),"cate"=>$urlseo),false);
				}else {
					$path_cate = $urlcate;
				}
		
			 }else{
				 $path_cate=$urlcate;
			 }
			 $children[$this->db->f($this->fields["id"])] = $this->db->get_row("assoc");
			 $children[$this->db->f($this->fields["id"])]["url"] =$path_cate;
		}
		return $children;
	}
	function _get_children_cate_report($id, $recursive,$status,$strfilter) {
		$children = array();
		$filter="";
		if($status>0)$filter=" and `status`=1 ";
		if($lang!="")$filter .=" and lang='".$lang."' ";
		$filter .=$strfilter;
		//print "aa:"."SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["parent_id"]."` = ".(int) $id."  ".$filter." ORDER BY `".$this->fields["position"]."` ASC";
		if($recursive) {
			$node = $this->_get_node($id);
			$this->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["left"]."` >= ".(int) $node[$this->fields["left"]]." AND `".$this->fields["right"]."` <= ".(int) $node[$this->fields["right"]]." ".$filter." ORDER BY `".$this->fields["left"]."` ASC");
			//print "aa:"."SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["left"]."` >= ".(int) $node[$this->fields["left"]]." AND `".$this->fields["right"]."` <= ".(int) $node[$this->fields["right"]]." ".$filter." ORDER BY `".$this->fields["left"]."` ASC";
		}
		else {
			$this->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["parent_id"]."` = ".(int) $id."  ".$filter." ORDER BY `".$this->fields["position"]."` ASC");
					

		}
		if($this->db->num_rows()==0) return false;
		while($this->db->next_record()){
			$code_module=$this->db->f($this->fields["code_module"]);
			$urlcate=$this->db->f($this->fields["url"]);
			
		
			
			if($code_module!="RSMENU" && !preg_match('/'._SSL_.':\/\//i', $urlcate, $result)){
				$urlcate=$this->db->f($this->fields["url"]);
				$urlseo=$this->db->f($this->fields["urlseo"]);
				$idcate=$this->db->f($this->fields["id"]);
				$lang=$this->db->f($this->fields["lang"]);
				
		
				if($urlseo=="")$urlseo=$idcate;
				$path_cate= method::pathweb(array("lang"=>strtolower($lang),"module"=>method::convert_module($code_module),"cate"=>$urlseo),"",true,_FLG_REWRITE,false);
				
				$urlcate	= preg_replace('/'.str_replace("/","\/",_ROOT_PATH_WEBSITE."/").'/i', '', $urlcate);
				$path_cate	= preg_replace('/'.str_replace("/","\/",_ROOT_PATH_WEBSITE."/").'/i', '', $path_cate);
				
				//print $path_cate."=".$urlcate."<br>";
				if($path_cate!=$urlcate && $urlcate!="")$path_cate=$urlcate;
				
				
				
		
		 		 
			 }else{
			 
			 $path_cate=$urlcate;
			 
			 }
			 $children[$this->db->f($this->fields["id"])] = $this->db->get_row("assoc");
			 $children[$this->db->f($this->fields["id"])]["url"] =$path_cate;
		
		}
		
		
		
		return $children;
	}
	function _get_path($id) {
		$node = $this->_get_node($id);
		$path = array();
		if(!$node === false) return false;
		$this->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["left"]."` <= ".(int) $node[$this->fields["left"]]." AND `".$this->fields["right"]."` >= ".(int) $node[$this->fields["right"]]);
		if($this->db->num_rows()==0) return false;
		while($this->db->next_record()) $path[$this->db->f($this->fields["id"])] = $this->db->get_row("assoc");
		return $path;
	}

	function _create($parent, $position) {
		return $this->_move(0, $parent, $position);
	}
	function _remove($id) {
		if((int)$id === 1) { return false; }
		$data = $this->_get_node($id);
		$lft = (int)$data[$this->fields["left"]];
		$rgt = (int)$data[$this->fields["right"]];
		$dif = $rgt - $lft + 1;

		// deleting node and its children
		$this->db->query("" . 
			"DELETE FROM `".$this->table."` " . 
			"WHERE `".$this->fields["left"]."` >= ".$lft." AND `".$this->fields["right"]."` <= ".$rgt
		);
		// shift left indexes of nodes right of the node
		$this->db->query("".
			"UPDATE `".$this->table."` " . 
				"SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - ".$dif." " . 
			"WHERE `".$this->fields["left"]."` > ".$rgt
		);
		// shift right indexes of nodes right of the node and the node's parents
		$this->db->query("" . 
			"UPDATE `".$this->table."` " . 
				"SET `".$this->fields["right"]."` = `".$this->fields["right"]."` - ".$dif." " . 
			"WHERE `".$this->fields["right"]."` > ".$lft
		);

		$pid = (int)$data[$this->fields["parent_id"]];
		$pos = (int)$data[$this->fields["position"]];

		// Update position of siblings below the deleted node
		$this->db->query("" . 
			"UPDATE `".$this->table."` " . 
				"SET `".$this->fields["position"]."` = `".$this->fields["position"]."` - 1 " . 
			"WHERE `".$this->fields["parent_id"]."` = ".$pid." AND `".$this->fields["position"]."` > ".$pos
		);
		return true;
	}
	function _move($id, $ref_id, $position = 0, $is_copy = false) {
		if((int)$ref_id === 0 || (int)$id === 1) { return false; }
		$sql		= array();						// Queries executed at the end
		$node		= $this->_get_node($id);		// Node data
		$nchildren	= $this->_get_children($id);	// Node children
		$ref_node	= $this->_get_node($ref_id);	// Ref node data
		$rchildren	= $this->_get_children($ref_id);// Ref node children

		$ndif = 2;
		$node_ids = array(-1);
		if($node !== false) {
			$node_ids = array_keys($this->_get_children($id, true));
			// TODO: should be !$is_copy && , but if copied to self - screws some right indexes
			if(in_array($ref_id, $node_ids)) return false;
			$ndif = $node[$this->fields["right"]] - $node[$this->fields["left"]] + 1;
		}
		if($position >= count($rchildren)) {
			$position = count($rchildren);
		}
		// Not creating or copying - old parent is cleaned
		if($node !== false && $is_copy == false) {
			$sql[] = "" . 
				"UPDATE `".$this->table."` " . 
					"SET `".$this->fields["position"]."` = `".$this->fields["position"]."` - 1 " . 
				"WHERE " . 
					"`".$this->fields["parent_id"]."` = ".$node[$this->fields["parent_id"]]." AND " . 
					"`".$this->fields["position"]."` > ".$node[$this->fields["position"]];
			$sql[] = "" . 
				"UPDATE `".$this->table."` " . 
					"SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - ".$ndif." " . 
				"WHERE `".$this->fields["left"]."` > ".$node[$this->fields["right"]];
			$sql[] = "" . 
				"UPDATE `".$this->table."` " . 
					"SET `".$this->fields["right"]."` = `".$this->fields["right"]."` - ".$ndif." " . 
				"WHERE " . 
					"`".$this->fields["right"]."` > ".$node[$this->fields["left"]]." AND " . 
					"`".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ";
		}
		// Preparing new parent
		$sql[] = "" . 
			"UPDATE `".$this->table."` " . 
				"SET `".$this->fields["position"]."` = `".$this->fields["position"]."` + 1 " . 
			"WHERE " . 
				"`".$this->fields["parent_id"]."` = ".$ref_id." AND " . 
				"`".$this->fields["position"]."` >= ".$position." " . 
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ");

		$ref_ind = $ref_id === 0 ? (int)$rchildren[count($rchildren) - 1][$this->fields["right"]] + 1 : (int)$ref_node[$this->fields["right"]];
		$ref_ind = max($ref_ind, 1);

		$self = ($node !== false && !$is_copy && (int)$node[$this->fields["parent_id"]] == $ref_id && $position > $node[$this->fields["position"]]) ? 1 : 0;
		foreach($rchildren as $k => $v) {
			if($v[$this->fields["position"]] - $self == $position) {
				$ref_ind = (int)$v[$this->fields["left"]];
				break;
			}
		}
		if($node !== false && !$is_copy && $node[$this->fields["left"]] < $ref_ind) {
			$ref_ind -= $ndif;
		}

		$sql[] = "" . 
			"UPDATE `".$this->table."` " . 
				"SET `".$this->fields["left"]."` = `".$this->fields["left"]."` + ".$ndif." " . 
			"WHERE " . 
				"`".$this->fields["left"]."` >= ".$ref_ind." " . 
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ");
		$sql[] = "" . 
			"UPDATE `".$this->table."` " . 
				"SET `".$this->fields["right"]."` = `".$this->fields["right"]."` + ".$ndif." " . 
			"WHERE " . 
				"`".$this->fields["right"]."` >= ".$ref_ind." " . 
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") ");

		$ldif = $ref_id == 0 ? 0 : $ref_node[$this->fields["level"]] + 1;
		$idif = $ref_ind;
		if($node !== false) {
			$ldif = $node[$this->fields["level"]] - ($ref_node[$this->fields["level"]] + 1);
			$idif = $node[$this->fields["left"]] - $ref_ind;
			if($is_copy) {
				$sql[] = "" . 
					"INSERT INTO `".$this->table."` (" . 
						"`".$this->fields["parent_id"]."`, " . 
						"`".$this->fields["position"]."`, " . 
						"`".$this->fields["left"]."`, " . 
						"`".$this->fields["right"]."`, " . 
						"`".$this->fields["level"]."`" . 
					") " . 
						"SELECT " . 
							"".$ref_id.", " . 
							"`".$this->fields["position"]."`, " . 
							"`".$this->fields["left"]."` - (".($idif + ($node[$this->fields["left"]] >= $ref_ind ? $ndif : 0))."), " . 
							"`".$this->fields["right"]."` - (".($idif + ($node[$this->fields["left"]] >= $ref_ind ? $ndif : 0))."), " . 
							"`".$this->fields["level"]."` - (".$ldif.") " . 
						"FROM `".$this->table."` " . 
						"WHERE " . 
							"`".$this->fields["id"]."` IN (".implode(",", $node_ids).") " . 
						"ORDER BY `".$this->fields["level"]."` ASC";
			}
			else {
				$sql[] = "" . 
					"UPDATE `".$this->table."` SET " . 
						"`".$this->fields["parent_id"]."` = ".$ref_id.", " . 
						"`".$this->fields["position"]."` = ".$position." " . 
					"WHERE " . 
						"`".$this->fields["id"]."` = ".$id;
				$sql[] = "" . 
					"UPDATE `".$this->table."` SET " . 
						"`".$this->fields["left"]."` = `".$this->fields["left"]."` - (".$idif."), " . 
						"`".$this->fields["right"]."` = `".$this->fields["right"]."` - (".$idif."), " . 
						"`".$this->fields["level"]."` = `".$this->fields["level"]."` - (".$ldif.") " . 
					"WHERE " . 
						"`".$this->fields["id"]."` IN (".implode(",", $node_ids).") ";
			}
		}
		else {
			$sql[] = "" . 
				"INSERT INTO `".$this->table."` (" . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."` " . 
					") " . 
				"VALUES (" . 
					$ref_id.", " . 
					$position.", " . 
					$idif.", " . 
					($idif + 1).", " . 
					$ldif. 
				")";
		}
		foreach($sql as $q) { $this->db->query($q);// echo $q; 
		}
		$ind = $this->db->insert_id();
		if($is_copy) $this->_fix_copy($ind, $position);
		return $node === false || $is_copy ? $ind : true;
	}
	function _fix_copy($id, $position) {
		$node = $this->_get_node($id);
		$children = $this->_get_children($id, true);

		$map = array();
		for($i = $node[$this->fields["left"]] + 1; $i < $node[$this->fields["right"]]; $i++) {
			$map[$i] = $id;
		}
		foreach($children as $cid => $child) {
			if((int)$cid == (int)$id) {
				$this->db->query("UPDATE `".$this->table."` SET `".$this->fields["position"]."` = ".$position." WHERE `".$this->fields["id"]."` = ".$cid);
				continue;
			}
			$this->db->query("UPDATE `".$this->table."` SET `".$this->fields["parent_id"]."` = ".$map[(int)$child[$this->fields["left"]]]." WHERE `".$this->fields["id"]."` = ".$cid);
			for($i = $child[$this->fields["left"]] + 1; $i < $child[$this->fields["right"]]; $i++) {
				$map[$i] = $cid;
			}
		}
	}

	function _reconstruct() {
		$_db_ss = new database();
		$_db_ss->connect_atp();

		$_db_ss->query_atp("" . 
			"CREATE TEMPORARY TABLE `temp_tree` (" . 
				"`".$this->fields["id"]."` INT(9) NOT NULL, " . 
				"`".$this->fields["parent_id"]."` INT(9) NOT NULL, " . 
				"`". $this->fields["position"]."` INT(9) NOT NULL" . 
			") ENGINE=HEAP");

		$_db_ss->query_atp(
			"INSERT INTO `temp_tree` ". 
				"SELECT " . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."` " . 
				"FROM `".$this->table."`"
		);

		$_db_ss->query_atp("" . 
			"CREATE TEMPORARY TABLE `temp_stack` (" . 
				"`".$this->fields["id"]."` INTEGER NOT NULL, " . 
				"`".$this->fields["left"]."` INTEGER, " . 
				"`".$this->fields["right"]."` INTEGER, " . 
				"`".$this->fields["level"]."` INTEGER, " . 
				"`stack_top` INTEGER NOT NULL, " . 
				"`".$this->fields["parent_id"]."` INTEGER, " . 
				"`".$this->fields["position"]."` INTEGER " . 
			")ENGINE  =HEAP"
		);
		$counter = 2;
		$_db_ss->query_atp("SELECT COUNT(*) FROM temp_tree");
		$_db_ss->next_record();
		$maxcounter = (int) $_db_ss->f(0) * 2;
		$currenttop = 1;
		$_db_ss->query_atp("" . 
			"INSERT INTO `temp_stack` " . 
				"SELECT " . 
					"`".$this->fields["id"]."`, " . 
					"1, " . 
					"NULL, " . 
					"0, " . 
					"1, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."` " . 
				"FROM `temp_tree` " . 
				"WHERE `".$this->fields["parent_id"]."` = 0"
		);
		$_db_ss->query_atp("DELETE FROM `temp_tree` WHERE `".$this->fields["parent_id"]."` = 0");

		while ($counter <= $maxcounter) {
			$_db_ss->query_atp("" . 
				"SELECT " . 
					"`temp_tree`.`".$this->fields["id"]."` AS tempmin, " . 
					"`temp_tree`.`".$this->fields["parent_id"]."` AS pid, " . 
					"`temp_tree`.`".$this->fields["position"]."` AS lid " . 
				"FROM `temp_stack`, `temp_tree` " . 
				"WHERE " . 
					"`temp_stack`.`".$this->fields["id"]."` = `temp_tree`.`".$this->fields["parent_id"]."` AND " . 
					"`temp_stack`.`stack_top` = ".$currenttop." " . 
				"ORDER BY `temp_tree`.`".$this->fields["position"]."` ASC LIMIT 1"
			);

			if ($_db_ss->next_record()) {
				$tmp = $_db_ss->f("tempmin");

				$q = "INSERT INTO temp_stack (stack_top, `".$this->fields["id"]."`, `".$this->fields["left"]."`, `".$this->fields["right"]."`, `".$this->fields["level"]."`, `".$this->fields["parent_id"]."`, `".$this->fields["position"]."`) VALUES(".($currenttop + 1).", ".$tmp.", ".$counter.", NULL, ".$currenttop.", ".$_db_ss->f("pid").", ".$_db_ss->f("lid").")";
				$_db_ss->query_atp($q);
				$_db_ss->query_atp("DELETE FROM `temp_tree` WHERE `".$this->fields["id"]."` = ".$tmp);
				$counter++;
				$currenttop++;
			}
			else {
				$_db_ss->query_atp("" . 
					"UPDATE temp_stack SET " . 
						"`".$this->fields["right"]."` = ".$counter.", " . 
						"`stack_top` = -`stack_top` " . 
					"WHERE `stack_top` = ".$currenttop
				);
				$counter++;
				$currenttop--;
			}
		}

		$temp_fields = $this->fields;
		unset($temp_fields["parent_id"]);
		unset($temp_fields["position"]);
		unset($temp_fields["left"]);
		unset($temp_fields["right"]);
		unset($temp_fields["level"]);
		if(count($temp_fields) > 1) {
			$_db_ss->query_atp("" . 
				"CREATE TEMPORARY TABLE `temp_tree2` " . 
					"SELECT `".implode("`, `", $temp_fields)."` FROM `".$this->table."` "
			);
		}
		
		////////////////////////////////////
		//comment
		
		
		/////////////////////////////////
		
		
		$_db_ss->query_atp("TRUNCATE TABLE `".$this->table."`");
		$_db_ss->query_atp("" . 
			"INSERT INTO ".$this->table." (" . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."` " . 
				") " . 
				"SELECT " . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."` " . 
				"FROM temp_stack " . 
				"ORDER BY `".$this->fields["id"]."`"
		);
		if(count($temp_fields) > 1) {
			$sql = "" . 
				"UPDATE `".$this->table."` v, `temp_tree2` SET v.`".$this->fields["id"]."` = v.`".$this->fields["id"]."` ";
			foreach($temp_fields as $k => $v) {
				if($k == "id") continue;
				$sql .= ", v.`".$v."` = `temp_tree2`.`".$v."` ";
			}
			$sql .= " WHERE v.`".$this->fields["id"]."` = `temp_tree2`.`".$this->fields["id"]."` ";
			$_db_ss->query_atp($sql);
		}
	}

	function _analyze() {
		$report = array();
$sql ="SELECT `".$this->fields["left"]."` FROM `".$this->table."` s WHERE `".$this->fields["parent_id"]."` = 0 ";
		$this->db->query($sql);
		$this->db->next_record();
		if($this->db->nf() == 0) {
			$report[] = "[FAIL]\tNo root node.";
		}
		else {
			$report[] = ($this->db->nf() > 1) ? "[FAIL]\tMore than one root node." : "[OK]\tJust one root node.";
		}
		$report[] = ($this->db->f(0) != 1) ? "[FAIL]\tRoot node's left index is not 1." : "[OK]\tRoot node's left index is 1.";

		$this->db->query("" . 
			"SELECT " . 
				"COUNT(*) FROM `".$this->table."` s " . 
			"WHERE " . 
				"`".$this->fields["parent_id"]."` != 12 AND " . 
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE `".$this->fields["id"]."` = s.`".$this->fields["parent_id"]."`) = 12 ");
		$this->db->next_record();
		$report[] = ($this->db->f(0) > 0) ? "[FAIL]\tMissing parents." : "[OK]\tNo missing parents.";

		$this->db->query("SELECT MAX(`".$this->fields["right"]."`) FROM `".$this->table."`");
		$this->db->next_record();
		$n = $this->db->f(0);
		$this->db->query("SELECT COUNT(*) FROM `".$this->table."`");
		$this->db->next_record();
		$c = $this->db->f(0);
		$report[] = ($n/2 != $c) ? "[FAIL]\tRight index does not match node count." : "[OK]\tRight index matches count.";
	$SQL = "" . 
			"SELECT COUNT(`".$this->fields["id"]."`) FROM `".$this->table."` s " . 
			"WHERE " . 
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE " . 
					"`".$this->fields["right"]."` < s.`".$this->fields["right"]."` AND " . 
					"`".$this->fields["left"]."` > s.`".$this->fields["left"]."` AND " . 
					"`".$this->fields["level"]."` = s.`".$this->fields["level"]."` + 1" . 
				") != " .
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE " . 
					"`".$this->fields["parent_id"]."` = s.`".$this->fields["id"]."`" . 
				") ";
		$this->db->query($SQL);
		$this->db->next_record();
		$report[] = ($this->db->f(0) > 0) ? "[FAIL]\tAdjacency and nested set do not match.": "[OK]\tNS and AJ match";

		return implode("<br />",$report);
	}
	function _dump($output = false) {
		$nodes = array();
		$this->db->query("SELECT * FROM ".$this->table." ORDER BY `".$this->fields["left"]."`");
		while($this->db->next_record()) $nodes[] = $this->db->get_row("assoc");
		if($output) {
			echo "<pre>";
			foreach($nodes as $node) {
				echo str_repeat("&#160;",(int)$node[$this->fields["level"]] * 2);
				echo $node[$this->fields["id"]]." (".$node[$this->fields["left"]].",".$node[$this->fields["right"]].",".$node[$this->fields["level"]].",".$node[$this->fields["parent_id"]].",".$node[$this->fields["position"]].")<br />";
			}
			echo str_repeat("-",40);
			echo "</pre>";
		}
		return $nodes;
	}
	function _drop() {
	
	}
}

class json_tree extends _tree_struct { 
    
	public $filtercate="";
	
	function __construct(
	
	$table = "tblcategory", 
	$fields = array(),
	$add_fields = array(
		"title" => "title",
		"code"=>"code",
		"code_module"=>"code_module",
		"url"=>"url",
		"menu"=>"menu",
		"intro"=>"intro",
		"description"=>"description",
		"imgURL"=>"imgURL",
		"t_status"=>"t_status",
		"lang"=>"lang",
		"urlseo"=>"urlseo"
	)) {
	
		parent::__construct($table, $fields);
		$this->fields = array_merge($this->fields, $add_fields);
		$this->add_fields = $add_fields;
	}

	function create_node($data) {
		$id = parent::_create((int)$data[$this->fields["id"]], (int)$data[$this->fields["position"]]);
		if($id) {
			$data["id"] = $id;
			$this->set_data($data);
			return  "{ \"status\" : 1, \"id\" : ".(int)$id." }";
		}
		return "{ \"status\" : 0 }";
	}
	function set_data($data) {
		if(count($this->add_fields) == 0) { return "{ \"status\" : 1 }"; }
		$s = "UPDATE `".$this->table."` SET `".$this->fields["id"]."` = `".$this->fields["id"]."` "; 
		foreach($this->add_fields as $k => $v) {
			if(isset($data[$k]))	$s .= ", `".$this->fields[$v]."` = \"".$this->db->escape($data[$k])."\" ";
			else					$s .= ", `".$this->fields[$v]."` = `".$this->fields[$v]."` ";
		}
		$s .= "WHERE `".$this->fields["id"]."` = ".(int)$data["id"];
		$this->db->query($s);
		return "{\"status\" : 1 }";
	}
	function rename_node($data) { return $this->set_data($data); }

	function move_node($data) { 
		$id = parent::_move((int)$data["id"], (int)$data["ref"], (int)$data["position"], (int)$data["copy"]);
		if(!$id) return "{ \"status\" : 0 }";
		if((int)$data["copy"] && count($this->add_fields)) {
			$ids	= array_keys($this->_get_children($id, true));
			$data	= $this->_get_children((int)$data["id"], true);

			$i = 0;
			foreach($data as $dk => $dv) {
				$s = "UPDATE `".$this->table."` SET `".$this->fields["id"]."` = `".$this->fields["id"]."` "; 
				foreach($this->add_fields as $k => $v) {
					if(isset($dv[$k]))	$s .= ", `".$this->fields[$v]."` = \"".$this->db->escape($dv[$k])."\" ";
					else				$s .= ", `".$this->fields[$v]."` = `".$this->fields[$v]."` ";
				}
				$s .= "WHERE `".$this->fields["id"]."` = ".$ids[$i];
				$this->db->query($s);
				$i++;
			}
		}
		return "{ \"status\" : 1, \"id\" : ".$id." }";
	}
	function remove_node($data) {
		$id = parent::_remove((int)$data["id"]);
		return "{ \"status\" : 1 }";
	}
	function get_children($data) {
	
	   $tmp = $this->_get_children((int)$data["id"]);
		foreach($data as $key => $val) $kk.= $key."=>".$val.";";
		$result = array();
		if((int)$data["id"] === 0) return json_encode($result);
		//print_r( $tmp);
		foreach($tmp as $k => $v) {
		
		
			$result[] = array(
				"attr" => array("id" => "node_".$k),
				"data" => $v[$this->fields["title"]],				
				"state"=> count($this->_get_children((int)$k)) > 0 ? "closed" : ""
				//"state" => ((int)$v[$this->fields["right"]] - (int)$v[$this->fields["left"]] > 1) ? "closed" : ""
				
				
			);
		}
		return json_encode($result);
	}
	
	function get_children_cate($data) {
		$filter=		strtr($data["filtercode"],array("\'"=>'"',"'"=>'"'));
		//$filter=str_replace("'",'"',$data["filtercode"]);
		$filter=unserialize($filter);
		
		$maxlevel=intval($data["maxlevel"]);
		if($maxlevel==0)$maxlevel=100;
		else $maxlevel=$maxlevel+1;
	
	    $tmp = $this->_get_children((int)$data["id"]);
		foreach($data as $key => $val) $kk.= $key."=>".$val.";";
		$result = array();
		if((int)$data["id"] === 0) return json_encode($result);
		foreach($tmp as $k => $v) {
			$code=$v[$this->fields["code"]];
			$results1 = print_r($v, true);
			
			if(in_array($code, $filter) && $v[$this->fields["level"]]<=$maxlevel){
			
		
				$result[] = array(
					"attr" => array("id" => "node_".$k),
					"data" => $v[$this->fields["title"]],				
					"state"=> count($this->_get_children((int)$k)) > 0 ? "closed" : ""
					//"state" => ((int)$v[$this->fields["right"]] - (int)$v[$this->fields["left"]] > 1) ? "closed" : ""
				);
			}
		}
		return json_encode($result);
	}
	function get_children_active($data) {
	
		
	    $tmp = $this->_get_children((int)$data["id"]);
		foreach($data as $key => $val) $kk.= $key."=>".$val.";";
		$result = array();
		if((int)$data["id"] === 0) return json_encode($result);
		foreach($tmp as $k => $v) {
			$status=$v[$this->fields["status"]];
			
			
			if($status==1){
		
				$result[] = array(
					"attr" => array("id" => "node_".$k),
					"data" => $v[$this->fields["title"]],				
					"state"=> count($this->_get_children((int)$k)) > 0 ? "closed" : ""
					//"state" => ((int)$v[$this->fields["right"]] - (int)$v[$this->fields["left"]] > 1) ? "closed" : ""
				);
			}
		}
		return json_encode($result);
	}
	function search($data) {
		$this->db->query("SELECT `".$this->fields["left"]."`, `".$this->fields["right"]."` FROM `".$this->table."` WHERE `".$this->fields["title"]."` LIKE '%".$this->db->escape($data["search_str"])."%'");
		if($this->db->nf() === 0) return "[]";
		$q = "SELECT DISTINCT `".$this->fields["id"]."` FROM `".$this->table."` WHERE 0 ";
		while($this->db->next_record()) {
			$q .= " OR (`".$this->fields["left"]."` < ".(int)$this->db->f(0)." AND `".$this->fields["right"]."` > ".(int)$this->db->f(1).") ";
		}
		$result = array();
		$this->db->query($q);
		while($this->db->next_record()) { $result[] = "#node_".$this->db->f(0); }
		return json_encode($result);
	}
/*==== Config Javascript for Tree =====*/	
function jsconfig()	
{
	if(is_array($this->arrConfig["plugins"])) $plugin = implode("\",\"",$this->arrConfig["plugins"]);
	else $plugin =$this->arrConfig["plugins"];
	
	if($this->arrConfig["check_root"]=="")$this->arrConfig["check_root"]=false;
	
	if(!is_array($this->arrConfig["checked_node"]))$this->arrConfig["checked_node"]=array();
	if(!is_array($this->arrConfig["root_node"]))$this->arrConfig["root_node"]=array();	
	
	$filter="";
	if($this->arrConfig["filtercate"]!=""){
		$filter=',"filtercode":"'.$this->arrConfig["filtercate"].'"';
	}
	
	
	
	
	$html='$(function () {
				$("#treeView")
				
					.jstree({ 
						

			"plugins" : [ "'.implode("\",\"",$this->arrConfig["plugins"]).'"
			
			
			 ],
			
			"json_data" : { 
				"ajax" : {
					"url" : "./'.$this->arrConfig["url"].'",
					"data" : function (n) { 
						return { 
							"operation" : "'.$this->arrConfig["func_build_tree"].'", 
							"id" : n.attr ? n.attr("id").replace("node_","") : '.$this->arrConfig["rootid"].',"maxlevel":"'.$this->arrConfig["maxlevel"].'"'.$filter.'
						}; 
					}
				}
			},
			"search" : {
				"ajax" : {
					"url" : "./'.$this->arrConfig["url"].'",
					"data" : function (str) {
						return { 
							"operation" : "search", 
							"search_str" : str 
						}; 
					}
				}
			},			
			// Using types - most of the time this is an overkill
			
			
			"core" : { 
				"initially_open" : [ "node_2" , "node_3" ] ,
				"check_root": "'.$this->arrConfig["check_root"].'",
				"checked_item":['.implode(",",$this->arrConfig["checked_node"]).'],
				"parent_item":['.implode(",",$this->arrConfig["root_node"]).'],
				
				
			}
		})';
		
		$html .= '
		.bind("loaded.jstree", function (event, data) {
		
			
		
		
			/*$("#treeView li").not(".jstree-leaf").each(function() {
					
				   $("a ins.jstree-checkbox", this).first().hide();
				   $("a", this).first().click(function(event) {
					alert("hi")
					  $("#demo1").jstree("toggle_node", "#"+$(this).parent().attr(\'id\'));
					  event.stopPropagation();
					  event.preventDefault();
				   });
			});*/
		
		';
			if($this->arrConfig['open_all']==true){
			$html .= '	  $("#treeView").jstree("open_all");
			';			 
			}		
			$html .= $this->arrConfig['loaded_action'];			
		
		$html .= '
    	})
		';
		
		
		if($this->arrConfig["action_checked"]!=""){
		//Get ID node khi click checked 
		$html .= '
			.delegate("a", "click.jstree", function (e, data) {
				var node =  $(this).jstree("_get_node(e.target)")
				
				//var total = $("#treeView").jstree("_get_node(e.target)")
				//alert(total.html());
				
				//$("li").removeClass("jstree-checked").addClass("jstree-unchecked")
				
				node_parent = node.parents("li");
				idnode=node_parent.attr("id").match(/\d+/gi);;	
				//jstree-clicked
				'.$this->arrConfig["action_checked"].'
				if(node_parent.hasClass("jstree-checked")||node_parent.hasClass("jstree-clicked")){
					
					//void(0);
					/*'.$this->arrConfig["action_checked"].'*/
					
					$(".jstree-checked, .jstree-undetermined").each(function(index) {
						if(node_parent.attr("id")!=jQuery(this).attr("id"))
							jQuery(this).removeClass("jstree-checked").addClass("jstree-unchecked")
							jQuery(this).removeClass("jstree-undetermined");
					})
					
				}
				
				

				
			})';
			}
			if($this->arrConfig["action_click"]!=""){
		//Get ID node khi click checked 
		$html .= '
			.delegate("a", "click.jstree", function (e, data) {
				var node =  $(this).jstree("_get_node(e.target)")
				
				//var total = $("#treeView").jstree("_get_node(e.target)")
				//alert(total.html());
				
				//$("li").removeClass("jstree-checked").addClass("jstree-unchecked")
				
				node_parent = node.parents("li");
				idnode=node_parent.attr("id").match(/\d+/gi);;				
				if(node_parent.hasClass("jstree-checked") || node_parent.hasClass("jstree-unchecked") || node_parent.hasClass("jstree-undetermined")){
					
					'.$this->arrConfig["action_click"].'
					
					
				}
				
				

				
			})';
			}
			$html .= '
			.bind("create.jstree", function (e, data) {
			$.post(
				"./'.$this->arrConfig["url"].'", 
				{ 
					"operation" : "create_node", 
					"id" : data.rslt.parent.attr("id").replace("node_",""), 
					"position" : data.rslt.position,
					"title" : data.rslt.name,
					"type" : data.rslt.obj.attr("rel")
				}, 
				function (r) {
					if(r.status) {
						$(data.rslt.obj).attr("id", "node_" + r.id);
					}
					else {
						$.jstree.rollback(data.rlbk);
					}
				}
			);
			
			
			
			
		})
		

		.bind("remove.jstree", function (e, data) {
			data.rslt.obj.each(function () {
				$.ajax({
					async : false,
					type: \'POST\',
					url: "./'.$this->arrConfig["url"].'",
					data : { 
						"operation" : "'.$this->arrConfig["func_delete_node"].'", 
						"id" : this.id.replace("node_","")
					}, 
					success : function (r) {
						if(!r.status) {
							data.inst.refresh();
						}
					}
				});
			});
		})
		.bind("rename.jstree", function (e, data) { 
			$.post(
				"./'.$this->arrConfig["url"].'", 
				{ 
					"operation" : "rename_node", 
					"id" : data.rslt.obj.attr("id").replace("node_",""),
					"title" : data.rslt.new_name
				}, 
				function (r) {
					if(!r.status) {
						$.jstree.rollback(data.rlbk);
					}
				}
			);
		}).bind("move_node.jstree", function (e, data) {
			data.rslt.o.each(function (i) {
				$.ajax({
					async : false,
					type: \'POST\',
					url: "./'.$this->arrConfig["url"].'",
					data : { 
						"operation" : "move_node", 
						"id" : $(this).attr("id").replace("node_",""), 
						"ref" : data.rslt.np.attr("id").replace("node_",""), 
						"position" : data.rslt.cp + i,
						"title" : data.rslt.name,
						"copy" : data.rslt.cy ? 1 : 0
					},
					success : function (r) {
						if(!r.status) {
							$.jstree.rollback(data.rlbk);
						}
						else {
							$(data.rslt.oc).attr("id", "node_" + r.id);
							if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
								data.inst.refresh(data.inst._get_parent(data.rslt.oc));
							}
						}
						$("#analyze").click();
					}
				});
			});
		});
		
		

		
		
});';
	return $html;
}
/* ===== Ham hien thi cay danh muc ======*
 * Cho phep cau hinh cac tham so cua cay */
public function showTree($arr,$type="menu")
 {
	 if(is_array($arr))	$this->arrConfig = method:: updateArray($arr,$this->arrConfig);
	$html=' <script>$(function() { 
			$( "#catalog_view" ).tabs();';
    $html.='$( "#accordion" ).accordion({autoHeight: true, fillSpace: true});
	}); ';
    $html.=$this->jsconfig();
    $html.='</script>';
	//$html.='<div id="nav_button_page"><button>'._ADD_SUB.'</button></div>';
	if($type=="citymap")
	$htmlmenu='<h3><a href="javascript:;">'._MAP_DAKNONG.'</a></h3>';
	else 
	$htmlmenu='<h3 ><a href="#">'._CATALOGS.'</a></h3>';
	
	
	$htmlmenu.='<div><div id="treeView"></div></div>';	
	
	if($type=="menu")
	$html.='<div id="accordion">'.$htmlmenu.'</div>';
	else if($type=="citymap")
	$html.='<div id="citymap-menu" >'.$htmlmenu.'</div>';
	else $html.=$htmlmenu;
	
	//foreach($this->fields as $k => $v)$html.=$k."=>".$v.";";
	return $html;
 }
}

?>