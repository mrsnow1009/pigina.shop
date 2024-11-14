<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<?php echo $showBreadcrumbAdmin; ?>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateSMTP">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="smtp_hostname" class="col-form-label"><?php echo $LANG['smtp_hostname']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="smtp_hostname" name="smtp_hostname" value="<?php echo $smtp_hostname; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="smtp_port" class="col-form-label"><?php echo $LANG['smtp_port']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="number" class="form-control" id="smtp_port" name="smtp_port" value="<?php echo $smtp_port; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="smtp_mail" class="col-form-label"><?php echo $LANG['smtp_mail']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="email" class="form-control" id="smtp_mail" name="smtp_mail" value="<?php echo $smtp_mail; ?> "required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="smtp_password" class="col-form-label"><?php echo $LANG['smtp_password']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="password" class="form-control" id="smtp_password" name="smtp_password" value="<?php echo $smtp_password; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="smtp_auth" class="col-form-label">&nbsp;</label>
						</div>
						<div class="col-xl-10">
							<label class="form-check-label cursor-pointer col-form-label" for="smtp_auth">
								<input class="form-check-input me-2" type="checkbox" name="smtp_auth" id="smtp_auth" value="1" <?php echo $smtp_auth==1?'checked':''; ?> >
								<?php echo $LANG['smtp_auth']; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="mail_contact" class="col-form-label"><?php echo $LANG['mail_contact']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="mail_contact" name="mail_contact" value="<?php echo $mail_contact; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="mail_order" class="col-form-label"><?php echo $LANG['mail_order']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="mail_order" name="mail_order" value="<?php echo $mail_order; ?>" required="required" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_smtp" name="act_smtp" id="act_smtp" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<section class="box-section mb-3">
			<div class="border border-info border-opacity-25 rounded p-3">
				<?php echo $LANG['note_config_system']; ?>
			</div>
		</section>
	</section>
</div>