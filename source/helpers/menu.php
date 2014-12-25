<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('get_menu'))
{
	function get_menu()
	{
		global $db;
		$query = mysqli_query($db, "SELECT `id`, `name`, `href` FROM `menu` ORDER BY `id`");
		while($row = mysqli_fetch_array($query))
		{
			$tpl=parse_tpl('menu.php');
			$tpl=str_replace("{_menu_href_}",$row['href'],$tpl);
			$tpl=str_replace("{_menu_name_}",$row['name'],$tpl);
			echo $tpl;
		}
	}
}