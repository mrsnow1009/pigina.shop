<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<?php echo $showBreadcrumbAdmin; ?>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateProductPrice">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_product" class="col-form-label"><?php echo $LANG['product']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_product" name="cbx_product" required="required">
								<option value=""><?php echo $LANG['choose']; ?> <?php echo $LANG['product']; ?></option>
								<?php echo $cbxProduct; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_title" class="col-form-label"><?php echo $LANG['title']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_title" name="txt_title" value="<?php echo $txt_title; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_color" class="col-form-label"><?php echo $LANG['color']; ?></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_color" name="cbx_color" />
								<option value=""><?php echo $LANG['choose']; ?> <?php echo $LANG['color']; ?></option>
								<?php echo $cbxColor; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_size" class="col-form-label"><?php echo $LANG['attribute']; ?></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_size" name="cbx_size" />
								<option value=""><?php echo $LANG['choose']; ?> <?php echo $LANG['attribute']; ?></option>
								<?php echo $cbxSize; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_price" class="col-form-label"><?php echo $LANG['price']; ?> (<?php echo _CURRENCY;?>) <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8 position-relative">
							<input onkeyup="convert_currency(this,'<?php echo _CURRENCY;?>','txt_price_temp')" value="<?php echo $txt_price; ?>" id="txt_price" name="txt_price" type="text" class="form-control">
							<input id="txt_price_temp" name="txt_price_temp" type="text" value="<?php echo $txt_price_temp; ?>" class="form-control input-currency-temp" disabled="disabled">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_reduced_price" class="col-form-label"><?php echo $LANG['reduced_price']; ?> (<?php echo _CURRENCY;?>)</label>
						</div>
						<div class="col-xl-8 position-relative">
							<input onkeyup="convert_currency(this,'<?php echo _CURRENCY;?>','txt_reduced_price_temp')" value="<?php echo $txt_reduced_price; ?>" type="text" class="form-control" id="txt_reduced_price" name="txt_reduced_price">
							<input id="txt_reduced_price_temp" name="txt_reduced_price_temp" type="text" value="<?php echo $txt_reduced_price_temp; ?>" class="form-control input-currency-temp" disabled="disabled">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_status" class="col-form-label"><?php echo $LANG['status']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_status" name="cbx_status" required="required">
								<?php echo $cbxStatus; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-md-2">
							<label for="imgURL" class="col-form-label"><?php echo $LANG['avatar']; ?></label>
						</div>
						<div class="col-md-10">
							<div id="imgcontentfile_url">
								<?php if($file_url != '' ){ ?>
                                <div class="img-wrap mb-3">
									<span value="<?php echo $file_url; ?>" onclick = "delImagefile_url($(this));" class="close">&times;</span>
									<img style="max-width:270px;border:1px solid #333" src="<?php echo $file_url; ?>">
								</div>
                                <?php  } ?>
							</div>
							<?php echo $form_upload_thumb; ?>
							<input type="hidden" value="<?php echo $thumb_id;?>" name="thumb_id" id="thumb_id" required="required">
							<input type="hidden" value="<?php echo $time_tmp;?>" name="time_tmp" id="time_tmp" required="required">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_product_price" name="act_product_price" id="act_product_price" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_PRODUCT_PRICE_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
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
						<label for="txt_updated_by" class="col-form-label"><?php echo $LANG['updated_by']; ?></label>
					</div>
					<div class="col-xl-8">
						<input disabled type="text" class="form-control" value="<?php echo $updated_by; ?>">
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
		</div>
		<section class="box-section mb-3">
			<div class="border border-info border-opacity-25 rounded p-3">
				<?php echo $LANG['note_create_unit']; ?>
			</div>
		</section>
	</section>
</div>