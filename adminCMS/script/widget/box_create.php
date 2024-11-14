<script src="<?=_ROOT_PATH_WEBSITE?>/assets/plugin/uploadifive/jquery.uploadifive.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugin/select2/select2.min.js"></script>
<script>
	$(document).ready(function(){
		
		$(".cbx_select2").select2();

		$( "#form_updateWidget" ).validate( {
			rules: {
				txt_w_name: "required",
				cbx_status: "required"
			},
			messages: {
				txt_w_name: "<?php echo $LANG['this_field_is_required']; ?>",
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