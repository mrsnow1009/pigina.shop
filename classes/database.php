<?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// GLOBAL $database;
// $database = "num_list";
class database {

    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $database = "";
    public $connect;
    public $lastid;
    public $record;

    public $row;
    private $errno = 0;
    private $error = '';
    private $result = 0;

    function __construct() {

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $WEBCONFIG          = unserialize(WEBCONFIG);
	   	$this->host        = $WEBCONFIG["DB"]['hosting'];
	   	$this->database    = $WEBCONFIG["DB"]['name_db'];
	   	$this->user        = $WEBCONFIG["DB"]['user_db'];
	   	$this->pass        = $WEBCONFIG["DB"]['pass_db'];

    }

    private function connect(){
        $this->connect = mysqli_connect($this->host,$this->user,$this->pass,$this->database);
        mysqli_select_db($this->connect,$this->database);
    }

    public function get_inset_id(){
        return $this->lastid;
    }
    public function set_inset_id($lastid){
        $this->lastid = $lastid;
    }

    protected function halt($msg){
      	var_dump($msg);
	}

    public function query($query){
    	$this->connect();
    	$this->result = mysqli_query($this->connect, $query);
    	$this->row   = 0;

		// $this->errno = mysqli_connect_errno($this->connect);
		// $this->error = mysqli_connect_error($this->connect);
        $this->errno = mysqli_connect_errno();
        $this->error = mysqli_connect_error();
		if (!$this->result)
		{
			$this->halt("Invalid SQL.");

		}
		// return $this->result;
    }

	public function num_rows(){
		return mysqli_num_rows($this->result);
	}
	public function next_record(){
		$this->record = mysqli_fetch_array($this->result);
		$this->row   += 1;
		// $this->errno = mysqli_connect_errno($this->connect);
		// $this->error = mysqli_connect_error($this->connect);
        $this->errno = mysqli_connect_errno();
        $this->error = mysqli_connect_error();

		$stat = is_array($this->record);
		if (!$stat)
		{
			mysqli_free_result($this->result);
			$this->result = 0;
		}

		return $stat;
	}
    public function nf() {
        if (mysqli_num_rows($this->result) === false) return $this->error;
        return mysqli_num_rows($this->result);
    }
    public function f($index) {
        return stripslashes($this->record[$index]);
        // return array_map("stripslashes",$this->record[$index]);
    }

    public function get_row($mode = "both") {
        if(!$this->record) return false;

        $return = array();
        switch($mode) {
            case "assoc":
                foreach($this->record as $k => $v) {
                    if(!is_int($k)) {
                        if ( $v == false) $v= '';
                        $return[$k] = $v;
                    }
                }
                break;
            case "num":
                foreach($this->record as $k => $v) {
                    if(!is_int($k)) {
                        if ( $v == false) $v= '';
                        $return[$k] = $v;
                    }
                }
                break;
            default:
                $return = $this->record;
                break;
        }
        if (count($return) != 0)
            return array_map("stripslashes",$return);
        else
            return false;
    }
    public function getField($table,$selectField,$field_set,$value,$filter='',$print=0){
        $this->connect();
        $sql='select `'.$selectField.'` from '.$table.' where `'.$field_set.'` = "'.$value.'" '.$filter;
        if ($print == 1) echo $sql;
        $this->result = mysqli_query ($this->connect, $sql);
        $data = false;
        while ( $row = mysqli_fetch_array($this->result)){
            $data = htmlspecialchars_decode($row[$selectField]);
        }
        return $data;
    }

    /* toi uu hoa va chong phan manh */
    public function autoOptimize(){
        $this->connect();
        $res = mysqli_query($this->connect,' SHOW TABLE STATUS WHERE Data_free > 0 and Engine="MyISAM" ');
        if (isset($res)) {
            while($row = mysqli_fetch_assoc($res)) {
                mysqli_query($this->connect,'OPTIMIZE TABLE ' . $row['Name']);
            }
        }
    }

    /* insert record */
    public function insertTable($table,&$fields,$printSql = 0){
        $this->connect();

        $sql = "insert into $table (`".implode("` , `",array_keys($fields))."`)";
        $sql .= " values(";
        foreach($fields as $key => $value) {
            // $fields[$key] = $value;
            if (gettype($value) == 'integer' || gettype($value) == 'double')
                $fields[$key] = $value;
            else
                $fields[$key] = "'".$value."'";
        }
        $sql .= implode(" , ",array_values($fields)).");";
        // $sql .= implode("' , '",array_values($fields))."');";
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        if ($printSql != 0) echo $sql;
        $this->autoOptimize();

        $result = mysqli_query($this->connect,$sql);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($this->connect));
        }else {
            //echo 'done.';
        }
        $this->set_inset_id($this->connect->insert_id);
        // mysqli_close($this->connect);

        return $this->connect->insert_id;

    }

    /* update record */
    public function updateTable($table,&$fields,$condition,$printSql = 0) {
        $this->connect();

        $sql = "update $table set ";
        foreach($fields as $key => $value) {
            if (gettype($value) == 'integer' || gettype($value) == 'double')
                $fields[$key] = " `".$key."` = ".$value;
            else
                $fields[$key] = " `".$key."` = '".$value."'";
        }
        $sql .= implode(" , ",array_values($fields))." where ".$condition.";";
        if ($printSql != 0) echo $sql;
        $this->autoOptimize();

        $result = mysqli_query($this->connect,$sql);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($this->connect));
        }

        return $result;
    }

    /* delete record */
    public function deleteTable($table,$fields,$printSql = 0){
        $this->connect();

        $sql = "delete from $table where ";
        foreach($fields as $key => $value) {
            if (gettype($value) == 'integer' || gettype($value) == 'double')
                $fields[$key] = " `".$key."` = ".$value;
            else
                $fields[$key] = " `".$key."` = '".$value."'";
        }
        $sql .= implode(" and ",array_values($fields))." ;";
        if ($printSql != 0) echo $sql;
        $this->autoOptimize();

        $result = mysqli_query($this->connect,$sql);
        if ( false===$result ) {
            printf("error: %s\n", mysqli_error($this->connect));
        }

        return $result;
    }

    /* delete record */
    public function deleteRecord($query){
        $this->query($query);
        return $this->result;
    }

    /* Get maxID in Database */
    public function getMaxID($table, $strID,$strfilter="") {
        $strSQL = "select ".$strID." from ".$table." ".$strfilter;
        $this->query($strSQL);
        $num = $this->num_rows();
        if ($num <= 0){
            $maxID = 1;
        }else{
            $strSQL = "select  ".$strID." from ".$table." ".$strfilter."  order by ".$strID." DESC LIMIT 0, 1 " ;
            $this->query($strSQL);
            $this->next_record();
            $data = $this->record[$strID];
            $maxID=$data+1;
        }
        return  $maxID;
    }

    public function getValue($query,$field){
        $result = false;
        $this->query($query);
        if($this->num_rows()>0) {
            $this->next_record();
            $result = htmlspecialchars_decode($this->record[$field]);
        }
        return $result;
    }

    /*  ham nay dung de dua ra so thu tu tang auto theo moi table
        tham so truyen vao : tablename,
        tham so tra ve : so thu tu tang */
    function returnOrdinals($table,$filter = ''){
        $sql="select count(ID) as quantity from ".$table." where 1 ".$filter;
        $this->query($sql);
        if($this->next_record()) return $this->record["quantity"] + 1;
        return 1;
    }

    public function connect_atp(){
        $this->connect = mysqli_connect($this->host,$this->user,$this->pass,$this->database);
        mysqli_select_db($this->connect,$this->database);
    }
    public function query_atp($query){
        $this->result = mysqli_query($this->connect, $query);
        $this->row   = 0;
        $this->errno = mysqli_connect_errno();
        $this->error = mysqli_connect_error();
        if (!$this->result){
            $this->halt("Invalid SQL.");
        }
    }
    public function getArrFieldID($query,$arrfield){
        $result = array();
        if(!is_array($arrfield)) return $result;
        $this->query($query);
        if($this->num_rows()>0){
            while($this->next_record()){
                $result[$this->record[$arrfield[0]]] = $this->record[$arrfield[1]];
            }
        }
        return $result;
    }
    public function getMultiFields($table,$arrField,$id,$value,$and=''){
        if(!is_array($arrField)) return false;
        $sql = "select `".implode("`,`",$arrField)."` from ".$table." where ".$id."='".$value."' ".$and;
        $values = array();
        $this->query($sql);
        if($this->num_rows()>0){
            $this->next_record();
            for($i = 0;$i < count($arrField);$i++){
                $values[$arrField[$i]] = htmlspecialchars_decode($this->record[$arrField[$i]]);
            }
        }
        return $values;
    }

    /* lay nhieu row chi co 1 field: $result[] = $field */
    public function getMultiRowsOnlyOneField($table,$field,$and=''){
        $sql=' select '.$field.' from '.$table.' where 1 '.$and;
        $this->query($sql);
        if($this->num_rows() < 1) return false;

        $result = array();
        while ($this->next_record()){
            $result[] = $this->record[$field];
        }
        return $result;
    }
}

