<?php 

	define('_STATUS_DEFAULT_CONTACT_FORM', 1);

	/* status */
	$_ARR_STATUS_CONTACT_FORM = array(
		'1' => $LANG['pending'],
		'2' => $LANG['confirmed']
	);
	define('_ARR_STATUS_CONTACT_FORM',serialize($_ARR_STATUS_CONTACT_FORM));
?>