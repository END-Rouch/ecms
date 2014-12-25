<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

if(!function_exists('showtopic'))
{
	function showtopic()
	{
		global $config,$lang,$db;
		if(isset($_GET['id'])) @$id=$_GET['id'];
		/* Перенаправляем на ЧПУ адрес */
		if(strpos(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL), 'id')) header('location: '.$config['http_server'].'topic/show/'.$id.'.html');
		/* Если запрос не обработан, перенаправляем на главную */
		if(!empty($id)=="") header("Location: {$config['http_server']}");
		if(is_numeric(@$id))
		{
			$id=mysqli_real_escape_string($db,(int) $id);
			$query_news=mysqli_query($db,'SELECT `id`,`title`,`full_text`,`min_text`,`tags`,`by`,`date`,`category` FROM `news` WHERE `id`='.$id.'');
			while($row_news=mysqli_fetch_array($query_news))
			{
				/* Автор публикации */
				$row_news['by']=mysqli_real_escape_string($db,(int) $row_news['by']);
				$query_by=mysqli_query($db,'SELECT `id`,`login`,`name`,`family` FROM `users` WHERE `id`='.$row_news['by'].'');
				$row_by=mysqli_fetch_array($query_by);
				/* Категория публикации */
				$row_news['category']=mysqli_real_escape_string($db,(int) $row_news['category']);
				$query_category=mysqli_query($db,'SELECT `id`,`name` FROM `category` WHERE `id`='.$row_news['category'].'');
				$row_category=mysqli_fetch_array($query_category);
				if($row_news['category']==0) $row_category['name']='Без категории';
				if($row_news['category']==0) $row_category['id']=0;
				/* Выводим список в шаблон */
				$tpl=parse_tpl('news/full.php');
				$tpl=str_replace("{_HTTP_SERVER_}",$config['http_server'],$tpl);
				$tpl=str_replace("{news_id}",$row_news['id'],$tpl);
				$tpl=str_replace("{news_title}",kill_tags($row_news['title']),$tpl);
				if($row_news['full_text']=='')
				{
					$row_news['full_text']=$lang['text_not'];
					$row_news['min_text']=$lang['text_not'];
					$tpl=str_replace("{news_text}",bbcode($row_news['full_text']),$tpl);
					$tpl=str_replace("{news_text_min}",kill_tags(bbcode($row_news['min_text'])),$tpl);
				} else {
					$tpl=str_replace("{news_text}",bbcode($row_news['full_text']),$tpl);
					$tpl=str_replace("{news_text_min}",kill_tags(bbcode($row_news['min_text'])),$tpl);
				}
				if($row_news['date']==0)
				{
					$row_news['date']=$lang['date_not'];
					$tpl=str_replace("{news_date}",$row_news['date'],$tpl);
				} else {
					$tpl=str_replace("{news_date}",ec_date($row_news['date']),$tpl);
				}
				if($row_by['name'] != "" && $row_by['family'] != "") $tpl=str_replace("{news_by}","{$row_by['name']} {$row_by['family']}",$tpl);
				else $tpl=str_replace("{news_by}",$row_by['login'],$tpl);
				$tpl=str_replace("{news_by_href}",$row_by['id'],$tpl);
				$tpl=str_replace("{news_category_href}",$row_category['id'],$tpl);
				$tpl=str_replace("{news_category}",$row_category['name'],$tpl);
				$tpl=str_replace("{news_tags_text}",$row_news['tags'],$tpl);
				$row_news['tags']=explode(",", $row_news['tags']);
				foreach($row_news['tags'] as $value)
				{
					if(!$value=='')
					{
						$tags=parse_tpl('news/tags.php');
						$tags=str_replace("{_HTTP_SERVER_}",$config['http_server'],$tags);
						$tags=str_replace("{tags_name}",$value,$tags);
						$tpl=str_replace("{news_tags}",$tags.'{news_tags}',$tpl);
					}
				}
				$tpl=str_replace("{news_tags}","",$tpl);
				echo $tpl;
			}
			if($query_news->num_rows==null)
			{
				echo parse_tpl('404.php');
				header("HTTP/1.0 404 Not Found");
			}
		}
	}
}