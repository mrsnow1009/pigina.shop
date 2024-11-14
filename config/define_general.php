<?php 
	$_SYSTEM_VAR=array(
		'RSCMS' => 'content',		
	);	
	define('_SYSTEM_VAR',serialize($_SYSTEM_VAR));
	
	$_SYSTEM_PAGE=array(
		'RSCMS' => 'content.php',
	);	
	define('_SYSTEM_PAGE',serialize($_SYSTEM_PAGE));

	$_ARR_FLAG_LANG=array(
		'vn' => _ROOT_PATH_WEBSITE.'/assets/images/flag_vn.png',
		'en' => _ROOT_PATH_WEBSITE.'/assets/images/flag_en.png',
	);
	define("_ARR_FLAG_LANG",serialize($_ARR_FLAG_LANG));
	$_ARR_LANG_TEXT=array(
	    'vn' => 'Vietnamese',
	    'en' => 'English',
	);
	define('_ARR_LANG_TEXT',serialize($_ARR_LANG_TEXT));

	$_ARR_MODULE=array(
	    'RSCMS' => 'Content Module',
	    'RSPRODUCT' => 'Product Module'
	);
	define('_ARR_MODULE',serialize($_ARR_MODULE));

	$_ARR_MODULE_TABLE=array(
	    'RSCMS' => TBLCONTENT,
	    'RSPRODUCT' => TBLPRODUCT
	);
	define('_ARR_MODULE_TABLE',serialize($_ARR_MODULE_TABLE));

?>