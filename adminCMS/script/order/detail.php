<script type="text/javascript" src="assets/plugin/select2/select2.min.js"></script>
<script>
	$(document).ready(function () {
		$('.cbx_select2').select2();

		$( "#form_updateOrder" ).validate( {
			rules: {
				txt_buyer_fullname: "required",
				txt_buyer_phone: "required",
				txt_buyer_email: {
					email: true
				},
				txt_receiver_fullname: "required",
				txt_receiver_phone: "required",
				txt_receiver_email: {
					email: true
				},
				txt_receiver_address: "required",
				txtlang: "required",
				quantity_product: "required",
				txt_delivery_fee: "required",
				cbx_status: "required",
				cbx_paymentmethod: "required",
				cbx_status_payment: "required",
				cbx_deliverymethod: "required",
				cbx_status_delivery: "required",
			},
			messages: {
				txt_buyer_fullname: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_buyer_phone: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_buyer_email: {
					email: "<?php echo $LANG['email_invalid']; ?>"
				},
				txt_receiver_fullname: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_receiver_phone: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_receiver_email: {
					email: "<?php echo $LANG['email_invalid']; ?>"
				},
				txt_receiver_address: "<?php echo $LANG['this_field_is_required']; ?>",
				txtlang: "<?php echo $LANG['this_field_is_required']; ?>",
				quantity_product: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_delivery_fee: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_paymentmethod: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status_payment: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_deliverymethod: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status_delivery: "<?php echo $LANG['this_field_is_required']; ?>",
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				error.addClass( "help-block" );
				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
			},
		} );
	});

	/**
	var timer;
	$('input.qty-product').bind('keyup change', function(e) {
		// $('#btn_search_2').addClass('show-loading');
		// $('#close_search').addClass('hidden-close-search');

		var _qty_tag = $(this);
		var _qty = _qty_tag.val();
		var _qty_box = _qty_tag.parent();
		var _tid = _qty_tag.attr('data-id');
		clearTimeout(timer);
	    timer = setTimeout(function() {
			_qty_box.addClass('loading');
			if (_qty === '') {
				// $('#btn_search_2').removeClass('show-loading');
				// $('#close_search').removeClass('hidden-close-search');
				// $('#search-result-2').addClass('hidden').html('');
				_qty = 1;
				_qty_tag.val(_qty);
			}
			$.ajax({
			  	'url': '<?php //echo _ROOT_PATH_ADMIN_AJAX;?>',
			  	data: 'q=update-quantity-product&tid='+_tid+'&quantity='+_qty,
			  	dataType: 'json'
			}).done(function(data) {
				console.log(data);
		  		// $('#search-result-2').removeClass('hidden').html(data.result_search);
				// $('#btn_search_2').removeClass('show-loading');
				// $('#close_search').removeClass('hidden-close-search');
			});
	    }, 500 );
	});
	 */

	function setAs(to,from){
		$('#txt_'+from+'_fullname').val($('#txt_'+to+'_fullname').val());
		$('#txt_'+from+'_phone').val($('#txt_'+to+'_phone').val());
		$('#txt_'+from+'_email').val($('#txt_'+to+'_email').val());
		$('#txt_'+from+'_address').val($('#txt_'+to+'_address').val());
	}

	function addRowProduct(){
		_stt_begin = _stt_begin + 1;
		var rowProduct = '<tr>'+
			'<td class="text-center">'+ (_stt_begin + _stt_product) + '</td>'+
			'<td colspan="4">'+
				'<select id="id_product_price_'+ _stt_begin + '" name="id_product_price_'+ _stt_begin + '" class="form-control">'+
					'<option value=""><?php echo $LANG['choose'];?> <?php echo $LANG['product'];?></option>'+
				   	'<?php echo $cbxProduct;?>'+
				'</select>'+
			'</td>'+
			'<td class="text-center">'+
				'<div class="qt-box d-inline-block">'+
					'<input type="number" class="form-control text-center qty-product" id="product_q_'+ _stt_begin + '" name="product_q_'+ _stt_begin + '" min="<?php echo _DEFAULT_MIN_QTY_PRODUCT_ORDER;?>" max="<?php echo _DEFAULT_MAX_QTY_PRODUCT_ORDER;?>" value="1">'+
                '</div>'+
			'</td>'+
			'<td class="text-center"></td>'+
		'</tr>';
		$('#quantity_product').val(_stt_begin);
		$('#product-list').append(rowProduct);
		$('#id_product_price_'+ _stt_begin).select2();


		$('#updateOrderProduct').removeClass('d-none');
		$('#total_quantity,#total_amount').html('.....');
	}

	function updateOrderProduct(){
		$('#act_order').val('update_order_product');
		$('#form_updateOrder').submit();
	}

	function removeProduct(e,idOrderDetail){
		if(confirm('<?php echo $LANG['delete_product'];?>') == true){
			e.classList.add("loading");
			e.classList.add("text-bg-warning");
			e.classList.remove("text-bg-danger");
			$.ajax({
				'url': '<?php echo _ROOT_PATH_ADMIN_AJAX;?>',
				data: 'q=remove-order-product&id='+idOrderDetail,
				dataType: 'json'
			}).done(function(data) {
				if(data.error === 1){
					alert('<?php echo $LANG['deleted_successfully']?> '+data.warning);
					window.location.href = '<?php echo $_method->curPageURL();?>';
				}else{
					alert('<?php echo $LANG['error_try_again']?> '+data.warning);
					e.classList.remove("loading");
					e.classList.remove("text-bg-warning");
					e.classList.add("text-bg-danger");
				}
			});
		}
	}

</script>