<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_HOME; ?>" title=""><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_BANNER_LIST; ?>" title=""><?php echo $LANG['list-banner']; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateBanner">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_title" class="col-form-label"><?php echo $LANG['title']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_title" name="txt_title" value="<?php echo $txt_title; ?>" required="required">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbxPosition" class="col-form-label"><?php echo $LANG['position']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbxPosition" name="cbxPosition" required="required">
								<?php echo $cbxPosition; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_width" class="col-form-label"><?php echo $LANG['width']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_width" name="txt_width" value="<?php echo $txt_width; ?>" <?php echo $readonly_size; ?>>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_height" class="col-form-label"><?php echo $LANG['height']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_height" name="txt_height" value="<?php echo $txt_height; ?>" <?php echo $readonly_size; ?>>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_url" class="col-form-label"><?php echo $LANG['link_banner']; ?> </label>
						</div>
						<div class="col-xl-8">
							<input name="txt_url" id="txt_url" type="text" value="<?php echo $txt_url; ?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbxTarget" class="col-form-label"><?php echo $LANG['target']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbxTarget" name="cbxTarget" required="required">
								<?php echo $cbxTarget; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="rad_type" class="col-form-label"><?php echo $LANG['type_banner']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-10">
							<?php echo $rad_type;?>
						</div>
					</div>
				</div>
				<div class="col-md-12" id="id_images_banner">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_script" class="col-form-label"><?php echo $LANG['images_slider']; ?></label>
						</div>
						<div class="col-xl-10">
							<div id="product-column">
								<div id="rs-tabs-hp" class="w-100">
									<div id="list_gallery" class="ui-sortable row">
										<?php echo $html_library;?>
									</div>
								</div> 
							</div>
							<?php echo $form_upload_slide_thumb;?>
							<input type="hidden" name="temp_id" id="temp_id" value="<?php echo $temp_id;?>" required="required">
						</div>
					</div>
				</div>
				<div class="col-md-12" id="id_script_banner">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_script" class="col-form-label"><?php echo $LANG['script_code']; ?></label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="txt_script" id="txt_script" rows="5"><?php echo $txt_script; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="cbx_cateid" class="col-form-label"><?php echo $LANG['category']; ?> </label>
						</div>
						<div class="col-xl-10">
							<select name="cbx_cateid[]" id="cbx_cateid" class="form-control" multiple="multiple">
								<?php echo $cbx_cateid;?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="started_date" class="col-form-label"><?php echo $LANG['started_date']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control datepicker_created" id="started_date" name="started_date" value="<?php echo $started_date; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="expired_date" class="col-form-label"><?php echo $LANG['expired_date']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control datepicker_created" id="expired_date" name="expired_date" value="<?php echo $expired_date; ?>">
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
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_sort" class="col-form-label"><?php echo $LANG['display_order']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_sort" name="txt_sort" value="<?php echo $txt_sort; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_banner" name="act_banner" id="act_banner" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_BANNER_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
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
				<?php echo $LANG['note_create_banner']; ?>
			</div>
		</section>
	</section>
</div>