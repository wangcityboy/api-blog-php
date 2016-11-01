<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$articleId = isset($_GET['id']) ? $_GET['id'] : 1;

if (!is_numeric($articleId)){
	 return Response::show(401,'数据不合法');
}

$sql = "UPDATE tg_article SET tg_readcount=tg_readcount+1 WHERE tg_id=".$articleId;

try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}

if(mysql_query($sql,$connect)){
	return Response::show(200,'文章阅读量更新成功');
}else{
	return Response::show(400,'文章阅读量更新失败');
}
