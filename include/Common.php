<?php
//设置字符集编码
header('Content-Type:text/html;charset=utf-8');

//拒绝PHP低版本
if (PHP_VERSION < '4.1.0') {
	exit('Version is to Low!');
}

require_once("DbConn.php");


//数据库连接
define('DB_HOST','127.0.0.1');
define('DB_USER','root');
define('DB_PWD','KeYpZrZx');
define('DB_NAME','guest');



// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PWD','KeYpZrZx');
// define('DB_NAME','guest');


//初始化数据库
_connect();   //连接MYSQL数据库
_select_db();   //选择指定的数据库
_set_names();   //设置字符集


function _html($_string) {
	if (is_array($_string)) {
		foreach ($_string as $_key => $_value) {
			$_string[$_key] = $_string[$_value];   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
		}
	} else {
		$_string = htmlspecialchars($_string);
	}
	return $_string;
}

/**
 * _content()标题截取函数
 * @param $_string
 */

function _content($_string,$_strlen) {
	if (mb_strlen($_string,'utf-8') > $_strlen) {
		$_string = mb_substr($_string,0,$_strlen,'utf-8').'...';
	}
	return $_string;
}


?>
