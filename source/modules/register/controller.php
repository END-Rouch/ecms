<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

class register
{
	function index()
	{
		global $lang;
		echo get_tpl('header.php', $lang['register']);
		echo reg_page();
		echo get_tpl('footer.php');
	}
}