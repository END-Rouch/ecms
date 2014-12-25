<?php/*-------------------------------------------------*//**| Powered by GNU/CMS for PHP, Elementary CMS. |**//**| Created by Vadim Kondakov (SibWeb Group).   |**//**| Official page: http://www.ecms.su/          |**//**| License GNU/GPL v 3, Freeware.              |**//*-------------------------------------------------*/defined('ECMS_FILESYSTEM') or die();if(!function_exists('home_news')){	function home_news()	{		global $config,$db,$lang;		$config['homepage_news']=mysqli_real_escape_string($db,(int) $config['homepage_news']);		$query_news=mysqli_query($db,'SELECT `id`,`title`,`min_text`,`tags`,`by`,`date`,`category` FROM `news` ORDER BY `id` DESC LIMIT '.$config['homepage_news'].'');		while($row_news=mysqli_fetch_array($query_news))		{			/* Автор публикации */			$row_news['by']=mysqli_real_escape_string($db,(int) $row_news['by']);			$query_by=mysqli_query($db,'SELECT `id`,`login`,`name`,`family` FROM `users` WHERE `id`='.$row_news['by'].'');			$row_by=mysqli_fetch_array($query_by);			/* Категория публикации */			$row_news['category']=mysqli_real_escape_string($db,(int) $row_news['category']);			$query_category=mysqli_query($db,'SELECT `id`,`name` FROM `category` WHERE `id`='.$row_news['category'].'');			$row_category=mysqli_fetch_array($query_category);			if($row_news['category']==0) $row_category['name']='Без категории';			if($row_news['category']==0) $row_category['id']=0;			/* Выводим список в шаблон */			$tpl=parse_tpl('news/min.php');			$tpl=str_replace("{_HTTP_SERVER_}",$config['http_server'],$tpl);			$tpl=str_replace("{news_id}",$row_news['id'],$tpl);			$tpl=str_replace("{news_title}",kill_tags($row_news['title']),$tpl);			if($row_news['min_text']=='')			{				$row_news['min_text']=$lang['text_not'];				$tpl=str_replace("{news_text}",bbcode($row_news['min_text']),$tpl);			} else {				$tpl=str_replace("{news_text}",bbcode($row_news['min_text']),$tpl);			}			if($row_news['date']==0)			{				$row_news['date']=$lang['date_not'];				$tpl=str_replace("{news_date}",$row_news['date'],$tpl);			} else {				$tpl=str_replace("{news_date}",ec_date($row_news['date']),$tpl);			}			if($row_by['name'] != "" && $row_by['family'] != "") $tpl=str_replace("{news_by}","{$row_by['name']} {$row_by['family']}",$tpl);			else $tpl=str_replace("{news_by}",$row_by['login'],$tpl);			$tpl=str_replace("{news_by_href}",$row_by['id'],$tpl);			$tpl=str_replace("{news_category_href}",$row_category['id'],$tpl);			$tpl=str_replace("{news_category}",$row_category['name'],$tpl);			$row_news['tags']=explode(",", $row_news['tags']);			foreach($row_news['tags'] as $value)			{				if(!$value=='')				{					$tags=parse_tpl('news/tags.php');					$tags=str_replace("{_HTTP_SERVER_}",$config['http_server'],$tags);					$tags=str_replace("{tags_name}",$value,$tags);					$tpl=str_replace("{news_tags}",$tags.'{news_tags}',$tpl);				}			}			$tpl=str_replace("{news_tags}","",$tpl);			echo $tpl;		}		if($query_news->num_rows==null) echo $lang['news_new_not'];	}}