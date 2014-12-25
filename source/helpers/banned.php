<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(isset($_SESSION['auth']))
{
	$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
	$query_banned=mysqli_query($db,'SELECT `id`,`groupid` FROM `users` WHERE `id`="'.$_SESSION['auth'][0].'"');
	while($row_banned=mysqli_fetch_array($query_banned))
	{
		if($row_banned['groupid']==5) die('Ваш аккаунт заблокирован за нарушение правил сайта.');
	}
}