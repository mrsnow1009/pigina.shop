<script src="<?=_ROOT_PATH_WEBSITE?>/assets/plugin/uploadifive/jquery.uploadifive.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){

		$( "#form_updateProductPrice" ).validate( {
			rules: {
				cbx_product: "required",
				cbx_status: "required",
				txt_price: {
					required: true,
					number: true,
				},
				txt_reduced_price: "number",
			},
			messages: {
				cbx_product: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_price: {
					required : "<?php echo $LANG['this_field_is_required']; ?>",
					number : "<?php echo $LANG['number_is_required']; ?>",
				},
				txt_reduced_price: "<?php echo $LANG['number_is_required']; ?>",
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

	function delImagefile_url(item){
		var url = item.attr("value");
		if(confirm("<?php echo $LANG['delete_image'];?>"))
		{
			$.post( "delfile.php", { path: url } ) .done(function( data ) {

				$( "#imgcontentfile_url" ).html(' ');
				$( "#file_url" ).val('');
				$( ".file_fileUpload" ).show();
			});

		}else return false;
	}

</script>

<script>
	function convert_currency(field,unit,fieldShow){
	   	var strk = field.value;
	  	var strv, strd = '';
		if (unit == 'VND') {
			dot = '.';
			dot_d = ',';
		}else{
			dot_d = '.';
			dot = ',';
		}
		arrstr = strk.split('.');
	  	strv = arrstr[0];
	  	if (arrstr[1] != undefined ) {
			strd = dot_d + arrstr[1];
		};
	  	var stmp='';
	  	if (strv!=''){
	      	var l=strv.length-1;
	      	k=0;
	      	for (i=l;i>=0;i--){
	         	k++;
        		stmp= strv.substr(i,1) + stmp;
	         	if (strv.substr(i,1) == dot){
	           		k=0;
	        	}
	        	if ((k==3)&&(i>0)){
	            	k=0;
	          		stmp= dot + stmp;
	        	}
	      	}
	   	}

 		const showCurrency = document.getElementById(fieldShow);
 		full_str = stmp + strd;
 		if (unit == 'VND') {
 			showCurrency.value = full_str + ' ' + unit;
 		}else{
			showCurrency.value = unit + ' ' + full_str;
 		}
	}
</script>