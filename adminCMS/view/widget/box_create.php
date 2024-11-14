<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<?php echo $showBreadcrumbAdmin; ?>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateWidget">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_w_name" class="col-form-label"><?php echo $LANG['name']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_w_name" name="txt_w_name" value="<?php echo $txt_w_name; ?>" required />
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
							<label for="txt_position" class="col-form-label"><?php echo $LANG['position']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_position" name="txt_position" value="<?php echo $txt_position; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_intro" class="col-form-label"><?php echo $LANG['introduction']; ?></label>
						</div>
						<div class="col-xl-10">
							<input type="text" class="form-control" id="txt_intro" name="txt_intro" value="<?php echo $txt_intro; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="txt_content" class="col-form-label"><?php echo $LANG['content']; ?></label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="txt_content" id="txt_content" rows="5"><?php echo $txt_content; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_link_1" class="col-form-label"><?php echo $LANG['url_button']; ?> 1</label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_link_1" name="txt_link_1" value="<?php echo $txt_link_1; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_link_2" class="col-form-label"><?php echo $LANG['url_button']; ?> 2</label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_link_2" name="txt_link_2" value="<?php echo $txt_link_2; ?>" />
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<input type="hidden" value="<?php echo $thumb_id;?>" name="thumb_id" id="thumb_id" required="required">
					<input type="hidden" value="<?php echo $time_tmp;?>" name="time_tmp" id="time_tmp" required="required">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="file_url" class="col-form-label"><?php echo $LANG['image']; ?></label>
						</div>
						<div class="col-xl-8">
							<div id="imgcontentfile_url">
								<?php if($file_url != '' ){ ?>
                                <div class="img-wrap mb-3">
									<span value="<?php echo $file_url; ?>" onclick = "delImagefile_url($(this),'');" class="close">&times;</span>
									<img style="max-width:270px;border:1px solid #333" src="<?php echo $file_url; ?>">
								</div>
                                <?php  } ?>
							</div>
							<?php echo $form_upload_thumb; ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="file_url_bg" class="col-form-label"><?php echo $LANG['background_image']; ?></label>
						</div>
						<div class="col-xl-8">
							<div id="imgcontentfile_url_bg">
								<?php if($file_url_bg != '' ){ ?>
                                <div class="img-wrap mb-3">
									<span value="<?php echo $file_url_bg; ?>" onclick = "delImagefile_url($(this),'_bg');" class="close">&times;</span>
									<img style="max-width:270px;border:1px solid #333" src="<?php echo $file_url_bg; ?>">
								</div>
                                <?php  } ?>
							</div>
							<?php echo $form_upload_thumb_bg; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<section class="box-section mb-3">
					<div class="border border-info border-opacity-25 rounded p-3">
						<h6 class="text-primary fw-bolder text-uppercase mb-3"><?php echo $LANG['list']; ?></h6>
						<table class="table table-info table-striped table-bordered table-hover table-select2 align-middle">
							<thead>
								<tr>
									<th width="50" class="text-center"><?php echo $LANG['stt']; ?></th>
									<th><?php echo $LANG['title']; ?></th>
									<th width="120" class="text-center"><?php echo $LANG['sort']; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php echo $tbody_widget;?>
							</tbody>
						</table>
					</div>
				</section>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="add_widget_box" name="act_widget_box" id="act_widget_box" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_WIDGET_BOX_LIST; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
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
				<?php echo $LANG['note_create_widget_box']; ?>
			</div>
		</section>
	</section>
</div>