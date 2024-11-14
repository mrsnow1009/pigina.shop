<?php

	/* define array thumb size */
	$_ARR_SIZE_THUMB_WIDGET = array(
	    // 0 => array(480,360),
	);
	define("_ARR_SIZE_THUMB_WIDGET",serialize($_ARR_SIZE_THUMB_WIDGET));

	/* define array bg size */
	$_ARR_SIZE_THUMB_WIDGET_BG = array(
	    // 0 => array(1920,1080)
	);
	define("_ARR_SIZE_THUMB_WIDGET_BG",serialize($_ARR_SIZE_THUMB_WIDGET_BG));

	/* define array type */
	$_ARR_WIDGET_TYPE = array(
	    'category'=>$LANG['category'],
	    'object'=>$LANG['object']
	);
	define("_ARR_WIDGET_TYPE",serialize($_ARR_WIDGET_TYPE));

	/* define type default */
	define("_ARR_WIDGET_TYPE_DEFAULT",'category');

	/* define module default */
	define("_ARR_WIDGET_MODULE_DEFAULT",'RSCMS');
?>