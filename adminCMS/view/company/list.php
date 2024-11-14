<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<?php echo $showBreadcrumbAdmin; ?>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<?php if(_DEV_MODE === 1){ ?>
		<div class="text-end mb-3"><a class="btn btn-primary" href="<?php echo _LINK_COMPANY_CREATE; ?>&lang=<?php echo _LANG_ADMIN_DEFAULT; ?>" title=""><?php echo $LANG['add-company']; ?></a></div>
		<?php } ?>
		<div class="border border-info border-opacity-25 rounded p-3">
			<table id="table-company" class="table table-striped table-hover table-bordered w-100">
				<thead>
		            <tr>
		            	<th></th>
		            	<th><?php echo $LANG['name'].' '.$LANG['company']; ?></th>
		            	<th><?php echo $LANG['address']; ?></th>
		                <th><?php echo $LANG['language']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </thead>
		        <tbody>

		        	<?php // echo $html_list;?>
		        	
		        </tbody>
		        <tfoot>
		            <tr>
		            	<th></th>
		            	<th><?php echo $LANG['name'].' '.$LANG['company']; ?></th>
		            	<th><?php echo $LANG['address']; ?></th>
		                <th><?php echo $LANG['language']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</section>
</div>