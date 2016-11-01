<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 6;
$sid = isset($_GET['sid']) ? $_GET['sid'] : 1;

if (!is_numeric($page) || !is_numeric($pageSize)){
	 return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;

$sql = "SELECT * FROM tg_photo WHERE tg_sid = ".$sid." order by tg_date DESC  limit ".$offset.",".$pageSize;

try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}


$result = mysql_query($sql,$connect);

$photos = array();

while ($photo = mysql_fetch_assoc($result)){
	$photos[] = $photo; 
}


if($photos){
	return Response::show(200,"相片列表获取成功",$photos);
}else{
	return Response::show(400,"相片列表获取失败");
}