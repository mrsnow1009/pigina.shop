<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<?php echo $showBreadcrumbAdmin; ?>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateBranch">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_lang" class="col-form-label"><?php echo $LANG['language']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select name="cbx_lang" id="cbx_lang" class="form-select" required="required" <?php echo $disabled_field; ?>>
								<?php echo $cbxLanguage; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_name" class="col-form-label"><?php echo $LANG['name'].' '.$LANG['branch']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_name" name="txt_name" value="<?php echo $txt_name; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_phone" class="col-form-label"><?php echo $LANG['phone']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_phone" name="txt_phone" value="<?php echo $txt_phone; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_email" class="col-form-label"><?php echo $LANG['email']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="email" class="form-control" id="txt_email" name="txt_email" value="<?php echo $txt_email; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_address" class="col-form-label"><?php echo $LANG['address']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_address" name="txt_address" value="<?php echo $txt_address; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_website" class="col-form-label"><?php echo $LANG['website']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo $txt_website; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_facebook" class="col-form-label"><?php echo $LANG['address'].' '.$LANG['facebook']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_facebook" name="txt_facebook" value="<?php echo $txt_facebook; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_twitter" class="col-form-label"><?php echo $LANG['address'].' '.$LANG['twitter']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_twitter" name="txt_twitter" value="<?php echo $txt_twitter; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_youtube" class="col-form-label"><?php echo $LANG['address'].' '.$LANG['youtube']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_youtube" name="txt_youtube" value="<?php echo $txt_youtube; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_instagram" class="col-form-label"><?php echo $LANG['address'].' '.$LANG['instagram']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_instagram" name="txt_instagram" value="<?php echo $txt_instagram; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_linkedin" class="col-form-label"><?php echo $LANG['address'].' '.$LANG['linkedin']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_linkedin" name="txt_linkedin" value="<?php echo $txt_linkedin; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_pinterest" class="col-form-label"><?php echo $LANG['address'].' '.$LANG['pinterest']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_pinterest" name="txt_pinterest" value="<?php echo $txt_pinterest; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_embedgooglemap" class="col-form-label"><?php echo $LANG['embedgooglemap']; ?></label>
						</div>
						<div class="col-xl-10">
							<textarea name="txt_embedgooglemap" id="txt_embedgooglemap" class="form-control" rows="2"><?php echo $txt_embedgooglemap; ?></textarea>
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
							<input type="number" class="form-control" id="txt_sort" name="txt_sort" value="<?php echo $txt_sort; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_branch" name="act_branch" id="act_branch" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_BRANCH_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
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
				<?php echo $LANG['note_create_company']; ?>
			</div>
		</section>
	</section>
</div>