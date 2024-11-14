<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo _LINK_HOME; ?>" title="<?php echo $LANG['index']; ?>"><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo _LINK_WEBMASTER_LIST; ?>" title="<?php echo $LANG['webmaster']; ?>"><?php echo $LANG['webmaster']; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form id="form_changePassword" action="" role="form" method="post" class="needs-validation" novalidate>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_password_old" class="col-form-label"><?php echo $LANG['old_password']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="password" class="form-control" id="txt_password_old" name="txt_password_old" value="" required>
						</div>
					</div>
				</div>
				<div class="col-md-6"></div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_password_new" class="col-form-label"><?php echo $LANG['new_password']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="password" class="form-control" id="txt_password_new" name="txt_password_new" value="" required>
						</div>
					</div>
				</div>
				<div class="col-md-6"></div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_password_confirm" class="col-form-label"><?php echo $LANG['confirm_password']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="password" class="form-control" id="txt_password_confirm" name="txt_password_confirm" value="" required>
						</div>
					</div>
				</div>
				<div class="col-md-6"><label class="text-danger d-empty-none col-form-label" id="err_password_confirm"></label></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
                            <input type="hidden" value="changePassword" name="act_changePassword" id="act_changePassword">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-secondary" href="<?php echo _LINK_WEBMASTER_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>