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
	$uid=$_SESSION['auth'][0];
	$uid=mysqli_real_escape_string($db,(int) $uid);
	$login=$_SESSION['auth'][1];
	$session_id=$_SESSION['auth'][2];
	$query_user=mysqli_query($db,'SELECT `session_id` FROM `users` WHERE `id`="'.$uid.'"');
	while($row_user=mysqli_fetch_array($query_user))
	{
		$session_sha1=sha1($uid.session_id());
		if($row_user['session_id'] != $session_sha1) header("Location: {$config['http_server']}login/boot");
	}
}