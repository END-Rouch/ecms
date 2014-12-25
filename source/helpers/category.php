<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('categoryMenu'))
{
	function categoryMenu()
	{
		global $config,$db,$lang;
		$query=mysqli_query($db, 'SELECT `id`,`name` FROM `category` ORDER BY `id`');
		while($row=mysqli_fetch_array($query))
		{
			$tpl=parse_tpl('category.php');
			$tpl=str_replace("{_HTTP_SERVER_}",$config['http_server'],$tpl);
			$tpl=str_replace("{cat_id}",$row['id'],$tpl);
			$tpl=str_replace("{cat_title}",kill_tags($row['name']),$tpl);
			echo $tpl;
		}
		if($query->num_rows==null) echo $lang['category_not'];
	}
}