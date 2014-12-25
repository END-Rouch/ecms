<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

class category
{
	function show()
	{
		global $config,$db;
		if(isset($_GET['id'])) @$id=$_GET['id'];
		/* Если запрос не обработан, перенаправляем на главную */
		if(!empty($id)=="") header("Location: {$config['http_server']}");
		$id=mysqli_real_escape_string($db,(int) @$id);
		$query_cat=mysqli_query($db,'SELECT `name`,`desc`,`keyword` FROM `category` WHERE `id`='.$id.'');
		$row_cat=mysqli_fetch_array($query_cat);
		echo get_tpl('header.php', $row_cat['name'],$row_cat['desc'],$row_cat['keyword'],'category?id='.$id);
		echo showcategory();
		echo get_tpl('footer.php');
	}
}