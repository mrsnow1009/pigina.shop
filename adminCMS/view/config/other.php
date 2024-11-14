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
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="head_tag" class="col-form-label"><?php echo $LANG['head_tag']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="head_tag" id="head_tag" rows="3"><?php echo $head_tag; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="body_tag" class="col-form-label"><?php echo $LANG['body_tag']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="body_tag" id="body_tag" rows="3"><?php echo $body_tag; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="google_analytic" class="col-form-label"><?php echo $LANG['google_analytic']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="google_analytic" id="google_analytic" rows="3"><?php echo $google_analytic; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="google_adwords" class="col-form-label"><?php echo $LANG['google_adwords']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="google_adwords" id="google_adwords" rows="3"><?php echo $google_adwords; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="facebook_code_tracking" class="col-form-label"><?php echo $LANG['facebook_code_tracking']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="facebook_code_tracking" id="facebook_code_tracking" rows="3"><?php echo $facebook_code_tracking; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="facebook_adwords" class="col-form-label"><?php echo $LANG['facebook_adwords']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="facebook_adwords" id="facebook_adwords" rows="3"><?php echo $facebook_adwords; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="embed_livechat" class="col-form-label"><?php echo $LANG['embed_livechat']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="embed_livechat" id="embed_livechat" rows="3"><?php echo $embed_livechat; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="javascript_other" class="col-form-label"><?php echo $LANG['javascript_other']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="javascript_other" id="javascript_other" rows="3"><?php echo $javascript_other; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_other" name="act_other" id="act_other" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>