<?php
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_DETAIL.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_BUYER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_BUYER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_BUYER.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_RECEIVER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_RECEIVER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_RECEIVER.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_NOTE)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_NOTE):die(_PHISICAL_PATH_ADMIN_CONTROLLER_ORDER_NOTE.' khong ton tai');

    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_MEMBER)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_MEMBER):die(_PHISICAL_PATH_ADMIN_CONTROLLER_MEMBER.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT):die(_PHISICAL_PATH_ADMIN_CONTROLLER_PRODUCT.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY):die(_PHISICAL_PATH_ADMIN_CONTROLLER_COMPANY.' khong ton tai');
    file_exists(_PATH_THUMB_CLASS)?include_once(_PATH_THUMB_CLASS):die(_PATH_THUMB_CLASS.' khong ton tai');
    file_exists(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE)?include_once(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE):die(_PHISICAL_PATH_ADMIN_CONTROLLER_TEMPLATE.' khong ton tai');
	/* get session dang nhap */
    // $webmt_level = $Session->get("webmt_level");
    $webmaster_fullname = $Session->get("webmt_fullname");
    $webmaster_ID = $Session->get("webmtId");
    $webmaster_username = $Session->get("username_admin");

    /* set - tieu de trang web */
    $page_title = $LANG['add-order'];

    $_method = new method();
	$_db  = new database();

    /* get submit form */
	$action = $_method->_Post('act_order','string');
	if ($action == 'add_order') {

		/*
			1. Insert don hang -> tblorder
			2. Insert chi tiet don hang -> tblorder_detail
			3. Update tong don hang: $total -> tblorder
			4. Insert thong tin nguoi mua -> tblorder_buyer
			5. Insert thong tin nguoi nhan hang -> tblorder_receiver
			6. Insert ghi chu nguoi quan tri -> tblorder_note
			7. Send mail cho nguoi mua
		 */
		$order_controller = new order_controller();
		$id = $_db->getMaxID($order_controller->getTable(),'ID');
		$time = strtotime("now");

        /**
            1. Insert don hang -> tblorder
        */
		$txt_orderdate = $_method->_Post('txt_orderdate','string');
		if (!$txt_orderdate) {
			$txt_orderdate = 'now';
		}
		$total = 0.00;

        $order_status = $_method->_Post('cbx_status','string');
        $delivery_method = $_method->_Post('cbx_deliverymethod','int');
        $delivery_status = $_method->_Post('cbx_status_delivery','string');
        $payment_method = $_method->_Post('cbx_paymentmethod','int');
        $payment_status = $_method->_Post('cbx_status_payment','string');

        $delivery_fee = $_method->_Post('txt_delivery_fee','string');
        $delivery_fee = (float)$_method->formatCurrencyToNumber($delivery_fee,_CURRENCY);

        $note = $_method->_Post('txt_note','html');
        $lang = $_method->_Post('txtlang','string');

        $data_form=array(
            'ID'=>$id,
        	'code'=>$time.'_'.$id,
        	'date'=>strtotime($txt_orderdate),
        	'total'=>$total,
        	't_status'=>$order_status,

        	'delivery_method'=>$delivery_method,
        	'delivery_status'=>$delivery_status,
        	'payment_method'=>$payment_method,
            'payment_status'=>$payment_status,
            'delivery_fee'=>$delivery_fee,
            'note'=>$note,
            'lang'=>$lang,

            "updated_date"=>$time,
            "updated_by"=>$webmaster_ID
        );
        // var_dump($data_form);
        $order_controller->setDataForm($data_form);
        $result = $order_controller->update($id);
        if ($result) {
            $alert_text = $LANG['save_successfully'];
            $orderID = $order_controller->getID();

            /**
                2. Insert chi tiet don hang -> tblorder_detail
            */
            $order_detail_controller = new order_detail_controller();
            $quantity_product = method::_Post('quantity_product', 'int');
            if($quantity_product && $quantity_product > 0){
                for ($i=1; $i <= $quantity_product; $i++) {
                    $id_product_price = method::_Post('id_product_price_'.$i, 'int');
                    $product_q = method::_Post('product_q_'.$i, 'int');
                    if ($id_product_price > 0 && $product_q > 0 && $product_q <= _DEFAULT_MAX_QTY_PRODUCT_ORDER) {
                        $product_price_detail = $_db->getMultiFields(TBLPRODUCT_PRICE,array('ID','product_id','color_id','size_id','title','price','reduced_price'),'ID',$id_product_price,' and `t_status`=1 ');
                        if($product_price_detail){
                            $id_product = $product_price_detail['product_id'];
                            // $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title','price','reduced_price'),'ID',$product_price_detail['product_id'],' and `t_status`=1 ');
                            $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title'),'ID',$id_product,' and `t_status`=1 ');
                            if ($product_detail) {
                                $exit_p = $_db->getField($order_detail_controller->getTable(),'ID','product_price_id',$id_product_price,' and order_id = '.$orderID);

                                $od_product_name = $product_detail['title'];
                                if($product_price_detail['title'] != '') $od_product_name.= ', '.$product_price_detail['title'];

                                if ($exit_p) {
                                    /* da ton tai san pham nay trong don hang */
                                    $quantity_old = $_db->getField($order_detail_controller->getTable(),'quantity','ID',$exit_p);
                                    $data_product = array(
                                        'quantity'=>($product_q + $quantity_old)
                                    );
                                    // var_dump($data_product);
                                    $order_detail_controller->setDataForm($data_product);
                                    $errsql_product = $order_detail_controller->update($exit_p,'update');
                                    if (!$errsql_product) {
                                        $alert_text .= $LANG['error_order_product_update'].$od_product_name;
                                    }
                                }else{
                                    $orderDetailId = $_db->getMaxID($order_detail_controller->getTable(),'ID');

                                    $color = $size = '';
                                    if($product_price_detail['color_id'] > 0) $color = $_db->getField(TBLCOLOR,'title_'.$lang,'ID',$product_price_detail['color_id']);
                                    if($product_price_detail['size_id'] > 0) $size = $_db->getField(TBLSIZE,'title_'.$lang,'ID',$product_price_detail['size_id']);

                                    $data_product = array(
                                        'ID'=>$orderDetailId,
                                        'order_id'=>$orderID,
                                        'product_id'=>$id_product,
                                        'product_price_id'=>$id_product_price,
                                        'color'=>$color,
                                        'size'=>$size,
                                        'product_name'=>$od_product_name,
                                        'price'=>$product_price_detail['price'],
                                        'reduced_price'=>$product_price_detail['reduced_price'],
                                        'quantity'=>$product_q
                                    );
                                    // var_dump($data_product);
                                    $order_detail_controller->setDataForm($data_product);
                                    $errsql_product = $order_detail_controller->update($orderDetailId);
                                    if (!$errsql_product) {
                                        $alert_text .= $LANG['error_order_product'].$od_product_name;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            /**
                3. Update tong don hang: $total -> tblorder
            */
            $order_detail_controller->setSqlFilter('');
            $total = $order_detail_controller->getTotal($orderID);
            $order_controller->setDataForm(array('total'=>$total));
            $errsql_total = $order_controller->update($orderID,'update');
            if (!$errsql_total) {
                $alert_text .= $LANG['error_order_total'];
            }

            /**
                4. Insert thong tin nguoi mua
            */
            $buyer_name = method::_Post('txt_buyer_fullname', 'string');
            $buyer_phone = method::_Post('txt_buyer_phone', 'string');
            $buyer_email = method::_Post('txt_buyer_email', 'string');
            $buyer_address = method::_Post('txt_buyer_address', 'string');

            $order_buyer_controller = new order_buyer_controller();
            $orderBuyerId = $_db->getMaxID($order_buyer_controller->getTable(),'ID');
            $data_buyer = array(
                'ID' => $orderBuyerId,
                'order_id' => $orderID,
                'member_id' => 0,
                'fullname' => $buyer_name,
                'phone' => $buyer_phone,
                'email' => $buyer_email,
                'address' => $buyer_address,
            );
            // var_dump($data_buyer);
            $order_buyer_controller->setDataForm($data_buyer);
            $errsql_buyer = $order_buyer_controller->update($orderBuyerId);
            if (!$errsql_buyer) {
                $alert_text .= $LANG['error_order_buyer'];
            }

            /**
                5. Insert thong tin nguoi nhan hang
            */
            $receiver_name = method::_Post('txt_receiver_fullname', 'string');
            $receiver_phone = method::_Post('txt_receiver_phone', 'string');
            $receiver_email = method::_Post('txt_receiver_email', 'string');
            $receiver_address = method::_Post('txt_receiver_address', 'string');

            $order_receiver_controller = new order_receiver_controller();
            $orderReceiverId = $_db->getMaxID($order_receiver_controller->getTable(),'ID');
            $data_receiver = array(
                'ID' => $orderReceiverId,
                'order_id' => $orderID,
                'member_id' => 0,
                'fullname' => $receiver_name,
                'phone' => $receiver_phone,
                'email' => $receiver_email,
                'address' => $receiver_address,
            );
            // var_dump($data_receiver);
            $order_receiver_controller->setDataForm($data_receiver);
            $errsql_receiver = $order_receiver_controller->update($orderReceiverId);
            if (!$errsql_buyer) {
                $alert_text .= $LANG['error_order_receiver'];
            }

            /**
                6. Insert ghi chu nguoi quan tri -> tblorder_note
            */
            $cbx_sendmail = method::_Post('cbx_sendmail', 'int');
            if ($cbx_sendmail > 0) {
                $tplname = $_db->getField(TBLTEMPLATE,'name','ID',$cbx_sendmail);
                $note_update = '<div>'.date('d/m/Y | H:i',$time).' - <strong>'.$webmaster_username.'</strong> : <em>('.$cbx_sendmail.') '.$tplname.'</em> - '.$LANG['note_order_default'].'</div>';
                $note_update = htmlspecialchars($note_update,ENT_QUOTES);
            }else{
                $note_update = '<div>'.date('d/m/Y | H:i',$time).' - <strong>'.$webmaster_username.'</strong> : '.$LANG['note_order_default'].'</div>';
                $note_update = htmlspecialchars($note_update,ENT_QUOTES);
            }

            $order_note_controller = new order_note_controller();
            $orderNoteId = $_db->getMaxID($order_note_controller->getTable(),'ID');
            $data_note = array(
                'ID' => $orderNoteId,
                'order_id' => $orderID,
                'note' => $note_update
            );
            // var_dump($data_note);
            $order_note_controller->setDataForm($data_note);
            $errsql_note = $order_note_controller->update($orderNoteId);
            if (!$errsql_note) {
                $alert_text .= $LANG['error_order_note'];
            }

            /**
                7. Send mail cho nguoi mua
            */
            $cbx_sendmail = method::_Post('cbx_sendmail', 'int');
            if ($cbx_sendmail > 0) {
                $buyer_email = $_db->getField($order_buyer_controller->getTable(),'email','order_id',$orderID);
                if ($buyer_email) {
                    $error_sendmail = $order_controller->sendmail_info($orderID,$cbx_sendmail);
                    if (!$error_sendmail) $alert_text .= $LANG['sending_email_failed'];
                }else{
                    $alert_text .= $LANG['buyer_email_is_not_exit'];
                }
            }
            

            $_method->alert($alert_text,_LINK_ORDER_DETAIL.'&id='.$id);
            die();
        }else{
            $_method->alert($LANG['error_try_again'],$_method->curPageURL());
            die();
        }
    }

    $buyer_fullname = $buyer_phone = $buyer_email = $buyer_address = '';
    $receiver_fullname = $receiver_phone = $receiver_email = $receiver_address = '';

    $txt_orderdate = date('d-m-Y H:i:s',strtotime("now"));
    $txt_note = '';
    $txt_delivery_fee = 0;

	$arrProduct = $_db->getArrFieldID("
        SELECT tpattr_c.ID priceID,CONCAT_WS(' - ',tpattr_c.product_code,tpattr_c.product_name,tpattr_c.product_name_option,tpattr_c.color_title,ts.title_vn,tpattr_c.price,tpattr_c.reduced_price) nameProduct
        FROM    (SELECT tpattr.ID,tpattr.product_id,tpattr.product_code,tpattr.product_name,tpattr.product_name_option,tpattr.price,tpattr.reduced_price,tpattr.color_id,tpattr.size_id,tc.title_vn color_title
                FROM    (SELECT tpp.ID, tpp.product_id,tp.code product_code,tp.title product_name,tpp.title product_name_option,tpp.price,tpp.reduced_price,tpp.color_id,tpp.size_id 
                        FROM `tblproduct_price` tpp, tblproduct tp 
                        WHERE tpp.product_id = tp.ID
                        ORDER BY product_id ASC) tpattr
                LEFT JOIN tblcolor tc 
                ON tpattr.color_id = tc.ID) tpattr_c
        LEFT JOIN tblsize ts 
        ON tpattr_c.size_id = ts.ID",array('priceID','nameProduct'));
    $cbxProduct = $_method->combo_arr($arrProduct,0);

    $arrPaymentmethod = $_db->getArrFieldID("select ID, title_vn from ".TBLPAYMENTMETHOD." where 1 and `t_status`=1 order by `title_vn` ASC ",array('ID','title_vn'));
    $cbxPaymentmethod = $_method->combo_arr($arrPaymentmethod,0);

    $arrDeliverymethod = $_db->getArrFieldID("select ID, title_vn from ".TBLDELIVERYMETHOD." where 1 and `t_status`=1 order by `title_vn` ASC ",array('ID','title_vn'));
    $cbxDeliverymethod = $_method->combo_arr($arrDeliverymethod,0);

    $cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),_DEFAULT_LANGUAGE_ORDER);

    $cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS_ORDER),_ARR_STATUS_DEFAULT_ORDER);
    $cbxStatus_Payment = $_method->combo_arr(unserialize(_ARR_STATUS_PAYMENT_ORDER),_ARR_STATUS_PAYMENT_DEFAULT_ORDER);
    $cbxStatus_Delivery = $_method->combo_arr(unserialize(_ARR_STATUS_DELIVERY_ORDER),_ARR_STATUS_DELIVERY_DEFAULT_ORDER);

    $txtnote_update = $LANG['note_order_default'];
    $arrTemplate = $_db->getArrFieldID("select ID, name from ".TBLTEMPLATE." where 1 and mask='"._MASK_SENDEMAIL."' and lang='vn' and `t_status`=1 order by `ID` ASC ",array('ID','name'));
    $cbxTemplate = $_method->combo_arr($arrTemplate,0);

    $created_by = $updated_by = $webmaster_fullname;
    $created_date = $updated_date = date('d - m - Y | H:i:s',strtotime("now"));

    /* default input hidden: quantity_product */
    $_stt_begin = 1;

?>