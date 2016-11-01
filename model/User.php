<?php

require_once(SITE_PATH."/include/Common.php");

class User{
	public $username;
	public $password;
	public $email;
	public $qq;
	public $url;
	public $sex;
	
	static $tablename = "tg_user";
	
	function Log($msg,$data,$file = "info.txt"){
		$filePath = isset($file) && !empty($file) ? __DIR__.DIRECTORY_SEPARATOR.$file : __DIR__.DIRECTORY_SEPARATOR."info.txt";
		echo $filePath;
		$output = "===============输出消息：$msg=============\n";
		$output.= "请求时间：".date("Y-m-d H:i:s",time())."  ,请求地址：http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\n";
		if(is_array($data)){
			$output .= var_export($data,true);
		}else{
			$output .= $data;
		}
		$output .= "\n======================================\n";
		file_put_contents($filePath,$output,FILE_APPEND);
	}
	
	//加了盐的密码验证
	static function getPassword($password, $salt)
	{
		$password = md5($password."#".PASSWORD_KEY."#".$salt);
		return $password;
	}
	
	//没有加盐的密码验证，使用sha1加密
	static function getPass($password)
	{
		$password = sha1($password);
		return $password;
	}
	
	//新增用户(用户注册)
	function addUser()
	{
		$salt = rand(10000000, 99999999);
// 		$password = self::getPassword($this->password, $salt);
		$password = self::getPass($this->password);
		$sql = "INSERT INTO ".self::$tablename."(tg_username,tg_nickname, tg_password, tg_sex, tg_email,tg_qq,tg_url, salt)
		  		VALUES('".$this->username."','".$this->nickname."',".$password."',".intval($this->sex).",'".$this->email."','".$this->qq."','".$this->url."','".$salt."')";
		return _query($sql);
	}
	
	//用户登录验证
	function checkUser()
	{
		$sql = "SELECT * FROM ".self::$tablename." WHERE tg_username='". mysql_real_escape_string($this->username)."'";
		$data =_fetch_array_list(_query($sql));
		$this->Log("sql语句查询",$data,"info.txt");
		$salt = $data['salt'];
// 		$password = self::getPassword($this->password, $salt);
		$password = self::getPass($this->password);
		if($password == $data['tg_password']){
			unset($data['tg_password']);
			unset($data['salt']);
			return $data;
		}else{
			return false;
		}
	}
	
	function getUser()
	{
		$sql = "SELECT * FROM ".self::$tablename;
		return _query($sql);
	}
	

}