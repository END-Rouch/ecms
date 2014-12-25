<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

$_object=array('controller'=>'home','action'=>'index');
if(isset($_SERVER['REQUEST_URI'])) $_uri=filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
if(preg_match("'^/index.php'i",$_uri)) $_uri='';
$paths=str_replace('index.php','',filter_input(INPUT_SERVER, 'SCRIPT_NAME', FILTER_SANITIZE_URL));
$_uri=substr($_uri,strlen($paths),strlen($_uri));
$_uri=preg_replace("'([/]+)'usi",'/',$_uri);
if($_uri=='/') $_uri=substr($_uri,'/',strlen($_uri));
$request=explode('/',$_uri);
$params=array_slice($request,0);
foreach($params as $key=>$value) $params[$key] = urldecode($value);
if(!empty($params[0])) $_object['controller'] = $params[0];
$controller=$_object['controller'];
$file_controller=ECMS_SOURCE.'modules/'.$controller.'/controller.php';
$file_model=ECMS_SOURCE.'modules/'.$controller.'/model.php';
if(!empty($params[1])) $_object['action']=$params[1];
$action=$_object['action'];
if(file_exists($file_controller)) require($file_controller);
if(file_exists($file_model)) require($file_model);
if(class_exists($controller))
{
	if(method_exists(new $controller,$action)) print call_user_func(array(new $controller,$action));
}