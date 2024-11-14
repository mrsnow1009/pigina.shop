
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

		if ($('#table-widget-box').length == 1) {
		   	var table_donate = $('#table-widget-box').DataTable({
		   		order: [[2, 'desc']],
		      	pageLength: <?php echo _MAX_RECORD_WIDGET;?>,
		      	// "lengthChange": false,
		      	scrollCollapse: _scrollCollapse,
		  		scrollX: _scrollX,
		      	columnDefs: [
		        	{ searchable: false, orderable: false, targets: [0,5] },
    				{ className: 'dt-center', targets: [4,5] },
    				{ className: 'align-middle', targets: "_all" }
	      		],
		      	columns: [
			      	{
		                className: 'dt-control',
		                orderable: false,
		                data: null,
		                defaultContent: '',
		            },
		      	   	{ data: 'w_name' },
	        	    { data: 'title' },
	        	    { data: 'position' },
	        	   	{ data: 't_status'},
	        	   	{ data: 't_index'}
	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_widget_box_list",
			        type: 'POST'
			    }
		   	});

	        if (window_width < 768) {
		        table_donate.column(2).visible(false);
		        table_donate.column(3).visible(false);
		        table_donate.column(4).visible(false);
			}else{
				table_donate.column(0).visible(false);
			}

	        $('#table-widget-box tbody').on('click', 'td.dt-control', function () {
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
			        '<td style="width: 80px;"><?php echo $LANG['title']?>:</td>' +
			        '<td>' + d.title + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['position']?>:</td>' +
			        '<td>' + d.position + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['status']?>:</td>' +
			        '<td>'+d.t_status+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
