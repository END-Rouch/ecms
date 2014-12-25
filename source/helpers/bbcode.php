<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('bbcode'))
{
	function bbcode($text)
	{
		global $lang,$config;
		$text=preg_replace('/\[(\/?)(b|i|u|s|p)\s*\]/',"<$1$2>",$text);
		$text=preg_replace('/\[url=(.+?)\](.*?)\[\/url\]/s',"<a rel=\"nofollow\" href=\"$1\">$2</a>",$text);
		$text=preg_replace('/\[url=(.+?)\]/s',"<a rel=\"nofollow\" href=\"$1\">".$lang['name_url']."</a>",$text);
		$text=preg_replace('/\[img=(.+?) alt=(.*?)\]/s',"<img src=\"$1\" alt=\"$2\" title=\"$2\" />",$text);
		$text=preg_replace('/\[img=(.+?)\]/s',"<img src=\"$1\" />",$text);
		$smile=array(
			'{:emot-1:}'=>'emot-1.png',
			'{:emot-2:}'=>'emot-2.png',
			'{:emot-3:}'=>'emot-3.png',
			'{:emot-4:}'=>'emot-4.png',
			'{:emot-5:}'=>'emot-5.png',
			'{:emot-6:}'=>'emot-6.png',
			'{:emot-7:}'=>'emot-7.png',
			'{:emot-8:}'=>'emot-8.png',
			'{:emot-9:}'=>'emot-9.png',
			'{:emot-10:}'=>'emot-10.png',
			'{:emot-11:}'=>'emot-11.png',
			'{:emot-12:}'=>'emot-12.png',
			'{:emot-13:}'=>'emot-13.png',
			'{:emot-14:}'=>'emot-14.png',
			'{:emot-15:}'=>'emot-15.png',
			'{:emot-16:}'=>'emot-16.png',
			'{:emot-17:}'=>'emot-17.png',
			'{:emot-18:}'=>'emot-18.png',
			'{:emot-19:}'=>'emot-19.png',
			'{:emot-20:}'=>'emot-20.png'
		);
		foreach($smile as $value=>$key) $text=str_replace($value,"<img src=\"{$config['http_server']}source/templates/{$config['template']}/images/smiles/{$key}\" alt=\"Smile\">",$text);
		$tags=array('<script>'=>'&lt;script&gt;','</script>'=>'&lt;/script&gt;','<style>'=>'&lt;style&gt;','</style>'=>'&lt;/style&gt;','<?php'=>'&lt;?php','<?'=>'&lt;?','<%'=>'&lt;%','?>'=>'?&gt;','%>'=>'%&gt;');
		foreach($tags as $value=>$key) $text=str_replace($value,$key,$text);
		$text=preg_replace('/\[br]/s',"<br>",$text);
		$text=preg_replace('/\[left\](.+?)\[\/left\]/s',"<div style=\"text-align: left;\">$1</div>",$text);
		$text=preg_replace('/\[right\](.+?)\[\/right\]/s',"<div style=\"text-align: right;\">$1</div>",$text);
		$text=preg_replace('/\[center\](.+?)\[\/center\]/s',"<div style=\"text-align: center;\">$1</div>",$text);
		return $text;
	}
}