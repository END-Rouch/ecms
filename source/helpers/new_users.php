<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('new_users'))
{
	function new_users()
	{
		global $config,$db,$lang;
		$query=mysqli_query($db,'SELECT `id`,`name`,`family`,`login` FROM `users` ORDER BY `id` DESC LIMIT 9');
		while($row=mysqli_fetch_array($query))
		{
			$tpl=get_tpl('new_users.php');
			$tpl=str_replace("{user_id}",$row['id'],$tpl);
			if($row['name'] != "" && $row['family'] != "") $tpl=str_replace("{user_title}","{$row['name']} {$row['family']}",$tpl);
			else $tpl=str_replace("{user_title}",$row['login'],$tpl);
			if(file_exists(ECMS_DIR.'uploads'.DIR_SEP.'avatars'.DIR_SEP.$row['id'].'.jpg')) $tpl=str_replace("{avatar}",$config['http_server'].'uploads/avatars/'.$row['id'].'.jpg',$tpl);
			else $tpl=str_replace("{avatar}",$config['http_server'].'uploads/avatars/default.png',$tpl);
			echo $tpl;
		}
	}
}