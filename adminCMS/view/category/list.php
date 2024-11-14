<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a href="<?php echo _LINK_HOME; ?>" title=""><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<div class="text-end"><a class="btn btn-primary" href="<?php echo _LINK_CATEGORY_CREATE; ?>&node=<?php echo $node; ?>&lang=<?php echo _LANG_ADMIN_DEFAULT; ?>" title=""><?php echo $LANG['create-category']; ?></a></div>
		<div class="treecate-wrapper">
            <div class="treecate-list">
                <div class="parent-cate">
                    <a href="javascript:;" title="ROOT"><span><strong>ROOT</strong></span></a>

                    <?php echo $html_tree; ?>

                </div>
            </div>
        </div>
	</section>
</div>