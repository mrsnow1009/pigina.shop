<?php
	file_exists($_LEVEL.'config/define_file.php')?include_once($_LEVEL.'config/define_file.php'):die($_LEVEL.'config/define_file.php khong ton tai');
	file_exists($_LEVEL.'config/db_table.php')?include_once($_LEVEL.'config/db_table.php'):die($_LEVEL.'config/db_table.php khong ton tai');
	file_exists($_LEVEL.'config/define_general.php')?include_once($_LEVEL.'config/define_general.php'):die($_LEVEL.'config/define_general.php khong ton tai');
	
	file_exists($_LEVEL.'config/define_datatable.php')?include_once($_LEVEL.'config/define_datatable.php'):die($_LEVEL.'config/define_datatable.php khong ton tai');

	file_exists($_LEVEL.'config/define_category.php')?include_once($_LEVEL.'config/define_category.php'):die($_LEVEL.'config/define_category.php khong ton tai');
	file_exists($_LEVEL.'config/define_content.php')?include_once($_LEVEL.'config/define_content.php'):die($_LEVEL.'config/define_content.php khong ton tai');
	file_exists($_LEVEL.'config/define_product.php')?include_once($_LEVEL.'config/define_product.php'):die($_LEVEL.'config/define_product.php khong ton tai');
	file_exists($_LEVEL.'config/define_product_version.php')?include_once($_LEVEL.'config/define_product_version.php'):die($_LEVEL.'config/define_product_version.php khong ton tai');
	file_exists($_LEVEL.'config/define_banner.php')?include_once($_LEVEL.'config/define_banner.php'):die($_LEVEL.'config/define_banner.php khong ton tai');
	file_exists($_LEVEL.'config/define_library.php')?include_once($_LEVEL.'config/define_library.php'):die($_LEVEL.'config/define_library.php khong ton tai');
	file_exists($_LEVEL.'config/define_order.php')?include_once($_LEVEL.'config/define_order.php'):die($_LEVEL.'config/define_order.php khong ton tai');
	file_exists($_LEVEL.'config/define_template.php')?include_once($_LEVEL.'config/define_template.php'):die($_LEVEL.'config/define_template.php khong ton tai');
	file_exists($_LEVEL.'config/define_company.php')?include_once($_LEVEL.'config/define_company.php'):die($_LEVEL.'config/define_company.php khong ton tai');
	file_exists($_LEVEL.'config/define_contact_form.php')?include_once($_LEVEL.'config/define_contact_form.php'):die($_LEVEL.'config/define_contact_form.php khong ton tai');
	file_exists($_LEVEL.'config/define_widget.php')?include_once($_LEVEL.'config/define_widget.php'):die($_LEVEL.'config/define_widget.php khong ton tai');

	/* path file controller */
	define("_PHISICAL_PATH_CONTROLLER",_PHISICAL_PATH_ROOT.'controller/');

	/* path file ajax */
	define("_PHISICAL_PATH_AJAX",_PHISICAL_PATH_ROOT.'ajax.php');

	/* path file classes */
	define("_PHISICAL_PATH_CLASSES",_PHISICAL_PATH_ROOT.'classes/');

	/* path file custom */
	define("_PHISICAL_PATH_VIEW",_PHISICAL_PATH_ROOT.'view/'.$GLOBALS['WEBCONFIG']['VIEW'].'/');
	define("_PHISICAL_PATH_VIEW_LAYOUT",_PHISICAL_PATH_VIEW.'layout/');
	define("_PHISICAL_PATH_VIEW_DATA",_PHISICAL_PATH_VIEW.'data/');
	define("_PHISICAL_PATH_VIEW_SCRIPT",_PHISICAL_PATH_VIEW.'script/');

	/* url file ajax */
	define("_ROOT_PATH_AJAX",_PHISICAL_PATH_ROOT.'ajax.php');

?>