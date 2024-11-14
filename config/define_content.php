<?php 

	/* code: node */
	$_NODE_CONTENT = array(
		'content' => '_CONTENT',
		'news' => '_NEWS'
	);
	define('_NODE_CONTENT',serialize($_NODE_CONTENT));

	/* define array thumb size */
	$_ARR_SIZE_THUMB_ARTICLE = array(
	    0 => array(480,360),
	);
	define("_ARR_SIZE_THUMB_ARTICLE",serialize($_ARR_SIZE_THUMB_ARTICLE));
?>