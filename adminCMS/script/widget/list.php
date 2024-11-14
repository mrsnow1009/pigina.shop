
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

		if ($('#table-widget').length == 1) {
		   	var table_donate = $('#table-widget').DataTable({
		   		order: [[2, 'desc']],
		      	pageLength: <?php echo _MAX_RECORD_WIDGET;?>,
		      	// "lengthChange": false,
		      	scrollCollapse: _scrollCollapse,
		  		scrollX: _scrollX,
		      	columnDefs: [
		        	{ searchable: false, orderable: false, targets: [0,1,7] },
    				{ className: 'dt-center', targets: [1,4,5,6,7] },
    				{ className: 'align-middle', targets: "_all" }
	      		],
		      	columns: [
			      	{
		                className: 'dt-control',
		                orderable: false,
		                data: null,
		                defaultContent: '',
		            },
		      	   	{ data: 'ID' },
		      	   	{ data: 'w_code' },
	        	    { data: 'w_name' },
	        	    { data: 'w_max_item' },
	        	    { data: 'w_type' },
	        	   	{ data: 't_status'},
	        	   	{ data: 't_index'}
	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_widget_list",
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

	        $('#table-widget tbody').on('click', 'td.dt-control', function () {
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
			        '<td style="width: 80px;"><?php echo $LANG['code']?>:</td>' +
			        '<td>' + d.w_code + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['max_item']?>:</td>' +
			        '<td>' + d.w_max_item + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['type']?>:</td>' +
			        '<td>' + d.w_type + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['status']?>:</td>' +
			        '<td>'+d.t_status+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
