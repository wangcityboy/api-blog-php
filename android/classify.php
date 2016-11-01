<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$sql = "SELECT * FROM tg_classify  order by tg_id DESC";

try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}

$result = mysql_query($sql,$connect);

$classifies = array();

while ($classify = mysql_fetch_assoc($result)){
	$classifies[] = $classify;
}

if($classifies){
	return Response::show(200,"分类列表获取成功",$classifies);
}else{
	return Response::show(400,"分类列表获取失败");
}