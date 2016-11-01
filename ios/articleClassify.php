<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 20;
$classifyID = $_GET['classify_id'] != 10006 ? $_GET['classify_id'] : '10007,10008,10009,10010,10011,10012,10013,10014';

if (!is_numeric($page) || !is_numeric($pageSize)){
	return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;

$sql = "SELECT * FROM tg_article WHERE tg_reid = 0 AND tg_classify in "."(".$classifyID.")"." order by tg_id DESC  limit ".$offset.",".$pageSize;

try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}

$result = mysql_query($sql,$connect);

$articles = array();

while ($article = mysql_fetch_assoc($result)){
	$articles[] = $article;
}

if($articles){
	return Response::show(200,"文章分类下的文章列表获取成功",$articles);
}else{
	return Response::show(400,"文章分类下的文章列表获取失败");
}