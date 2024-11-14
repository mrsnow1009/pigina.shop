<div class="page-home">
	<div class="alert alert-primary p-2" role="alert">
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb mb-0">
		    	<?php echo $showBreadcrumbAdmin; ?>
		  	</ol>
		</nav>
	</div>
	<section class="box-section mb-3">
		<div class="border border-info border-opacity-25 rounded p-3">
			<table id="table-widget-box" class="table table-striped table-hover table-bordered w-100">
				<thead>
		            <tr>
		            	<th></th>
		            	<th><?php echo $LANG['name']; ?></th>
		            	<th><?php echo $LANG['title']; ?></th>
		            	<th><?php echo $LANG['position']; ?></th>
		                <th><?php echo $LANG['status']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </thead>
		        <tbody>

		        	<?php // echo $html_list;?>
		        	
		        </tbody>
		        <tfoot>
		            <tr>
		            	<th></th>
		            	<th><?php echo $LANG['name']; ?></th>
		            	<th><?php echo $LANG['title']; ?></th>
		            	<th><?php echo $LANG['position']; ?></th>
		                <th><?php echo $LANG['status']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</section>
</div>