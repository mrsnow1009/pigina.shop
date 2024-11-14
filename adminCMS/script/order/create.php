<script type="text/javascript" src="assets/plugin/select2/select2.min.js"></script>
<script src="assets/plugin/daterangepicker/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function () {

		$(".cbx_select2").select2();

		$('.datepicker_created').datepicker({
		   format: 'dd-mm-yyyy'
		});

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
				txt_orderdate: "required",
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
				txt_orderdate: "<?php echo $LANG['this_field_is_required']; ?>",
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

	function setAs(to,from){
		$('#txt_'+from+'_fullname').val($('#txt_'+to+'_fullname').val());
		$('#txt_'+from+'_phone').val($('#txt_'+to+'_phone').val());
		$('#txt_'+from+'_email').val($('#txt_'+to+'_email').val());
		$('#txt_'+from+'_address').val($('#txt_'+to+'_address').val());
	}

	function addRowProduct(){
		_stt_begin = _stt_begin + 1;
		var rowProduct = '<tr>'+
			'<td class="text-center">'+ _stt_begin + '</td>'+
			'<td>'+
				'<select id="id_product_price_'+ _stt_begin + '" name="id_product_price_'+ _stt_begin + '" class="form-control" required>'+
					'<option value=""><?php echo $LANG['choose'];?> <?php echo $LANG['product'];?></option>'+
				   	'<?php echo $cbxProduct;?>'+
				'</select>'+
			'</td>'+
			'<td class="text-center">'+
				'<input type="number" class="form-control text-center" id="product_q_'+ _stt_begin + '" name="product_q_'+ _stt_begin + '" min="<?php echo _DEFAULT_MIN_QTY_PRODUCT_ORDER;?>" max="<?php echo _DEFAULT_MAX_QTY_PRODUCT_ORDER;?>" required value="1">'+
			'</td>'+
		'</tr>';
		$("#quantity_product").val(_stt_begin);
		$("#product-list").append(rowProduct);
		$("#id_product_price_"+ _stt_begin).select2();
	}
</script>
