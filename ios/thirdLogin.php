<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");
class thirdLogin{

	public function index(){
		
		$client_id = $_POST['client_id'];
		$platform_id = $_POST['platform_id'];
		$username = $_POST['username'];
		$face = $_POST['face'];

		
		if ($client_id && $platform_id && $username && $face){
			$sql = "SELECT * FROM tg_thirdLogin WHERE tg_username='{$username}'";
			
			try{
				$connect = DbServer::getInstance()->connect();
			}catch(Exception $e){
				return Response::show(403,"数据库连接失败");
			}
			
			$result = mysql_query($sql,$connect);
			$third_users = array();
			
			if($result){
				while ($third_user = mysql_fetch_assoc($result)){
					$third_users[] = $third_user;
				}
			}else{
				$insertInto = "INSERT INTO tg_thirdLogin (tg_platform_id,tg_client_id,tg_username,tg_face)  VALUES	($platform_id,$client_id,'{$username}','{$face}')";					
				mysql_query($insertInto);
			}
			if($third_users){
				return Response::show(200,'query sucess',$third_users);
			}else{
				return Response::show(401,'insert sucess',$username);
			}
		}else{
			Response::show(501,'第三方登录失败');
		}
	}
}

$thirdLogin = new thirdLogin();
$thirdLogin->index();