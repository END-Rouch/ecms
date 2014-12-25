<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

// Time zone by default,
// the list of supported time zones:
// https://php.net/manual/en/timezones.php
date_default_timezone_set("Asia/Omsk");

header('X-Powered-By: Elementary CMS');
header('Content-type: text/html; charset=utf-8');

$_SERVER['HTTP_HOST']=filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL);
$_SERVER['SERVER_NAME']=filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL);