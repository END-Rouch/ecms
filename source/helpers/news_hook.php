<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('newTopics'))
{
	function newTopics()
	{
		global $config,$db,$lang;
		$query = mysqli_query($db, 'SELECT `id`, `title`, `date` FROM `news` ORDER BY `id` DESC LIMIT 5');
		while($row = mysqli_fetch_array($query))
		{
			$tpl=get_tpl('news/new.php');
			$tpl=str_replace("{news_id}",$row['id'],$tpl);
			$tpl=str_replace("{news_title}",kill_tags($row['title']),$tpl);
			echo $tpl;
		}
		if($query->num_rows==null) echo $lang['news_new_not'];
	}
}