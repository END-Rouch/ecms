<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

class user
{
	function profile()
	{
		echo showprofile();
	}
	function setting()
	{
		global $lang;
		echo get_tpl('header.php', $lang['setting']);
		echo setting_page();
		echo get_tpl('footer.php');
	}
	function addtopic()
	{
		global $lang;
		echo get_tpl('header.php', $lang['create_topic']);
		echo addtopic_page();
		echo get_tpl('footer.php');
	}
}