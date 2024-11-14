<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_HOME; ?>" title=""><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_TEMPLATE_LIST; ?>&lang=<?php echo _LANG_ADMIN_DEFAULT; ?>" title=""><?php echo $LANG['list-template']; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateTemplate">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_lang" class="col-form-label"><?php echo $LANG['language']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_lang" name="txt_lang" value="<?php echo $txt_lang; ?>" required="required" disabled />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_code" class="col-form-label"><?php echo $LANG['code']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="cbx_code" name="cbx_code" value="<?php echo $cbx_code; ?>" required="required" disabled />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_group" class="col-form-label"><?php echo $LANG['group_en']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="cbx_group" name="cbx_group" value="<?php echo $cbx_group; ?>" required="required" disabled />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_mask" class="col-form-label"><?php echo $LANG['module_en']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="cbx_mask" name="cbx_mask" value="<?php echo $cbx_mask; ?>" required="required" disabled />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_name" class="col-form-label"><?php echo $LANG['name']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-10">
							<input type="text" class="form-control" id="txt_name" name="txt_name" value="<?php echo $txt_name; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_title" class="col-form-label"><?php echo $LANG['subject']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-10">
							<input type="text" class="form-control" id="txt_title" name="txt_title" value="<?php echo $txt_title; ?>" required="required" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_content" class="col-form-label"><?php echo $LANG['content']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="txt_content" id="txt_content" rows="2" required="required"><?php echo $txt_content; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_template" name="act_template" id="act_template" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_TEMPLATE_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="row">
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
				<div class="mail_tpl">
					<?php echo $LANG['note_create_template']; ?>
    				<table class="table">
    					<?php echo $keywordsTemplate; ?>
    				</table>
    				<div class="row">
    					<div class="col-xl-6">
    						<table class="table">
		    					<tr>
		    						<td colspan="2"><?php echo $LANG['order_module_only']; ?></td>
		    					</tr>
		    					<?php echo $keywordsTemplate_Order; ?>
		    				</table>
    					</div>
    					<div class="col-xl-6">
    						<table class="table">
		    					<tr>
		    						<td colspan="2"><?php echo $LANG['member_module_only']; ?></td>
		    					</tr>
		    					<?php echo $keywordsTemplate_Member; ?>
		    				</table>
    					</div>
    				</div>
				</div>
			</div>
		</section>
	</section>
</div>