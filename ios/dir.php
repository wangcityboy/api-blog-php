<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 6;

if (!is_numeric($page) || !is_numeric($pageSize)){
	 return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;

$sql = "SELECT * FROM tg_dir WHERE tg_type = 0 order by tg_date DESC  limit ".$offset.",".$pageSize;


try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}


$result = mysql_query($sql,$connect);

$dirs = array();

while ($dir = mysql_fetch_assoc($result)){
	$dirs[] = $dir; 
}


if($dirs){
	return Response::show(200,"相册列表获取成功",$dirs);
}else{
	return Response::show(400,"相册列表获取失败");
}