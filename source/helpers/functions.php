<?php/*-------------------------------------------------*//**| Powered by GNU/CMS for PHP, Elementary CMS. |**//**| Created by Vadim Kondakov (SibWeb Group).   |**//**| Official page: http://www.ecms.su/          |**//**| License GNU/GPL v 3, Freeware.              |**//*-------------------------------------------------*/defined('ECMS_FILESYSTEM') or die();if($config['language']=="russian") ecms::file_folder_load(ECMS_SOURCE.'language'.DIR_SEP.$config['language'].DIR_SEP); else ecms::file_folder_load(ECMS_SOURCE.'language'.DIR_SEP.$config['language'].DIR_SEP);if(!function_exists('meta')){	function meta($title=false,$desc=false,$keyword=false)	{		global $config;		if(!$title!="") $title=$config['sitename']; else $title=$title.' - '.$config['sitename'];		if(!$desc!="") $desc=$config['desc']; else $desc=$desc;		if(!$keyword!="") $keyword=$config['keywords']; else $keyword=$keyword;		$arr=array($title,$desc,$keyword);		$result="\n<title>{$arr[0]}</title>\r\n\r\n<meta name=\"description\" content=\"{$arr[1]}\" />\r\n\r\n<meta name=\"keywords\" content=\"{$arr[2]}\" />\r\n\r\n<meta name=\"generator\" content=\"Elementary CMS\" />";		return $result;	}}if(!function_exists('og_meta')){	function og_meta($title=false,$desc=false,$url=false)	{		global $config;		if(!$title!="") $title=$config['sitename']; else $title=$title.' - '.$config['sitename'];		if(!$desc!="") $desc=$config['desc']; else $desc=$desc;		if(!$url!="") $url=$config['http_server']; else $url=$_SERVER['REQUEST_URI'];		$arr=array($title,$desc,$url);		$result="\n<meta property=\"og:og:title\" content=\"{$arr[0]}\" />\r\n\r\n<meta property=\"og:og:url\" content=\"{$arr[2]}\" />\r\n\r\n<meta property=\"og:og:description\" content=\"{$arr[1]}\" />\r\n";		return $result;	}}if(!function_exists('parse_tpl')){	function parse_tpl($tpl)	{		global $config,$lang;		ob_start();		$template = ECMS_SOURCE."templates".DIR_SEP.$config['template'].DIR_SEP.$tpl;		if(!file_exists($template)) die(LANG_TPLFILE_NOT." <span style=\"color: red;\">({$tpl})</span></br>");		require($template);		return ob_get_clean();	}}if(!function_exists('get_tpl')){	function get_tpl($var,$title=false,$desc=false,$keyword=false,$url=false)	{		global $config,$lang,$db;		$result=parse_tpl($var);		@$result=preg_replace("/\{lang=(.+?)\\}/ies","lang_show('\$1')",@$result);		@$result=preg_replace("/\{config=(.+?)\\}/ies","config_show('\$1')",@$result);		$result=str_replace("{_META_}",meta($title,$desc,$keyword),$result);		$result=str_replace("{_OGMETA_}",og_meta($title,$desc,$url),$result);		$result=str_replace("{_TPL_}",$config['http_server'].'source/templates/'.$config['template'].'/',$result);		$result=str_replace("{_HTTP_SERVER_}",$config['http_server'],$result);		$result=str_replace("{search_form}",search_form(),$result);		if(isset($_SESSION['auth']))		$result=str_replace("{auth_id}",$_SESSION['auth'][0],$result);		if(!isset($_SESSION['auth'])) {			$result = preg_replace('/\[hide\]/', '', $result);			$result = preg_replace('/\[\/hide\]/', '', $result);	    } else $result = preg_replace("/\[hide\].*?\[\/hide\]/s", '', $result);		if(isset($_SESSION['auth']))		{			$result = preg_replace('/\[guest_hide\]/', '', $result);			$result = preg_replace('/\[\/guest_hide\]/', '', $result);	    } else $result = preg_replace("/\[guest_hide\].*?\[\/guest_hide\]/s", '', $result);		return $result;	}}if(!function_exists('ec_mail')){	function ec_mail($type,$email,$title,$text)	{		global $config;		$headers=array();		if($type=="text")		{			$headers[]="MIME-Version: 1.0";			$headers[]="Content-type: text/plain; charset=utf-8";			$headers[]="From: ".$config['sitename']." <".$config['email'].">";			$headers[]="X-Mailer: Elementary CMS";		}		else if($type=="html")		{			$headers[]="MIME-Version: 1.0";			$headers[]="Content-type: text/html; charset=utf-8";			$headers[]="From: ".$config['sitename']." <".$config['email'].">";			$headers[]="X-Mailer: Elementary CMS";		}		return mail($email,$title,$text,implode("\r\n",$headers));	}}if(!function_exists('ec_date')){	function ec_date($ddd=false)	{		global $lang;		$date=explode("-", $ddd);		switch ($date[1]){			case 1: $m=$lang['lang_m_gen']; break;			case 2: $m=$lang['lang_m_feb']; break;			case 3: $m=$lang['lang_m_match']; break;			case 4: $m=$lang['lang_m_apr']; break;			case 5: $m=$lang['lang_m_may']; break;			case 6: $m=$lang['lang_m_ilyn']; break;			case 7: $m=$lang['lang_m_ilyl']; break;			case 8: $m=$lang['lang_m_abg']; break;			case 9: $m=$lang['lang_m_cen']; break;			case 10: $m=$lang['lang_m_okt']; break;			case 11: $m=$lang['lang_m_noy']; break;			case 12: $m=$lang['lang_m_dec']; break;		}		$lor=substr($date[2],0,1);		if($lor==0) $date[2]=substr($date[2],1);		return $date[2].'&nbsp;'.$m.'&nbsp;'.$date[0];	}}if(!function_exists('ec_ip')){	function ec_ip()	{		foreach(array('HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','HTTP_X_COMING_FROM','HTTP_COMING_FROM','HTTP_CLIENT_IP','HTTP_X_CLUSTER_CLIENT_IP','HTTP_PROXY_USER','HTTP_XROXY_CONNECTION','HTTP_PROXY_CONNECTION','HTTP_USERAGENT_VIA') as $value)		{			$ip=filter_input(INPUT_SERVER, $value, FILTER_SANITIZE_URL);		}		if (empty($ip) || $ip=='unknown')		{			$ip=filter_input(INPUT_SERVER, "REMOTE_ADDR", FILTER_SANITIZE_URL);		}		return $ip;	}}if(!function_exists('mb_strlen')){	function mb_strlen($s,$sEncode="UTF-8") {				$length=strlen(iconv($sEncode,'Windows-1251',$s));      	return (int)$length;	}}if (!function_exists('mb_strtolower')){	function mb_strtolower($s,$sEncode="UTF-8") {				$s=iconv($sEncode,"Windows-1251",$s);		$s=strtolower($s);		$s=iconv("Windows-1251",$sEncode,$s);		return $s;	}}if (!function_exists('kill_tags')){	function kill_tags($document){		$search = array(		'@<script[^>]*?>.*?</script>@si',		'@<style[^>]*?>(.*?)</style>@siU',		'@<style>(.*?)</style>@siU',		'@<[\/\!]*?[^<>]*?>@si',		'@<![\s\S]*?--[ \t\n\r]*>@'		);		$text=preg_replace($search,'',$document);		return $text;	}}if (!function_exists('mb_str')){	function mb_str($var)	{		$var=preg_replace('/\s+/','_',trim(mb_strtolower($var,'utf-8')));		return $var;	}}if (!function_exists('search_form')){	function search_form()	{		global $lang;		$search=parse_tpl('search.php');		$search=str_replace("{placeholder}",$lang['search_placeholder'],$search);		$search=str_replace("{submit}",$lang['search_submit'],$search);		return $search;	}}if(!function_exists('lang_show')){	function lang_show($var)	{		global $lang;		if(isset($lang[$var]))		return $lang[$var];	}}if(!function_exists('config_show')){	function config_show($var)	{		global $config;		if(isset($config[$var]))		return $config[$var];	}}