<script>
	$(document).ready(function(){

		$( "#form_updateBranch" ).validate( {
			rules: {
				cbx_lang: "required",
				txt_name: "required",
				txt_email: {
					email: true
				},
				cbx_status: "required",
				txt_sort: {
					number: true
				},
			},
			messages: {
				cbx_lang: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_name: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_email: {
					email: "<?php echo $LANG['email_invalid']; ?>"
				},
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

	function delImagefile_url(item,field){
		var url = item.attr("value");
		if(confirm("<?php echo $LANG['delete_image'];?>"))	
		{
			$.post( "delfile.php", { path: url } ) .done(function( data ) {
				
				$( "#imgcontentfile_url"+field ).html(' ');
				$( "#file_url"+field ).val('');
				$( ".file_fileUpload"+field ).show();
			});
			
		}else return false;
	}
</script>