
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

		if ($('#table-content').length == 1) {
		   	var table_donate = $('#table-content').DataTable({
		   		order: [[4, 'desc']],
		      	pageLength: <?php echo _MAX_RECORD_ARTICLE;?>,
		      	// "lengthChange": false,
		      	scrollCollapse: _scrollCollapse,
		  		scrollX: _scrollX,
		      	columnDefs: [
		        	{ searchable: false, orderable: false, targets: [0,1,6] },
    				{ className: 'dt-center', targets: [1,4,5,6] }
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
	        	    { data: 'cateid' },
	        	   	{ data: 'created_date'},
	        	   	{ data: 't_status'},
	        	   	{ data: 't_index'}
	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_article_list&node=<?php echo $node;?>",
			        type: 'POST'
			    }
		   	});

	        if (window_width < 768) {
		        table_donate.column(3).visible(false);
		        table_donate.column(4).visible(false);
		        table_donate.column(5).visible(false);
			}else{
				table_donate.column(0).visible(false);
			}

	        $('#table-content tbody').on('click', 'td.dt-control', function () {
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
			        '<td style="width: 80px;"><?php echo $LANG['category']?>:</td>' +
			        '<td>' + d.cateid + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['created_date']?>:</td>' +
			        '<td>' + d.created_date + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['status']?>:</td>' +
			        '<td>'+d.t_status+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
