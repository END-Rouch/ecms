<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

$dbconfig=array(
	'SERVER'=>'localhost',
	'USERNAME'=>'root',
	'PASSWORD'=>'',
	'NAME'=>'test',
	'PORT'=>'3306',
	'SOCKET'=>'mysqli'
);
$db=mysqli_connect($dbconfig['SERVER'],$dbconfig['USERNAME'],$dbconfig['PASSWORD'],$dbconfig['NAME'],$dbconfig['PORT'],$dbconfig['SOCKET']);
mysqli_set_charset($db, "utf8");