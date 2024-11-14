
<script type="text/javascript" src="assets/plugin/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/plugin/datatable/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	var _scrollCollapse = false;
	var _scrollX = false;
	if (window_width < 768) {
	  	_scrollCollapse = true;
	  	_scrollX = true;
	}

	$(document).ready(function () {

		if ($('#table-template').length == 1) {
		   	var table_donate = $('#table-template').DataTable({
		   		order: [],//[1, 'asc']
		      	pageLength: <?php echo _MAX_RECORD_TEMPLATE;?>,
		      	// "lengthChange": false,
		      	scrollCollapse: _scrollCollapse,
		  		scrollX: _scrollX,
		      	columnDefs: [
		        	{ searchable: false, orderable: false, targets: [0,6] },
    				{ className: 'dt-center', targets: [0,3,4,5,6] },
    				{ className: 'align-middle', targets: [0,1,2,3,4,5,6] }
	      		],
		      	columns: [
			      	{
		                className: 'dt-control',
		                orderable: false,
		                data: null,
		                defaultContent: '',
		            },
	        	    { data: 'name' },
	        	    { data: 'title' },
	        	    { data: 'lang' },
	        	   	{ data: 't_group'},
	        	   	{ data: 'mask'},
	        	   	{ data: 't_index'}
	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_template_list",
			        type: 'POST'
			    }
		   	});

	        if (window_width < 768) {
		        table_donate.column(2).visible(false);
		        table_donate.column(4).visible(false);
		        table_donate.column(5).visible(false);
		        table_donate.column(6).visible(false);
			}else{
				table_donate.column(0).visible(false);
			}

	        $('#table-template tbody').on('click', 'td.dt-control', function () {
		        var tr = $(this).closest('tr');
		        var row = table_donate.row(tr);
		        if (row.child.isShown()) {
		            // This row is already open - close it
		            row.child.hide();
		            tr.removeClass('shown');
		        } else {
		            // Open this row
		            row.child(format(row.data())).show();
		            tr.addClass('shown');
		        }
		    });
	    };
  	});

	function format(d) {
	    return (
	        '<table class="table table-bordered table-hover table-striped w-100">' +
		        '<tr>' +
			        '<td style="width: 120px;"><?php echo $LANG['title']?>:</td>' +
			        '<td>' + d.title + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['group_en']?>:</td>' +
			        '<td>'+d.t_group+'</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['module_en']?>:</td>' +
			        '<td>'+d.mask+'</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['action']?>:</td>' +
			        '<td>'+d.t_index+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
