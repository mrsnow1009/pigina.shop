

<script type="text/javascript" src="assets/plugin/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/plugin/datatable/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
	    $('#table-order').DataTable({
	    	order: [[4, 'desc']],
	    	columnDefs: [
    			{ orderable: false, targets: 5 }
  			],
	    });
	});


</script>
