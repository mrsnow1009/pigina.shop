<?php
$_INCLUDE_PHYSICAL_PATH = str_replace("\\","/",realpath(dirname(__FILE__)) . '/');
ini_set('display_errors', '1');
error_reporting(E_ALL);

/*Get Shop information and identifying it*/
$_LEVEL =   ''; // Config path for domain config. Do not remove.
include $_LEVEL.'identify.php';


?>