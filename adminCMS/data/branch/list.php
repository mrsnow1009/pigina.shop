<?php  

	$_method = new method();
	
    /* set - tieu de trang web */
    $page_title = $LANG['list-branch'];

	/* set - breadcrumb */
	$showBreadcrumbAdmin = $_method->showBreadcrumbAdmin(serialize(array(
		_LINK_HOME => $LANG['index'],
		'javascript:;' => $page_title,
	)));
?>