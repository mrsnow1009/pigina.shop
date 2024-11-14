<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_HOME; ?>" title=""><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_ORDER_LIST; ?>" title=""><?php echo $LANG['list']; ?> <?php echo $LANG['order']; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateOrder">
			<div class="row">
				<div class="col-md-6">
					<section class="box-section mb-3">
						<div class="border border-info border-opacity-25 rounded p-3">
							<h6 class="text-primary fw-bolder text-uppercase mb-3"><?php echo $LANG['customer']; ?></h6>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_buyer_fullname" class="col-form-label"><?php echo $LANG['fullname']; ?> <span class="text-danger">(*)</span></label>
								</div>
								<div class="col-xl-8">
									<input type="text" class="form-control" name="txt_buyer_fullname" id="txt_buyer_fullname" value="<?php echo $buyer_fullname; ?>" required="required" />
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_buyer_phone" class="col-form-label"><?php echo $LANG['phone']; ?> <span class="text-danger">(*)</span></label>
								</div>
								<div class="col-xl-8">
									<input type="text" class="form-control" name="txt_buyer_phone" id="txt_buyer_phone" value="<?php echo $buyer_phone; ?>" required="required" />
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_buyer_email" class="col-form-label"><?php echo $LANG['email']; ?></label>
								</div>
								<div class="col-xl-8">
									<input type="email" class="form-control" name="txt_buyer_email" id="txt_buyer_email" value="<?php echo $buyer_email; ?>" />
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_buyer_address" class="col-form-label"><?php echo $LANG['address']; ?></label>
								</div>
								<div class="col-xl-8">
									<input type="text" class="form-control" name="txt_buyer_address" id="txt_buyer_address" value="<?php echo $buyer_address; ?>"/>
								</div>
							</div>
							<div class="text-end">
								<button onclick="setAs('buyer','receiver')" type="button" class="btn btn-warning btn-sm"><?php echo $LANG['setasreceiver']; ?> <i class="fa-sharp fa-solid fa-arrow-right ms-2"></i></button>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-6">
					<section class="box-section mb-3">
						<div class="border border-info border-opacity-25 rounded p-3">
							<h6 class="text-primary fw-bolder text-uppercase mb-3"><?php echo $LANG['receiver']; ?></h6>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_receiver_fullname" class="col-form-label"><?php echo $LANG['fullname']; ?> <span class="text-danger">(*)</span></label>
								</div>
								<div class="col-xl-8">
									<input type="text" class="form-control" name="txt_receiver_fullname" id="txt_receiver_fullname" value="<?php echo $receiver_fullname; ?>" required="required" />
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_receiver_phone" class="col-form-label"><?php echo $LANG['phone']; ?> <span class="text-danger">(*)</span></label>
								</div>
								<div class="col-xl-8">
									<input type="text" class="form-control" name="txt_receiver_phone" id="txt_receiver_phone" value="<?php echo $receiver_phone; ?>" required="required" />
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_receiver_email" class="col-form-label"><?php echo $LANG['email']; ?></label>
								</div>
								<div class="col-xl-8">
									<input type="email" class="form-control" name="txt_receiver_email" id="txt_receiver_email" value="<?php echo $receiver_email; ?>" />
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-4">
									<label for="txt_receiver_address" class="col-form-label"><?php echo $LANG['address']; ?> <span class="text-danger">(*)</span></label>
								</div>
								<div class="col-xl-8">
									<input type="text" class="form-control" name="txt_receiver_address" id="txt_receiver_address" value="<?php echo $receiver_address; ?>" required="required" />
								</div>
							</div>
							<div class="text-start">
								<button onclick="setAs('receiver','buyer')" type="button" class="btn btn-warning btn-sm"><i class="fa-sharp fa-solid fa-arrow-left me-2"></i> <?php echo $LANG['setasbuyer']; ?></button>
							</div>
						</div>
					</section>
				</div>
				<div class="col-12">
					<h6 class="text-primary fw-bolder text-uppercase mb-3 d-flex justify-content-start align-items-center">
						<span><?php echo $LANG['order']; ?></span>
						<select name="txtlang" id="txtlang" required class="ms-3">
							<?php echo $cbxLanguage;?>
						</select>
					</h6>
					<div class="table-responsive">
						<script>var _stt_begin = <?php echo $_stt_begin;?>;</script>
						<input type="hidden" name="quantity_product" id="quantity_product" value="<?php echo $_stt_begin;?>" autocomplete="off" required>
						<table class="table table-info table-striped table-bordered table-hover align-middle table-select2">
							<thead class="fw-bold">
								<tr>
									<td class="text-center" width="80px"><?php echo $LANG['stt']; ?></td>
									<td class="text-center"><?php echo $LANG['product']; ?></td>
									<td class="text-center" width="100px"><?php echo $LANG['quantity']; ?></td>
								</tr>
							</thead>
							<tbody class="table-group-divider" id="product-list">
								<tr>
									<td class="text-center"><?php echo $_stt_begin;?></td>
									<td>
	    							   <select id="id_product_price_<?php echo $_stt_begin;?>" name="id_product_price_<?php echo $_stt_begin;?>" class="form-control cbx_select2" required>
											<option value=""><?php echo $LANG['choose'];?> <?php echo $LANG['product'];?></option>
		    							   	<?php echo $cbxProduct;?>
										</select>
									</td>
									<td class="text-center">
										<input type="number" class="form-control text-center" id="product_q_<?php echo $_stt_begin;?>" name="product_q_<?php echo $_stt_begin;?>" min="<?php echo _DEFAULT_MIN_QTY_PRODUCT_ORDER;?>" max="<?php echo _DEFAULT_MAX_QTY_PRODUCT_ORDER;?>" required value="1">
									</td>
								</tr>
							</tbody>
							<tfoot class="table-group-divider text-danger fw-bold">
								<tr>
									<td class="text-center"><a onclick="addRowProduct();" href="javascript:;" class="btn btn-warning"><i class="fa fa-plus"></i></a></td>
									<td colspan="2"></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_orderdate" class="col-form-label"><?php echo $LANG['order_date']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control datepicker_created" name="txt_orderdate" id="txt_orderdate" value="<?php echo $txt_orderdate;?>" required />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label class="col-form-label"><?php echo $LANG['notes']; ?> <?php echo $LANG['order']; ?></label>
						</div>
						<div class="col-xl-8">
							<textarea class="form-control" rows="1" name="txt_note" id="txt_note"><?php echo $txt_note; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_delivery_fee" class="col-form-label"><?php echo $LANG['delivery_fee']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input onkeyup="convert_number(this)" type="text" class="form-control" name="txt_delivery_fee" id="txt_delivery_fee" value="<?php echo $txt_delivery_fee;?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_status" class="col-form-label"><?php echo $LANG['status']; ?> <?php echo $LANG['order']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_status" name="cbx_status" required="required">
								<?php echo $cbxStatus;?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_paymentmethod" class="col-form-label"><?php echo $LANG['paymentmethod']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_paymentmethod" name="cbx_paymentmethod" required="required">
								<?php echo $cbxPaymentmethod;?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_status_payment" class="col-form-label"><?php echo $LANG['status']; ?> <?php echo $LANG['payment']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_status_payment" name="cbx_status_payment" required="required">
								<?php echo $cbxStatus_Payment;?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_deliverymethod" class="col-form-label"><?php echo $LANG['deliverymethod']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_deliverymethod" name="cbx_deliverymethod" required="required">
								<?php echo $cbxDeliverymethod;?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_status_delivery" class="col-form-label"><?php echo $LANG['status']; ?> <?php echo $LANG['delivery']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_status_delivery" name="cbx_status_delivery" required="required">
								<?php echo $cbxStatus_Delivery;?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txtnote_update" class="col-form-label"><?php echo $LANG['notes']; ?> <?php echo $LANG['update']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" name="txtnote_update" id="txtnote_update" disabled value="<?php echo $txtnote_update;?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_sendmail" class="col-form-label"><?php echo $LANG['sendmail_buyer_order']; ?></label>
						</div>
						<div class="col-xl-8">
							<select id="cbx_sendmail" name="cbx_sendmail" class="form-select">
								<option value=""><?php echo $LANG['choose'].' '.$LANG['email_template'];?></option>
								<?php echo $cbxTemplate;?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_order" name="act_order" id="act_order" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['add']; ?> <?php echo $LANG['order']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_ORDER_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-md-6">
				<div class="row mb-3">
					<div class="col-xl-4">
						<label for="txt_created_date" class="col-form-label"><?php echo $LANG['created_date']; ?></label>
					</div>
					<div class="col-xl-8">
						<input disabled type="text" class="form-control" value="<?php echo $created_date; ?>">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row mb-3">
					<div class="col-xl-4">
						<label for="txt_created_by" class="col-form-label"><?php echo $LANG['created_by']; ?></label>
					</div>
					<div class="col-xl-8">
						<input disabled type="text" class="form-control" value="<?php echo $created_by; ?>">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row mb-3">
					<div class="col-xl-4">
						<label for="txt_updated_date" class="col-form-label"><?php echo $LANG['updated_date']; ?></label>
					</div>
					<div class="col-xl-8">
						<input disabled type="text" class="form-control" value="<?php echo $updated_date; ?>">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row mb-3">
					<div class="col-xl-4">
						<label for="txt_updated_by" class="col-form-label"><?php echo $LANG['updated_by']; ?></label>
					</div>
					<div class="col-xl-8">
						<input disabled type="text" class="form-control" value="<?php echo $updated_by; ?>">
					</div>
				</div>
			</div>
		</div>
	</section>
</div>