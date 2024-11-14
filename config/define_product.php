<?php
	/* PREFIX product code */
	define('_PREFIX_PRODUCT_CODE','SP');

	/* define array thumb size */
	$_ARR_SIZE_THUMB_PRODUCT = array(
	    0 => array(480,480),
	);
	define("_ARR_SIZE_THUMB_PRODUCT",serialize($_ARR_SIZE_THUMB_PRODUCT));

	/* define array slider size */
	$_ARR_SIZE_SLIDER_PRODUCT = array(
	    0 => array(480,480)
	);
	define("_ARR_SIZE_SLIDER_PRODUCT",serialize($_ARR_SIZE_SLIDER_PRODUCT));

	/* slider crop-resize : $thumb->index */
	define("_SLIDE_INDEX_PRODUCT",0); /* $_ARR_SIZE_SLIDER_PRODUCT */

	/* FLAG SLIDER : title, intro, link */
	define('_FLAG_PRODUCT_TITLE',1);
	define('_FLAG_PRODUCT_INTRO',1);
	define('_FLAG_PRODUCT_LINK',1);

	/* slider : max image upload */
	define('_MAX_IMAGE_SLIDER_PRODUCT',5);

?>