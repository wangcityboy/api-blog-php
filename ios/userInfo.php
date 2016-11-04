<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

class userInfo{

		public function index(){
			
			$username = $_GET['username'];
			$sql = "SELECT * FROM tg_user WHERE tg_username= '{$username}'";
			
			try{
				$connect = DbServer::getInstance()->connect();
			}catch(Exception $e){
				return Response::show(403,"数据库连接失败");
			}

			$result = mysql_query($sql,$connect);
	

			$userinfos = array();
			
			while ($userinfo = mysql_fetch_assoc($result)){
				$userinfos[] = $userinfo;
			}
			
			if($userinfos){
				return Response::show(200,"用户信息获取成功",$userinfos);
			}else{
				return Response::show(400,"用户信息获取失败");
			}			
	}
}

$userInfo = new userInfo();
$userInfo->index();
