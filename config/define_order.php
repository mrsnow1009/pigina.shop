<?php
	/* PREFIX order code */
	define('_PREFIX_ORDER_CODE','0');
	/* default languge order */
	define('_DEFAULT_LANGUAGE_ORDER','vn');
	/* default min: quantity product input */
	define('_DEFAULT_MIN_QTY_PRODUCT_ORDER',0);
	/* default max: quantity product input */
	define('_DEFAULT_MAX_QTY_PRODUCT_ORDER',100);

	/* define - html style - badge status - bacground-color */
	$_ARR_STATUS_BADGE_ORDER = array(
		'pending' => '<span class="badge text-bg-pending">'.$LANG['pending'].'</span>',
		'confirmed' => '<span class="badge text-bg-confirmed">'.$LANG['confirmed'].'</span>',
		'packaged' => '<span class="badge text-bg-packaged">'.$LANG['packaged'].'</span>',
		'delivering' => '<span class="badge text-bg-delivering">'.$LANG['delivering'].'</span>',
		'delivered_successfully' => '<span class="badge text-bg-delivered_successfully">'.$LANG['delivered_successfully'].'</span>',
		'delivery_failed' => '<span class="badge text-bg-delivery_failed">'.$LANG['delivery_failed'].'</span>',
		'order_completed' => '<span class="badge text-bg-order_completed">'.$LANG['order_completed'].'</span>',
		'order_failed' => '<span class="badge text-bg-order_failed">'.$LANG['order_failed'].'</span>',
		'refund_order' => '<span class="badge text-bg-refund_order">'.$LANG['refund_order'].'</span>'
	);
	define('_ARR_STATUS_BADGE_ORDER',serialize($_ARR_STATUS_BADGE_ORDER));

	/* status */
	$_ARR_STATUS_ORDER = array(
		'pending' => $LANG['pending'],
		'confirmed' => $LANG['confirmed'],
		'packaged' => $LANG['packaged'],
		'delivering' => $LANG['delivering'],
		'delivered_successfully' => $LANG['delivered_successfully'],
		'delivery_failed' => $LANG['delivery_failed'],
		'order_completed' => $LANG['order_completed'],
		'order_failed' => $LANG['order_failed'],
		'refund_order' => $LANG['refund_order']
	);
	define('_ARR_STATUS_ORDER',serialize($_ARR_STATUS_ORDER));

	/* status: default */
	define('_ARR_STATUS_DEFAULT_ORDER','pending');

	/* status: payment */
	$_ARR_STATUS_PAYMENT_ORDER = array(
		'unpaid' => $LANG['unpaid'],
		'paid' => $LANG['paid'],
		'not_yet_refunded' => $LANG['not_yet_refunded'],
		'refunded' => $LANG['refunded']
	);
	define('_ARR_STATUS_PAYMENT_ORDER',serialize($_ARR_STATUS_PAYMENT_ORDER));

	/* status: payment default */
	define('_ARR_STATUS_PAYMENT_DEFAULT_ORDER','unpaid');

	/* status: delivery */
	$_ARR_STATUS_DELIVERY_ORDER = array(
		'not_yet_delivered'		=>	$LANG['not_yet_delivered'],
		'packing_up_goods'		=>	$LANG['packing_up_goods'],
		'delivering'			=>	$LANG['delivering'],
		'cancel_delivery'		=>	$LANG['cancel_delivery'],
		'delivery_success'		=>	$LANG['delivery_success'],
		'delivery_not_success'	=>	$LANG['delivery_not_success'],
		'redelivery'			=>	$LANG['redelivery'],
		'return_goods'			=>	$LANG['return_goods']
	);
	define("_ARR_STATUS_DELIVERY_ORDER",serialize($_ARR_STATUS_DELIVERY_ORDER));

	/* status: delivery default */
	define('_ARR_STATUS_DELIVERY_DEFAULT_ORDER','not_yet_delivered');
?>