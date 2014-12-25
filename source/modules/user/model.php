<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('showprofile'))
{
	function showprofile()
	{
		global $lang,$db,$config;
		if(isset($_GET['id'])) @$id=$_GET['id'];
		/* Перенаправляем на ЧПУ адрес */
		if(strpos(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL), 'id')) header('location: '.$config['http_server'].'user/profile/'.$id.'.html');
		/* Если запрос не обработан, перенаправляем на главную */
		if(!empty($id)=="") header("Location: {$config['http_server']}");
		if(is_numeric(@$id))
		{
			$id=mysqli_real_escape_string($db,(int) $id);
			$query_user=mysqli_query($db,'SELECT `id`,`login`,`name`,`family`,`email`,`groupid`,`about`,`balance`,`register`,`last_visit` FROM `users` WHERE `id`='.$id.'');
			while($row_user=mysqli_fetch_array($query_user))
			{
				$query_topic=mysqli_query($db,'SELECT `id`,COUNT("by") FROM `news` WHERE `by`="'.$row_user['id'].'" ORDER BY `id`');
				$row_topic=mysqli_fetch_array($query_topic);
				$tpl=get_tpl('user.php');
				if($row_user['name'] != "" && $row_user['family'] != "") $tpl=str_replace("{user_title}","{$row_user['name']} {$row_user['family']}",$tpl);
				else $tpl=str_replace("{user_title}",$row_user['login'],$tpl);
				if($row_user['groupid']==0) $tpl=str_replace("{groupid}",$lang['guest'],$tpl);
				if($row_user['groupid']==1) $tpl=str_replace("{groupid}",$lang['administrator'],$tpl);
				if($row_user['groupid']==2) $tpl=str_replace("{groupid}",$lang['moderator'],$tpl);
				if($row_user['groupid']==3) $tpl=str_replace("{groupid}",$lang['editor'],$tpl);
				if($row_user['groupid']==4) $tpl=str_replace("{groupid}",$lang['user'],$tpl);
				if($row_user['groupid']==5) $tpl=str_replace("{groupid}",$lang['banned'],$tpl);
				if($row_user['about']=='') $row_user['about'] = $lang['info_not'];
				$tpl=str_replace("{user_status}",$row_user['about'],$tpl);
				$tpl=str_replace("{user_login}",$row_user['login'],$tpl);
				$tpl=str_replace("{user_id}",$row_user['id'],$tpl);
				$status=explode(",",$row_user['last_visit']);
				$status[1]=explode(":",$status[1]);
				if($status[1][1]==date("i")) $user_status=$lang['online'];
				else $user_status=$lang['offline'];
				$tpl=str_replace("{user_last_visit}",$user_status,$tpl);
				if(file_exists(ECMS_DIR.'uploads'.DIR_SEP.'avatars'.DIR_SEP.$row_user['id'].'.jpg')) $tpl=str_replace("{avatar}",$config['http_server'].'uploads/avatars/'.$row_user['id'].'.jpg',$tpl);
				else $tpl=str_replace("{avatar}",$config['http_server'].'uploads/avatars/default.png',$tpl);
				$tpl=str_replace("{user_register}",ec_date($row_user['register']),$tpl);
				$tpl=str_replace("{user_visit}",ec_date($status[0]).", {$status[1][0]}:{$status[1][1]}",$tpl);
				if(isset($_SESSION['auth']))
				{
					$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
					$query_my=mysqli_query($db,'SELECT `id`,`groupid` FROM `users` WHERE `id`="'.$_SESSION['auth'][0].'"');
					$row_my=mysqli_fetch_array($query_my);
				}
				if(isset($row_my)==null)
				{
					$tpl=str_replace("{user_email}",$lang['input_private'],$tpl);
					$tpl=str_replace("{user_balance}",$lang['input_private'],$tpl);
				}
				else
				{
					if($row_my['groupid']!=1 && $row_my['groupid']!=2) $tpl=str_replace("{user_email}",$lang['input_private'],$tpl);
					else $tpl=str_replace("{user_email}",$row_user['email'],$tpl);
					if($row_user['balance']==null) $row_user['balance']=0;
					if($_SESSION['auth'][0]!=$row_user['id'] && $row_my['groupid']!=1) $tpl=str_replace("{user_balance}",$lang['input_private'],$tpl);
					else $tpl=str_replace("{user_balance}",$row_user['balance']." {$lang['valute']}",$tpl);
				}
				if($row_topic) $tpl=str_replace("{user_count_topic}",$row_topic[1],$tpl);
				return $tpl;
			}
			if($query_user->num_rows==null) header("Location: ".$config['http_server']);
		}
		if(@$query_user->num_rows==null)
		{
			echo parse_tpl('404.php');
			header("HTTP/1.0 404 Not Found");
		}
	}
}
if(!function_exists('setting_page'))
{
	function setting_page()
	{
		global $lang,$db,$config;
		if(isset($_SESSION['auth']))
		{
			if(isset($_POST['setting'])) $setting=kill_tags($_POST['setting']);
			if(!isset($setting))
			{
				if(isset($_POST['name'])) $name=kill_tags($_POST['name']);
				if(isset($_POST['family'])) $family=kill_tags($_POST['family']);
				if(isset($_POST['email']))
				{
					$email=kill_tags($_POST['email']);
					if(!preg_match("/^[-_a-zA-Z0-9.]+@[-_a-zA-Z0-9.]+\.[-_a-zA-Z]+$/s",$email)) echo $lang['email_unknow'];
				}
				if(isset($_POST['about'])) $about=kill_tags($_POST['about']);
				if(isset($name) && isset($family) && isset($email))
				{
					if($name && $family && $email != '')
					{
						$name=mysqli_real_escape_string($db,(string) $name);
						$family=mysqli_real_escape_string($db,(string) $family);
						$email=mysqli_real_escape_string($db,(string) $email);
						$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
						$query_string=mysqli_query($db,'UPDATE `users` SET `name`="'.$name.'",`family`="'.$family.'",`email`="'.$email.'" WHERE `id`="'.$_SESSION['auth'][0].'"');
						if(isset($query_string)==true) echo $lang['ok_setting_one'];
					}
				}
				if(isset($about))
				{
					if($about != '')
					{
						$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
						$about=mysqli_real_escape_string($db,(string) $about);
						$query_string=mysqli_query($db,'UPDATE `users` SET `about`="'.$about.'" WHERE `id`="'.$_SESSION['auth'][0].'"');
						if(isset($query_string)==true) echo $lang['ok_setting_two'];
					}
				}
				if(isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name'] != "")
				{
					$img=getimagesize($_FILES['avatar']['tmp_name']);
					if($img['mime'] != 'image/jpeg') echo $lang['error_mime'];
					else
					{
						$size=10;
						if($_FILES['avatar']['size'] <= $size*1024*1024)
						{
							$upload=ECMS_DIR.'uploads/avatars/'.basename($_SESSION['auth'][0].'.jpg');
							if(move_uploaded_file($_FILES['avatar']['tmp_name'],$upload)) echo $lang['avatar_upload'];
							else echo $lang['avatar_upload_error'];
						}
						else  echo $lang['avatar_upload_disk'];
					}
				}
			}
			if(isset($_POST['password'])) $password=kill_tags($_POST['password']);
			if(!isset($password))
			{
				if(isset($_POST['pass_my'])) $pass_my=kill_tags(sha1($_POST['pass_my']));
				if(isset($_POST['pass_new'])) $pass_new=kill_tags(sha1($_POST['pass_new']));
				if(isset($pass_my) && isset($pass_new))
				{
					$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
					$qpass_my=mysqli_query($db,'SELECT `id`,`password` FROM `users` WHERE `id`="'.$_SESSION['auth'][0].'"');
					$rpass_my=mysqli_fetch_array($qpass_my);
					if($pass_my==$rpass_my['password'])
					{
						$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
						$pass_my=mysqli_real_escape_string($db,(string) $pass_my);
						$qpass_new=mysqli_query($db,'UPDATE `users` SET `password`="'.$pass_my.'" WHERE `id`="'.$_SESSION['auth'][0].'"');
						if(isset($qpass_new)==true) echo $lang['password_change_ok'];
					} else echo $lang['password_my_error'];
				}
			}
			$result=get_tpl('setting.php');
			$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
			$query_user=mysqli_query($db,'SELECT `id`,`name`,`family`,`email`,`about` FROM `users` WHERE `id`="'.$_SESSION['auth'][0].'"');
			while($row_user=mysqli_fetch_array($query_user))
			{
				$result=str_replace("{name}",$row_user['name'],$result);
				$result=str_replace("{family}",$row_user['family'],$result);
				$result=str_replace("{email}",$row_user['email'],$result);
				$result=str_replace("{about}",$row_user['about'],$result);
			}
			return $result;
		}
		else header("Location: {$config['http_server']}");
	}
}
if(!function_exists('addtopic_page'))
{
	function addtopic_page()
	{
		global $lang,$db,$config;
		if(isset($_SESSION['auth']))
		{
		$result=get_tpl('addtopic.php');
		$query_cat=mysqli_query($db,'SELECT `id`,`name` FROM `category` ORDER BY `id`');
		while($row_cat=mysqli_fetch_array($query_cat))
		{
			$category=parse_tpl('select_cat.php');
			$category=str_replace("{cat_id}",$row_cat['id'],$category);
			$category=str_replace("{cat_name}",$row_cat['name'],$category);
			$result=str_replace("{category_show}",$category.'{category_show}',$result);
		}
		$result=str_replace("{category_show}",'',$result);
		if(isset($_POST['addtopic'])) $addtopic=kill_tags($_POST['addtopic']);
		if(!isset($addtopic))
		{
			if(isset($_POST['name'])) $name=kill_tags($_POST['name']);
			if(isset($_POST['category']))
			{
				$category=kill_tags($_POST['category']);
				if($category != "")
				{
					if(!is_numeric($category)) echo $lang['err_category_id'];
				}
				else echo $lang['err_category_value'];
			}
			if(isset($_POST['min_text'])) $min_text=kill_tags($_POST['min_text']);
			if(isset($_POST['full_text'])) $full_text=kill_tags($_POST['full_text']);
			if(isset($_POST['tags'])) $tags=kill_tags($_POST['tags']);
			if(isset($name) && isset($category) && isset($min_text) && isset($full_text) && isset($tags))
			{
				if($name && $category && $min_text && $full_text && $tags != "")
				{
					$_SESSION['auth'][0]=mysqli_real_escape_string($db,(int) $_SESSION['auth'][0]);
					$name=mysqli_real_escape_string($db,(string) $name);
					$category=mysqli_real_escape_string($db,(int) $category);
					$min_text=mysqli_real_escape_string($db,(string) $min_text);
					$full_text=mysqli_real_escape_string($db,(string) $full_text);
					$tags=mysqli_real_escape_string($db,(string) $tags);
					$add_news=mysqli_query($db,"INSERT INTO `news` (`id`,`title`,`min_text`,`full_text`,`tags`,`by`,`date`,`category`)
					VALUES (NULL,'".$name."','".$min_text."','".$full_text."','".$tags."','".$_SESSION['auth'][0]."','".date("Y-m-d")."','".$category."')");
					if(isset($add_news)==true) echo $lang['addnews_ok'];
				} else echo "2";
			}
		}
		return $result;
		}
		else header("Location: {$config['http_server']}");
	}
}