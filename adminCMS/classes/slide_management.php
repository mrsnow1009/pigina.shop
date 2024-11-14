<?php
// file_exists(_PATH_FILE_LIB_CLASS)?include_once(_PATH_FILE_LIB_CLASS):die(_PATH_FILE_LIB_CLASS.' khong ton tai');

class slide_management{  

	private $watermark = 0;
	private $thumb_arr;
	private $thumb_index;
	private $path_upload;
	private $node_id;
	private $flag_title = 0;
	private $flag_intro = 0;
	private $flag_link = 0;

	function setWatermark($watermark){
		$this->watermark = $watermark;
	}
	function setThumbArr($thumb_arr){
		$this->thumb_arr = $thumb_arr;
	}
	function setThumbIndex($thumb_index){
		$this->thumb_index = $thumb_index;
	}
	function setPathUpload($path_upload){
		$this->path_upload = $path_upload;
	}
	function setNodeID($node_id){
		$this->node_id = $node_id;
	}
	function setFlagTitlte($flag_title){
		$this->flag_title = $flag_title;
	}
	function setFlagIntro($flag_intro){
		$this->flag_intro = $flag_intro;
	}
	function setFlagLink($flag_link){
		$this->flag_link = $flag_link;
	}
	
	/*
	 * var $code_module to define code of module
	 * var $path_upload to define path contain gallery images
	 * var $thumb to define size of thumbnail images
	 */
	function manageStoreGallery($code_module,$temp_id){
		$html_gallery = '';

		if ($temp_id != 0) {
			$this->setNodeID($temp_id);
		}
		
		$_ARR_SIZE_THUMB	=unserialize($thumb);
		$_FILE_LIB = new FILE_LIB;
		$_thumb= new thumb;

	
		if($id > 0){
			$galleries = $this->getListStoreGallery($id,$code_module);
		}else{
			$galleries = array();
		}

		$hdact = method::_Post('hdact','string');
		
		$msgError = '';
		
		if($hdact == "add_store_gallery"){

			$Session = new Session();
			$username_admin  = $Session->get("username_admin");

			//print_r($_POST);
			//$this->InsertRecord(TBLLIBFILE,array("nodeid"=>$id),"del");
			$gallery_index				= method::_Post('gallery_index','array');
			$title						= method::_Post('title','array');
			$intro						= method::_Post('intro','array');
			$linkUrl        = method::_Post('linkUrl','array');
			//print_r($gallery_index);
			$db= new db_local();
			
			$file_url			= method::_Post("slidethumnail_gallery","array");
			$time_tmp			= method::_Post("time_tmp","string");
			
			
			if( !isset($file_url[0]) )
			{
				//$msgError = _PLEASE_CHOOSE_FILE_TO_UPLOAD;
			}
			
			if($id > 0 && isset($file_url[0])){//update data
				
				$i = 1;
				
			}
			// if(count($file_url) < 1 && $id > 0){
			// 	$field_del=array(
			//         "ID"=>$id,
			//     );
			// 	$errsql=$db->InsertRecord(TBLLIBFILE,$date_form,"del","",0);
			// }

			if(isset($file_url) && count($file_url)>0 && $file_url != false)	{

				//////////////////////////////////////////////////////////////////////////
				// path watermark
				// $stamp_path = _PHISICAL_PATH._WATERMARK_IMG;
				// $opacity_w = _TEXT_OPACITY;
				//////////////////////////////////////////////////////////////////////////
			  
				for($f=0;$f<count($file_url);$f++){
					$fileid 	= $this->getMaxID(TBLLIBFILE,"ID");
						//echo '2'.$time_tmp;
					    $file_url[$f] = trim($file_url[$f]);

						$filepath=$file_url[$f];

						$path_tmp = _PHISICAL_PATH.$path_upload."".$time_tmp."/";
						$pathdes  = _PHISICAL_PATH.$path_upload."".$id."/";

						if($time_tmp){
							if(is_dir($path_tmp) && !is_dir($pathdes))
								rename($path_tmp, $pathdes);
							
							$file_url[$f] = str_replace($time_tmp,$id,$file_url[$f]);
							$filepath=$file_url[$f];
							
						}
						$_thumb->create_folder($pathdes);
						@chmod($pathdes,0777);

						$paththumb=$_thumb->getPathReal($file_url[$f]);

						$filepath=str_replace(_PHISICAL_PATH,"",$file_url[$f]);	
						/////////////////////////////////////////////////////////////////////////
						$check_id_exist = $db->getField(TBLLIBFILE,'ID','source',$filepath);
						// if(!$check_id_exist){
						// 	if ($this->watermark == 1) {
						// 		$add_watermark = $_thumb->watermark_image_no_bg($paththumb,$stamp_path,15,15,$opacity_w);
						// 	}
						// }
						// /////////////////////////////////////////////////////////////////////////
						// $_thumb->create_scaled_image($paththumb, array("upload_dir"=>$pathdes,"arr_size"=>$_ARR_SIZE_THUMB,"index_thumb"=>$this->_thumb_banner));
						
						if(!$check_id_exist){

							$_thumb->create_scaled_image($paththumb, array("upload_dir"=>$pathdes,"arr_size"=>$_ARR_SIZE_THUMB,"index_thumb"=>$this->_thumb_banner));

						    $name_file = basename($file_url[$f]);
						    if (!file_exists($pathdes.$name_file)){
    						    copy($file_url[$f], $pathdes.$name_file);
    						    if (file_exists($paththumb)) {
    						    	unlink($paththumb);
    						    }
						    }
						    /////////////////////////////////////

						    $date_form=array(
						        "ID"=>$fileid,
						        "nodeid"=>$id,
						        "code_module"=>$code_module,
						        /* "source"=>$filepath, */
						        "source"=>$path_upload."".$id."/".$name_file,
						        "`title`"=>htmlentities($title[$f],ENT_QUOTES,'UTF-8'),
						        "`intro`"=>nl2br(htmlentities($intro[$f], ENT_QUOTES, 'UTF-8')),
						        "linkUrl"=>$linkUrl[$f],
						        "`index`"=>$f,
						        "created_date"=>strtotime("now"),
						        "created_by"=>$username_admin
						    );
						    $errsql=$db->InsertRecord(TBLLIBFILE,$date_form,"insert");
						}else {

							$date_form=array(
								"nodeid"=>$id,
								"code_module"=>$code_module,
								"source"=>$filepath,
						        "`title`"=>htmlentities($title[$f],ENT_QUOTES,'UTF-8'),
							    "`intro`"=>nl2br(htmlentities($intro[$f], ENT_QUOTES, 'UTF-8')),
						        "linkUrl"=>$linkUrl[$f],
								"`index`"=>$f,
						        "created_date"=>strtotime("now"),
						        "created_by"=>$username_admin
					);
					//print_r($date_form);
					$errsql=$db->InsertRecord(TBLLIBFILE,$date_form,"update"," source='".$filepath."' and nodeid = '".$id."' ",0);
				}
			}
		
			}			
			$jsscript = '';
			
						
		}
		
		if($hdact == "delete_gallery"){
			//for delete one images
			$file_id		= method::_Post("file_id","int");
			if( $file_id > 0 )
			{
				$arr_id = array($file_id);
				$flagdelete = $this->delete_gallery_images($arr_id);
				
			}
			//end delete one image
			
			//for delete multi images
			$inputFile		= method::_Post("input_file","array");
			if( isset($inputFile[0]) )
			{
				$flagdelete = $this->delete_gallery_images($inputFile);
			}
			//end delete multi image
		}
		$list_images = '';
		
		if($galleries){
			
			foreach( $galleries as $gallery ){
				
				$file_img = str_replace(_ROOT_PATH_WEBSITE."/","",$gallery->source);
				$file_img = _PHISICAL_PATH.$gallery->source;
				$file_img_full = _ROOT_PATH_WEBSITE."/".$gallery->source;
				
				//echo $file_img;
				if($file_img != "" && is_file($file_img) ){
					$intro_gallery = '';
					$desc_gallery =  '' ;
					$linkUrl =  '' ;
					
					if($flag_intro == 1){
					    $intro_gallery = '<input id="title_image_gallery" class=" form-control" value="'.$gallery->title.'" type="text" name="title[]" placeholder="'._TITLE.'">';
					}
					if($flag_desc == 1){
					    $desc_gallery = '<textarea id="txtintro_image_gallery" class=" form-control" name="intro[]" rows="2" placeholder="'._DESCRIPTION.'">'.$content = str_ireplace("<br />", "", $gallery->intro).'</textarea>';
					}
					if($flag_url == 1){
					    $linkUrl = '<input id="linkUrl" class=" form-control" value="'.$gallery->linkUrl.'" type="text" name="linkUrl[]" placeholder="'._LINK_FOR_THIS_IMAGE.'">';
					}
					
					$list_images .= '
						<li style="'.$style.'  " class="list_image" title="'._DRAG_DROP_TO_SHORT.'">
								
							<p class="img-wrap">
								<span value="'.$file_img_full.'" id="'.$gallery->ID.'" onclick = "delImageSlide($(this));" class="close">&times;</span>
								<img height="100" id="'.$gallery->ID.'" style="width:100%;" src="'.$file_img_full.'">
							</p>
							'.$intro_gallery.'
							'.$desc_gallery.'
							'.$linkUrl.'
								
							<p align="center">
								
								<input type="text" style="display:none;" class=" form-control" style="width:100px;margin-bottom: 10px;" name="gallery_index[]" value="'.$gallery->index.'" />
							
								<input type="hidden" style="width:100px" name="slidethumnail_gallery[]" value="'.$file_img.'">
								<input type="hidden" name="gallery_id[]" value="'.$gallery->ID.'" />
								<input type="hidden" name="gallery_fields[]" value="" />
							</p>
						</li>
					';
				}
				
			}
			$html_gallery .= $list_images;
			
		}
		$html = '
 		
			 
			
			<div class="" style="margin:5px 0;padding:0px"> 
			<div style="width:100%;margin-left: 10px;height:30px;" id="rs-tabs-hp" class="">
				
						<p class="img" align="center" style="">
							'.$_FILE_LIB->formUploadMultiFile($path_upload.$id."/",$rid,"fileSlide","slidethumnail_gallery[]","../../","*.jpg;*.jpeg;*.gif;*.png;*.webp;*.JPG;*.JPEG;*.GIF;*.PNG;*.WEBP;",5,$flag_intro,$flag_desc,$flag_url).'
							
						</p>
					
			</div>
				<div id="product-column">
					<div id="rs-tabs-hp" class="container" style="width:100%;margin-top:10px;float:left;">
						<ul id="list_gallery" class="col_new ui-sortable">
							'.$html_gallery.'
						</ul>
					</div> 
				</div>
			
				 
			
			<input type="hidden" name="hdact" id="hdact" value="add_store_gallery">
			<input type="hidden" name="file_id" id="file_id" value="">
			<div id="dialog_hidden" name="dialog_hidden" title="'._WARNING.'" style="display:none"></div>
	 	</div> 
		
		';
		
		return $html.$jsscript;
				
	}
	
	/*
	 * var $code_module to define code of module
	* var $path_upload to define path contain gallery images
	* var $thumb to define size of thumbnail images
	*/
	function list_slide_gallery($code_module='RSPRODUCTS',$path_upload = _PATH_UPLOAD_PRODUCTS,$thumb = _ARR_SIZE_THUMB_PRODUCT,$tem_id=0){
		$_GALLERIES_CORE = new GALLERIES_CORE();
		$id				= method::_Get('id','int');
		$urlfile = '';
		$html_gallery = '';
		$rid = '';
		$jsscript = '';
		$style = '';
		//$errsql=$db->InsertRecord(TBLLIBFILE,$data_form,"update"," ID='".$id."'",0);
		if(!$id){
				
			$id = $tem_id;
		}
		//	echo 1;
		//$module			= method::_Get('module','string');
		$_db 			= new db_local;
		//echo _UPLOAD_BY_FTP;
	
		$_ARR_SIZE_THUMB	=unserialize($thumb);
		$_FILE_LIB = new FILE_LIB;
		$_thumb= new thumb;
	
		if($id > 0)
		{
			//echo $id;
			$galleries = $this->getListStoreGallery($id,$code_module);
				
				
		}
	
				$list_images = '';
	
				if($galleries)
				{
						
					foreach( $galleries as $gallery )
					{
		
						$file_img = str_replace(_ROOT_PATH_WEBSITE."/","",$gallery->source);
						$file_img = _LEVEL_ADMIN.$gallery->source;
						$file_img_full   = _ROOT_PATH_WEBSITE."/".$gallery->source;
						//echo $file_img;
						$_file_img_show  = $_thumb->formatFileUrl($gallery->source,$_ARR_SIZE_THUMB[0]);
						if($file_img != "" && is_file($file_img) ){
							$list_images .= '
								<li style="'.$style.' ">
									
			
										<div class="img-wrap">
											<span value="'.$file_img_full.'"  id="'.$gallery->ID.'" onclick = "delImageSlide($(this));" class="close">&times;</span>
											<a class="fancybox" href="'.$file_img_full.'" rel="group_'.$id.'">
													
													<img width="130" height="100" id="'.$gallery->ID.'" style="max-width:200px;border:1px solid #333" src="'.$_file_img_show.'">
											</a>
										</div>
									
									<p align="center">
										
										<input type="text" style="display:none;" class=" form-control" style="width:100px;margin-bottom: 10px;" name="gallery_index[]" value="'.$gallery->index.'" />
						
										<input type="hidden" style="width:100px" name="slidethumnail_gallery[]" value="'.$file_img.'">
										<input type="hidden" name="gallery_id[]" value="'.$gallery->ID.'" />
										<input type="hidden" name="gallery_fields[]" value="" />
									</p>
								</li>
												
								
												
												
													';
						}
		
					}
					$html_gallery .= $list_images;
					
				}
	
	
				$html = '
		
		
		<div class="" style="margin:5px 0;padding:0px">
			
				<div id="product-column">
					<div id="rs-tabs-hp" class="container" style="width:100%;">
						<ul id="list_gallery" class="col_new ui-sortable">
							'.$html_gallery.'
						</ul>
					</div>
				</div>
		
			
		
			<input type="hidden" name="hdact" id="hdact" value="add_store_gallery">
			<input type="hidden" name="file_id" id="file_id" value="">
			<div id="dialog_hidden" name="dialog_hidden" title="'._WARNING.'" style="display:none"></div>
	 	</div>
	
		';
	
		return $html.$jsscript;
	
	}
	
	function delete_gallery_images($arrFileId){
		$db= new db_local();
		if( !is_array($arrFileId) ) return false;
		$_thumb = new thumb;
		
		$flag = true;
		for($i=0;($i<=count($arrFileId));$i++){
			if($arrFileId[$i] != '' && $arrFileId[$i] > 0)
			{
				$path_file = $db->getField(TBLLIBFILE,"source","ID",$arrFileId[$i]);		
				
				$sqldelete="DELETE FROM ".TBLLIBFILE." WHERE ID=".$arrFileId[$i];
				$errdelete=$db->query($sqldelete);
				//$_thumb->del_File(_LEVEL_ADMIN.$path_file);
				if($errdelete)
				{
					$_thumb->del_File(_LEVEL_ADMIN.$path_file);
				}
				else
				{
					$flag = false;
				}
			}		
		}
		
		return $flag;
	}
	
	
	
	function getListStoreGallery($node_id,$code_module){

		$db=new db_local;
		
		$sql=" select ID, nodeid, code_module, source,`index`, title,intro,linkUrl from ".TBLLIBFILE." where ID>0 ";
		
		if($node_id != ''){
			$sql .= " and nodeid = '".$node_id."' ";
		}
		
		if($code_module != ''){
			$sql .= " and code_module = '".$code_module."' ";
		}
		
		$sql .= " ORDER BY `index` ASC ";
// 		echo $sql; 
		$db->query($sql);
		if($db->num_rows()<=0) return false;// alert::redirect_page('NO_EXIST');
		
		while ($db->next_record()){
			
			$store_gallery[] = $this->formatStoreGalleryObjRecordBD($db->record);
			
		}
		
    	return $store_gallery;
	}
	
	
	function formatStoreGalleryObjRecordBD($objRecordBD){
		
		if(!$objRecordBD) return false;
		
		$gallery = new stdClass;
		
		$gallery->ID			=  $objRecordBD['ID'];
		$gallery->nodeid		=  $objRecordBD['nodeid'];
		$gallery->code_module	=  $objRecordBD['code_module'];
		$gallery->source		=  $objRecordBD['source'];
		$gallery->index			=  $objRecordBD['index'];
		$gallery->title			=  $objRecordBD['title'];
		$gallery->intro			=  $objRecordBD['intro'];
		$gallery->linkUrl		=  $objRecordBD['linkUrl'];
		return $gallery;
	
	}
/////////////////////////////////////////
}
?>