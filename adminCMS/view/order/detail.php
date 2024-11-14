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
						<span><?php echo $LANG['order']; ?></span> &nbsp;
						<span class="text-danger">#<?php echo $order_code; ?></span>
						<select name="txtlang" id="txtlang" required class="ms-3">
							<?php echo $cbxLanguage;?>
						</select>
					</h6>
					<div class="table-responsive">
						<script>var _stt_begin = <?php echo $_stt_begin;?>; var _stt_product = <?php echo $count_product;?>;</script>
						<input type="hidden" name="quantity_product" id="quantity_product" value="<?php echo $_stt_begin;?>" autocomplete="off" required>
						<table class="table table-info table-striped table-bordered table-hover align-middle table-select2">
							<thead class="fw-bold">
								<tr>
									<td class="text-center"><?php echo $LANG['stt']; ?></td>
									<td class="text-center"><?php echo $LANG['code']; ?> <?php echo $LANG['product']; ?></td>
									<td><?php echo $LANG['name']; ?> <?php echo $LANG['product']; ?></td>
									<td class="text-center"><?php echo $LANG['price']; ?> (<?php echo _CURRENCY; ?>)</td>
									<td class="text-center"><?php echo $LANG['reduced_price']; ?> (<?php echo _CURRENCY; ?>)</td>
									<td class="text-center"><?php echo $LANG['quantity']; ?></td>
									<td class="text-end"><?php echo $LANG['total_amount']; ?> (<?php echo _CURRENCY; ?>)</td>
								</tr>
							</thead>
							<tbody class="table-group-divider" id="product-list">

								<?php echo $html_product;?>

							</tbody>
							<tfoot class="table-group-divider fw-bold">
								<tr>
									<td class="text-center"><?php echo $show_addRowProduct;?></td>
									<td class="text-center"><?php echo $show_updateOrderProduct;?></td>
									<td class="text-end text-danger" colspan="3"><?php echo $LANG['total']; ?></td>
									<td class="text-center text-danger" id="total_quantity"><?php echo $total_quantity;?></td>
									<td class="text-end text-danger" id="total_amount"><?php echo $total_amount;?></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_orderdate" class="col-form-label"><?php echo $LANG['order_date']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" name="txt_orderdate" id="txt_orderdate" value="<?php echo $order_date;?>" disabled />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label class="col-form-label"><?php echo $LANG['notes']; ?> <?php echo $LANG['order']; ?></label>
						</div>
						<div class="col-xl-8">
							<textarea class="form-control" rows="1" name="txt_note" id="txt_note" disabled><?php echo $order_note; ?></textarea>
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
							<input type="text" class="form-control" name="txtnote_update" id="txtnote_update" value="<?php echo $txtnote_update;?>" />
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
							<input type="hidden" value="update_order" name="act_order" id="act_order" required="required">
							<input type="hidden" value="<?php echo $id;?>" name="order_id" id="order_id" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['update']; ?> <?php echo $LANG['order']; ?></button>
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
			<?php if($order_note_admin){ ?>
				<div class="col-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label class="col-form-label"><?php echo $LANG['notes']; ?> <?php echo $LANG['update']; ?></label>
						</div>
						<div class="col-xl-10">
							<div class="border border-info border-opacity-25 rounded p-3">
								<div class="note-order-update">
									<?php echo $order_note_admin; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>
</div>