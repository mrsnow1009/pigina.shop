<script>
	$(document).ready(function(){

		$( "#form_updateWidget" ).validate( {
			rules: {
				cbx_lang: "required",
				txt_w_type: "required",
				txt_module_code: "required",
				txt_w_code: "required",
				txt_w_name: "required",
				txt_sort: {
					number: true
				},
				txt_w_max_item: {
					number: true,
					required:"required"
				},
				cbx_status: "required",
				act_widget: "required"
			},
			messages: {
				cbx_lang: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_w_type: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_module_code: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_w_name: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_w_code: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_sort: "<?php echo $LANG['number_is_required']; ?>",
				txt_w_max_item: {
					number: "<?php echo $LANG['number_is_required']; ?>",
					required:"<?php echo $LANG['this_field_is_required']; ?>"
				},
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				act_widget: "<?php echo $LANG['this_field_is_required']; ?>"
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