<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

class userLogin{
	
		public function index(){
			
			$username = $_GET['username'];
			$password = sha1($_GET['password']);
			$sql = "SELECT * FROM tg_user WHERE tg_username= '{$username}' AND tg_password = '{$password}'";
			try{
				$connect = DbServer::getInstance()->connect();
			}catch(Exception $e){
				return Response::show(403,"数据库连接失败");
			}

			$queryuser = mysql_query($sql,$connect);
			
			$rowuser = mysql_fetch_array($queryuser);
			
			if ($rowuser || is_array($rowuser) || !empty($rowuser)) {
				if ($rowuser['tg_username'] == $username) {
					if ($rowuser['tg_password'] == $password) {
						mysql_query("UPDATE tg_user SET
						tg_last_time=NOW(),
						tg_last_ip='{$_SERVER["REMOTE_ADDR"]}',
								tg_login_count=tg_login_count+1
														WHERE
														tg_username='{$username}'
														");										
						return Response::show(200,"登录成功",$rowuser);
					} else {
						return Response::show(400,"密码错误");
					}
				} else {
					return Response::show(401,"用户名不存在");
				}
			} else {
				return Response::show(402,"用户名和密码错误");
			}
	}
}

$userLogin = new userLogin();
$userLogin->index();
