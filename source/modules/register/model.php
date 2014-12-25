<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('reg_page'))
{
	function reg_page()
	{
		global $config,$db,$lang;
		if(isset($_POST['login']))
		{
			$login=kill_tags($_POST['login']);
			if(!preg_match("/^[ˆa-zA-Zа-яА-Я0-9_ ]+$/s",$login)) echo $lang['login_unknow'];
			if(mb_strlen($login) > 25) echo $lang['login_text_full'];
		}
		if(isset($_POST['email']))
		{
			$email=kill_tags($_POST['email']);
			if(!preg_match("/^[-_a-zA-Z0-9.]+@[-_a-zA-Z0-9.]+\.[-_a-zA-Z]+$/s",$email)) echo $lang['email_unknow'];
		}
		if(isset($_POST['password'])) $password=kill_tags($_POST['password']);
		if(isset($login) && isset($email) && isset($password))
		{
			if($login && $password && $email != '')
			{
				$query_user=mysqli_query($db,'SELECT `login`,`email` FROM `users`');
				$row_user=mysqli_fetch_array($query_user);
				if($login != $row_user['login'] && $email != $row_user['email'])
				{
					$zone=date("Y-m-d,H:i");
					$ip=ec_ip();
					$browser=strip_tags($_SERVER['HTTP_USER_AGENT']);
					$login=mysqli_real_escape_string($db,(string) $login);
					$password=mysqli_real_escape_string($db,(string) $password);
					$browser=mysqli_real_escape_string($db,(string) $browser);
					$query_reg=mysqli_query($db,'INSERT INTO `users` (`id`,`login`,`email`,`groupid`,`password`,`activate`,`register`,`last_visit`,`last_ip`,`last_browser`)
					VALUES (NULL,"'.$login.'","'.$email.'","4","'.sha1($password).'","1","'.$zone.'","'.$zone.'","'.$ip.'","'.$browser.'")');
					if(isset($query_reg)==true) header("Location: {$config['http_server']}login/");
				}
				else echo $lang['reg_isset'];
			}
			else echo $lang['err_input_reg'];
		}
		if(isset($_SESSION['auth'])) header("Location: {$config['http_server']}");
		else $result=get_tpl('reg.php');
		return $result;
	}
}