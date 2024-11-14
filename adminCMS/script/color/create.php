<script>
	$(document).ready(function(){

		$( "#form_updateColor" ).validate( {
			rules: {
				txt_title_vn: "required",
				txt_title_en: "required",
				cbx_status: "required",
				act_color: "required"
			},
			messages: {
				txt_title_vn: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_title_en: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				act_color: "<?php echo $LANG['this_field_is_required']; ?>"
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