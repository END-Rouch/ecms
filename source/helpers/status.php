<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

/* Обновляем статус на онлайн... */
if(isset($_SESSION['auth'][0]))
{
	$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
	$browser=strip_tags($_SERVER['HTTP_USER_AGENT']);
	$query_zone=mysqli_query($db,'UPDATE `users` SET `last_visit`="'.date("Y-m-d,H:i").'",`last_ip`="'.ec_ip().'",`last_browser`="'.$browser.'" WHERE `id`="'.$_SESSION['auth'][0].'"');
}