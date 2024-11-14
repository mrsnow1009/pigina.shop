<script>
	$(document).ready(function(){

		$( "#form_updateContactForm" ).validate( {
			rules: {
				txt_name: "required",
				cbx_status: "required",
				add_contact_form: "required"
			},
			messages: {
				txt_name: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				add_contact_form: "<?php echo $LANG['this_field_is_required']; ?>"
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