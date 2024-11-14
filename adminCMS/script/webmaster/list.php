
<script type="text/javascript" src="assets/plugin/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/plugin/datatable/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
	    $('#table-webmaster').DataTable({
	    	order: [[1, 'desc']],
	    	columnDefs: [
    			{ orderable: false, targets: [0,5] },
    			{ className: 'dt-center', targets: [0,4,5] }
  			],
	    });
	});

	function resetPassword(id){
		alert('Reset và gửi mật khẩu: \nChức năng lười làm, tự reset tay đê!');
	}
</script>
