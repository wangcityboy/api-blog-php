<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");
require_once("../include/CacheFile.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 20;

$articleId = isset($_GET['id']) ? $_GET['id'] : 1;

if (!is_numeric($page) || !is_numeric($pageSize)){
	 return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;

$sql = "SELECT * FROM tg_article WHERE tg_reid = 0 order by tg_id DESC  limit ".$offset.",".$pageSize;


$articles = array();
$cache = new CacheFile();

if(!$articles = $cache->cacheData("article_cache".$page.'_'.$pageSize)){
	try{
		$connect = DbServer::getInstance()->connect();
	}catch(Exception $e){
		return Response::show(403,"数据库连接失败");
	}

	$result = mysql_query($sql,$connect);

	while ($article = mysql_fetch_assoc($result)){
		$articles[] = $article;
	}
	
	//保存到数据库本地上进行缓存
	if($articles){
		$cache->cacheData("article_cache".$page.'_'.$pageSize,$articles,1200);
	}
}

if($articles){
	return Response::show(200,"首页文章列表获取成功",$articles);
}else{
	return Response::show(400,"首页文章列表获取失败");
}