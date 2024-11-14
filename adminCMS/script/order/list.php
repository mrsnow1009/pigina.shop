
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

		if ($('#table-order').length == 1) {
		   	var table_order = $('#table-order').DataTable({
		   		order: [[5, 'desc']],
		      	pageLength: <?php echo _MAX_RECORD_ORDER;?>,
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
	        	    { data: 'code' },
	        	   	{ data: 'fullname'},
	        	   	{ data: 'total'},
	        	   	{ data: 'date'},
	        	   	{ data: 't_status'},
	        	   	{ data: 't_index'}

	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_order_list",
			        type: 'POST'
			    }
		   	});

	        if (window_width < 768) {
		        table_order.column(1).visible(false);
		        table_order.column(2).visible(false);
		        table_order.column(4).visible(false);
		        table_order.column(5).visible(false);
		        table_order.column(6).visible(false);
			}else{
				table_order.column(0).visible(false);
			}

	        $('#table-order tbody').on('click', 'td.dt-control', function () {
		        var tr = $(this).closest('tr');
		        var row = table_order.row(tr);
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
			        '<td style="width: 100px;"><?php echo $LANG['code_order']?>:</td>' +
			        '<td>' + d.code + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['total_amount']?>:</td>' +
			        '<td>' + d.total + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['order_date']?>:</td>' +
			        '<td>' + d.date + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['status']?>:</td>' +
			        '<td>'+d.t_status+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
