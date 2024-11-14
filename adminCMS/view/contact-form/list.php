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
		<div class="text-end mb-3"><a class="btn btn-primary" href="<?php echo _LINK_CONTACT_FORM_CREATE; ?>&lang=<?php echo _LANG_ADMIN_DEFAULT; ?>" title=""><?php echo $LANG['add-contact-form']; ?></a></div>
		<?php } ?>
		<div class="border border-info border-opacity-25 rounded p-3">
			<table id="table-contact-form" class="table table-striped table-hover table-bordered w-100">
				<thead>
		            <tr>
		            	<th></th>
		            	<th><input class="form-check-input" type="checkbox" value="0" id="tb-checked-item" name="tb-checked-all-item[]"></th>
		            	<th><?php echo $LANG['name']; ?></th>
		            	<th><?php echo $LANG['phone']; ?></th>
		                <th><?php echo $LANG['created_date']; ?></th>
		                <th><?php echo $LANG['status']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </thead>
		        <tbody>

		        	<?php // echo $html_list;?>
		        	
		        </tbody>
		        <tfoot>
		            <tr>
		            	<th></th><th><a onclick="getDelRecord('delContact_form')" id="tb-delete-item" href="javascript:;" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $LANG['delete']; ?>"><i class="fa-light fa-trash-can"></i></a></th>
		            	<th><?php echo $LANG['name']; ?></th>
		            	<th><?php echo $LANG['phone']; ?></th>
		                <th><?php echo $LANG['created_date']; ?></th>
		                <th><?php echo $LANG['status']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</section>
</div>