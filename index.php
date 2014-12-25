<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

ob_start();

define('DIR_SEP', DIRECTORY_SEPARATOR);
define('ECMS_DIR', dirname(__FILE__).DIR_SEP);
define('ECMS_SOURCE', ECMS_DIR.'source'.DIR_SEP);
define('ECMS_FILESYSTEM', true);

error_reporting(E_ALL);
ini_set('display_errors',1);

if(!isset($_SESSION)) session_start();

require_once ECMS_SOURCE.'elementary.php';
new ecms;

ob_end_flush();