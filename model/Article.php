<?php
require_once(SITE_PATH."/include/Common.php");

class Article{
	public $_id;
	public $_username;
	public $_type;
	public $_classify;
	public $_title;
	public $_image;
	public $_content;
	public $_readcount;
	public $_date;
	
	static $tablename = "tg_article";
	
	public function getArticleList()
	{
		$sql = "SELECT * FROM tg_article  ORDER BY tg_date DESC";
		$res = _query($sql);
		return $res;
	}
	
	
	public function getArticleHomeList()
	{
		$sql = "SELECT * FROM  tg_article WHERE tg_reid=0 ORDER BY tg_readcount DESC LIMIT 10";
		$res = _query($sql);
		return $res;
	}
	
}
?>
