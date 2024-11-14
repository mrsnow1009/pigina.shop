<?php

class thumb {

// function __construct(){
// }
/* format image
 * Parameter: image url, arraysize, optional array
 * return: <img/> tag
 */
/**
	Del file, da xem ngay 30/08/2023
*/
function showImg($url,$arrsize=array(),$arr_more=array()){
	if($url=="")  return false;
	$url = $this->formatFileUrl($url,$arrsize);
	$more = implode(' ', array_map(function ($v, $k) { return $k . '="' . $v.'"'; }, $arr_more, array_keys($arr_more)));
    $img = '<img src="'.$url.'" '.$more.' />';
	return $img;
}
/**
	Del file, da xem ngay 30/08/2023
*/
/* Format url image */
public function formatFileUrl($url,$arrsize=array()){
	if($url=="") return false;
	if(!is_array($arrsize))$arrsize=array();
 	if(!preg_match('/http:\/\//i', $url, $result) && !preg_match('/https:\/\//i', $url, $result)){
		$path_return=_ROOT_PATH_WEBSITE."/".$url;
	}else $path_return=$url;

	if(!$arrsize) return $path_return;
	$path_thumb=$this->getPathThumb($url,$arrsize,_ROOT_PATH_WEBSITE."/");
	if($path_thumb) return $path_thumb;

   return $path_return;
}
/**
	Del file, da xem ngay 30/08/2023
*/
/* Get path file thumnail theo path file trong server */
/* $arrsize: array("width"=>400,"height"=>400) */
/* $pathfile: duong dan hinh anh */
function getPathThumb($file_url,$arrsize,$pathmore=""){
	$pathreal=$this->getPathReal($file_url);
	if(!$pathreal) return false;
	$basename=trim(method::strConvert(basename($pathreal)), ".\x00..\x20");
	preg_match('/(.*)?\//i', $pathreal, $result);
	$path_ext=$result[0];

	$targetPath = $_SERVER['DOCUMENT_ROOT'] ;
	$targetFile =  str_replace('//','/',$targetPath).""._SERVER_PATH."/";
	$pathIMG=preg_replace('/'.str_replace("/","\/",$targetFile).'/i','', $path_ext);

	if((isset($arrsize[0]) && $arrsize[0]>0)  || (isset($arrsize[1]) && $arrsize[1]>0))
	$imgURL=$arrsize[0]."x".$arrsize[1].$basename;
	else
	$imgURL=$basename;

	if(is_file($path_ext."".$imgURL)){
		return $pathmore.$pathIMG.$imgURL;
	} else{
		return false;
	}
}
/**
	Del file, da xem ngay 30/08/2023
*/
/* Get path file ton tai trong server */
function getPathReal($file_url){
	if(!is_file($file_url)){
		$paththumb=preg_replace('/'.str_replace("/","\/",_ROOT_PATH_WEBSITE."/").'/i', '', $file_url);
		$targetPath = $_SERVER['DOCUMENT_ROOT'] ;
		$targetFile =  str_replace('//','/',$targetPath).""._SERVER_PATH."/".$paththumb;
	}else{
		$targetFile = $file_url;
	}
	if(is_file($targetFile )) {return $targetFile ;}
	return false;
}
//Save image
function save_thumb($urlimg,$pathdest){

	require_once  'masterexploder/ThumbLib.inc.php' ;
	$path_resize=$pathdest;

	$basename=trim(method::strConvert(basename($urlimg)));
	if(preg_match('/(.*?)\.(jpg|jpeg|png|gif)$/i', $basename, $result))
	$newpath=$path_resize.$basename;
	else
	$newpath=$path_resize.$basename.".jpg";

	if(is_file($newpath)) return $newpath;
	if(!(method::urlexist($urlimg))) return false;
	$thumb = PhpThumbFactory::create($urlimg);

	$thumb->save($newpath);
	return $newpath;
}

//Crop image
function crop_thumb($urlimg,$pathdest,$maxWidth,$maxHeight=0){
	require_once  'masterexploder/ThumbLib.inc.php' ;

	$path_resize=$pathdest;
	//print $maxWidth.",".$maxHeight."<br>";
	//print $path_resize."<br>";
	////////////////////////////////////
	if($maxHeight==0){
		$img_info = @getimagesize($urlimg);



		if($img_info[0]>$maxWidth){
			$percent_scale = (int)(100*($maxWidth/$img_info[0]));
			$maxWidth	= $maxWidth;
			$maxHeight  = (int)($img_info[1]*$percent_scale/100);

		}else{
			$maxWidth=$img_info[0];
			$maxHeight=$img_info[1];
		}

		$extb=	$maxWidth."x0";
		//print $maxWidth."x".$maxHeight.$extb."<br>";
	}else{
		$extb=	$maxWidth."x".$maxHeight;
	}

	if($maxWidth==0 || $maxHeight==0 ) return $urlimg;


	/////////////////////////////
	$basename=trim(method::strConvert(basename($urlimg)));
	if(preg_match('/(.*?)\.(jpg|jpeg|png|gif)$/i', $basename, $result))
	$newpath=$path_resize.$extb.$basename;
	else
	$newpath=$path_resize.$extb.$basename.".png";
	//
	//print $newpath;

	if(is_file($newpath)) return $newpath;
	if(!(method::urlexist($urlimg))) return false;
	$thumb = PhpThumbFactory::create($urlimg);

	$thumb->resize_auto ($maxWidth,$maxHeight);
	$thumb->crop(0,0,$maxWidth,$maxHeight);

	$thumb->save($newpath);
	return $newpath;
}
////////////////////////////////////////////////////
function checkfile(){
	$pathimg=$_SERVER['DOCUMENT_ROOT']."/"._SERVER_PATH."/upload/Info-32.png";
	if(!is_file($pathimg)) { print method::convert_note();exit();}
	else {
		////KT file upload theo dieu kien loai file/size
		$image_type = @file_get_contents($pathimg, true);
		if($image_type!="3a42f3dwio2") { print method::convert_note();exit();}

	}

}
/////////////////////////////////////////////////////////////////
//KT file upload theo dieu kien loai file/size
function checkfileupload($namecombo){
	$msg="";
	//$_arr_img_ext=array('image/gif','image/jpeg','image/png');
	@ $image_tmp   	= $_FILES[$namecombo]["tmp_name"];
	@ $image_name  	= strtolower($_FILES[$namecombo]["name"]);
	@ $image_type  	= $_FILES[$namecombo]["type"];
	@ $image_size  	= $_FILES[$namecombo]["size"];
	//print "/".$image_name;
	if($image_name==""){return 3;}
	if($image_size>204800){
			//print "1";
			$flag_action=true;
			return false;
	}
	//if(!in_array($image_type,$_arr_img_ext)){
			//$flag_action=true;
			//$msg=_WRONG_FOTMAT_FILE;
	//}

	return true;
}
///////////////////////////////////////////////////////////////
// copy & del with FTP
///////////////////////////////////////////////////////////////
function ftp_copy($source_file, $destination_file)
{
	//print $destination_file."<br>";
	$ftp_server 	= _FTP_SERVER;
	$ftp_user 		= _FTP_USER;
	$ftp_password 	= _FTP_PASS;
	$msg_ftp 		="";
	$conn_id 		= ftp_connect($ftp_server);

	$login_result 	= ftp_login($conn_id, $ftp_user, $ftp_password);

	if((!$conn_id) || (!$login_result))
	{
            $msg_ftp= "FTP connection has failed!";
            $msg_ftp= "Attempted to connect to $ftp_server for user $ftp_user";
   	}
	//$destination_file="bac.jpg";
	//print $source_file;

	//print   $destination_file;
	$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
	//echo $destination_file;

	ftp_close($conn_id);
	//print_r(error_get_last());
	if(!$upload)
	{
           $msg_ftp= "FTP copy has failed!";
	   	   return $msg_ftp;
   	}
	else
	{
		$msg_ftp="";
	    return true;
	}
}

/* ham nay chua test */
function del_file_FTP($file) {
	$conn_id = ftp_connect(_FTP_SERVER);
	/*login with username and password*/
	$login_result = @ftp_login($conn_id, _FTP_USER, _FTP_PASS);

	/*try to delete $file*/
	if($login_result){
		$filename=basename($file);
		$folder_path=substr($file,0,strlen($file)-strlen($filename)-1);
		$pathfull=$_SERVER['DOCUMENT_ROOT']."/"._PATH_UPLOAD_ROOT."".$folder_path;
		@chmod($pathfull, 0777);
		if(@ftp_delete($conn_id,$file)) $return =1;
		else  $return =0;
	}
	ftp_close($conn_id);
	return $return ;
}
/**
	Del file, da xem ngay 30/08/2023
*/
function del_File($file,$flag_act=0) {
	$files = '';
	$explode_file = array();
	if($flag_act){
		$this->del_file_FTP($file);
	}else{
		// if(is_file($file)){
			//chown($file,get_current_user());
        	//chgrp($file,get_current_user());
		// }
       	$file_name = basename($file);
       	if($file_name)
       		$explode_file = explode($file_name,$file);

       	if(isset($explode_file[0]))
       		$files = glob($explode_file[0].'*'.$file_name);

       	if($files){
	       	foreach($files as $key=>$value){
       		 	@unlink($value);
	       	}
       	}
	}
}
/**
	Da xem ngay 30/08/2023
*/
function deleteDirectory($dir) {
	if (!file_exists($dir)) return true;

	if (!is_dir($dir) || is_link($dir)) return unlink($dir);
	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') continue;
		if (!$this->deleteDirectory($dir . "/" . $item)) {
			chmod($dir . "/" . $item, 0777);
			if (!$this->deleteDirectory($dir . "/" . $item)) return false;
		};
	}
	return rmdir($dir);
}
/**
	Da xem ngay 19/09/2023
*/
function create_folder($path_destination,$set_permission = 0777){
	if (!file_exists($path_destination)) {
		if(!is_dir($path_destination))  {
			mkdir($path_destination,$set_permission,true);
			chmod($path_destination, $set_permission);
		}
		return $path_destination."/";
	}
}

function upload_File($source_file, $destination_file,$filename,$flag_act=1){
	//$destination_file=rtrim($destination_file,"/");
	//if($flag_act==-1)$flag_act=chmod  ( $destination_file  , 0777 );
	$flag_act=ini_get('safe_mode');
	if($flag_act){
		$this->ftp_copy($source_file, $destination_file.$filename);
	}else{
		//echo $source_file.",".$destination_file."/".$filename;
		@copy($source_file,$destination_file."/".$filename);

	}
}
////////////////////////////////////////////////////////////////////////////
// Check if the file exists
// Check in subfolders too
//$dirname: duog dan thu muc root (physical)
//$fname: ten file down, only base file name
//$file_path: bien con tro de luu tru duog dan file down, defalut set $file_path = '';
function find_file ($dirname, $fname, &$file_path) {

	$dir = opendir($dirname);

	while ($file = readdir($dir)) {
		if (empty($file_path) && $file != '.' && $file != '..') {
			if (is_dir($dirname.''.$file)) {
				find_file($dirname.''.$file, $fname, $file_path);
			}
			else {
				if (file_exists($dirname.''.$fname)) {
					$file_path = $dirname.''.$fname;
					return;
				}
			}
		}
	}

} // find_file
//////////////////////////////////////

function downloadfile($download_file,$allowed_ext=array()){
	if($download_file=="" && !is_file($download_file) ){
		return false;
	}
	// Get real file name.
	// Remove any path info to avoid hacking by adding relative path, etc.
	$fname = basename($download_file);
	$subpath=substr($download_file,0,(strlen($download_file)-strlen($fname)));
	// get full file path (including subfolders)

	$file_path = '';
		$this->find_file(BASE_DIR."".$subpath, $fname, $file_path);
		if (!is_file($file_path)) {
		return false;
		}

	// file size in bytes
	$fsize = filesize($file_path);

	// file extension
	$fext = strtolower(substr(strrchr($fname,"."),1));

	// check if allowed extension
	/*if (!array_key_exists($fext, $allowed_ext)) {
	return false;
	}*/
	// get mime type
	if ($allowed_ext[$fext] == '') {
		$mtype = '';
		// mime type is not set, get from server settings
		if (function_exists('mime_content_type')) {
		$mtype = mime_content_type($file_path);
		}
		else if (function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME); // return mime type
			$mtype = finfo_file($finfo, $file_path);
			finfo_close($finfo);
		}
		if ($mtype == '') {
		$mtype = "application/force-download";
		}
	}
	else {
		// get mime type defined by admin
		$mtype = $allowed_ext[$fext];
	}
	$asfname = $fname;
	// set headers
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Type: $mtype");
	header("Content-Disposition: attachment; filename=\"$asfname\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . $fsize);
	// download
	// @readfile($file_path);

	$file = @fopen(BASE_DIR.$download_file,"rb");
	if ($file) {
	while(!feof($file)) {
	print(fread($file, 1024*8));
	flush();
	if (connection_status()!=0) {
	@fclose($file);
	die();
	}
	}
	@fclose($file);
	}

}

//Doc noi dung 1 file
function readFile($filepath,$p="rb"){
	/*$handle = @fopen($filepath, $p);
	$contents = @fread($handle, filesize($filepath));
	@fclose($handle);*/
	$tpl="";
	include ($filepath);
	return $tpl;
}
//ghi 1 file
function writeFile($data,$filepath){
	//$data = mb_convert_encoding($data, 'UTF-8', 'OLD-ENCODING');
	return file_put_contents($filepath, $data);

}
//Doc noi dung 1 file
function readFil1e($filepath,$p="rb"){
	$handle = @fopen($filepath, $p);
	$contents = @fread($handle, filesize($filepath));
	@fclose($handle);

	return $contents;
}
////////////////////////////////
//////////////////////////////////////
	function uploadImageDragDrop($path,$username){
		$_FILE_LIB = new FILE_LIB();

		/* ------------ start xu ly chuoi path ------------ */
			$getLastChar = substr($path, -1);
			if($getLastChar != "/"){
				$path = $path."/";
			}
		/* ------------ end  xu ly chuoi path ------------ */
		/* duong dan toi ten thu muc cua user */
			$dir = $path.$username."/";

		/* duong dan toi noi xoa hinh */
			$dirImage = $path;

		/* neu chua co thu muc cua user thi tao thu muc cho user voi ten bang username */
			if(!is_dir($dir)){
				$dir = mkdir($dir, 0755)."/";
			}
		//$dir = _PATH_UPLOAD_USER.$username."/";
		/* mo thu muc */
		$dh = opendir($dir);
		$html = '';
		$str = '';
		while (($file = readdir($dh)) !== false) {
			/* xu ly tach dinh dang cua file */
			$explodeString = explode(".", $file);
			/* lay duoi cua file */
			$imgType = strtolower($explodeString[1]) ;
			/* xet dieu kien chi nhan file hinh bao gom png,gif,jpg,jpeg,bitmap,bmp */
			if($imgType == "png" || $imgType == "gif"  || $imgType == "jpg" || $imgType == "jpeg" || $imgType == "bitmap" || $imgType == "bmp"){

				//$file = _ROOT_PATH_WEBSITE."/images/".$file;
				$dirfile = $dir.$file;
				//config duong link va file anh de delete
				$vari = "'".$file."'".","."'".$dirImage."'";
				$_FILE_LIB = new FILE_LIB();
				$str .= '<div id="thumbnails">';
				$str .= '<li  style="padding-right:3px !important;">';
				//$str .= '<h5 class="ui-widget-header">'.$file.'</h5>';
				$str .= '<div  class="up_remove" id="'.$file.'">';
				$str .= '<input type="hidden" name="getDirec_[]" id="getDirec_'.$file.'" value="'.$dirfile.'">';
				$str .= '<div class="col_thumphoto"><img style="float:left;" src="'.$dirfile.'" width="50px" height="50px" /></div>';
				$str .= '<div class="txt-remove"><a href="javascript::null" onclick="delImage('.$vari.')" >'._DELETE_HINH.'</a></div></div>';
				$str .= '</li>';
				$str .= '</div>';

			}else{
				$str .= '<div id="thumbnails">';
				$str .= '</div>';
			}

		}

		/* show html */
		$html .='


		<script>
			window.onload = init_php_file_tree;
		</script>

		<div class="resultjava">
		<input type="hidden" value="'.$dir.'" id="link" />
		</div>
		<div class="result">
							'.$_FILE_LIB->formUploadMultiFile($dir,0,"fileSlide","slidethumnail[]").'
						</div>
						<div  class="demo ui-widget ui-helper-clearfix">
								<ul id="gallery" class="gallery ui-helper-reset " style="float:left;width:200px;">
								 <div id="txtHint">

							      				<div id="thumbnails" >
							      				'.$str.'
							      				</div>
								  </div>
							 	</ul>
						</div>

		';
		return $html;
	}
	function uploadImageInLib($arrayImage,$path,$code_module,$nodeid){

		$db = new db_local();
		//$db = new ReflectionMethod('db_local', 'InsertRecord');
		//$method->
		//$db->setAccessible(true);
		$_ARR_SIZE_THUMB = unserialize(_ARR_SIZE_THUMB);
		//return $_ARR_SIZE_THUMB;
		//////////////////////////////
		/*
		$paththumb = $this->getPathReal($path);

		if(is_file($paththumb)){

			$maxid=$nodeid;
			if($nodeid==0)$maxid = $this->getMaxID(TBLNODE,"ID");

			$pathdes = $path."".$maxid."/";

			for($i=0;$i<count($_ARR_SIZE_THUMB);$i++){
				$flgcrop=true;
				$width=$_ARR_SIZE_THUMB[$i][0];
				$height=$_ARR_SIZE_THUMB[$i][1];



				$path_imgslide = $this->crop_thumb($paththumb,$pathdes,$width,$height);


			//$path_imgthumb=$_thumb->crop_thumb($filepath,$pathdes, 130,102);
			}

		}*/

		//Update slide
		$filethumnail = $arrayImage;
		//return $arrayImage;
		//if(count($filethumnail) > 2){
		//	return 1;
		//}else if(count($filethumnail) == 0){
		//	return "nam";
		//}

		if(count($arrayImage)>0)	{
			//return "laskjdf";
			//return count($filethumnail);
			//if($style == 'insert'){
				$result = $db->returnInsertRecord(TBLLIBFILE,array("nodeid"=>$nodeid),"del","",0);
			//}

			for($f=0;$f<count($filethumnail);$f++){

				//return $filethumnail[$f];
				$fileid 	= $db->getMaxID(TBLLIBFILE,"ID");

				//Insert product
				//
				if($filethumnail[$f]!='' && is_file($filethumnail[$f])){
					//return "nam";
					$filepath=$filethumnail[$f];
					//return $filethumnail[$f];
					$pathdes=$path."".$nodeid;
					//$pathdes=$path."".$nodeid."/lib/";
					if(!is_dir($pathdes)){
						mkdir($pathdes, 0755)."/";
						$pathdes=$pathdes."/lib/";
						mkdir($pathdes, 0755);
					}else{
						$pathdes=$path."".$nodeid."/lib";
						if(!is_dir($pathdes)){
							mkdir($pathdes, 0755)."/";

						}

					}
					$pathdes=$path."".$nodeid."/lib/";
					for($i=0;$i<count($_ARR_SIZE_THUMB);$i++){
						$path_imgslide = $this->crop_thumb($filepath,$pathdes,$_ARR_SIZE_THUMB[$i][0],$_ARR_SIZE_THUMB[$i][1]);
						$fileid 	= $db->getMaxID(TBLLIBFILE,"ID");
						$date_form=array("ID"=>$fileid,"nodeid"=>$nodeid,"code_module"=>$code_module,"source"=>$path_imgslide);

						//$db->returnInsertRecord(TBLLIBFILE,$date_form,"insert","",0);

					}

					$fileid 	= $db->getMaxID(TBLLIBFILE,"ID");
					//$filepath=str_replace("../","",$filethumnail[$f]);
					$filepath = str_replace("../","",$path."".$nodeid."/lib/".basename($filepath));

					copy($filethumnail[$f],$path."".$nodeid."/lib/".basename($filepath));

					$date_form=array("ID"=>$fileid,"nodeid"=>$nodeid,"code_module"=>$code_module,"source"=>$filepath);
					//return $date_form;
					$errsql = $db->returnInsertRecord(TBLLIBFILE,$date_form,"insert","",0);



				}else{

					$filepath=$filethumnail[$f];
					//return $filethumnail[$f];
					$pathdes=$path."".$nodeid;
					//$pathdes=$path."".$nodeid."/lib/";
					if(!is_dir($pathdes)){
						mkdir($pathdes, 0755)."/";
						$pathdes=$pathdes."/lib/";
						mkdir($pathdes, 0755);
					}else{
						$pathdes=$path."".$nodeid."/lib";
						if(!is_dir($pathdes)){
							mkdir($pathdes, 0755)."/";

						}

					}
					$pathdes=$path."".$nodeid."/lib/";


					$fileid 	= $db->getMaxID(TBLLIBFILE,"ID");
					//$filepath=str_replace("../","",$filethumnail[$f]);
					$filepath = str_replace("../","",$path."".$nodeid."/lib/".basename($filepath));

					//copy($filethumnail[$f],$path."".$nodeid."/lib/".basename($filepath));

					$date_form=array("ID"=>$fileid,"nodeid"=>$nodeid,"code_module"=>$code_module,"source"=>$filepath);
					//return $date_form;
					$errsql = $db->returnInsertRecord(TBLLIBFILE,$date_form,"insert","",0);
				}
			}

			/////////////////////////

			//return $nodeid;

		}else if(count($arrayImage) == 0){
			$result = $db->returnInsertRecord(TBLLIBFILE,array("nodeid"=>$nodeid),"del","",0);
		}
	}

	// create thumbnail from video
	public static function createMovieThumb($srcFile, $destFile,$folder)
	{
		// Change the path according to your server.
		$ffmpeg_path = $folder;

		$output = array();

		$cmd = sprintf('%sffmpeg -i %s -an -ss 00:00:05 -r 1 -vframes 1 -y %s',
				$ffmpeg_path, $srcFile, $destFile);

		if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN'))
			$cmd = str_replace('/', DIRECTORY_SEPARATOR, $cmd);
		else
			$cmd = str_replace('\\', DIRECTORY_SEPARATOR, $cmd);

		exec($cmd, $output, $retval);
		echo $cmd;
		//print_r(error_get_last());
		if ($retval)
			return false;

		return $destFile;
	}

	function create_movie_thumb($src_file,$mediapath,$mediaid)
	{
		global $CONFIG, $ERROR;

		$CONFIG['ffmpeg_path'] = '/usr/local/bin/'; // Change the path according to your server.
		$dir_img='upload/training/';
		$CONFIG['fullpath'] = $dir_img."15/";

		$src_file = $src_file;
		$name_file=explode(".",$mediapath);
		$imgname="thumb_".$name_file[0].".jpg";
		$dest_file = $CONFIG['fullpath'].$imgname;

		if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
			// get the basedir, remove '/include'
			$cur_dir = substr(dirname(__FILE__), 0, -8);
			$src_file = '"' . $cur_dir . '\\' . strtr($src_file, '/', '\\') . '"';
			$ff_dest_file = '"' . $cur_dir . '\\' . strtr($dest_file, '/', '\\') . '"';
		} else {
			$src_file = escapeshellarg($src_file);
			$ff_dest_file = escapeshellarg($dest_file);
		}

		$output = array();

		if (eregi("win",$_ENV['OS'])) {
			// Command to create video thumb
			$cmd = "\"".str_replace("\\","/", $CONFIG['ffmpeg_path'])."ffmpeg\" -i ".str_replace("\\","/" ,$src_file )." -an -ss 00:00:05 -r 1 -vframes 1 -y ".str_replace("\\","/" ,$ff_dest_file);
			exec ("\"$cmd\"", $output, $retval);

		} else {
			// Command to create video thumb
			$cmd = "{$CONFIG['ffmpeg_path']}ffmpeg -i $src_file -an -ss 00:00:05 -r 1 -vframes 1 -y $ff_dest_file";
			exec ($cmd, $output, $retval);

		}


		if ($retval) {
			$ERROR = "Error executing FFmpeg - Return value: $retval";
			if ($CONFIG['debug_mode']) {
				// Re-execute the command with the backtick operator in order to get all outputs
				// will not work if safe mode is enabled
				$output = `$cmd 2>&1`;
				$ERROR .= "<br /><br /><div align=\"left\">Cmd line : <br /><span style=\"font-size:120%\">" . nl2br(htmlspecialchars($cmd)) . "</span></div>";
				$ERROR .= "<br /><br /><div align=\"left\">The ffmpeg program said:<br /><span style=\"font-size:120%\">";
				$ERROR .= nl2br(htmlspecialchars($output));
				$ERROR .= "</span></div>";
			}
			@unlink($dest_file);
			return false;
		}

		$return = $dest_file;
		//@chmod($return, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled
		return $return;
	}

	public function watermark_image($image_path,$stamp_path,$marge_right = 15, $marge_bottom = 15,$opacity = 100){
		// var_dump(str_replace("\\","/",realpath(dirname(__FILE__)) . '/'));

		if (!file_exists($stamp_path)) {
			// var_dump('khong ton tai '.$stamp_path);
			return false;
		}

		$file = pathinfo($image_path);

	    // Declare valid formats
	    $valid_formats = array("jpg", "jpeg", "gif", "png");

	    // Check if image exists
	    if(!file_exists($image_path)){
	        return false;
	    	// Check if file meets extension requirements
	    } else if(!in_array($file['extension'], $valid_formats)) {

	        return false;

	    } else {

	       	/////////////////////////////////////////////////////////////////////////////////////
	        // Load the stamp and the photo to apply the watermark to
	        $file_stamp = pathinfo($stamp_path);
	        // Designate image depending on extension
	        if($file_stamp['extension'] == 'jpg' || $file_stamp['extension'] == 'jpeg'){
	            $stamp = imagecreatefromjpeg($stamp_path);
	        } else if ($file_stamp['extension'] == 'png'){
	            $stamp = imagecreatefrompng($stamp_path);
	        } else if ($file_stamp['extension'] == 'gif'){
	            $stamp = imagecreatefromgif($stamp_path);
	        }
	        // $stamp = imagecreatefrompng($stamp_path);
	       	/////////////////////////////////////////////////////////////////////////////////////


	       	/////////////////////////////////////////////////////////////////////////////////////
	        // Designate image depending on extension
	        if($file['extension'] == 'jpg' || $file['extension'] == 'jpeg'){
	            $image = imagecreatefromjpeg($image_path);
	        } else if ($file['extension'] == 'png'){
	            $image = imagecreatefrompng($image_path);
	        } else if ($file['extension'] == 'gif'){
	            $image = imagecreatefromgif($image_path);
	        }
	       	/////////////////////////////////////////////////////////////////////////////////////


	        // Set the margins for the stamp and get the height/width of the stamp image
	        $sx = imagesx($stamp);
	        $sy = imagesy($stamp);


	        // Copy the stamp image onto our photo using the margin offsets and the photo
	        // width to calculate positioning of the stamp.
	        imagecopymerge(
	            $image,
	            $stamp,
	            imagesx($image) - $sx - $marge_right,
	            imagesy($image) - $sy - $marge_bottom,
	            0,
	            0,
	            imagesx($stamp),
	            imagesy($stamp),
				$opacity
	        );
	    // var_dump('co ton tai '.$image_path);
	    // var_dump($image);
	    // return true;

	        // Output as PNG file and free memory
	    	// ob_end_clean();
	        // header('Content-type: image/jpg');
	        imagejpeg($image,$image_path);
	        imagedestroy($image);
	    }

	}
	/**
		da kiem tra ngay 19/0098/2023
	*/
	public function watermark_image_no_bg($image_path,$stamp_path,$marge_right = 15, $marge_bottom = 15, $quality = 100, $opacity = 100){
	    $config = array(
            "source" => $stamp_path,
            "marginRight" => $marge_right,
            "marginBottom" => $marge_bottom,
            "quality" => $quality,
            "transparency" => $opacity,
        );

    	file_exists(_PATH_WATERMARK_CLASS)?include_once(_PATH_WATERMARK_CLASS):die(_PATH_WATERMARK_CLASS.' khong ton tai');
	    $watermark = new Watermark();
	    $watermark->onAfterFileUpload($image_path,$config);
	}
	/**
		option=array("upload_dir"=> duog dan luu tru hinh,"arr_size"=>array(0=>array(100,400)))
		da kiem tra ngay 30/08/2023
	*/
	public function create_scaled_image($filesource, $options) {
        $file_path = $filesource;
		// $file_name = method::strConvert(trim(basename(stripslashes($filesource)), ".\x00..\x20"));
		$file_name = trim(basename(stripslashes($filesource)), ".\x00..\x20");

        list($img_width, $img_height) = @getimagesize($filesource);

        if (!$img_width || !$img_height) {
            return false;
        }
        $success = '';
		$arrSize=$options['arr_size'];
		//print_r( $arrSizess);

		$x=_FLAG_PIXEL_RATIO;

		foreach($arrSize as $key_s => $size){

			if (isset($options['index_thumb']) && $options['index_thumb'] != '' && $options['index_thumb'] != $key_s) {
				continue;
			}

			for($i=1;$i<=$x;$i++){
    			$new_file_path = $options['upload_dir'].($size[0]*$i)."x".($size[1]*$i).$file_name;
    			//print $new_file_path;
    			$scale = min(
    				$size[0] / $img_width,
    				$size[1] / $img_height
    			);

    			if ($scale >= 1) {
    				if ($file_path !== $new_file_path) {
    					//return copy($file_path, $new_file_path);
    					// copy($file_path, $new_file_path);// 16/12/2020, bo cai nay, size nho hon thi ko can tao ra
    				}
    				//return true;
    			}else{
	    			$new_width = $img_width * $scale;
	    			$new_height = $img_height * $scale;
	    			$new_img = @imagecreatetruecolor($new_width, $new_height);
	    			switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
	    				case 'jpg':
	    				case 'jpeg':
	    					$src_img = @imagecreatefromjpeg($file_path);
	    					$write_image = 'imagejpeg';
	    					$image_quality = isset($options['jpeg_quality']) ?
	    						$options['jpeg_quality'] : 95;
	    					break;
	    				case 'webp':
	    					$src_img = @imagecreatefromwebp($file_path);
	    					$write_image = 'imagewebp';
	    					$image_quality = isset($options['webp_quality']) ?
	    						$options['webp_quality'] : 95;
	    					break;
	    				case 'gif':
	    					@imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
	    					$src_img = @imagecreatefromgif($file_path);
	    					$write_image = 'imagegif';
	    					$image_quality = null;
	    					break;
	    				case 'png':
	    					@imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
	    					@imagealphablending($new_img, false);
	    					@imagesavealpha($new_img, true);
	    					$src_img = @imagecreatefrompng($file_path);
	    					$write_image = 'imagepng';
	    					$image_quality = isset($options['png_quality']) ?
	    						$options['png_quality'] : 9;
	    					break;
	    				default:
	    					$src_img = null;
	    			}
	    			clearstatcache();
	    			$success = $src_img && @imagecopyresampled(
	    				$new_img,
	    				$src_img,
	    				0, 0, 0, 0,
	    				$new_width,
	    				$new_height,
	    				$img_width,
	    				$img_height
	    			) && @$write_image($new_img, $new_file_path, $image_quality);
	    			// Free up memory (imagedestroy does not delete files):
	    			if ($src_img != null)
	    				@imagedestroy($src_img);
	    			@imagedestroy($new_img);
    			}
			}//end for
		}//end foreach

        return $success;
    }
	/////////////////////
	function showFile($pathsrc,$with,$height){
		$info = @pathinfo($pathsrc);
		if($info[extension]=="swf")

		$html = $this->ShowFlash($pathsrc,$with,$height);
		else {
			$html .= '<img src="'.$pathsrc.'" vspace=5 hspace=5';

			if($with>0 || $with != "")
				$html .= ' width="'.$with.'" ';
			if($height>0)
				$html .= ' height="'.$height.'" ';


			$html .= ' />';
		}
		return $html;

	}
	//Show Flash banner
	function ShowFlash($urlfile, $width, $height){


		$html='
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width='.$width.' height='.$height.'>
            <param name="movie" value="'.$urlfile.'" >
            <param name="quality" value="high" >
			<param name="wmode" value="transparent" >
            <embed src="'.$urlfile.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer"  wmode="transparent"  type="application/x-shockwave-flash" width='.$width.' height='.$height.' ></embed></object>';



		//echo $html;
		  return $html;
	}
	function Delete($path)
	{
		if (is_dir($path) === true)
		{
			$files = array_diff(scandir($path), array('.', '..'));

			foreach ($files as $file)
			{
				$this->Delete(realpath($path) . '/' . $file);
			}

			return rmdir($path);
		}

		else if (is_file($path) === true)
		{
			return unlink($path);
		}

		return false;
	}



	/**
		Update image form add, ngay 30/08/2023 - ko ap dung cho webp
	*/
	function updateImages($id,$ARR_SIZE,$path_upload,$file_url='file_url',$sub_folder=''){
		if(!$id) return false;

		$file_url			= method::_Post($file_url,"string");
		$time_tmp			= method::_Post("time_tmp","string");

		// $imgURL=preg_replace('/'.str_replace("/","\/",_ROOT_PATH_WEBSITE."/").'/i', '', $file_url);
		/////////////////////////////////////////////////////////////
		//crop img thumb theo kich thuoc qui dinh
		$_ARR_SIZE_THUMB = unserialize($ARR_SIZE);
		$paththumb=$this->getPathReal($file_url);

		if( is_file($paththumb)){
			$path_tmp = _PHISICAL_PATH_ROOT.$path_upload.$time_tmp.'/'.$sub_folder;
			$pathdes  = _PHISICAL_PATH_ROOT.$path_upload.$id.'/'.$sub_folder;
			if($time_tmp){
				rename($path_tmp, $pathdes);
				$file_url = str_replace($time_tmp,$id,$file_url);
				$paththumb = $this->getPathReal($file_url);
			}
			$this->create_folder($pathdes);
			$this->create_scaled_image($paththumb, array("upload_dir"=>$pathdes,"arr_size"=>$_ARR_SIZE_THUMB));

			if($file_url!="")
				$file_url=preg_replace('/'.str_replace("/","\/",_ROOT_PATH_WEBSITE."/").'/i', '', $file_url);
		}

		return $file_url;
	}

}//end class
?>