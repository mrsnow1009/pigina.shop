<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_HOME; ?>" title=""><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_ARTICLE_LIST; ?>&node=<?php echo $node; ?>&lang=<?php echo _LANG_ADMIN_DEFAULT; ?>" title=""><?php echo $LANG['list']; ?> <?php echo $LANG[$node]; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<form action="" role="form" method="post" id="form_updateArticle">
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_lang" class="col-form-label"><?php echo $LANG['language']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_lang" name="cbx_lang" required="required">
								<?php echo $cbxLang; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="cbx_cateid" class="col-form-label"><?php echo $LANG['choose_category']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<select class="form-select" id="cbx_cateid" name="cbx_cateid" required="required">
								<option value=""><?php echo $LANG['choose_category']; ?></option>
								<?php echo $cbxCategory; ?>
							</select>
						</div>
					</div>
				</div>
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
							<label for="txt_url" class="col-form-label"><?php echo $LANG['redirect_link']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_url" name="txt_url" value="<?php echo $txt_url; ?>" placeholder="<?php echo $LANG['note_url_cate']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_urlseo" class="col-form-label"><?php echo $LANG['url_friendly']; ?> <span class="text-danger">(*)</span></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control" id="txt_urlseo" name="txt_urlseo" value="<?php echo $txt_urlseo; ?>" placeholder="duong-dan-seo">
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
						<div class="col-xl-2">
							<label for="txt_intro" class="col-form-label"><?php echo $LANG['introduction']; ?> </label>
						</div>
						<div class="col-xl-10">
							<textarea class="form-control" name="txt_intro" id="txt_intro" cols="1"><?php echo $txt_intro; ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="mb-3">
						<label for="txt_content" class="col-form-label"><?php echo $LANG['content']; ?></label>
						<textarea class="form-control" name="txt_content" id="txt_content" cols="50"><?php echo $txt_content; ?></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">
							<label for="txt_publish_date" class="col-form-label"><?php echo $LANG['publish_date']; ?></label>
						</div>
						<div class="col-xl-8">
							<input type="text" class="form-control datepicker_created" id="txt_publish_date" name="txt_publish_date" value="<?php echo $txt_publish_date; ?>">
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
			<section class="box-section mb-3">
				<div class="border border-info border-opacity-25 rounded p-3">
					<h6 class="text-primary fw-bolder mb-3"><?php echo strtoupper($LANG['seo']); ?></h6>
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="metaTitle" class="col-form-label"><?php echo $LANG['meta_title']; ?></label>
						</div>
						<div class="col-xl-10">
							<input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?php echo $metaTitle; ?>" placeholder="">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="metaKeywords" class="col-form-label"><?php echo $LANG['meta_keyword']; ?></label>
						</div>
						<div class="col-xl-10">
							<textarea name="metaKeywords" id="metaKeywords" class="form-control" rows="2"><?php echo $metaKeywords; ?></textarea>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-xl-2">
							<label for="metaDescription" class="col-form-label"><?php echo $LANG['meta_description']; ?></label>
						</div>
						<div class="col-xl-10">
							<textarea name="metaDescription" id="metaDescription" class="form-control" rows="2"><?php echo $metaDescription; ?></textarea>
						</div>
					</div>
				</div>
			</section>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-3">
						<div class="col-xl-4">&nbsp;</div>
						<div class="col-xl-8">
							<input type="hidden" value="<?php echo $txt_type_art; ?>" name="txt_type_art" id="txt_type_art" required="required">
							<input type="hidden" value="add_article" name="act_article" id="act_article" required="required">
							<button class="btn btn-primary me-2" type="submit"><?php echo $LANG['save_information']; ?></button>
							<a class="btn btn-warning" href="<?php echo _LINK_CONTENT_LIST.'&node='.$node; ?>" title="<?php echo $LANG['cancel']; ?>"><?php echo $LANG['cancel']; ?></a>
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
				<?php echo $LANG['note_create_article']; ?>
			</div>
		</section>
	</section>
</div>