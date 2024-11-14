<?php

class order_controller {
	private $table = TBLORDER;
	private $table_detail = TBLORDER_DETAIL;
	private $table_buyer = TBLORDER_BUYER;
	private $table_receiver = TBLORDER_RECEIVER;
	private $table_note = TBLORDER_NOTE;
	private $table_template = TBLTEMPLATE;
	
	private $_id;
	private $_data_form = array();

	private $_start = 0;
	private $_limit = 0;

	private $_sql_sort = '';
	private $_sql_filter = '';
	private $_selectField = '
		ID,
		code,
		date,
		total,
		t_status,
		delivery_method,
		delivery_status,
		payment_method,
		payment_status,
		delivery_fee,
		note,
		updated_date,
		updated_by,
		t_index,
		lang
	';
	
	public function getTable(){
		return $this->table;
	}

	public function getID(){
		return $this->_id;
	}
	public function setID($id){
		$this->_id = $id;
	}

	public function getDataForm($data_form){
		return $this->_data_form;
	}
	public function setDataForm($data_form){
		$this->_data_form = $data_form;
	}

	public function setSelectField($selectField){
		$this->_selectField = $selectField;
	}
	public function setSqlFilter($sql_filter){
		$this->_sql_filter = $sql_filter;
	}
	public function setSqlSort($sql_sort){
		$this->_sql_sort = $sql_sort;
	}
	public function setLimit($limit){
		$this->_limit = $limit;
	}
	public function setStart($start){
		$this->_start = $start;
	}

	/* lay thong tin bai viet ID hoac sql_filter */
	public function getDetail(){
		$db = new database();
		$sql=' select '.$this->_selectField.' from '.$this->table.' where  ID>0 ';
		if($this->_id != '')
			$sql .= ' and ID='.$this->_id.' ';
		if($this->_sql_filter != '')
			$sql .= ' '.$this->_sql_filter.' ';

		$db->query($sql);
		if($db->num_rows() <= 0) return false;
		$db->next_record();
		return $this->format_std($db->record);
	}

	/* format thong tin tai khoan ve dang doi tuong */
	private function format_std($object = array()){
		$result = new stdClass();
		$result->ID = $object['ID'];

		isset($object['code']) ? $result->code = $object['code'] : $result->code = '';
		isset($object['date']) ? $result->date = $object['date'] : $result->date = '';
		isset($object['total']) ? $result->total = $object['total'] : $result->total = '';
		isset($object['t_status']) ? $result->t_status = $object['t_status'] : $result->t_status = '';
		isset($object['delivery_method']) ? $result->delivery_method = $object['delivery_method'] : $result->delivery_method = '';
		isset($object['delivery_status']) ? $result->delivery_status = $object['delivery_status'] : $result->delivery_status = '';
		isset($object['payment_method']) ? $result->payment_method = $object['payment_method'] : $result->payment_method = '';
		isset($object['payment_status']) ? $result->payment_status = $object['payment_status'] : $result->payment_status = '';
		isset($object['delivery_fee']) ? $result->delivery_fee = $object['delivery_fee'] : $result->delivery_fee = '';
		isset($object['note']) ? $result->note = $object['note'] : $result->note = '';
		isset($object['t_index']) ? $result->t_index = $object['t_index'] : $result->t_index = '';
		isset($object['lang']) ? $result->lang = $object['lang'] : $result->lang = '';
		isset($object['updated_date']) ? $result->updated_date = $object['updated_date'] : $result->updated_date = '';
		isset($object['updated_by']) ? $result->updated_by = $object['updated_by'] : $result->updated_by = '';

		return $result;
	}

	/* lay danh sach thong tin tai khoan */
	public function getList(){
		$db = new database();
		$sql=' select '.$this->_selectField.' from '.$this->table.' where 1 ';
		if($this->_sql_filter != '') $sql .= ' '.$this->_sql_filter.' ';
		if($this->_sql_sort != '') $sql .= ' '.$this->_sql_sort.' ';

		$db->query($sql);
		if($db->num_rows() < 1) return false;
		$result = array();
		while ($db->next_record()){
            $result[] = $this->format_std($db->record);
        }
		return $result;
	}

	/* them moi hoac cap nhat */
	public function update($id,$action='create'){
		$db = new database();
		
		if ($action == 'update') {
			$result = $db->updateTable($this->table,$this->_data_form,' ID='.$id.' ');
		}else{
			$result = $db->insertTable($this->table,$this->_data_form);
		}
		$this->setID($id);

		return $result;
	}
	
	public function getIndexSort($filter = ''){
		$db = new database();
		return $db->returnOrdinals($this->table,$filter);
	}

	/* count : record */
	public function count(){
	    $db= new database();
		$sql=" select COUNT(ID) as count_id from ".$this->table." where 1 ";
		if($this->_sql_filter!="") $sql .=$this->_sql_filter;
		// var_dump($sql);
		$db->query($sql);
		if($db->num_rows()<=0) return 0;
		$db->next_record();
		return $db->record['count_id'];
	}

	/* count : record */
	public function count_Table(){
	    $db= new database();
		$sql=" select COUNT(tb_order.ID) as count_id from ".$this->table." as tb_order, ".$this->table_buyer." as tb_buyer where 1 and tb_order.ID = tb_buyer.order_id ";
		if($this->_sql_filter!="") $sql .=$this->_sql_filter;
		// var_dump($sql);
		$db->query($sql);
		if($db->num_rows()<=0) return 0;
		$db->next_record();
		return $db->record['count_id'];
	}

	/* list : datatable */
	function getList_Table(){
	    $db= new database();
		$sql="
			select tb_order.ID, tb_order.date, tb_order.total, tb_order.delivery_fee, tb_order.code, tb_order.t_status, tb_order.t_index, tb_buyer.fullname, tb_buyer.phone, tb_buyer.email 
			from ".$this->table." as tb_order, ".$this->table_buyer." as tb_buyer
		 	where 1 
		 	and tb_order.ID = tb_buyer.order_id";

		if($this->_sql_filter!="") $sql .= " ".$this->_sql_filter;
		$sql .= " ".$this->_sql_sort;
		if($this->_limit>0) $sql .=" limit ".$this->_start.",".$this->_limit;
		
		// var_dump($sql);
		$db->query($sql);
		if($db->num_rows()<=0) return false;

		$arrMembers = array();
		// $arr_key = explode(',', $this->_selectField);
		while($db->next_record()){
			$obj = new stdClass();

			// foreach ($arr_key as $value) {
			// 	$obj->{$value} = $db->record[$value];
			// }

			$obj->ID = $db->record['ID'];
			$obj->code = $db->record['code'];
			$obj->total = $db->record['total'];
			$obj->delivery_fee = $db->record['delivery_fee'];
			$obj->date = $db->record['date'];
			$obj->t_status = $db->record['t_status'];
			$obj->t_index = $db->record['t_index'];
			
			$obj->fullname = $db->record['fullname'];
			$obj->phone = $db->record['phone'];
			$obj->email = $db->record['email'];

			$arrMembers[] = $obj;
		}
		return $arrMembers;
	}
	
	function DeleteRecord($str_id){
		if($str_id=="") return false;
		$arrId=explode(",",$str_id);
		if(count($arrId)<0) return false;
		$db= new database();

		/* xoa record bang tblorder_detail */
		$result = $db->deleteRecord('delete from '.$this->table_detail.' where order_id in ('.implode(",",$arrId).')');
		/* xoa record bang tblorder_buyer */
		$result = $db->deleteRecord('delete from '.$this->table_buyer.' where order_id in ('.implode(",",$arrId).')');
		/* xoa record bang tblorder_receiver */
		$result = $db->deleteRecord('delete from '.$this->table_receiver.' where order_id in ('.implode(",",$arrId).')');
		/* xoa record bang tblorder_note */
		$result = $db->deleteRecord('delete from '.$this->table_note.' where order_id in ('.implode(",",$arrId).')');
		
		/* xoa record bang tblorder */
		$result = $db->deleteRecord('delete from '.$this->table.' where ID in ('.implode(",",$arrId).')');
		return $result;	
	}

	function sendmail_info($id,$template_id){
		if (!$template_id) return false;
		/*
            1. Thong tin don hang
            2. Lay template gui email
            3. Thong tin cong ty
            4. Thong tin nguoi mua
            5. Thong tin nguoi nhan hang
            6. Thong tin san pham trong don hang
            7. Lay mang thay the cac thanh phan trong email
            8. Gui email
         */
		$db= new database();
		$_method = new method();

        /**
            1. Thong tin don hang
        */
        $this->setID($id);
        $order_detail = $this->getDetail();

        /**
            2. Lay template gui email
        */
		$template_controller = new template_controller();
        $checkExistTemplate = $db->getField($this->table_template,'ID','ID',$template_id,' and lang="'.$order_detail->lang.'" ');
        if (!$checkExistTemplate) return false;
        $template_controller->setID($template_id);
        $template_detail = $template_controller->getDetail();
        if (!$template_detail) return false;

        /**
            3. Thong tin cong ty
        */
        $company_id = $db->getField(TBLCOMPANY,'ID','lang',$order_detail->lang,' and t_status = 1 ');
        if (!$company_id) return false;
        $company_controller = new company_controller();
        $company_controller->setID($company_id);
        $company_controller->setSelectField(' ID, name, address, phone, email, fax, hotline, website, brand, logo, logo_favicon, facebook, twitter, youtube, instagram, linkedin, pinterest ');
        $company_detail = $company_controller->getDetail();
        if (!$company_detail) return false;

        /**
            4. Thong tin nguoi mua
        */
        $buyer_id = $db->getField($this->table_buyer,'ID','order_id',$id);
        $order_buyer_controller = new order_buyer_controller();
        $order_buyer_controller->setID($buyer_id);
        $buyer_detail = $order_buyer_controller->getDetail();
        if (!$buyer_detail) return false;

        /**
            5. Thong tin nguoi nhan hang
        */
        $receiver_id = $db->getField($this->table_receiver,'ID','order_id',$id);
        $order_receiver_controller = new order_receiver_controller();
        $order_receiver_controller->setID($receiver_id);
        $receiver_detail = $order_receiver_controller->getDetail();
        if (!$receiver_detail) return false;

        /**
            6. Thong tin don hang
        */
        $order_detail_controller = new order_detail_controller();
        $order_detail_controller->setSqlFilter(' and order_id='.$id);
        $order_detail_controller->setSqlSort(' order by ID asc ');
        $list_product = $order_detail_controller->getList();

        /**
            7. Lay mang thay the cac thanh phan trong email
        */
    	$arrayReplace = $this->convertArrayReplace($order_detail,$buyer_detail,$receiver_detail,$list_product,$company_detail);

        /**
            8. Gui email
            sendMail($emailTO, $Subject, $body,$path_attachement="",$emailREPLY='minhnhat@redsun.vn',$name_from=_SERVER_NAME,$email_from='developer@redsun.vn')
        */
        $result = $_method->sendMail($buyer_detail->email, strtr($template_detail->title, $arrayReplace), strtr(htmlspecialchars_decode(htmlspecialchars_decode($template_detail->content)),$arrayReplace),'','minhnhat@redsun.vn',$company_detail->brand);	

        return $result;
	}

	function convertArrayReplace($order_detail,$buyer_detail,$receiver_detail,$list_product,$company_detail){
		$_db = new database();
		$thumb = new thumb();
		$_method = new method();

		/* $buyer_detail: Thong tin nguoi mua */
        /* $receiver_detail: Thong tin nguoi nhan */
        /* $company_detail: Thong tin cong ty */

		/* 
            $orderStatus: Trang thai don hang
            $deliveryMethod: Phuong thuc giao hang
            $deliveryStatus: Trang thai giao hang
            $paymentMethod: Phuong thuc thanh toan
            $paymentStatus: Trang thai thanh toan
         */
        $_ARR_STATUS_ORDER = unserialize(_ARR_STATUS_ORDER);
        $_ARR_STATUS_PAYMENT_ORDER = unserialize(_ARR_STATUS_PAYMENT_ORDER);
        $_ARR_STATUS_DELIVERY_ORDER = unserialize(_ARR_STATUS_DELIVERY_ORDER);

        $orderStatus = $_ARR_STATUS_ORDER[$order_detail->t_status];
        $deliveryMethod = $_db->getField(TBLDELIVERYMETHOD,'title_'.strtolower($order_detail->lang),'ID',$order_detail->delivery_method);
        $deliveryStatus = $_ARR_STATUS_DELIVERY_ORDER[$order_detail->delivery_status];
        $paymentMethod = $_db->getField(TBLPAYMENTMETHOD,'title_'.strtolower($order_detail->lang),'ID',$order_detail->payment_method);
        $paymentStatus = $_ARR_STATUS_PAYMENT_ORDER[$order_detail->payment_status];

        /*
            $orderCode: Ma don hang
            $orderDate: Ngay dat hang
            $deliveryFee: Phi giao hang
            $orderNote: Ghi chu don hang
         */
        $deliveryFee = $_method->formatNumberToCurrency($order_detail->delivery_fee,_CURRENCY);
        $orderNote = $order_detail->note;
        $orderCode = $order_detail->code;
        $orderDate = date('d-m-Y | H:i:s', $order_detail->date);

        /*
            $totalOrder: Tong don hang
            $totalAmount: Tong thanh tien
            $totalQty: Tong so luong
         */
        $order_detail_controller = new order_detail_controller();
        $order_detail_controller->setSqlFilter('');
        $totalAmount = $order_detail_controller->getTotal($order_detail->ID);
        $totalOrder = $_method->formatNumberToCurrency(($totalAmount + $order_detail->delivery_fee),_CURRENCY);
        $totalAmount = $_method->formatNumberToCurrency($totalAmount,_CURRENCY);
        $totalQty = $order_detail_controller->getTotalbyField($order_detail->ID,'quantity');

        /*
            $productList: Danh sach san pham
         */
        $productList = '';
        $count = count($list_product);
        $lang = $order_detail->lang;
        for ($i=0; $i < $count; $i++) {
        	$productItem = $list_product[$i];
        	$product_attr = '';
            if ($productItem->color != '') $product_attr .= $productItem->color;
            if ($productItem->size != ''){
            	if ($product_attr != '') $product_attr .= ', '.$productItem->size;	
            	else $product_attr .= $productItem->size;
            }
            if ($product_attr != '') $product_attr = '<tr>
	            	<td>'.$GLOBALS['LANG']['option_'.$lang].'</td>
	            	<td align="right">'.$product_attr.'</td>
            	</tr>';

            $product_price = '';
            if($productItem->reduced_price != $productItem->price){
            	$product_price = '<span style="color:#808080;text-decoration:line-through">'.$_method->formatNumberToCurrency(($productItem->price),_CURRENCY).'</span> &nbsp; '.$_method->formatNumberToCurrency(($productItem->reduced_price),_CURRENCY);
            }else{
            	$product_price = $_method->formatNumberToCurrency(($productItem->reduced_price),_CURRENCY);
            }

        	$productList .= '
        		<div style="border: 1px solid #dddddd;margin-bottom: 15px;">
					<table width="100%" cellpadding="8">
				      	<tbody>
				      		<tr>
				            	<td><b>'.$GLOBALS['LANG']['product_'.$lang].'  #'.($i + 1).':</b></td>
				            	<td align="right">'.$productItem->product_name.'</td>
				          	</tr>
				          	'.$product_attr.'
				          	<tr>
				            	<td>'.$GLOBALS['LANG']['price_'.$lang].':</td>
				            	<td align="right">'.$product_price.'</td>
				          	</tr>
				          	<tr>
				            	<td>'.$GLOBALS['LANG']['quantity_'.$lang].':</td>
				            	<td align="right">'.$productItem->quantity.'</td>
				          	</tr>
				          	<tr>
				            	<td>'.$GLOBALS['LANG']['total_amount_'.$lang].':</td>
				            	<td align="right"><b>'.$_method->formatNumberToCurrency(($productItem->reduced_price * $productItem->quantity),_CURRENCY).'</b></td>
				          	</tr>
				        </tbody>
					</table>
				</div>';
        }

        /*
            convert
         */
       	return array(
            '[ORDER_CODE]' => $orderCode,
            '[ORDER_DATE]' => $orderDate,
            '[ORDER_NOTE]' => $orderNote,

            '[ORDER_STATUS]' => $orderStatus,
            '[ORDER_DELIVERY_METHOD]' => $deliveryMethod,
            '[ORDER_DELIVERY_STATUS]' => $deliveryStatus,
            '[ORDER_PAYMENT_METHOD]' => $paymentMethod,
            '[ORDER_PAYMENT_STATUS]' => $paymentStatus,

            '[DELIVERY_FEE]' => $deliveryFee,
            '[TOTAL_QUANTITY]' => $totalQty,
            '[TOTAL_AMOUNT]' => $totalAmount,
            '[TOTAL_ORDER]' => $totalOrder,

            '[PRODUCT_LIST]' => $productList,

            '[BUYER_NAME]' => $buyer_detail->fullname,
            '[BUYER_PHONE]' => $buyer_detail->phone,
            '[BUYER_EMAIL]' => $buyer_detail->email,
            '[BUYER_ADDRESS]' => $buyer_detail->address,

            '[RECEIVER_NAME]' => $receiver_detail->fullname,
            '[RECEIVER_PHONE]' => $receiver_detail->phone,
            '[RECEIVER_EMAIL]' => $receiver_detail->email,
            '[RECEIVER_ADDRESS]' => $receiver_detail->address,

            '[COMPANY_NAME]' => $company_detail->name,
            '[COMPANY_ADDRESS]' => $company_detail->address,
            '[COMPANY_PHONE]' => $company_detail->phone,
            '[COMPANY_HOTLINE]' => $company_detail->hotline,
            '[COMPANY_EMAIL]' => $company_detail->email,
            '[COMPANY_FAX]' => $company_detail->fax,
            '[COMPANY_WEBSITE]' => $company_detail->website,
            '[COMPANY_LOGO]' => $thumb->showImg($company_detail->logo,array(),array('alt'=>'','style'=>'height:60px;')),
            '[COMPANY_LOGO_FAVICON]' => $thumb->showImg($company_detail->logo_favicon,array(),array('alt'=>'','style'=>'height:60px;')),
            '[COMPANY_BRANDNAME]' => $company_detail->brand,
            '[COMPANY_FACEBOOK]' => $company_detail->facebook,
            '[COMPANY_TWITTER]' => $company_detail->twitter,
            '[COMPANY_YOUTUBE]' => $company_detail->youtube,
            '[COMPANY_INSTAGRAM]' => $company_detail->instagram,
            '[COMPANY_LINKEDIN]' => $company_detail->linkedin,
            '[COMPANY_PINTEREST]' => $company_detail->pinterest,


        );



	}

}
	
?>