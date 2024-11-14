<script type="text/javascript">
	$(document).ready(function () {
        $('#form_changePassword').submit(function( event ){
        	var _password_new = $('#txt_password_new').val();
		    var _password_confirm = $('#txt_password_confirm').val();
		    if (_password_new != _password_confirm) {
		    	$('#err_password_confirm').text('<?php echo $LANG["err_confirm_password"]; ?>');
				event.preventDefault();
		    }else{
		    	return;
		    }
        });
	});


</script>
