<?php
/***********************************************************
* Modified date :
* Modifier		:   
* Description	:   class ket noi database.
* Ghi chu		:	- chi can thay doi cac thong so trong class db_local.
*				:	- Khong duoc thay doi bat ky dong nao trong class db_sql.
************************************************************/
//don't change db_sql class.
class db_local 
{
   public $host;    // hostname of our mysql server.
   public $database;// logical database name on that server.
   public $user   ; // user  for login.
   public $password ; // password for login.

  var $link_id  = 0;  // result of mysqli_connect().
  var $query_id = 0;  // result of most recent mysqli_query().
  var $record   = array();  // current mysqli_fetch_array()-result.
  var $row;           // current row number.

  var $errno    = 0;  // error state of query...
  var $error    = "";
  function __construct() {
	  	// $Session = new Session();
	  	$WEBCONFIG      = unserialize(WEBCONFIG);
	   	$this->host     = $WEBCONFIG["DB"]['hosting'];
	   	$this->database = $WEBCONFIG["DB"]['name_db'];
	   	$this->user     = $WEBCONFIG["DB"]['user_db'];
	   	$this->password = $WEBCONFIG["DB"]['pass_db'];
  }
  protected function halt($msg){
		
      common_controller::error('Lỗi:',' Lỗi hệ thống, vui lòng thử lại ('.$msg.')');
		
	}
	public function halt_li()
	{
		
	    common_controller::error('Lỗi:',' Lỗi hệ thống, vui lòng thử lại!');
	}
private function connect()
{
	if (!$this->link_id )
		{
			$this->link_id   =  mysqli_connect($this->host, $this->user, $this->password) or die("Cannot connect to Database! Please contact your Administrator");
			mysqli_set_charset($this->link_id, 'utf8mb4');
			
			mysqli_select_db($this->link_id,$this->database) or die ("Cannot use this database");  

			// $this->link_id = mysqli_connect($this->host,$this->user,$this->password,$this->database);
			// if (mysqli_connect_errno()) {
			//   	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		 //  	}
		 //  	mysqli_set_charset($this->link_id, 'UTF8');
		}
	
}

function query($query_string)
{
		// echo $query_string;
	self::connect();
	
	$this->query_id = mysqli_query($this->link_id,$query_string);
	$this->row   = 0;
	$this->errno = mysqli_connect_errno($this->link_id);
	$this->error = mysqli_connect_error($this->link_id);
	if (!$this->query_id)
	{
		$this->halt("Invalid SQL.");
		
	}

	return $this->query_id;
}

	
function next_record()
{
	$this->record = mysqli_fetch_array($this->query_id);
	$this->row   += 1;
	$this->errno = mysqli_connect_errno($this->link_id);
	$this->error = mysqli_connect_error($this->link_id);

	$stat = is_array($this->record);
	if (!$stat)
	{
		mysqli_free_result($this->query_id);
		$this->query_id = 0;
	}

	return $stat;
}

protected function result()
{
	return mysqli_result($this->query_id,0,0);
}

public function num_rows()
{
	// var_dump($this->query_id);
	return mysqli_num_rows($this->query_id);
}
public function close()
{
	#if($this->query_id)
	#{
	#	mysqli_free_result($this->query_id);
	#}
	mysqli_close($this->link_id);
}
protected function haverecord($query_string){
	$this->query($query_string);
	$num= 	$this->num_rows();
	if( $num>0 ) return $num; else return 0;
	
}
protected function num_fields(){
	return mysqli_num_fields($this->query_id);
}
/*===================== Cac function Query SQL ============================*/ 
private function make_Sql_Value($arr,$action="update"){
	$sql ="";
	$subSQL ="";
	$subSQL2="";
	while(list($name,$value) =each($arr))
	{
		switch ($action)
		{
				case "update": 
				{
						if($sql=="")
						$sql.=$name."='".$value."'";
						else
						$sql.=",".$name."='".$value."'";				
					break;
				}
				case "insert":
				 {
						if($subSQL=="")
							 $subSQL.="(".$name."";	
						else $subSQL.=",".$name;
							
						if($subSQL2=="") 
							 $subSQL2=") values('".$value."'";
						else	$subSQL2.=",'".$value."'";
						
					 break;
				 }
				case "select":
				 {
						
						if($sql=="")
						$sql.=$value;
						else
						$sql.=",".$value;
						
					 break;
				 }	
				default:
				 {
						
						if($sql=="")
						$sql.=$name."='".$value."'";
						else
						$sql.=",".$name."='".$value."'";
						
					 break;
				 }	
		}	//end switch
	} // end while
	
	if($action=="insert") $sql =$subSQL.$subSQL2.")";
	
	
	return $sql;
}	
/*****************************************************
 * Get maxID in Database
 ***********************************************/
public function getMaxID($strTableName, $strID,$strfilter="") {
  $db  = new db_local; 
  $db1 = new db_local; 
  
  $strSQL = "select ".$strID." from ".$strTableName." ".$strfilter;

  $db->query($strSQL);
  $num = $db->num_rows();
  if ($num <= 0)
   {    
	$MaxID = 1;
	}
  else{
	 $strSQL = "select  ".$strID." from ".$strTableName." ".$strfilter."  order by ".$strID." DESC LIMIT 0, 1 " ;
	 $db1->query($strSQL);
	 $db1->next_record();
	 $data = $db1->record[$strID]; 
	 $MaxID=$data+1;
	 }
	  return  $MaxID;
}
///////////////////////////////////////////////////////////////////	
//Get max ID with ID is string
//$strTableName: ten table
//$strID: ten field ID
//$len=chieu dai ma chuoi  //ex: 000000000
//$nummax=gia tri lon nhat cua ID : ex : 999999999
function getMaxIDString($strTableName, $strID,$len,$nummax,$prefix="",$prefix_last="",$start_code="",$strfilter="") { 
	
	$numchar=strlen($nummax);
	
	$db  = new db_local;
	$db1  = new db_local;
	$strSQL = "Select ".$strID." From ".$strTableName." ".$strfilter; 
	
	$db->query($strSQL);
	  $num = $db->num_rows();
	
	if ($num <= 0) {   
		if($start_code=="")
		$MaxID = $prefix.substr($len,0,strlen($start_num)-1)."1".$prefix_last;
		else 
		$MaxID =$start_code;
		
		
		return  $MaxID;
	}
	else{
		$strSQL = "Select  ".$strID." From ".$strTableName." ".$strfilter." order by ".$strID." DESC LIMIT 0, 1 " ;
	   
	   
		$db1->query($strSQL);
		$db1->next_record();
		$data = $db1->record[$strID];
		
		$temp=substr($data,strlen($prefix),$numchar);  			
		$j=1;
		// print strlen($prefix).":".$numchar ;
		for($i=10;$i<=$nummax*10;$i=$i*10){
			
			if($temp<($i-1)){
				
				$temp=$temp+1;
				
				$MaxID = $prefix.substr($len,0,strlen($len)-$j).$temp.$prefix_last;
				return  $MaxID;
			}
			
			$j++;
		}
	}
   
	
}	

/////////////////////////////////////////////////////////
public function getArrRow($table,$Gvalue,$id,$value,$and=''){
    $db  = new db_local;
    $arr = array();
    $sql="select `".$Gvalue."` from $table where $id='".$value."' $and";
    $db->query($sql);
    if($db->num_rows()<=0) return false;
    while ($db->next_record()){
        $arr[] =$db->record["$Gvalue"];
    }
    return $arr;
}
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
public function getMultiArrRow($table,$arrField,$id,$value,$and=''){
    $db  = new db_local;
    $arr = array();
    $sql="select `".implode("`,`",$arrField)."` from $table where ".$id."='".$value."' $and";
    $db->query($sql);
    if($db->num_rows()<=0) return false;

    $count = count($arrField);
    while ($db->next_record()){
    	
    	$arr_val = array();
    	for ($i=0; $i < $count; $i++) { 
    		$arr_val[$arrField[$i]] = $db->record[$arrField[$i]];
    	}
    	
        $arr[] = $arr_val;
    }
    return $arr;
}
/////////////////////////////////////////////////////////	
public function getField($table,$Gvalue,$id,$value,$and='')
{
	$db  = new db_local;
	$html=0;

	$sql="select `".$Gvalue."` from ".$table." where `".$id."`='".$value."' ".$and;
	// print $sql."<br>";
	// if ($s = 1) {
	// 	echo $sql;
	// }
	$db->query($sql);	
	if($db->num_rows()>0)
	{
		$db->next_record();
		$html =htmlspecialchars_decode($db->record["$Gvalue"]);
	}
//	else $html=0;
	return $html;
}
public function getMultiFields($table,$arrField,$id,$value,$and='') {
    $db  = new db_local;
    $html=0;
    if(!is_array($arrField)) return false;
    #for cboCategory
    $sql="select `".implode("`,`",$arrField)."` from $table where $id='".$value."' $and";
    //$sql .= " limit 0,1 ";
    //print $sql."<br>";
    $values=array();
    $db->query($sql);	
    if($db->num_rows()>0)
    {
    	$db->next_record();
    	for($i=0;$i<count($arrField);$i++){
    	$values[$i] =htmlspecialchars_decode($db->record[$arrField[$i]]);
    	}
    }
    
    return $values;
}
public function getMultiFields2($table,$arrField,$id,$value,$and='')
{
 $db  = new db_local;
 $html=0;
 if(!is_array($arrField)) return false;
 #for cboCategory
 $sql="select `".implode("`,`",$arrField)."` from $table where $id='".$value."' $and";
 //$sql .= " limit 0,1 ";
 //print $sql."<br>";
 $values=array();
 $db->query($sql);
 if($db->num_rows()>0){
     $db->next_record();
     for($i=0;$i<count($arrField);$i++){
         $values[$arrField[$i]] =htmlspecialchars_decode($db->record[$arrField[$i]]);
     }
 }

 return $values;
}
public function getValue($query,$Gvalue)
{
	$db  = new db_local;
	$html=0;
	#for cboCategory
	//$sql="select ID,$Gvalue from $table where $id='".$value."'";
	// print $query;
	$db->query($query);	
	if($db->num_rows()>0)
	{
		$db->next_record();
		$html =htmlspecialchars_decode($db->record["$Gvalue"]);
	}
	else $html=0;
	return $html;
 }	
//Tra ve dang array
//array ("ID"=> gia tri cua ID) voi $Gvalue=ID
public function getArrFields($query,$Gvalue)
{
	
	$html=0;
	#for cboCategory
	//$sql="select ID,$Gvalue from $table where $id='".$value."'";
	//print $query;
	$arr=array();
	$this->query($query);	
	
	if($this->num_rows()>0)
	{	
		while($this->next_record()){
			$arr[$Gvalue]=htmlspecialchars_decode($this->record["$Gvalue"]);
		}
	}
	
	return $arr;
}	
//Tra ve dang arr
//array(1=>value1 of Gvalue,2=>value2 of Gvalue,3=>value3 of Gvalue)	
public function getArrField($query,$Gvalue)
{
	$db  = new db_local;
	$html=0;
	#for cboCategory
	//$sql="select ID,$Gvalue from $table where $id='".$value."'";
	
	$arr=array();
	$db->query($query);	
	
	if($db->num_rows()>0)
	{	
		while($db->next_record()){
			$arr[]=htmlspecialchars_decode($db->record["$Gvalue"]);
		}
	}

	return $arr;
}

//KT ID nay co ton tai trong database hay khong?
 function checkID($table,$field,$id){
	$db  = new db_local;
	$sql="select ID from $table where $field  ='".$id."' ";
	//echo $sql ;
	$db->query($sql);	
	if($db->num_rows()>0)return true;
	return false;
}
// ham nay dung de dua ra so thu tu tang auto theo moi table
// tham so truyen vao : tablename,
// tham so tra ve : so thu tu tang 
function returnOrdinals($table,$sql_extend=''){
	$db  = new db_local;
	$sql="select count(ID) as soluong from $table where 1 ".$sql_extend;
	//echo $sql;
	$db->query($sql);
	if($db->next_record()){return $db->record["soluong"]+1;}
	return 0;
}
public function getArrFieldID($query,$arrfield)
{
	$db  = new db_local;
	$html=0;
	if(!is_array($arrfield)) return false;
	#for cboCategory
	//$sql="select ID,$Gvalue from $table where $id='".$value."'";
	// print $query;
	$arr=array();
	$db->query($query);	
	
	if($db->num_rows()>0)
	{	
		while($db->next_record()){
			$arr[$db->record[$arrfield[0]]]=$db->record[$arrfield[1]];
		}
	}
	
	return $arr;
}
function insert_id() {
		if(!$this->link_id) return false;
		return mysqli_insert_id();
	}
	
function get_row($mode = "both") {
		if(!$this->record) return false;

		$return = array();
		switch($mode) {
			case "assoc":
				foreach($this->record as $k => $v) {
					if(!is_int($k)) $return[$k] = $v;
				}
				break;
			case "num":
				foreach($this->record as $k => $v) {
					if(is_int($k)) $return[$k] = $v;
				}
				break;
			default:
				$return = $this->record;
				break;
		}
		return array_map("stripslashes",$return);
	}
function f($index) {
		return stripslashes($this->record[$index]);
	}	
function nf() {
		if ($numb = mysqli_num_rows($this->query_id) === false) return $this->error;
		return mysqli_num_rows($this->query_id);
	}	
function escape($string){
		if(!$this->link_id) return addslashes($string);
		return mysqli_real_escape_string($string);
	}
	
////////////////////////////////////////////
	//Xu ly copy record trong mot table bat ki
	protected function copyRecord($table,$oldid,$newid){
	
		if(!isset($table) || !isset($oldid) || !isset($newid))return false;
		//echo 1;
		
		$db = new db_local;
		$sql_temp='CREATE TEMPORARY TABLE tmp SELECT * FROM '.$table.' WHERE ID = '.$oldid.' ';
		$this->query($sql_temp);
		$sql_update_title='UPDATE tmp SET  title=CONCAT("'._DEFINE_PREFIX_TITLE.'"," ",title) WHERE ID = '.$oldid.'';
		$this->query($sql_update_title);
		$sql_update_urlseo='UPDATE tmp SET urlseo=CONCAT(urlseo,"-","'.time().'") WHERE ID = '.$oldid.'';
		$this->query($sql_update_urlseo);
		$sql_update='UPDATE tmp SET ID='.$newid.' WHERE ID = '.$oldid.'';
		$this->query($sql_update);
		$sql_insert='INSERT INTO '.$table.' SELECT * FROM tmp WHERE ID ='.$newid.'';
		$flag = $this->query($sql_insert);
		$sql_insert='DROP TABLE tmp ';
		$flag = $this->query($sql_insert);
		
		return $flag;

	}
	
	//Xu ly copy record trong mot table bat ki
	protected function copyRecord_original($table,$oldid,$newid){
	
		if(!isset($table) || !isset($oldid) || !isset($newid))return false;
		//echo 1;
		$table_tmp = 'tmp_'.time();
		$db = new db_local;
		$sql_temp='CREATE TEMPORARY TABLE '.$table_tmp.' SELECT * FROM '.$table.' WHERE ID = '.$oldid.' ;';
		$db->query($sql_temp);	
		
		$sql_update='UPDATE '.$table_tmp.' SET ID='.$newid.' WHERE ID = '.$oldid.';';
		$db->query($sql_update);
		$sql_insert='INSERT INTO '.$table.' SELECT * FROM '.$table_tmp.' WHERE ID ='.$newid.';';
		$db->query($sql_insert);
		$sql_drop='DROP TABLE '.$table_tmp.'; ';
		$flag = $db->query($sql_drop);
	
		return $flag;
	
	}
	//Xu ly copy record san pham 
	protected function copyRecord_product($table,$oldid,$newid){
	
		if(!isset($table) || !isset($oldid) || !isset($newid))return false;
		//echo 1;
	
		$db = new db_local;
		$sql_temp='CREATE TEMPORARY TABLE tmp_table SELECT * FROM '.$table.' WHERE ID = '.$oldid.'';
		$this->query($sql_temp);
		$sql_update_title='UPDATE tmp_table SET 
				
				code="'._REFIX_CODE_PRODUCT.$newid.'",
				product_name=CONCAT("'._DEFINE_PREFIX_TITLE.'"," ",product_name),
				product_name_en=CONCAT("'._DEFINE_PREFIX_TITLE.'"," ",product_name_en)
				
				WHERE ID = '.$oldid.'';
		$this->query($sql_update_title);
		//$sql_update_title='UPDATE tmp SET product_name_en=CONCAT("'._DEFINE_PREFIX_TITLE.'"," ",product_name_en) WHERE ID = '.$oldid.'';
		//$this->query($sql_update_title);
		$sql_update_urlseo='UPDATE tmp_table SET url_seo="'.$newid.'",
											url_seo_en="'.$newid.'"
				WHERE ID = '.$oldid.'';
		$this->query($sql_update_urlseo);
		$sql_update='UPDATE tmp_table SET ID='.$newid.' WHERE ID = '.$oldid.'';
		$this->query($sql_update);
		$sql_insert='INSERT INTO '.$table.' SELECT * FROM tmp_table WHERE ID ='.$newid.'';
		$flag = $this->query($sql_insert);
	
		return $flag;
	
	}
	
	public function autoOptimize(){
		// var_dump($this->link_id);
		self::connect();
		$res = mysqli_query($this->link_id,' SHOW TABLE STATUS WHERE Data_free > 0 and Engine="MyISAM" ');
		if (isset($res)) {
			# code...
			while($row = mysqli_fetch_assoc($res)) {
				mysqli_query($this->link_id,'OPTIMIZE TABLE ' . $row['Name']);
			}
		}
		
	}
//Xu ly cac tac vu Update, Insert, Delete trong DB
public function InsertRecord($table,$arrSQL,$action="insert",$queryWhere='',$print=0){
	
	if(!is_array($arrSQL)) return false;
	// $db = new db_local;
	$sql='';
	$sqlvalue=	self::make_Sql_Value($arrSQL,$action);
	switch($action)
	{
	  case "insert"	: 
	  	$sql="insert into ".$table.$sqlvalue; 
	  	self::autoOptimize();
	  	
	  break;
	  case "update"	: 
	  	$sql="update ".$table." set ".$sqlvalue." where ".$queryWhere;
	  	self::autoOptimize();
	  break;
	  
	  case "del"	: $sql="delete from ".$table." where ( ".$sqlvalue.") "; 
	  					 
	  					if($queryWhere!=""){
							if($sqlvalue!="") $sql.=" and "; 
							$sql.= $queryWhere; break;
						}
						break;
	}
	//return $sql;
    if($print==1){
	    echo $sql."<br>";
// 	    die();
	}
	if($sql!="") { $flag	=$this->query($sql); return $flag;}

	else return false;
}
////////////////////////////////////////////////
/////////////////////////////////////////////////
}//end class
?>