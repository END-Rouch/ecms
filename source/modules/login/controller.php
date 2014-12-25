<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

class login
{
	function index()
	{
		global $lang;
		echo get_tpl('header.php', $lang['auth']);
		echo login_page();
		echo get_tpl('footer.php');
	}
	function boot()
	{
		global $config;
		if(isset($_SESSION['auth']))
		{
			unset($_SESSION['auth']);
			header("Location: {$config['http_server']}login/");
		}
		else header("Location: {$config['http_server']}login/");
	}
}