<?php
class DbServer{
	
	static private $_instance;
	static private $_connectSource;
// 	private $_dbConfig = array(
// 		'host' => 'localhost',
// 		'user' => 'root',
// 		'password' => 'root',
// 		'database' => 'testguest',
// 	);
	
	
	private $_dbConfig = array(
		'host' => 'hdm14969059.my3w.com',
		'user' => 'hdm14969059',
		'password' => 'whf324512',
		'database' => 'hdm14969059_db',
	);
	
	
	private function _construct(){
		
	}
	
	static public function getInstance(){
		if (self::$_instance instanceof  self){
			self::$_instance = new self();
		}
		
		self::$_instance = new self();
		return self::$_instance;
	}
	
	
	public function connect(){
		if(!self::$_connectSource){
			self::$_connectSource = mysql_connect($this->_dbConfig['host'],$this->_dbConfig['user'],$this->_dbConfig['password']);
			if(!self::$_connectSource){
				throw new Exception('myql connect error'.mysql_errno());
			}
			
			mysql_select_db($this->_dbConfig['database'],self::$_connectSource);
			mysql_query("set names UTF8", self::$_connectSource);
		}
		return self::$_connectSource;
	}
}

