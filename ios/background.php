<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$sql = "SELECT * FROM tg_background  order by tg_order desc";

try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}

$result = mysql_query($sql,$connect);

$bg_imgs = array();	

while ($bg_img = mysql_fetch_assoc($result)){
	$bg_imgs[] = $bg_img;
}

$rank = rand(0,count($bg_imgs)-1);

if($bg_imgs){
	return Response::show(200,"个人中心背景图获取成功",$bg_imgs[$rank]);
}else{
	return Response::show(400,"个人中心背景图获取失败");
}
