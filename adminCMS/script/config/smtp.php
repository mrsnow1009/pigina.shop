<script>
	$(document).ready(function(){

		$( "#form_updateSMTP" ).validate( {
			rules: {
				smtp_hostname: "required",
				smtp_port: {
					required: true,
					number: true
				},
				smtp_mail: {
					required: true,
					email: true
				},
				smtp_password: "required",
				mail_contact: "required",
				mail_order: "required",
			},
			messages: {
				smtp_hostname: "<?php echo $LANG['this_field_is_required']; ?>",
				smtp_port: {
					required: "<?php echo $LANG['this_field_is_required']; ?>",
					number: "<?php echo $LANG['number_is_required']; ?>",
				},
				smtp_mail: {
					required: "<?php echo $LANG['this_field_is_required']; ?>",
					email: "<?php echo $LANG['email_invalid']; ?>"
				},
				smtp_password: "<?php echo $LANG['this_field_is_required']; ?>",
				mail_contact: "<?php echo $LANG['this_field_is_required']; ?>",
				mail_order: "<?php echo $LANG['this_field_is_required']; ?>",
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
		} );

	});

</script>