<?php

require_once(SITE_PATH."/include/Common.php");

class Photo{
	public $_id;
	public $_name;
	public $_url;
	public $_content;
	public $_username;
	public $_readcount;
	public $_comcount;
	public $_date;
	
	static $tablename = "tg_photo";
	

	
	public function addPhoto()
	{
		$sql = "INSERT INTO tg_photo(tg_id, tg_name, tg_url, tg_content, tg_username, tg_readcount, tg_commendcount, tg_date)
				VALUES(".intval($this->_id).",".intval($this->_name).",'".mysql_real_escape_string($this->_url)."','".mysql_real_escape_string($this->_content)."','".mysql_real_escape_string($this->_username)."','".mysql_real_escape_string($this->_readcount)."','".mysql_real_escape_string($this->_comcount)."','".intval($this->_date)."')";
		echo $sql;
		$ret = _query($sql);
		return $ret;
	}
	
	public function getPhotoList($sid)
	{
		$sql = "SELECT * FROM ".self::$tablename." WHERE tg_sid =".intval($sid);
		return _query($sql);
	}
	
	
	public function  getUserPhotoList(){
		$sql = "SELECT * FROM ".self::$tablename;
		return _query($sql);
	}
 


	
	
	
}