<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 4;

if (!is_numeric($page) || !is_numeric($pageSize)){
	 return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;
$sql = "SELECT * FROM tg_advertise  order by tg_id DESC  limit ".$offset.",".$pageSize;


try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}

$result = mysql_query($sql,$connect);

$advertises = array();

while ($advertise = mysql_fetch_assoc($result)){
	$advertises[] = $advertise; 
}

if($advertises){
	return Response::show(200,"广告轮播图获取成功",$advertises);
}else{
	return Response::show(400,"广告轮播图获取失败");
}