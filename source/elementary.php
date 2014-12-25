<?php
/*-------------------------------------------------*/
/**| Powered by GNU/CMS for PHP, Elementary CMS. |**/
/**| Created by Vadim Kondakov (SibWeb Group).   |**/
/**| Official page: http://www.ecms.su/          |**/
/**| License GNU/GPL v 3, Freeware.              |**/
/*-------------------------------------------------*/

defined('ECMS_FILESYSTEM') or die();

class ecms
{
	public function __construct()
	{
		$this->file_folder_load(ECMS_DIR.'config'.DIR_SEP);
		$this->file_folder_load(ECMS_SOURCE.'helpers'.DIR_SEP);
	}
	function file_folder_load($var)
	{
		global $config,$lang,$db;
		$folder=ecms::arr_rein(array_diff(scandir($var), array('..', '.')));
		foreach($folder as $file) require_once($var.$file);
	}
	function file_folder_load_text($var)
	{
		global $config,$lang,$db;
		$folder=ecms::arr_rein(array_diff(scandir($var), array('..', '.')));
		foreach($folder as $file) echo($var.$file);
	}
	function arr_rein($data=array())
	{
		$offset=0;
		$result=array();
		foreach($data as $value)
		{
			$result[$offset]=$value;
			$offset++;
		}
		unset($data,$offset);
		return $result;
	}
}