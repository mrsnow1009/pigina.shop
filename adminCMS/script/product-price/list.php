
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

		if ($('#table-product-price').length == 1) {
		   	var table_donate = $('#table-product-price').DataTable({
		   		order: [[2, 'desc']],
		      	pageLength: <?php echo _MAX_RECORD_PRODUCT_PRICE;?>,
		      	// "lengthChange": false,
		      	scrollCollapse: _scrollCollapse,
		  		scrollX: _scrollX,
		      	columnDefs: [
		        	{ orderable: false, targets: [0,1,8] },
		        	{ searchable: false, targets: [0,1,7,8] },
    				{ className: 'dt-center', targets: [1,4,5,6,7,8] },
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
	        	    { data: 'product_id' },
	        	    { data: 'color_id' },
	        	    { data: 'size_id' },
	        	   	{ data: 'price'},
	        	   	{ data: 'reduced_price'},
	        	   	{ data: 't_status'},
	        	   	{ data: 'updated_by'}
	            ],
				serverSide: true,
			    ajax: {
			        "url": "<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=_product_price_list",
			        type: 'POST'
			    }
		   	});

	        if (window_width < 768) {
		        table_donate.column(4).visible(false);
		        table_donate.column(5).visible(false);
		        table_donate.column(6).visible(false);
		        table_donate.column(7).visible(false);
			}else{
				table_donate.column(0).visible(false);
			}

	        $('#table-product-price tbody').on('click', 'td.dt-control', function () {
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
			        '<td style="width: 80px;"><?php echo $LANG['color']?>:</td>' +
			        '<td>' + d.color_id + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td"><?php echo $LANG['attribute']?>:</td>' +
			        '<td>' + d.size_id + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['price']?>:</td>' +
			        '<td>' + d.price + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['reduced_price']?>:</td>' +
			        '<td>' + d.reduced_price + '</td>' +
		        '</tr>' +
		        '<tr>' +
			        '<td><?php echo $LANG['status']?>:</td>' +
			        '<td>'+d.t_status+'</td>' +
		        '</tr>' +
	        '</table>'
	    );
	}
</script>
