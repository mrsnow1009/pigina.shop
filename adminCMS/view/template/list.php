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
		<div class="border border-info border-opacity-25 rounded p-3">
			<table id="table-template" class="table table-striped table-hover table-bordered w-100">
				<thead>
		            <tr>
		            	<th></th>
		            	<th><?php echo $LANG['name']; ?></th>
		            	<th><?php echo $LANG['subject']; ?></th>
		            	<th><?php echo $LANG['language']; ?></th>
		            	<th><?php echo $LANG['group_en']; ?></th>
		            	<th><?php echo $LANG['module_en']; ?></th>
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
		            	<th><?php echo $LANG['subject']; ?></th>
		            	<th><?php echo $LANG['language']; ?></th>
		            	<th><?php echo $LANG['group_en']; ?></th>
		            	<th><?php echo $LANG['module_en']; ?></th>
		                <th><span class="d-none d-md-block"><?php echo $LANG['action']; ?></span></th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</section>
</div>