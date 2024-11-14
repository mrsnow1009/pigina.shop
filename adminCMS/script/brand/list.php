
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

		if ($('#table-brand').length == 1) {
		   	var table_donate = $('#table-brand').DataTable({
		   		order: [[2, 'asc']],
		      	pageLength: <?php echo _MAX_RECORD_BRAND;?>,
		      	// "lengthChange": false,
		      	scrollCollapse: _scrollCollapse,
		  		scrollX: _scrollX,
		      	columnDefs: [
		        	{ searchable: false, orderable: false, targets: [0,1,6] },
		        	{ searchable: false, targets: [3,4,5] },
    				{ className: 'dt-center', targets: [1,3,4,5,6] },
    				{ className: 'align-middle', targets: '_all' }
	      		],
		      	columns: [
			      	{
		                className: 'dt-control',
		                orderable: false,
		                data: null,
		                defaultContent: '',
		            },
		      	   	{ data: 'ID' },
		      	   	{ data: 'title' },
	        	    { data: 'created_by' },
	        	    { data: 't_status' },
	        	    { data: 'lang' },
	        	   	{ data: 't_index'}
	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_brand_list",
			        type: 'POST'
			    }
		   	});

	        if (window_width < 768) {
		        table_donate.column(1).visible(false);
		        table_donate.column(3).visible(false);
		        table_donate.column(4).visible(false);
		        table_donate.column(5).visible(false);
			}else{
				table_donate.column(0).visible(false);
			}

	        $('#table-brand tbody').on('click', 'td.dt-control', function () {
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
			        '<td style="width: 120px;"><?php echo $LANG['product']?>:</td>' +
			        '<td>' + d.created_by + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td style="width: 120px;"><?php echo $LANG['status']?>:</td>' +
			        '<td>' + d.t_status + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['language']?>:</td>' +
			        '<td>'+d.lang+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
