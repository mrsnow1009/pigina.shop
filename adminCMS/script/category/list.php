<script>
	function activeCate(cateid){
		var id = cateid;
		$.ajax({
		  	'url': '<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=active-category&id='+id,
		  	dataType: 'json'
		}).done(function(data) {
	  		alert(data.note);
  		 	location.reload(); 
		});
	}
	function removeCate(cateid){
		var id = cateid;
		$.ajax({
		  	'url': '<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=remove-category&id='+id,
		  	dataType: 'json'
		}).done(function(data) {
	  		alert(data.note);
  		 	location.reload(); 
		});
	}
</script>