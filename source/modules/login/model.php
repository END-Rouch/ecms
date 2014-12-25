<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('login_page'))
{
	function login_page()
	{
		global $db,$lang,$config;
		if(isset($_POST['login'])) $login=kill_tags($_POST['login']);
		if(isset($_POST['password'])) $password=kill_tags(sha1($_POST['password']));
		if(isset($login) && isset($password))
		{
			if($login && $password != '')
			{
				$login=mysqli_real_escape_string($db,(string) $login);
				$password=mysqli_real_escape_string($db,(string) $password);
				$query_auth=mysqli_query($db,'SELECT `id`,`login`,`password`,`activate` FROM `users` WHERE `login`="'.$login.'" AND `password`="'.$password.'"');
				$row_auth=mysqli_fetch_array($query_auth);
				if($row_auth==null) echo $lang['err_auth'];
				else {
					if($row_auth['activate']==0) echo $lang['err_activate'];
					else
					{
						$add_session=array($row_auth['id'],$row_auth['login'],sha1(session_id()));
						$_SESSION['auth']=$add_session;
						$zone=date("Y-m-d,H:i");
						$ip=ec_ip();
						$browser=strip_tags($_SERVER['HTTP_USER_AGENT']);
						$query_zone=mysqli_query($db,'UPDATE `users` SET `last_visit`="'.$zone.'",`session_id`="'.sha1($row_auth['id'].session_id()).'",`last_ip`="'.$ip.'",`last_browser`="'.$browser.'" WHERE `id`="'.$row_auth['id'].'"');
					}
				}
			}
			else echo $lang['err_input_auth'];
		}
		if(isset($_SESSION['auth'])) header("Location: {$config['http_server']}user/profile/{$_SESSION['auth'][0]}.html");
		else $tpl=get_tpl('login.php');
		return $tpl;
	}
}