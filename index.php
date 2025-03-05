<?php 

	/* start - get cate */
    if (!isset($_GET['cate']) || $_GET['cate'] == ''){
        $cate = false;
    }else
        $cate = $_GET['cate'];
    define('GLOBALS_CATE',$cate);
	/* end - get cate */

	/* start - get item */
    if (!isset($_GET['item']) || $_GET['item'] == ''){
        $item = false;
    }else
        $item = $_GET['item'];
    define('GLOBALS_ITEM',$item);
	/* end - get item */

	/* start - get action */
    if (!isset($_GET['act']) || $_GET['act'] == ''){
        $action = false;
    }else
        $action = $_GET['act'];
    define('GLOBALS_ACTION',$action);
	/* end - get action */

	/* start - get module */
	if (!isset($_GET['module']) || $_GET['module'] == ''){
        $module = 'error';
    }else
        $module = $_GET['module'];

	if ($cate === false && $item === false && $action === false) {
		$module = 'HOMEPAGE';
	}
    define('GLOBALS_MODULE',$module);
	/* end - get module */

    $_LEVEL ='';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');

    file_exists(_PATH_DB_LOCAL_CLASS)?include_once(_PATH_DB_LOCAL_CLASS):die(_PATH_DB_LOCAL_CLASS.' khong ton tai');
    file_exists(_PATH_METHOD_CLASS)?include_once(_PATH_METHOD_CLASS):die(_PATH_METHOD_CLASS.' khong ton tai');
    
    /* khai bao bien toan cuc */
    // $Session = new Session();
    $method = new method();
    

    /* get data - layout */

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
    controler -> data -> layout -> script
</body>

</html>