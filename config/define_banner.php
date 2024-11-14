<?php 

	/* group banner */
	define('_GROUP_DEFAULT_BANNER','header');

	/* target */
	define('_TARGET_DEFAULT_BANNER','_self');
	$_TARGET_BANNER = array(
		'_self' => $LANG['self_tab'],
		'_blank' => $LANG['blank_tab']
	);
	define('_TARGET_BANNER',serialize($_TARGET_BANNER));

	/* type */
	define('_TYPE_DEFAULT_BANNER','images');
	$_TYPE_BANNER = array(
		'images' => $LANG['image'],
		'script' => $LANG['script_code']
	);
	define('_TYPE_BANNER',serialize($_TYPE_BANNER));

	/* slider : max image upload */
	define('_MAX_IMAGE_SLIDER_BANNER',5);

	/* define array slider size */
	$_ARR_SIZE_SLIDER_BANNER = array(
	    0 => array(360,360),
	    // 0 => array(1920,864),
	);
	define("_ARR_SIZE_SLIDER_BANNER",serialize($_ARR_SIZE_SLIDER_BANNER));

	/* slider crop-resize : $thumb->index */
	$_ARR_THUMB_INDEX_BANNER = array(
	    'header' => 0,
	    'footer' => 1,
	    'popup' => 2,
	    'popup_right' => 3,
	    'right' => 4,
	    'left' => 5
	);
	define("_ARR_THUMB_INDEX_BANNER",serialize($_ARR_THUMB_INDEX_BANNER));

	/* FLAG SLIDER : title, intro, link */
	define('_FLAG_BANNER_TITLE',1);
	define('_FLAG_BANNER_INTRO',1);
	define('_FLAG_BANNER_LINK',1);
?>