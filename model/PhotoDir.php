<?php

require_once(SITE_PATH."/include/Common.php");

class PhotoDir{
	public $_id;
	public $_name;
	public $_type;
	public $_password;
	public $_content;
	public $_face;
	public $_dir;
	public $_date;
	
	static $tablename = "tg_dir";
	
	
	public function addDir()
	{
		$sql = "INSERT INTO tg_dir(tg_id, tg_name, tg_type, tg_password, tg_content, tg_face, tg_dir, tg_date)
				VALUES(".intval($this->_id).",".intval($this->_name).",'".mysql_real_escape_string($this->_type)."','".mysql_real_escape_string($this->_password)."','".mysql_real_escape_string($this->_content)."','".mysql_real_escape_string($this->_face)."','".mysql_real_escape_string($this->_dir)."','".intval($this->_date)."')";
		$ret = _query($sql);
		return $ret;
	}
	
	public function getPhotoDirList()
	{
		$sql = "SELECT * FROM tg_dir";
		return _query($sql);
	}
	
	public function  getPhotoNum(){
		$sql = "SELECT COUNT(tg_id) tg_count FROM tg_photo";
		return _query($sql);
	}
	
	public function  getDirList($id){
		$sql = "SELECT a.tg_id,a.tg_name, a.tg_type, COUNT(b.tg_sid) tg_count,a.tg_password,a.tg_content,a.tg_face,a.tg_dir,a.tg_date FROM tg_dir a,tg_photo b where a.tg_id = b.tg_sid AND a.tg_id =".intval($id);
		return _query($sql);
	}
		
	
}