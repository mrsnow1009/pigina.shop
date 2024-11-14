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
    $page_title = $LANG['detail-order'];

    $_method = new method();
    $_db = new database();

    $id = $_method->_Get('id','int');

    /* Thong tin don hang */
    $order_controller = new order_controller();
    $order_controller->setID($id);
    $detail_order = $order_controller->getDetail();
    if (!$detail_order) {
        $_method->alert($LANG['page_does_not_exist'],_LINK_ORDER_LIST);
    }

    /* get submit form */
    $action = $_method->_Post('act_order','string');
	if ($action == 'update_order') {
        /*
            1. Insert don hang -> tblorder
            2. Insert chi tiet don hang -> tblorder_detail
            3. Update tong don hang: $total -> tblorder
            4. Insert thong tin nguoi mua -> tblorder_buyer
            5. Insert thong tin nguoi nhan hang -> tblorder_receiver
            6. Insert ghi chu nguoi quan tri -> tblorder_note
            7. Send mail cho nguoi mua
         */
        $time = strtotime("now");
        $orderID = $order_controller->getID();

        /**
            1. Insert don hang -> tblorder
        */
        $order_status = $_method->_Post('cbx_status','string');
        $delivery_method = $_method->_Post('cbx_deliverymethod','int');
        $delivery_status = $_method->_Post('cbx_status_delivery','string');
        $payment_method = $_method->_Post('cbx_paymentmethod','int');
        $payment_status = $_method->_Post('cbx_status_payment','string');

        $delivery_fee = $_method->_Post('txt_delivery_fee','string');
        $delivery_fee = (float)$_method->formatCurrencyToNumber($delivery_fee,_CURRENCY);

        $lang = $_method->_Post('txtlang','string');

        $data_form=array(
            't_status'=>$order_status,
            'delivery_method'=>$delivery_method,
            'delivery_status'=>$delivery_status,
            'payment_method'=>$payment_method,
            'payment_status'=>$payment_status,
            'delivery_fee'=>$delivery_fee,
            'lang'=>$lang,

            "updated_date"=>$time,
            "updated_by"=>$webmaster_ID
        );
        $order_controller->setDataForm($data_form);
        $result = $order_controller->update($orderID,'update');
        if ($result) {
            $alert_text = $LANG['save_successfully'];

            /**
                2. Insert chi tiet don hang -> tblorder_detail
            */
            $order_detail_controller = new order_detail_controller();
            $quantity_product = method::_Post('quantity_product', 'int');
            /*
            if($quantity_product && $quantity_product > 0){
                $arrID_detail_old = $_db->getMultiRowsOnlyOneField($order_detail_controller->getTable(),'ID',' and order_id = '.$orderID);
                $arrID_detail_old_t = implode(',', $arrID_detail_old);

                for ($i=1; $i <= $quantity_product; $i++) { 
                    $id_product_price = method::_Post('id_product_price_'.$i, 'int');
                    $product_q = method::_Post('product_q_'.$i, 'int');
                    if ($id_product_price > 0 && $product_q > 0 && $product_q <= _DEFAULT_MAX_QTY_PRODUCT_ORDER) {
                        $product_price_detail = $_db->getMultiFields(TBLPRODUCT_PRICE,array('ID','product_id','color_id','size_id','title','price','reduced_price'),'ID',$id_product_price,' and `t_status`=1 ');
                        if ($product_price_detail) {
                            $id_product = $product_price_detail['product_id'];
                            // $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title','price','reduced_price'),'ID',$id_product,' and `t_status`=1 ');
                            $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title'),'ID',$id_product,' and `t_status`=1 ');
                            if ($product_detail) {
                                $exit_p = $_db->getField($order_detail_controller->getTable(),'ID','product_id',$id_product,' and order_id = '.$orderID.' and ID not in ('.$arrID_detail_old_t.') ');
                                if ($exit_p) {
                                    $quantity_old = $_db->getField($order_detail_controller->getTable(),'quantity','ID',$exit_p);
                                    $data_product = array(
                                        'quantity'=>($product_q + $quantity_old)
                                    );
                                    // var_dump($data_product);
                                    $order_detail_controller->setDataForm($data_product);
                                    $errsql_product = $order_detail_controller->update($exit_p,'update');
                                    if (!$errsql_product) {
                                        $alert_text .= $LANG['error_order_product_update'].$product_detail['title'];
                                    }
                                }else{
                                    $orderDetailId = $_db->getMaxID($order_detail_controller->getTable(),'ID');
                                    $data_product = array(
                                        'ID'=>$orderDetailId,
                                        'order_id'=>$orderID,
                                        'product_id'=>$product_detail['ID'],
                                        'product_name'=>$product_detail['title'],
                                        'price'=>$product_detail['price'],
                                        'reduced_price'=>$product_detail['reduced_price'],
                                        'quantity'=>$product_q
                                    );
                                    // var_dump($data_product);
                                    $order_detail_controller->setDataForm($data_product);
                                    $errsql_product = $order_detail_controller->update($orderDetailId);
                                    if (!$errsql_product) {
                                        $alert_text .= $LANG['error_order_product'].$product_detail['title'];
                                    }
                                }
                            }
                        }
                    }
                }
            }
            */
            if($quantity_product && $quantity_product > 0){
                $arrID_detail_old = $_db->getMultiRowsOnlyOneField($order_detail_controller->getTable(),'ID',' and order_id = '.$orderID);
                $arrID_detail_old_t = implode(',', $arrID_detail_old);

                for ($i=1; $i <= $quantity_product; $i++) { 
                    $id_product_price = method::_Post('id_product_price_'.$i, 'int');
                    $product_q = method::_Post('product_q_'.$i, 'int');
                    if ($id_product_price > 0 && $product_q > 0 && $product_q <= _DEFAULT_MAX_QTY_PRODUCT_ORDER) {
                        $product_price_detail = $_db->getMultiFields(TBLPRODUCT_PRICE,array('ID','product_id','color_id','size_id','title','price','reduced_price'),'ID',$id_product_price,' and `t_status`=1 ');
                        if($product_price_detail){
                            $id_product = $product_price_detail['product_id'];
                            // $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title','price','reduced_price'),'ID',$id_product,' and `t_status`=1 ');
                            $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title'),'ID',$id_product,' and `t_status`=1 ');
                            if ($product_detail) {
                                $exit_p = $_db->getField($order_detail_controller->getTable(),'ID','product_price_id',$id_product_price,' and order_id = '.$orderID.' and ID in ('.$arrID_detail_old_t.') ');

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
            $orderBuyerId = $_db->getField($order_buyer_controller->getTable(),'ID','order_id',$orderID);
            if (!$orderBuyerId) {
                /* add new */
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
                $order_buyer_controller->setDataForm($data_buyer);
                $errsql_buyer = $order_buyer_controller->update($orderBuyerId,'create');
            }else{
                /* update */
                $data_buyer = array(
                    'fullname' => $buyer_name,
                    'phone' => $buyer_phone,
                    'email' => $buyer_email,
                    'address' => $buyer_address,
                );
                $order_buyer_controller->setDataForm($data_buyer);
                $errsql_buyer = $order_buyer_controller->update($orderBuyerId,'update');
            }
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
            $orderReceiverId = $_db->getField($order_receiver_controller->getTable(),'ID','order_id',$orderID);
            if (!$orderReceiverId) {
                /* add new */
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
                $order_receiver_controller->setDataForm($data_receiver);
                $errsql_receiver = $order_receiver_controller->update($orderReceiverId,'create');
            }else{
                /* update */
                $data_receiver = array(
                    'fullname' => $receiver_name,
                    'phone' => $receiver_phone,
                    'email' => $receiver_email,
                    'address' => $receiver_address,
                );
                $order_receiver_controller->setDataForm($data_receiver);
                $errsql_receiver = $order_receiver_controller->update($orderReceiverId,'update');
            }
            if (!$errsql_receiver) {
                $alert_text .= $LANG['error_order_receiver'];
            }

            /**
                6. Insert ghi chu nguoi quan tri -> tblorder_note
            */
            $order_note_controller = new order_note_controller();
            $orderNoteId = $_db->getField($order_note_controller->getTable(),'ID','order_id',$orderID);
            if ($orderNoteId) {
                $orderNoteNote_old = $_db->getField($order_note_controller->getTable(),'note','ID',$orderNoteId);
                if (!$orderNoteNote_old) $orderNoteNote_old = '';

                $txtnote_update = method::_Post('txtnote_update', 'string');
                $cbx_sendmail = method::_Post('cbx_sendmail', 'int');
                if ($cbx_sendmail > 0) {
                    $tplname = $_db->getField(TBLTEMPLATE,'name','ID',$cbx_sendmail);
                    $note_update = '<div>'.date('d/m/Y | H:i',$time).' - <strong>'.$webmaster_username.'</strong> : <em>('.$cbx_sendmail.') '.$tplname.'</em> - '.$txtnote_update.'</div>';
                    $note_update = htmlspecialchars($note_update,ENT_QUOTES);
                }else{
                    $note_update = '<div>'.date('d/m/Y | H:i',$time).' - <strong>'.$webmaster_username.'</strong> : '.$txtnote_update.'</div>';
                    $note_update = htmlspecialchars($note_update,ENT_QUOTES);
                }

                $data_note = array(
                    'note' => $note_update.$orderNoteNote_old
                );
                $order_note_controller->setDataForm($data_note);
                $errsql_note = $order_note_controller->update($orderNoteId,'update');
                if (!$errsql_note) {
                    $alert_text .= $LANG['error_order_note'];
                }
            }else{
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
        
        /* get post */
		// $cbx_status = $_method->_Post('cbx_status','string');
		// $cbx_status_payment = $_method->_Post('cbx_status_payment','string');
  //       $data_form=array(
  //           't_status'=>$cbx_status,
  //           'payment_status'=>$cbx_status_payment,
  //           "updated_date"=>strtotime("now"),
  //           "updated_by"=>$Session->get("webmtId")
  //       );
  //       $order_controller->setDataForm($data_form);
  //       $result = $order_controller->update($id,'update');
  //       if ($result) {
  //   		$_method->alert($LANG['save_successfully'],$_method->curPageURL());
  //   		die();
  //   	}else{
  //   		$_method->alert($LANG['error_try_again'],$_method->curPageURL());
  //   	}
    }elseif($action == 'update_order_product'){
        /* 
            1. Lay tong don hang truoc do
            2. Insert chi tiet don hang -> tblorder_detail
            3. Update tong don hang: $total -> tblorder
         */
        $alert_text = $LANG['save_successfully'];

        /**
            1. Lay tong don hang truoc do
        */
        $orderID = $detail_order->ID;
        $u_order_total_old = (float)$detail_order->total;

        /**
            2. Insert chi tiet don hang -> tblorder_detail
        */
        $lang = $_method->_Post('txtlang','string');
        $order_detail_controller = new order_detail_controller();
        $quantity_product = $_method->_Post('quantity_product','int');
        if($quantity_product && $quantity_product > 0){
            $arrID_detail_old = $_db->getMultiRowsOnlyOneField($order_detail_controller->getTable(),'ID',' and order_id = '.$orderID);
            $arrID_detail_old_t = implode(',', $arrID_detail_old);

            for ($i=1; $i <= $quantity_product; $i++) { 
                $id_product_price = method::_Post('id_product_price_'.$i, 'int');
                $product_q = method::_Post('product_q_'.$i, 'int');
                if ($id_product_price > 0 && $product_q > 0 && $product_q <= _DEFAULT_MAX_QTY_PRODUCT_ORDER) {
                    $product_price_detail = $_db->getMultiFields(TBLPRODUCT_PRICE,array('ID','product_id','color_id','size_id','title','price','reduced_price'),'ID',$id_product_price,' and `t_status`=1 ');
                    if($product_price_detail){
                        $id_product = $product_price_detail['product_id'];
                        // $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title','price','reduced_price'),'ID',$id_product,' and `t_status`=1 ');
                        $product_detail = $_db->getMultiFields(TBLPRODUCT,array('ID','title'),'ID',$id_product,' and `t_status`=1 ');
                        if ($product_detail) {
                            $exit_p = $_db->getField($order_detail_controller->getTable(),'ID','product_price_id',$id_product_price,' and order_id = '.$orderID.' and ID in ('.$arrID_detail_old_t.') ');

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

        $_method->alert($alert_text,_LINK_ORDER_DETAIL.'&id='.$id);
        die();
    }

    /* Thong tin don hang */
    $order_code = $detail_order->code;
    $order_note = $detail_order->note;
    $order_date = date('d-m-Y | H:i:s',$detail_order->date);
    $txt_delivery_fee = $_method->formatNumberToCurrency($detail_order->delivery_fee,_CURRENCY);

    $cbxLanguage = $_method->combo_arr(unserialize(_ARR_LANG_TEXT),$detail_order->lang);
    if ($detail_order->t_status != _ARR_STATUS_DEFAULT_ORDER) {
        $cbxStatus = $_method->combo_arr_with_disabled(unserialize(_ARR_STATUS_ORDER),$detail_order->t_status,array(_ARR_STATUS_DEFAULT_ORDER));
        $show_addRowProduct = '';
        $show_updateOrderProduct = '';
    }else{
        $cbxStatus = $_method->combo_arr(unserialize(_ARR_STATUS_ORDER),$detail_order->t_status);
        $show_addRowProduct = '<a onclick="addRowProduct();" href="javascript:;" class="btn btn-warning"><i class="fa fa-plus"></i></a>';
        $show_updateOrderProduct = '<a onclick="updateOrderProduct();" id="updateOrderProduct" class="btn btn-success d-none" href="javascript:;">'.$LANG['update'].'</a>';
    }

    $arrPaymentmethod = $_db->getArrFieldID("select ID, title_vn from ".TBLPAYMENTMETHOD." where 1 and `t_status`=1 order by `title_vn` ASC ",array('ID','title_vn'));
    $cbxPaymentmethod = $_method->combo_arr($arrPaymentmethod,$detail_order->payment_method);

    $cbxStatus_Payment = $_method->combo_arr(unserialize(_ARR_STATUS_PAYMENT_ORDER),$detail_order->payment_status);

    $arrDeliverymethod = $_db->getArrFieldID("select ID, title_vn from ".TBLDELIVERYMETHOD." where 1 and `t_status`=1 order by `title_vn` DESC ",array('ID','title_vn'));
    $cbxDeliverymethod = $_method->combo_arr($arrDeliverymethod,$detail_order->delivery_method);

    $cbxStatus_Delivery = $_method->combo_arr(unserialize(_ARR_STATUS_DELIVERY_ORDER),$detail_order->delivery_status);

    $txtnote_update = '';
    $arrTemplate = $_db->getArrFieldID("select ID, name from ".TBLTEMPLATE." where 1 and mask='"._MASK_SENDEMAIL."' and lang='vn' and `t_status`=1 order by `ID` ASC ",array('ID','name'));
    $cbxTemplate = $_method->combo_arr($arrTemplate,0);

    $updated_by = '';
    $updated_date = date('d - m - Y | H:i:s',$detail_order->updated_date);
    if ($detail_order->updated_by != '') $updated_by = $_db->getField(TBLWEBMASTER,'fullname','ID',$detail_order->updated_by);

    /* Thong tin nguoi mua */
    // $member_controller = new member_controller();
    // $member_controller->setSqlFilter('and code ="'.$detail_order->customer_code.'"');
    // $detail_member = $member_controller->getDetail();
    // if ($detail_member) {
    //     $customer_name = $detail_member->name;
    //     $customer_phone = $detail_member->phone;
    //     $customer_email = $detail_member->email;
    //     $customer_address = $detail_member->address;
    // }else{
    //     $customer_name = '';
    //     $customer_phone = '';
    //     $customer_email = '';
    //     $customer_address = '';
    // }

    $order_buyer_controller = new order_buyer_controller();
    $order_buyer_controller->setSqlFilter('and order_id ='.$id);
    $detail_order_buyer = $order_buyer_controller->getDetail();
    if ($detail_order_buyer) {
        $buyer_fullname = $detail_order_buyer->fullname;
        $buyer_phone = $detail_order_buyer->phone;
        $buyer_email = $detail_order_buyer->email;
        $buyer_address = $detail_order_buyer->address;
    }else{
        $buyer_fullname = $LANG['unknow'];
        $buyer_phone = $LANG['unknow'];
        $buyer_email = $LANG['unknow'];
        $buyer_address = $LANG['unknow'];
    }
    
    /* Thong tin nguoi nhan */
    $order_receiver_controller = new order_receiver_controller();
    $order_receiver_controller->setSqlFilter('and order_id ='.$id);
    $detail_order_receiver = $order_receiver_controller->getDetail();
    if ($detail_order_receiver) {
        $receiver_fullname = $detail_order_receiver->fullname;
        $receiver_phone = $detail_order_receiver->phone;
        $receiver_email = $detail_order_receiver->email;
        $receiver_address = $detail_order_receiver->address;
    }else{
        $receiver_fullname = $LANG['unknow'];
        $receiver_phone = $LANG['unknow'];
        $receiver_email = $LANG['unknow'];
        $receiver_address = $LANG['unknow'];
    }
    
    /* San pham don hang */
    $order_detail_controller = new order_detail_controller();
    $order_detail_controller->setSqlFilter('and order_id ='.$id);
    $order_detail_controller->setSqlSort('order by ID asc');
    $list_order_product = $order_detail_controller->getList();
    
    $html_product = '';
    $total_amount = 0;
    $count_product = 0;
    if($list_order_product){
        $product_controller = new product_controller();
        $count_product = count($list_order_product);
        for ($p=0; $p < $count_product; $p++) { 
            /* lay link san pham - neu co */
            $product_controller->setID($list_order_product[$p]->product_id);
            $detail_product = $product_controller->getDetail();
            $edit_product = '';
            if ($detail_product) {
                $edit_product = '<a href="'._LINK_PRODUCT_CREATE.'&id='.$list_order_product[$p]->product_id.'" title="'.$LANG['view'].' '.$LANG['product'].'" target="_blank">'.$detail_product->code.'</a>';
            }

            if ($detail_order->t_status != _ARR_STATUS_DEFAULT_ORDER) {
                $remove_product = '';
            }else{
                $remove_product = '<a onclick="removeProduct(this,'.$list_order_product[$p]->ID.');" href="javascript:;" title="'.$LANG['delete'].'" class="badge text-bg-danger me-2"><span class="remove-loading"><i class="fa-light fa-trash-can"></i></span><span class="rotate-loading"><i class="fa-duotone fa-loader "></i></span></a>';
            }

            $product_attr = '';
            if ($list_order_product[$p]->color != '') $product_attr .= ' - '.$list_order_product[$p]->color;
            if ($list_order_product[$p]->size != '') $product_attr .= ' - '.$list_order_product[$p]->size;
            if ($product_attr != '') $product_attr = '<span class="font-monospace opacity-75">'.$product_attr.'</span>';

            $html_product .= '<tr>
                <td class="text-center">'.($p+1).'</td>
                <td class="text-center">'.$edit_product.'</td>
                <td>'.$remove_product.$list_order_product[$p]->product_name.$product_attr.'</td>
                <td class="text-center">'.$_method->formatNumberToCurrency($list_order_product[$p]->price,_CURRENCY).'</td>
                <td class="text-center">'.$_method->formatNumberToCurrency($list_order_product[$p]->reduced_price,_CURRENCY).'</td>
                <td class="text-center">'.$list_order_product[$p]->quantity.'</td>
                <td class="text-end">'.$_method->formatNumberToCurrency(($list_order_product[$p]->reduced_price * $list_order_product[$p]->quantity),_CURRENCY).'</td>
            </tr>';
            
            // $total_quantity += $list_order_product[$p]->quantity;
            // $total_amount += $total;
        }
    }

    /* tong don hang va tong so luong san pham trong don hang */
    $order_detail_controller->setSqlFilter('');
    $total = $order_detail_controller->getTotal($id);
    $total_amount = $_method->formatNumberToCurrency($total,_CURRENCY);
    $total_quantity = $order_detail_controller->getTotalbyField($id,'quantity');

    /* neu $total != total trong don hang thi cap nhat lai total cho don hang */
    if($total != $detail_order->total){
        $order_controller->setDataForm(array('total'=>(float)$total));
        $errsql_total = $order_controller->update($id,'update');
    }

    /* order note: admin */
    $order_note_admin = $_db->getField(TBLORDER_NOTE,'note','order_id',$id);
    if (!$order_note_admin) $order_note_admin = '';
    else $order_note_admin = htmlspecialchars_decode($order_note_admin);

    /* default input hidden: quantity_product */
    $_stt_begin = 0;

    /* product - list */
    // $arrProduct = $_db->getArrFieldID("select ID, CONCAT_WS(' - ',code,title,reduced_price) as nameProduct from ".TBLPRODUCT." where 1 and `t_status`=1 order by `title` ASC ",array('ID','nameProduct'));
    // $arrProduct = $_db->getArrFieldID("select product_price.ID as priceID, CONCAT_WS(' - ',product.code,product.title,product_price.title,product_price.reduced_price) as nameProduct from ".TBLPRODUCT." product, ".TBLPRODUCT_PRICE." product_price where 1 and product.ID = product_price.product_id and product_price.`t_status`=1 order by product.`title` ASC ",array('priceID','nameProduct'));
    // $cbxProduct = $_method->combo_arr($arrProduct,0);

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
    
?>