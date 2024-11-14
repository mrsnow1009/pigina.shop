<?php

	/* lang array */
	define("_LANG_ARR",serialize($WEBCONFIG['LANG_ARR']));
	/* Mod ReWRITE */
	define("_FLG_REWRITE",$WEBCONFIG['REWRITE']);
	/* Dev mode */
	define('_DEV_MODE',1);
	/* Currency */
	define('_CURRENCY',$WEBCONFIG['CURRENCY']);
	/* Ratio - thumb */
	define("_FLAG_PIXEL_RATIO",1);

	$_PHISICAL_PATH = str_replace("\\","/",realpath(dirname(__FILE__)) . '/');
	define('_PHISICAL_PATH_ROOT',current(preg_split('/config/i', $_PHISICAL_PATH)));
	define("_PHISICAL_PATH_ADMIN",_PHISICAL_PATH_ROOT."adminCMS/");

	/* ===================== Config Upload file  ====================== */
	define('_UPLOAD_BY_FTP','0');
	define('_FTP_SERVER','');
	define('_FTP_USER','');
	define('_FTP_PASS','');
	define('_FTP_PORT','21');
	/* ===================== Config Upload file  ====================== */

	/* ===================== Config PATH_WEBSITE ====================== */
	if ($WEBCONFIG['ONSSL']=="on") {
		define('_SSL','https://');
		define('_SSL_','https');
	}else {
		define('_SSL','http://');
		define('_SSL_','http');
	}
	define('_SERVER_NAME',$_SERVER['HTTP_HOST']);
	define('_SERVER_PATH','/tuyetshop.net');
	define('_ROOT_PATH',_SSL._SERVER_NAME);
	define('_ROOT_PATH_WEBSITE',_SSL._SERVER_NAME._SERVER_PATH);
	define('_ROOT_PATH_WEBSITE_F',_ROOT_PATH_WEBSITE."/");
	define('_PATH_ADMIN','adminCMS');
	define("_ROOT_PATH_ADMIN",_SSL._SERVER_NAME._SERVER_PATH."/"._PATH_ADMIN."/");
	define('_LEVEL_ADMIN','../');
	/* ==================== Config PATH_WEBSITE ======================== */


	/* ======================== Config PATH_UPLOAD ======================== */
	define('_PATH_RESOURCE_DOMAIN', 'resources/');
	define('_PATH_UPLOAD',_PATH_RESOURCE_DOMAIN.'upload/');
	define('_PATH_CACHED',_PATH_RESOURCE_DOMAIN.'cached/');
	define('_PATH_UPLOAD_CATEGORY',_PATH_UPLOAD.'category/');
	define('_PATH_UPLOAD_ARTICLE',_PATH_UPLOAD.'article/');
	define('_PATH_UPLOAD_PRODUCT',_PATH_UPLOAD.'product/');
	define('_PATH_UPLOAD_PRODUCT_SLIDER',_PATH_UPLOAD_PRODUCT.'slider/');
	define('_PATH_UPLOAD_PRODUCT_VERSION',_PATH_UPLOAD.'product-version/');
	define('_PATH_UPLOAD_BANNER',_PATH_UPLOAD.'banner/');
	define('_PATH_UPLOAD_COMPANY',_PATH_UPLOAD.'company/');
	define('_PATH_UPLOAD_DATA_FILE',_PATH_UPLOAD.'data_file/');
	define('_PATH_UPLOAD_GALLERY',_PATH_UPLOAD.'gallery/');
	define('_PATH_UPLOAD_ADMIN',_PATH_UPLOAD.'admin/');
	define('_PATH_UPLOAD_EXTEND',_PATH_UPLOAD.'extend/');
	define('_PATH_UPLOAD_WIDGET',_PATH_UPLOAD.'widget/');
	define('_PATH_UPLOAD_CAREER',_PATH_UPLOAD.'career/');
	define('_PATH_UPLOAD_MEMBER',_PATH_UPLOAD.'member/');
	/* define upload folder for CKeditor - BO */
	define('_PATH_UPLOAD_EDITOR',_SERVER_PATH.'/'._PATH_UPLOAD.'userfiles/');
?>