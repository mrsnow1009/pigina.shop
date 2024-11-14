<?php

	/* Language Admin Default */
	define('_LANG_ADMIN_DEFAULT',$WEBCONFIG['LANG_DEFAULT']);
	/* define status */
	$_ARR_STATUS = array(
		'1' => $LANG['active'],
		'2' => $LANG['inactive']
	);
	define('_ARR_STATUS',serialize($_ARR_STATUS));
	/* define status webmaster */
	define('_ARR_STATUS_WEBMASTER',serialize($_ARR_STATUS));

	/* level webmaster : root */
	$_LEVEL_WEBMASTER = array(
		'root' => $LANG['root'],
		'admin' => $LANG['administrator'],
		'staff' => $LANG['staff']
	);
	define('_LEVEL_WEBMASTER',serialize($_LEVEL_WEBMASTER));

	/* define - html style - badge status - bacground-color */
	$_ARR_STATUS_BADGE = array(
		'1' => '<span class="badge text-bg-info">'.$LANG['active'].'</span>',
		'2' => '<span class="badge text-bg-secondary">'.$LANG['inactive'].'</span>'
	);
	define('_ARR_STATUS_BADGE',serialize($_ARR_STATUS_BADGE));

	/* define - html class - color status icon */
	$_ARR_STATUS_COLOR_CLASS = array(
		'1' => 'text-primary',
		'2' => 'text-secondary'
	);
	define('_ARR_STATUS_COLOR_CLASS',serialize($_ARR_STATUS_COLOR_CLASS));

	/* set level cua danh muc cha, va se ko hien thi khi chon danh muc va ko được chon danh muc cha */
	define("_ROOT_LEVEL_HIDDEN",3);

	/* Ma code thay the trong template mail */
	$_ARR_HELP_TEMPLATE =array(
		'[SUPPORT_EMAIL]'=>$LANG['support_email'],
		"[SERVER_NAME]"=>$_SERVER['HTTP_HOST'],

		'[COMPANY_NAME]' => $LANG['company_name'],
		'[COMPANY_ADDRESS]' => $LANG['company_address'],
		'[COMPANY_PHONE]' => $LANG['company_phone'],
		'[COMPANY_HOTLINE]' => $LANG['company_hotline'],
		'[COMPANY_EMAIL]' => $LANG['company_email'],
		'[COMPANY_FAX]' => $LANG['company_fax'],
		'[COMPANY_WEBSITE]' => $LANG['website'],
		'[COMPANY_BRANDNAME]' => $LANG['company_brandname'],
		'[COMPANY_LOGO]' => $LANG['company_logo'],
		'[COMPANY_LOGO_FAVICON]' => $LANG['logo-favicon'],
		'[COMPANY_FACEBOOK]' => $LANG['company_facebook'],
		'[COMPANY_TWITTER]' => $LANG['company_twitter'],
		'[COMPANY_YOUTUBE]' => $LANG['company_youtube'],
		'[COMPANY_INSTAGRAM]' => $LANG['company_instagram'],
		'[COMPANY_LINKEDIN]' => $LANG['company_linkedin'],
		'[COMPANY_PINTEREST]' => $LANG['company_pinterest'],
	);
	define("_ARR_HELP_TEMPLATE",serialize($_ARR_HELP_TEMPLATE));
	$_ARR_HELP_ORDER_TEMPLATE =array(
		'[ORDER_CODE]' => $LANG['order_code'],
		'[ORDER_DATE]' => $LANG['order_date'],
		'[ORDER_NOTE]' => $LANG['order_note'],

		'[ORDER_STATUS]' => $LANG['order_status'],
		'[ORDER_DELIVERY_METHOD]' => $LANG['order_delivery_method'],
		'[ORDER_DELIVERY_STATUS]' => $LANG['order_delivery_status'],
		'[ORDER_PAYMENT_METHOD]' => $LANG['order_payment_method'],
		'[ORDER_PAYMENT_STATUS]' => $LANG['order_payment_status'],

		'[DELIVERY_FEE]' => $LANG['order_delivery_fee'],
		'[PRODUCT_LIST]' => $LANG['order_product_list'],
		'[TOTAL_QUANTITY]' => $LANG['order_total_quantity'],
		'[TOTAL_AMOUNT]' => $LANG['order_total_amount'],
		'[TOTAL_ORDER]' => $LANG['order_total_order'],

		'[BUYER_NAME]' => $LANG['order_buyer_fullname'],
		'[BUYER_PHONE]' => $LANG['order_buyer_phone'],
		'[BUYER_EMAIL]' => $LANG['order_buyer_email'],
		'[BUYER_ADDRESS]' => $LANG['order_buyer_address'],

		'[RECEIVER_NAME]' => $LANG['order_receiver_fullname'],
		'[RECEIVER_PHONE]' => $LANG['order_receiver_phone'],
		'[RECEIVER_EMAIL]' => $LANG['order_receiver_email'],
		'[RECEIVER_ADDRESS]' => $LANG['order_receiver_address'],
	);
	define("_ARR_HELP_ORDER_TEMPLATE",serialize($_ARR_HELP_ORDER_TEMPLATE));
	$_ARR_HELP_MEMBER_TEMPLATE =array(
		"[MEMBER_USERNAME]"=>$LANG['member_username'],
		"[MEMBER_PASSWORD]"=>$LANG['member_password'],
		'[MEMBER_CODE]'=>$LANG['member_code'],
		"[MEMBER_FULLNAME]"=>$LANG['member_fullname'],
		"[MEMBER_LASTNAME]"=>$LANG['member_lastname'],
		"[MEMBER_FIRSTNAME]"=>$LANG['member_firstname'],
		"[MEMBER_EMAIL]"=>$LANG['member_email'],
		'[MEMBER_PHONE]'=>$LANG['member_phone'],
		'[MEMBER_ADDRESS]'=>$LANG['member_address'],
		'[MEMBER_GENDER]'=>$LANG['member_gender'],
		'[MEMBER_BIRTHDATE]'=>$LANG['member_birthdate'],
		'[MEMBER_LASTLOGIN]'=>$LANG['member_lastlogin'],
	);
	define("_ARR_HELP_MEMBER_TEMPLATE",serialize($_ARR_HELP_MEMBER_TEMPLATE));

    $_ARR_COLOR_LANG_BADGET = array(
        'vn'=>'<span class="badge text-bg-info">'.$LANG['en_vietnamese'].'</span>',
        'en'=>'<span class="badge text-bg-warning">'.$LANG['en_english'].'</span>'
    );
	define('_ARR_COLOR_LANG_BADGET',serialize($_ARR_COLOR_LANG_BADGET));
?>