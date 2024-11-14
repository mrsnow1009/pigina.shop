<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo _LINK_HOME; ?>" title="<?php echo $LANG['index']; ?>"><?php echo $LANG['index']; ?></a></li>
		    	<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<div class="text-end mb-3"><a class="btn btn-primary" href="<?php echo _LINK_WEBMASTER_CREATE; ?>" title=""><?php echo $LANG['add-webmaster']; ?></a></div>
		<div class="border border-info border-opacity-25 rounded p-3">
			<table id="table-webmaster" class="table table-striped table-hover table-bordered" style="width:100%">
				<thead>
		            <tr>
		            	<th><input class="form-check-input" type="checkbox" value="0" id="tb-checked-item" name="tb-checked-item[]"></th>
		            	<th><?php echo $LANG['fullname']; ?></th>
		            	<th><?php echo $LANG['email']; ?></th>
		            	<th><?php echo $LANG['created_date']; ?></th>
		                <th><?php echo $LANG['status']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php echo $html_list;?>
		        </tbody>
		        <tfoot>
		            <tr>
		            	<th><a onclick="getDelRecord('delWebmaster')" id="tb-delete-item" href="javascript:;" class="badge text-bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $LANG['delete']; ?>"><i class="fa-light fa-trash-can"></i></a></th>
		            	<th><?php echo $LANG['fullname']; ?></th>
		            	<th><?php echo $LANG['email']; ?></th>
		            	<th><?php echo $LANG['created_date']; ?></th>
		                <th><?php echo $LANG['status']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</section>
</div>