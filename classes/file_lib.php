<?php
class FILE_LIB {
	private $folderUpload; /* resource/upload/content/{id}/ */
	private $defaultValue = ''; /* url image: http(s)://domain/resource/upload/content/{id}/{hinhanh.png} */
	private $divUpload = 'fileUpload'; /* the div chua button click to upload */
	private $urlFile = 'file_url'; /* input file tag */
	private $path = ''; /* level duong dan den resource/upload folder = $LEVEL */
	private $fileExt = 'image/*'; /* file extension */
	private $buttonText; /* text button : click to upload */
	private $buttonLink; /* text button : enter link picture */
	private $_LANG;
	private $maxFileUpload = 1; /* The maximum number of files you can upload*/
	private $path_outside = 0;

	function __construct($arrVal=array()){
		$this->_LANG = unserialize(_LANG);
		$this->set_buttonText($this->_LANG['choose_picture']);
		$this->set_buttonLink($this->_LANG['link_picture']);
	}

	public function set_folderUpload($folderUpload){
		$this->folderUpload = $folderUpload;
	}
	public function set_defaultValue($defaultValue){
		$this->defaultValue = $defaultValue;
	}
	public function set_divUpload($divUpload){
		$this->divUpload = $divUpload;
	}
	public function set_urlFile($urlFile){
		$this->urlFile = $urlFile;
	}
	public function set_path($path){
		$this->path = $path;
	}
	public function set_fileExt($fileExt){
		$this->fileExt = $fileExt;
	}
	public function set_buttonText($buttonText){
		$this->buttonText = $buttonText;
	}
	public function set_buttonLink($buttonLink){
		$this->buttonLink = $buttonLink;
	}
	public function set_maxFileUpload($maxFileUpload){
		$this->maxFileUpload = $maxFileUpload;
	}

/*
*****Upload nhieu file
* $divUpload: #id run script container upload
* $fileExt: dinh dang file duoc upload
* $urlFile: name tag input file url
* $folderUpload: duong dan folder de upload file
*/
function showUploadThumb(){
	$_thumb= new thumb();
	$display = '';
	$display_r = '';
	$display_p = '';
	
	if($this->defaultValue != "" && is_file($_thumb->getPathReal($this->defaultValue))){
		$display = 'style="display:none;"';
		$display_r = 'style="display:none;"';
	}
	if($this->defaultValue == "") $display_r = 'style="display:none;"';
	if($this->path_outside === 0) $display_p = 'style="display:none;"';

	$html='
		<link rel="stylesheet" type="text/css" href="'._ROOT_PATH_WEBSITE.'/assets/plugin/uploadifive/uploadifive.css">
		<script src="'._ROOT_PATH_WEBSITE.'/assets/js/jquery.js" type="text/javascript"></script>
		<script>
		jQuery(document).ready(function() {
			jQuery("#'.$this->divUpload.'").uploadifive({
				
				\'buttonText\': \''.$this->buttonText.'\',
				\'uploadScript\': \''.$this->path.'assets/plugin/uploadifive/uploadifive.php?folder='.$this->folderUpload.'\',				
				\'multi\': false,
				\'fileType\'     : \''.$this->fileExt.'\',
				\'onCancel\' : function() {
					$.post( "'.$this->path.'library/delfile.php", { path: "'.$this->path.''.$this->folderUpload.'"+file.name, file: file.name } );
					jQuery("#'.$this->urlFile.'").val("");
				},
				\'itemTemplate\' : \'<div class="uploadifive-queue-item"><div class="filename"></div><div class="fileinfo"></div><div class="progress-bar"></div></div>\',
				\'onProgress\'   : function(file, e) {
					
		            if (e.lengthComputable) {
		                var percent = Math.round((e.loaded / e.total) * 100);
		            }
		            file.queueItem.find(\'.fileinfo\').html(\' - \' + percent + \'%\');
		            file.queueItem.find(\'.progress-bar-info\').css(\'width\', percent + \'%\');
		        },
				\'onUploadComplete\' : function(file,data) {
					var url_img = data;
					
					value = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'.''.'", "'._ROOT_PATH_WEBSITE."/".'");
					arrsplit=value.split(/\./gi);
					ext=arrsplit[arrsplit.length-1];
					arrfile=value.split(/\//gi);
					filename=arrfile[arrfile.length-1];
							
					value_url = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'.''.'", "../");
					
					if(ext=="jpg"||ext=="jpeg"||ext=="gif"||ext=="png"||ext=="PNG"||ext=="GIF"||ext=="JPG"||ext=="JPEG"||ext=="webp"||ext=="WEBP"){
					jQuery("#imgcontent'.$this->urlFile.'").html(\'\
						<div class="img-wrap mb-3">\
							<span value="\'+value+\'" onclick = "delImage($(this),\\\''.$this->urlFile.'\\\',\\\''.$this->divUpload.'\\\');" class="close">&times;</span>\
							<img style="max-width:200px;border:1px solid #333" src="\'+value+\'">\
						</div>\');	
					
		           		/*$(\'#preview\').css(\'background-image\', \'url(" \'+value+\'  ")\');
						var image = \'<img src="\'+value+\'" >\';
		
						$(\'.img-wrap img\').popover({
						    trigger: \'hover\',
						        placement: \'top\',
						        content  : image,html: true
						});*/
					}else{
					jQuery("#imgcontent'.$this->urlFile.'").html(\'\
						<div class="img-wrap">\
							<a href="\'+value+\'" target=_blank >\'+filename+\' </a>\
							<span value="\'+value+\'" onclick = "delImage($(this),\\\''.$this->urlFile.'\\\',\\\''.$this->divUpload.'\\\');" class="close">&times;</span>\
						</div>\');
					}
					jQuery(".file_'.$this->divUpload.'").hide();		
					jQuery("#'.$this->urlFile.'").val(value);
					jQuery(".uploadifive-queue-item").remove();
		        } 
			});
			jQuery(".class_'.$this->divUpload.'").click(function() {
				jQuery("#'.$this->divUpload.'_url").toggle();
			});
		});
	
		</script>

		<div class="uploadfile_btn file_'.$this->divUpload.'"  '.$display.'>
			<div id="'.$this->divUpload.'"></div>
			<div class="uploadifive-button buttonLink class_'.$this->divUpload.'" id="upload" '.$display_p.'>
				'.$this->buttonLink.'
			</div>
			<div id="'.$this->divUpload.'_url" '.$display_r.' class="mt-2">
			 	<input placeholder="http://demo.com/image.png" type="text" id="'.$this->urlFile.'" name="'.$this->urlFile.'" value="'.$this->defaultValue.'" class=" form-control">
			</div>
		</div>';

	return $html;
}

/*
*****Upload nhieu file
* $flag_*: show field introduction
* $maxFileUpload: so luong toi da hinh anh duoc upload
* $divUpload: #id run script container upload
* $fileExt: dinh dang file duoc upload
* $urlFile: name tag input file url
* $folderUpload: duong dan folder de upload file
*/
function formUploadMultiFile($flag_title=0,$flag_intro=0,$flag_link=0){
	$html = '
		<link rel="stylesheet" type="text/css" href="'._ROOT_PATH_WEBSITE.'/assets/plugin/uploadifive/uploadifive.css">
		<script src="'._ROOT_PATH_WEBSITE.'/assets/js/jquery.js" type="text/javascript"></script>
		<script>
		jQuery(document).ready(function() {
			jQuery("#'.$this->divUpload.'").uploadifive({
				\'uploadLimit\': '.$this->maxFileUpload.',
				\'buttonText\': \''.$this->buttonText.'\',
				\'uploadScript\': \''.$this->path.'assets/plugin/uploadifive/uploadifive.php?folder='.$this->folderUpload.'\',	
				\'fileType\'     : \''.$this->fileExt.'\',
				\'multi\': true,
				\'itemTemplate\' : \'<div class="uploadifive-queue-item w-25 float-start"><a class="close" href="#">X</a><div class="filename"></div><div class="fileinfo"></div><div class="progress-bar"></div></div>\',
				\'onUploadComplete\' : function(file,data) {
					var url_img = data;

					value = url_img.replace("'.$_SERVER['DOCUMENT_ROOT']._SERVER_PATH.'/", "'._ROOT_PATH_WEBSITE."/".'");
					value_url = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/", "'._PHISICAL_PATH_ROOT.'");

					jQuery("#list_gallery").append(\'\
						<div class="list_image col-lg-2 col-sm-3 col-6">\
							<div class="img-wrap mb-1">\
								<span value="\'+value+\'" onclick = "delImageSlide($(this));" class="close">&times;</span>\
								<img style="width:100%;" src="\'+value+\'">\
							</div>';
					    	if ($flag_title == 1) $html .='<input type="text" name="title[]" id="title_image_gallery" class="form-control mb-1" placeholder="'.$this->_LANG['title'].'"> ';
							if($flag_intro == 1) $html .='<textarea class="form-control mb-1" rows="2" name="intro[]" placeholder="'.$this->_LANG['introduction'].'"></textarea>\ ';
							if($flag_link == 1) $html .='<input id="linkUrl" class="form-control mb-1" value="" name="linkUrl[]" placeholder="'.$this->_LANG['link_for_image'].'" type="text">\ ';

							$html .='\
			                <input type="hidden" value="\'+value_url+\'" name="'.$this->urlFile.'" >\
		                </div>\
				   \');
	 			} 
			});
			jQuery(".class_'.$this->divUpload.'").click(function() {
				jQuery("#'.$this->divUpload.'_url").css("display","none");
				jQuery("#'.$this->divUpload.'_upload").css("display","none");
				mode=jQuery(this).attr("id");
				jQuery("#'.$this->divUpload.'_"+mode).css("display","block");
			});
		});
		</script>
		
		<div id="some-queue"></div>
		<div id="'.$this->divUpload.'">You have a problem with your javascript</div>
		<input type="hidden" name="hdact" id="hdact" value="add_store_gallery">
		<input type="hidden" name="file_id" id="file_id" value="">
		<div id="dialog_hidden" name="dialog_hidden" style="display:none"></div>';
	
	return $html;
}

//Show form upload single video
function showUploadVideo($folderupload,$defaultlvalue,$divupload="fileUpload_video",$urlfile="file_url_video",$path="../",$fileExt="application/mp4",$button_text='Chọn video'){
	$display = '';
	//echo _MIMI_TYPE_DOCUMENT;
	$file_size = ini_get('post_max_size').'B';
	$_thumb= new thumb;
	if($defaultlvalue!="" &&  is_file($_thumb->getPathReal($defaultlvalue))) $display = 'style="display:none;"';
	//$folderupload=method::create_folder($path.$folderupload);

	$html='
	<link rel="stylesheet" type="text/css" href="../assets/js/uploadifive/uploadifive.css">
	<script src="../assets/js/jquery.js" type="text/javascript"></script>

	<script>

	jQuery(document).ready(function() {
			var limit_size = jQuery("#file_size").val();
			jQuery("#'.$divupload.'").uploadifive({

				\'buttonText\': \''.$button_text.'\',
				\'uploadScript\': \''.$path.'assets/js/uploadifive/uploadifive.php?folder='.$folderupload.'\',
				\'multi\': false,
				\'fileSizeLimit\' : \''.$file_size.'\',
				\'fileType\'     : [
						\'video/mp4\'
										
					],
				\'onError\'      : function(errorType) {
					if(errorType == "FILE_SIZE_LIMIT_EXCEEDED"){
						var error_text = "Dung lượng upload file tối đa:'.$file_size.'";
					}
		            alert(error_text);
		        },
						
				\'onCancel\' : function() {
					//var url_img = data;
			
					$.post( "delfile.php", { path: "../'.$folderupload.'"+file.name, file: file.name } );
					jQuery("#'.$urlfile.'").val("");
				},
				\'itemTemplate\' : \'<div class="uploadifive-queue-item" style="display:none;"><span class="filename"></span> | <span class="fileinfo"></span></div>\',
				\'onProgress\'   : function(file, e) {
					jQuery(\'.file_fileUpload_video\').hide();
		            if (e.lengthComputable) {
		                var percent = Math.round((e.loaded / e.total) * 100);
		            }
		            jQuery(\'.fileinfo\').html(\'\' + percent + \'%\');
					jQuery(\'.cover_div\').show();
		            jQuery(\'.progress-bar\').css(\'width\', percent + \'%\');
		        },
							
				\'onUploadComplete\' : function(file,data) {
					var url_img = data;
					jQuery(\'.cover_div\').hide();
					value = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'.''.'", "'._ROOT_PATH_WEBSITE."/".'");
					arrsplit=value.split(/\./gi);
					ext=arrsplit[arrsplit.length-1];
					arrfile=value.split(/\//gi);
					filename=arrfile[arrfile.length-1];
				
					value_url = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'.''.'", "../");
			
					if(ext=="mp4"){
					jQuery("#imgcontent'.$urlfile.'").html(\'\
						<div class="img-wrap">\'+value+\'\
							<span value="\'+value+\'" onclick = "delVideo($(this),\\\''.$urlfile.'\\\',\\\''.$divupload.'\\\');" class="close">&times;</span>\
							<video width="400" controls>\
							  <source src="\'+value+\'" type="video/mp4">\
							</video>\
						</div>\
							\');
				
			
		           	$(\'#preview\').css(\'background-image\', \'url(" \'+value+\'  ")\');
							var image = \'<img src="\'+value+\'" >\';
		
							$(\'.img-wrap img\').popover({
							    trigger: \'hover\',
							        placement: \'top\',
							        content  : image,html: true
							});
					}else{
					jQuery("#imgcontent'.$urlfile.'").html(\'\
						<div class="img-wrap" style="font-size:12px;width:auto;padding:5px;font-weight:bold">\
							<a href="\'+value+\'" target=_blank >\'+filename+\' </a>\
							<span value="\'+value+\'" onclick = "delVideo($(this),\\\''.$urlfile.'\\\',\\\''.$divupload.'\\\');" class="close">&times;</span>\
							\
						</div>\
							\');

					}
									
					jQuery(".file_'.$divupload.'").hide();
					jQuery("#'.$urlfile.'").val(value);
		        }
			});

// 			jQuery(".class_'.$divupload.'").click(function() {

// 				jQuery("#'.$divupload.'_url").css("display","none");
// 				jQuery("#'.$divupload.'_upload").css("display","none");
// 				mode=jQuery(this).attr("id");
// 				jQuery("#'.$divupload.'_"+mode).css("display","block");
// 			});
			jQuery(".class_'.$divupload.'").click(function() {
				jQuery("#'.$divupload.'_url").toggle();
			});

	});

	</script>
	<div class="file_'.$divupload.'"  '.$display.'>
		<div id="'.$divupload.'"  style="float:left;"></div>
			
	</div>
	';
	return $html;
}

function showUploadFILE($folderupload,$defaultlvalue,$divupload="fileUpload",$urlfile="file_url",$path=_ROOT_PATH_WEBSITE,$button_text='Choose File',$button_link='URL File'){
	$display = '';
	$_thumb= new thumb;
	if($defaultlvalue!="" &&  is_file($_thumb->getPathReal($defaultlvalue))) $display = 'style="display:none;"';
	if($this->path_outside === 0) $display_p = 'display:none';

	//$folderupload=method::create_folder($path.$folderupload);
	$html='
	<link rel="stylesheet" type="text/css" href="'._ROOT_PATH_WEBSITE.'/assets/js/uploadifive/uploadifive.css">
	<script src="'._ROOT_PATH_WEBSITE.'/assets/js/jquery.js" type="text/javascript"></script>
	
	<script>
			 
	jQuery(document).ready(function() {
			jQuery("#'.$divupload.'").uploadifive({
				
				\'buttonText\': \''.$button_text.'\',
				\'uploadScript\': \''.$path.'/assets/js/uploadifive/uploadifive.php?folder='.$folderupload.'\',				
				\'multi\': false,
				\'fileType\'     : "application/pdf",
				\'onCancel\' : function() {
					
					$.post( "'.$path.'del_file.php", { path: "'.$path.''.$folderupload.'"+file.name, file: file.name } );
					jQuery("#'.$urlfile.'").val("");
				},
				\'itemTemplate\' : \'<div class="uploadifive-queue-item" style=""><div class="filename"></div><div class="fileinfo"></div><div class="progress-bar"></div></div>\',
				\'onProgress\'   : function(file, e) {
					
		            if (e.lengthComputable) {
		                var percent = Math.round((e.loaded / e.total) * 100);
		            }
		            file.queueItem.find(\'.fileinfo\').html(percent + \'%\');
		            file.queueItem.find(\'.progress-bar-info\').css(\'width\', percent + \'%\');
		        },
				\'onUploadComplete\' : function(file,data) {
					var url_img = data;
					
					value = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'.''.'", "'._ROOT_PATH_WEBSITE."/".'");
					arrsplit=value.split(/\./gi);
					ext=arrsplit[arrsplit.length-1];
					arrfile=value.split(/\//gi);
					filename=arrfile[arrfile.length-1];
							
					value_url = url_img.replace("'.$_SERVER['DOCUMENT_ROOT'] ._SERVER_PATH.'/'.''.'", "../");
					
					jQuery("#imgcontent'.$urlfile.'").html(\'\
						<div class="img-wrap" style="font-size:12px;width:auto;padding:5px;font-weight:bold">\
							<span value="\'+value+\'" onclick = "delImagefile_url($(this),\\\''.$urlfile.'\\\',\\\''.$divupload.'\\\');" class="close">&times;</span>\
							<a href="\'+value+\'" target="_blank">\'+filename+\'</a>\
						</div>\
					\');

					jQuery(".file_'.$divupload.'").hide();		
					jQuery("#'.$urlfile.'").val(value);
					jQuery(".uploadifive-queue-item").remove();	
		        } 
			});
	
// 			jQuery(".class_'.$divupload.'").click(function() {
	
// 				jQuery("#'.$divupload.'_url").css("display","none");
// 				jQuery("#'.$divupload.'_upload").css("display","none");
// 				mode=jQuery(this).attr("id");
// 				jQuery("#'.$divupload.'_"+mode).css("display","block");
// 			});
			jQuery(".class_'.$divupload.'").click(function() {
				jQuery("#'.$divupload.'_url").toggle();
			});
	
	});
	
	</script>
	<div class="file_'.$divupload.'"  '.$display.'>
		<div id="'.$divupload.'"  style="float:left;"></div>
			<div  class="uploadifive-button class_'.$divupload.'"  id="upload" style="height:30px;line-height:30px;float:left;width:200px;'.$display_p.'">
				'.$button_link.'
			</div>
			
		<div id="'.$divupload.'_url" style="display:none;margin-top: 14px;width: 100%;float: left;">
				
		 	<input placeholder="http://demo.com/image.png" type="text" id="'.$urlfile.'" name="'.$urlfile.'" value="'.$defaultlvalue.'" class=" form-control">
		</div>
	</div>
	';

	return $html;
}
/////////////////////////
}//end class
?>