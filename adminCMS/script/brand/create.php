<script>
	$(document).ready(function(){

		$( "#form_updateBrand" ).validate( {
			rules: {
				cbx_lang: "required",
				txt_title: "required",
				cbx_status: "required",
				txt_sort: {
					number: true
				},
			},
			messages: {
				cbx_lang: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_title: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_sort: {
					number: "<?php echo $LANG['number_is_required']; ?>"
				},
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