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
							<label for="robot_file" class="col-form-label"><?php echo $LANG['robot_file']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="robot_file" id="robot_file" rows="8"><?php echo $robot_file; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="sitemap_file" class="col-form-label"><?php echo $LANG['sitemap_file']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="sitemap_file" id="sitemap_file" rows="8"><?php echo $sitemap_file; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_robot_sitemap" name="act_robot_sitemap" id="act_robot_sitemap" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>