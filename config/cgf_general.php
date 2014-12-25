<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

$config=array();

/* Основное */
$config['sitename']="Elementary CMS";
$config['desc']="Сайт основан на Elementary CMS";
$config['keywords']="Elementary, CMS, Elementary CMS, Content Managament System, Скачать движок, Скачать бесплатно CMS, Downoload Elementary CMS.";
$config['template']="default";
$config['language']="russian";
$config['email']="admin@cms.ru";
$config['http_server']="http://".filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL)."/";

/* Записи */
$config['homepage_news']=10;

/* Инфо о Elementary CMS (редактировать запрещено) */
define('CMS_VERSION', 1.0);