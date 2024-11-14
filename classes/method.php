<?php 
class method{

	public static function _Get($var_name,$format){
		if(!in_array($format,array("string","int","html","all","array")))return false;
		if (!isset($_GET[$var_name])){
			return false;
		}
		$var_value=$_GET[$var_name];
		if ($format != 'array') {
			$var_value=trim($_GET[$var_name]);
			$var_value=htmlspecialchars($var_value, ENT_QUOTES, "UTF-8");
		}
		switch ($format){
			case "string": return self::replaceHtml($var_value); break;
			case "int": return (int)preg_replace("'/^-?[0-9]{1,4}$/'","",$var_value);break;
			// case "html":return self::cleanHTML($var_value); break;
			case "html":return $var_value; break;
			case "array": return $_GET[$var_name]; break;
			case "all":return $var_value; break;
		}
	}

	public static function _Post($var_name,$format){
		if(!in_array($format,array("string","int","html","all","array")))return false;
		if (!isset($_POST[$var_name])){
			return false;
		}
		$var_value ='';
		if(!is_array($_POST[$var_name]))
			$var_value=trim($_POST[$var_name]);
		$var_value=htmlspecialchars($var_value, ENT_QUOTES, "UTF-8");
	
		switch ($format){
			case "string": return self::replaceHtml($var_value); break;
			case "int": return (int)preg_replace("'/^-?[0-9]{1,4}$/'","",$var_value);break;
			// case "html": return self::cleanHTML($var_value); break;
			case "html": return $var_value; break;
			case "array": return $_POST[$var_name]; break;
			case "all": return $var_value; break;
		}
	}

	public static function _Request($var_name,$format=''){
		if(!in_array($format,array("string","int","html","all")))return false;
		if (!isset($_REQUEST[$var_name])){
			return false;
		}
		$var_value=trim($_REQUEST[$var_name]);
		$var_value=htmlspecialchars($var_value, ENT_QUOTES, "UTF-8");
		switch ($format){
			case "string": return self::replaceHtml($var_value); break; break;
			case "int":  return (float)preg_replace("/[^0-9.]/","",$var_value);break;
			// case "html": return self::cleanHTML($var_value); break;
			case "html": return $var_value; break;
			case "all": return $var_value; break; 
		}
	}

	/*
		replace cac the html
		$tagAllow: ma tag cho phep ton tai trong chuoi str 
	*/
	static function replaceHtml($str,$tagAllow=''){
		while($str != strip_tags($str,$tagAllow)) {
		   $str = addslashes(strip_tags($str,$tagAllow));
		}
		return $str;	 
	}

	public static function cleanHTML($html) {
	    /// <summary>
	    /// Removes all FONT and SPAN tags, and all Class and Style attributes.
	    /// Designed to get rid of non-standard Microsoft Word HTML tags.
	    /// </summary>
	    // start by completely removing all unwanted tags
	
		///////////////////////////////////////////////////////
	    // $html = @preg_replace("/<(/)?(xml|style|w|o)[^>]*>/","",$html);
		///////////////////////////////////////////////////////
	
	    // then run another pass over the html (twice), removing unwanted attributes
	
	    /*$html = ereg_replace("<([^>]*)(class|lang|style|size|face)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>","<\\1>",$html);
	     $html = ereg_replace("<([^>]*)(class|lang|style|size|face)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>","<\\1>",$html);*/
	
	    return $html;
	}

	/*
		ramdon chu va so
	*/
	public static function get_random_string($len=8,$salt="") { 
		if($salt=="")
			$salt = "ABCDEFGHIJKLMNOPRQSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
		$str = '';
		srand((double)microtime()*1000000); 
		$i = 0; 
		while ($i <= $len) { 
			$num = rand() % strlen($salt); 
			$tmp = (string)substr($salt, $num, 1); 
			$str = (string)$str . $tmp; 
			$i++; 
		} 
		return $str; 
	}

	/*
		gui mail
	*/
	// public static function sendMail($emailTO, $Subject, $body,$path_attachement="",$emailREPLY=_EMAIL_CONTACT,$name_from=_SERVER_NAME,$email_from=_ACCOUNT_MAIL){
	public static function sendMail($emailTO, $Subject, $body,$path_attachement="",$emailREPLY='minhnhat@redsun.vn',$name_from=_SERVER_NAME,$email_from='developer@redsun.vn'){
		include_once(_PATH_PHPMAILER_CLASS);
		include_once(_PATH_PHPMAILER_EXCEPTION_CLASS);
		include_once(_PATH_PHPMAILER_SMTP_CLASS);


		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
			$mail->CharSet  = "utf-8";
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output || SMTP::DEBUG_SERVER || 2 || 1
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'minhnhat.yuzuki.241012@gmail.com';                     //SMTP username
		    $mail->Password   = 'ojhstgqnklfijtvl';                               //SMTP password
		    // $mail->Port       = _SMTP_PORT;                             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		    $mail->Port       = 587;                             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		 //    if(_SMTP_PORT == '465'){
			    // $mail->SMTPSecure = "ssl";
			// }

		    //Recipients
		    $mail->setFrom($email_from, $name_from);
		    // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
		    $mail->addAddress($emailTO);               //Name is optional
		    $mail->addReplyTo($emailREPLY, '');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    //Attachments
		    if ($path_attachement != '') {
			    $mail->addAttachment($path_attachement);         //Add attachments
			    // $mail->addAttachment($path_attachement, 'newName.jpg');    //Optional name
		    }

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $Subject;
		    $mail->Body    = $body;
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    return $mail->send();
		    
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		return false;
	}

	public static function alert($str,$url=''){
		echo"<script> alert(\"".$str."\");";
		if($url!="") echo " location.href='".$url."';";
		else echo" window.close();";
		echo"</script> ";
	}

	/*
		create combo with disabled option
	*/
	public static function html_option($arr,$node,$arr_disable = array()){
		$html ="";
		foreach($arr as $id=>$value) {
			$html .="<option  value=\"".$id."\" ";
			if(trim($node)==trim($id)) $html .=" selected='selected' ";
			if (in_array($id, $arr_disable)) $html .=" disabled='disabled' ";
			$html .=">".$value;
			$html .="</option>";
		}
		return $html;
	}
	
	/*
		create combo with array
	*/
	public static function combo_arr($arr,$key){
		$str ='';
		foreach($arr as $id => $value) {
			$str .= '<option value="'.$id.'" ';
			if(trim($key) == trim($id)) $str .=' selected="selected" ';
			$str .= '>'.$value;
			$str .= '</option>';
		}
		return $str;
	}

	/*
		create combo with array - disable
	*/
	public static function combo_arr_with_disabled($arr,$key,$arr_disable){
		$str = '';

		foreach($arr as $id => $value) {
			if(in_array($id, $arr_disable)){
				$str .='<option value="'.$id.'" disabled>'.$value.'</option>';
			}else{
				$str .='<option  value="'.$id.'" ';
				if(trim($key)==trim($id)) $str .=' selected ';
				$str .='>'.$value.'</option>';
			}
		}
		return $str;
	}
	
	/**
	 * get Current page - link
	 */
	public static function curPageURL() {
		$pageURL = 'http';
		if(!isset($_SERVER["HTTPS"]))$_SERVER["HTTPS"]="";
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
		 $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
		 $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
   }

	public static function pathweb($arr=array(),$url='',$flgurl=true,$rewrite=_FLG_REWRITE,$lang=true) {
		$code = '';
		$module = '';
		$value ="";
		$db = new database();
		if($url==""){
			$_SYSTEM_PAGE=unserialize(_SYSTEM_PAGE);
			if(isset($arr['module']))
				$code= self::reconvert_module($arr['module']);
			
			if(isset($_SYSTEM_PAGE[$code]))
				$url=$_SYSTEM_PAGE[$code];
		}
		//}
		$querystring = array();
		$querystring_rw = array();
		$urlw11 = '';
		$urlw12 = '';
		$flag_video = 0;
		$slash_module = '';// dung de phan biet cac module khi rewrite
		$flag_member = 0;
		$lang = '';
		$value_more = '';
		$more = '';
		$flash = '';
		$flag_blog = 0;
		$flag_cart = 0;
		$flag_brand = 0;
		$value_brand = '';
		$id ='';
		$flag_timkiem = 0;
		foreach($arr as $id=>$value) {
			$flag = 0;
			$module = '';
			$urlseo=$value;
			/////////////////////////
			if($id=="module" ){
				switch($value){
					case "gallery":
						$urlseo="gallery";
						$module = 'gallery';
						$flash = 'gallery';
					break;
					case "product":
						$urlseo="memberships";
						$module = 'product';
						$flash = 'product';
					break;
					case "content":
						$urlseo="noi-dung";
						$module = 'content';
						$flash = 'content';
						break;
					case "widget":
						$urlseo="widget";
						$module = 'widget';
						break;
					case "member":
						$urlseo="member";
						$module = 'member';
						$flash = 'member';
					break;
					case "tournament":
						$urlseo="tournament";
						$module = 'tournament';
						$flash = 'tournament';
					break;
				}
			}
			//////////////////////
			if($id=="item"){
				$flag_item = 1;
			}
			if($id=="act"){
				switch( $value){
					case "search":
						$urlseo="tim-kiem";
						if (_ACTIVE_LANG == 'EN') {
							$urlseo="search";
						}
						$flag_timkiem = 1 ;
					break;
					case "contactus":
						$urlseo="lien-he";
						$flag = 1;

						break;
				}
			}
	        if($id=="item" ||$id=="id"||$id=="cate"||$id=="module"||$id=="act")	{
				if(
					$module=="content" || $module=="gallery" || 
					$module=="widget" || $module=="product" ||
					$module=="member"  ||
					$module=="tournament" 
				){
						$urlw11 .="";
				}
				else{
					if($flag_member == 1 && $id=="cate"){
						
						$urlw11 .="/cate/".$urlseo;
						
					}else{
						$urlw11 .="/".$urlseo;
					}
					
				}
			}else	{
				if($id=="order" ){
					$urlw11 .="/".$value;
				}else if($id=="page" || $id=="oid"|| $id=="email"||$id=="email_user"||$id=="flgchange"){
					
					$urlw12 .="/".$id."/".$value;
				}
				else if($id=="nologin"){
					$more = "?".$id."=".$value;
					
				}
			}

			 $querystring[$id] = $id."=".$value;

			 if ($id == 'lang') {
			 	$querystring_rw[$id] = $id."=".$value;
			 }
		}
		$urlw1 =$urlw11.$urlw12;

		/////////////////////////
		$temp="";
		if(isset($_GET["template"]))$temp="&template=".$_GET["template"];
		$strlang="";
		
		
		if($rewrite==0 || $module == 'notice' || $flag_timkiem == 1 || $flag_cart ==1 || $url == 'view_video.php') {

			if ($id=="act" && $flag_timkiem == 1){
			    $PATH=_ROOT_PATH_WEBSITE.$urlw1.".html";
			}else{
			    $query =implode("&", array_values($querystring));
			    $PATH=_ROOT_PATH_WEBSITE."/".$url."?".$query.$temp;
			}
			
			//echo $PATH.'<br>';
		}else{
			
			//$url="";
			$query =$urlw1 ;
			if($value == 'notice'){
				$PATH=_ROOT_PATH_WEBSITE.$lang."/".$url."?".$query.$temp;
			} else if($url =='index.php')
			{
				$PATH=_ROOT_PATH_WEBSITE.$lang.'';
			} else{
				
				$keywords = method::_Get('keywords', 'string');
				$more_url = '';

				$querystring_rw =implode("&", array_values($querystring_rw));
				if ($querystring_rw) {
					$more_url = "?".$querystring_rw;
				}
				
				if($flash == 'gallery'){
					if($flag_brand == 1){
						$PATH=_ROOT_PATH_WEBSITE.$lang.$query.'.htm?brand='.$value_brand;
					}else{
						$PATH=_ROOT_PATH_WEBSITE.$lang.$query.'/'.$more_url.$more;
					}
				// }else if($flash == 'product' ){
				// 	$PATH=_ROOT_PATH_WEBSITE.$lang.$query.'.htm'.$more_url;
				}else if($flash == 'member' ){
					$PATH=_ROOT_PATH_WEBSITE.$lang.$query.'.htm'.$more_url;
				}else if($flash == 'content' ){
					$PATH=_ROOT_PATH_WEBSITE.$lang.$query.'/'.$more_url;
				}else {
					if(!isset($query) || $query == '') $PATH=_ROOT_PATH_WEBSITE.'error.html';
					return _ROOT_PATH_WEBSITE.$lang.$query.'.html'.$more_url.$more;
				}
					
			}


		}
		
		if($flgurl)
			return $PATH;
		else
			return $query;
	}

	public static function reconvert_module($module_code){
		if(!$module_code) return false;
		$_SYSTEM_VAR=unserialize(_SYSTEM_VAR);	
		$module = array_search($module_code,$_SYSTEM_VAR);
		if($module==""){ print "Module không tồn tại ".$module;die; }
		return $module;
	}
	public static function convert_module($module_code){
		if(!$module_code) return false;
		$module="";
		$_SYSTEM_VAR=unserialize(_SYSTEM_VAR);	
		$module= isset($_SYSTEM_VAR[$module_code])?$_SYSTEM_VAR[$module_code]:"";
		return $module;
	}

	public static function flag_lang($lang) {
		$_ARR_FLAG_LANG = unserialize(_ARR_FLAG_LANG);
		if (isset($lang)) {
			return $_ARR_FLAG_LANG[$lang];
		}
	}
	public static function checkbox_array($arr,$name_radio,$arr_value,$flag_all=0){
		$html = '';
		foreach($arr as $key => $val){
			$checked = '';
			if(!is_array($arr_value)) $arr_value=array();
			if(in_array($key,$arr_value) || $flag_all == 1) $checked =" checked=\"checked\"";
			$html .= '
				<div class="form-check me-5 mb-0 pt-2">
					<input class="form-check-input" '.$checked.' type="checkbox" name="'.$name_radio.'[]" value="'.$key.'" id="'.$name_radio.'_'.strtolower($key).'">
					<label class="form-check-label" for="'.$name_radio.'_'.strtolower($key).'">'.$val.'</label>
				</div>';
		}
		return $html;
	}

	public static function strConvert($value){ 
		$value  = 	self::vietConvert($value);
		$value  =	trim(preg_replace('/[^a-zA-Z0-9]/',' ',$value));
		$value	=	preg_replace('/\s\s+/', ' ', $value);
		$value	=   preg_replace('/\-/ims', '', $value);
		
		$value	=	str_replace(" ","-",$value);
		$value	=	str_replace("/\-\-/i","-",$value);
		
	 	return $value;
	}

	public static function strConvert_2($value){ 

		$value  = 	self::vietConvert($value);
		$value  =	preg_replace('/[^a-zA-Z0-9\.\-]/',' ',$value);
		$value	=	preg_replace('/\s\s+/', ' ', $value);
		$value	=	str_replace(" ","_",$value);
		$value	=	str_replace("_.",".",$value);
		
		return $value;
	}	

	/* xoa dau tieng viet */ 
	public static function vietConvert($value) {
	    if(!$value) return '';
	    $arr_special_key = array("'","`",".","?","\"","-","_","+","=","{","}","[","]","|","\\",":",";","<",">",",","/","!","@","#","$","%","^","&","*","(",")","~");
	    $value = str_replace($arr_special_key,"", $value);
	     
	    $unicode = array(
	        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
	        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	        'd' => 'đ',
	        'D' => 'Đ',
	        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	        'i' => 'í|ì|ỉ|ĩ|ị',
	        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
	        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
	        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	
	    );
	    foreach ($unicode as $key => $char_value){
	        $arr_char = explode("|", $char_value);
	        $value = str_replace($arr_char, $key, $value);
	    }
	    return $value;
	}

	/* format : currency */
	 /* 15000.00 => 15000 or 15000.00 => 15000.00 */
	public static function formatCurrency($currency,$type_curr="VND") {
		if($type_curr != "VND") return $currency;
		else return (int)$currency;
	}

	/* format : currency into number */
	public static function formatCurrencyToNumber($currency,$type_curr='USD'){
		if($type_curr!='VND'){
	    	$currency=str_replace(',','',$currency);
		}else{
	    	$currency=str_replace('.','',$currency);
	    	$currency=str_replace(',','.',$currency);
		}
		return $currency;
	}

	/* format : number into currency */
	/* 15000 => 15.000 or 15000.00 => 15,000.00 */
	public static function formatNumberToCurrency($currency,$type_curr="VND",$decimal = 2) {
		$currency = self::formatCurrency($currency,$type_curr);
	 	if($type_curr == "none") return round($currency,3);
		if($type_curr != "VND") {
		 	return number_format($currency,$decimal, '.', ',');
		}else {
		 	return number_format($currency,0,",",".");
		} 
	}

	/* format : show currency */
	/* 15000.00 => 15.000 VND or 15000.00 => $15,000.00 */
	public static function showCurrency($currency,$type_curr="VND") {
		$currency = self::formatNumberToCurrency($currency,$type_curr);
		if($type_curr != "VND") {
			return $type_curr.$currency;
		}else{
			return $currency.' '.$type_curr; 
	 	}
	}	
	
	/* Conver dang array ("ID"=> Value) thanh list radio button */
	public static function radio_array($arr,$name_radio,$arr_value){
		$html ="";
		$i = 1;
		foreach($arr as $key => $val){
			$checked = '';
			if($key==$arr_value){ $checked .='checked="checked"'; }
					
			$html .='
				<div class="form-check form-check-inline mb-0">
					<label class="form-check-label cursor-pointer col-form-label" for="'.$name_radio.'_'.$key.'">
						<input class="form-check-input" type="radio" name="'.$name_radio.'" id="'.$name_radio.'_'.$key.'" value="'.$key.'" '.$checked.'>
						'.$val.'
					</label>
				</div>
			';
			$i++;
		}
		return $html;
	}

	/*Show list cac tu khoa dai dien khi viet mail template */
	public static function keywordsTemplate($arr){
		$html ="";
		foreach($arr as $key => $val){
			$html .= '<tr><td width="210"><strong>'.$key.'</strong></td><td>'.$val.'</td></tr>';
		}
		return $html;
	}

	/*Show breadcrumb cho trang admin */
	public function showBreadcrumbAdmin($array_serialize){
		$array = unserialize($array_serialize);
		$result = '';
    	$count = count($array);
    	$i = 1;
		foreach ($array as $key => $value) {
			if($i == $count)
				$result .= '<li class="breadcrumb-item active" aria-current="page">'.$value.'</li>';
			else
				$result .= '<li class="breadcrumb-item"><a class="text-decoration-none" href="'.$key.'" title="'.$value.'">'.$value.'</a></li>';
			$i = $i + 1;
		}
		return $result;
	}
}
?>