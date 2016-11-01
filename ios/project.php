<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$sql = "SELECT * FROM tg_project  order by tg_order desc";


try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}

$result = mysql_query($sql,$connect);

$projects = array();
	
while ($project = mysql_fetch_assoc($result)){
	$projects[] = $project;
}


if($projects){
	return Response::show(200,"项目列表获取成功",$projects);
}else{
	return Response::show(400,"项目列表获取失败");
}
