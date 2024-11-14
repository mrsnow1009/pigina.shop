<script>
	$(document).ready(function(){
		$( "#form_updateAccount" ).validate( {
			rules: {
				txt_username: "required",
				txt_email: {
					required: true,
					email: true
				},
				txt_fullname: "required",
				txt_phone: {
					required: true
				},
				cbx_level: {
					required: true,
				},
				cbx_status: "required"
			},
			messages: {
				txt_username: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_email: {
					required: "<?php echo $LANG['this_field_is_required']; ?>",
					email: "<?php echo $LANG['email_invalid']; ?>",
				},
				txt_fullname: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_phone: {
					required: "<?php echo $LANG['this_field_is_required']; ?>",
				},
				cbx_level: {
					required: "<?php echo $LANG['this_field_is_required']; ?>",
				},
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>"
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				error.addClass( "help-block" );
				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
			},
			// highlight: function ( element, errorClass, validClass ) {
			// 	$( element ).parents('.error-wrapper').addClass( "has-error" ).removeClass( "has-success" );
			// },
			// unhighlight: function (element, errorClass, validClass) {
			// 	$( element ).parents('.error-wrapper').addClass( "has-success" ).removeClass( "has-error" );
			// }
		} );
	});
</script>