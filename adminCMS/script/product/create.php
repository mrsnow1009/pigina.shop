<script src="<?=_ROOT_PATH_WEBSITE?>/assets/plugin/uploadifive/jquery.uploadifive.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#cbx_lang').on('change', function() {
		  	var _lang = this.value;
		  	$.ajax({
			  	'url': '<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=html-option-cate-product&lang='+_lang+'&cate=<?php echo $cbx_cateid; ?>',
			  	dataType: 'json'
			}).done(function(data) {
		  		if (data.error == "true") {
		  			$('#cbx_cateid').html(data.html);
		  		}else{
		  			alert(data.html);
  		 			location.reload();
		  		}
			});
		});

		$( "#form_updateProduct" ).validate( {
			rules: {
				cbx_lang: "required",
				cbx_cateid: "required",
				txt_title: "required",
				txt_urlseo: "required",
				txt_code: {
					remote: "<?php echo _ROOT_PATH_ADMIN_AJAX; ?>?q=check-product-code&id=<?php echo $check_id; ?>",
				},
				cbx_status: "required",
				txt_sort: {
					number: true
				},
				txt_price: {
					required: true,
					number: true,
                	// dollarsscents: true
				},
				// txt_price: "required",
				txt_reduced_price: "number",
				cbx_unit: "required",
			},
			messages: {
				cbx_lang: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_cateid: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_title: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_urlseo: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_code: {
					remote: "<?php echo $LANG['code_exited']; ?>",
				},
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_sort: "<?php echo $LANG['number_is_required']; ?>",
				txt_price: {
					required : "<?php echo $LANG['this_field_is_required']; ?>",
					number : "<?php echo $LANG['number_is_required']; ?>",
					// dollarsscents : "<?php echo $LANG['number_is_required']; ?>"
				},
				txt_reduced_price: "<?php echo $LANG['number_is_required']; ?>",
				cbx_unit: "<?php echo $LANG['this_field_is_required']; ?>",
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

		$("#txt_title").keyup( function() {
			$("#txt_urlseo").val(convertVNstring($("#txt_title").val()));
	 	});
	});

	function geturlseo(){
		str = $("#txt_title").val();
		str_cv = convertVNstring(str);
		$("#txt_urlseo").val(str_cv);
	}
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
	function delImageSlide(item){
		var url = item.attr("value");
		var id_slide = item.attr("id");
		if(confirm("<?php echo $LANG['delete_image'];?>")){
			$.post( "delfileSlide.php", { path: url,id:id_slide } ) .done(function( data ) {
				item.parent().closest( "div.list_image" ).remove();
			});
		}else return false;
	}
</script>

<!-- start new ckeditor -->
<script src="assets/library/ckeditor5/build/ckeditor.js"></script>
<script src="assets/library/ckfinder3/ckfinder.js"></script>
<script>
    ClassicEditor.create( document.querySelector( '#txt_content' ), {

   		// placeholder: 'Type the content here --- !',

		ckfinder: {
			uploadUrl: '<?=_ROOT_PATH_ADMIN?>assets/library/ckfinder3/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		},
		fontSize: {
            options: [
                'default',8,9,10,11,12,14,16,18,20,22,24,26,28,36,48
            ]
        },
        fontColor: {
            colors: [

            	{ color: '#1c1d1b', label: 'Default' },
                { color: 'hsl(0, 0%, 100%)', label: 'White', hasBorder: true },
                { color: 'red', label: 'Red' },
                { color: 'purple', label: 'Purple' },
                { color: 'fuchsia', label: 'Fuchsia' },
                { color: 'green', label: 'Green' },
                { color: 'lime', label: 'Lime' },
                { color: 'olive', label: 'Olive' },
                { color: 'yellow', label: 'Yellow' },
                { color: 'navy', label: 'Navy' },
                { color: 'blue', label: 'Blue' },
                { color: 'teal', label: 'Teal' },
                { color: 'Aqua', label: 'aqua' },
                { color: 'gray', label: 'Gray' },
                { color: 'silver', label: 'Silver' },
                { color: 'maroon', label: 'Maroon' },
                { color: 'black', label: 'Black' }
            ],
            columns: 4
        },
		toolbar: {
			items: [
				'undo','redo','|','heading','fontSize','fontColor','fontFamily','|',
				'bold','italic','underline','|',
				'CKFinder','imageInsert',/*'imageUpload',*/'mediaEmbed','|',
				'link','bulletedList','numberedList','|',
				'alignment','outdent','indent','pageBreak','|',
				'insertTable','blockQuote','htmlEmbed','code','codeBlock','|',
				'fontBackgroundColor','removeFormat','highlight','todoList'
			],
			shouldNotGroupWhenFull: true
		},
		mediaEmbed: {
            previewsInData: true
        },
		language: 'en',
		image: {
			toolbar: [
				'toggleImageCaption',
				'linkImage',
				'imageTextAlternative',
				'|',
				'imageStyle:alignLeft',
				'imageStyle:full',
				'imageStyle:alignRight',
				'|',
				'imageStyle:side',
				'ImageResize',

				'ImageCaption'
			],
			styles: [
                'full',
                'alignLeft',
                'alignRight'
            ]
		},
		table: {
			contentToolbar: [
				'tableColumn',
				'tableRow',
				'mergeTableCells',
				'tableCellProperties',
				'tableProperties'
			]
		},
		licenseKey: '',


	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( error => {
		console.error( 'Oops, something went wrong!' );
		console.warn( 'Build id: a6m361e8de7k-rmf3zwyp623n' );
		console.error( error );
	} );
</script>

<script src="assets/plugin/daterangepicker/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function(){
		$('.datepicker_created').datepicker({
		   format: 'dd-mm-yyyy'
		});
	});
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