<script src="<?=_ROOT_PATH_WEBSITE?>/assets/plugin/uploadifive/jquery.uploadifive.js" type="text/javascript"></script>
<!-- two side multiselect -->
<script type="text/javascript" src="assets/plugin/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/js/jquery.quicksearch.js"></script>
<script>
	$(document).ready(function () {

		$('#cbxPosition').on('change', function() {
		  	var _cbxPosition = this.value;
		  	console.log(_cbxPosition);
		  	$.ajax({
			  	'url': '<?php echo _ROOT_PATH_ADMIN_AJAX;?>?q=banner-size-value&position='+_cbxPosition,
			  	dataType: 'json'
			}).done(function(data) {
		  		console.log(data);
		  		if (data.error == true) {
		  			$('#txt_width').val(data.width);
		  			$('#txt_height').val(data.height);
		  			if (data.readonly === 1) $('#txt_width, #txt_height').attr('readonly','readonly');
		  			else $('#txt_width, #txt_height').removeAttr('readonly');
		  		}else{
		  			alert('<?php echo $LANG['error_try_again'];?>');
  		 			location.reload(); 
		  		}
			});
		});

		$( "#form_updateBanner" ).validate( {
			rules: {
				txt_title: "required",
				cbxPosition: "required",
				txt_width: {
					number: true
				},
				txt_height: {
					number: true
				},
				cbxTarget: "required",
				cbx_status: "required",
				txt_sort: {
					number: true
				}
			},
			messages: {
				txt_title: "<?php echo $LANG['this_field_is_required']; ?>",
				cbxPosition: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_width: "<?php echo $LANG['number_is_required']; ?>",
				txt_height: "<?php echo $LANG['number_is_required']; ?>",
				cbxTarget: "<?php echo $LANG['this_field_is_required']; ?>",
				cbx_status: "<?php echo $LANG['this_field_is_required']; ?>",
				txt_sort: "<?php echo $LANG['number_is_required']; ?>"
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

		/* type banner: images or script */
		checkTypeBanner("<?php echo  $txt_type;?>");
		$('input').filter('[name="rad_type"]').click(function() {
		console.log($(this).val());			
			checkTypeBanner($(this).val());
		});

		/* two side - mutiselect */
		$('#cbx_cateid').multiSelect({
			/*keepOrder: true, */
			selectableOptgroup: true,
			cssClass: 'w-100',
			selectableHeader: '<input type="text" class="form-control mb-1" autocomplete="off" placeholder="<?php echo $LANG['search'];?>">',
			selectionHeader: '<input type="text" class="form-control mb-1" autocomplete="off" placeholder="<?php echo $LANG['search'];?>">',
			afterInit: function(ms){
				var that = this,
				    $selectableSearch = that.$selectableUl.prev(),
				    $selectionSearch = that.$selectionUl.prev(),
				    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
				    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

				that.qs1 = $selectableSearch.quicksearch(selectableSearchString).on('keydown', function(e){
			  		if (e.which === 40){
			    	that.$selectableUl.focus();
			    	return false;
			  		}
				});

				that.qs2 = $selectionSearch.quicksearch(selectionSearchString).on('keydown', function(e){
				  	if (e.which == 40){
					    that.$selectionUl.focus();
					    return false;
				  	}
				});
			},
			afterSelect: function(){
				this.qs1.cache();
				this.qs2.cache();
			},
			afterDeselect: function(){
				this.qs1.cache();
				this.qs2.cache();
			}
		});
  	});

	function checkTypeBanner(mode){
		$("#id_images_banner").css("display", "none");
		$("#id_script_banner").css("display", "none");
		
		if(mode=="images"){
			$("#id_images_banner").css("display", "block");	
		}
		if(mode=="script"){
			$("#id_script_banner").css("display", "block");
		}
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

<script src="assets/plugin/daterangepicker/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function(){
		$('.datepicker_created').datepicker({
		   format: 'dd-mm-yyyy'
		});
	});
</script>