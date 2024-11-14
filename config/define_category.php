<?php 
	define("_LEVEL_CATE_ADMIN",4);

	/* config menu */
	$_ARR_MENU_CONFIG=array(
	    "1"=>$LANG['header_menu'],
	    "2"=>$LANG['mobile_header_menu'],
	    // "3"=>$LANG['bottommenu'],
	    // "4"=>$LANG['topmenu'],
	   // "5"=>$LANG['right'],
	    // "6"=>$LANG['right_product'],
	//    "7"=>_SCOLL_MENU_CATE,
	);
	define("_ARR_MENU_CONFIG",serialize($_ARR_MENU_CONFIG));

	/* cate module: node */
	$_NODE_MODULE = array(
		'cate' => 'RSCATEGORY',
		'content' => 'RSCMS',
		'product' => 'RSPRODUCT'
	);
	define('_NODE_MODULE',serialize($_NODE_MODULE));
	
	/* status */
	define('_STATUS_DEFAULT_CATEGORY',1);

	/* define array thumb size */
	$_ARR_SIZE_THUMB_CATEGORY = array(
	    0 => array(480,360),
	);
	define("_ARR_SIZE_THUMB_CATEGORY",serialize($_ARR_SIZE_THUMB_CATEGORY));
?>