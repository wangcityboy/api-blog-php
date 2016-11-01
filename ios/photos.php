<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 6;

if (!is_numeric($page) || !is_numeric($pageSize)){
	 return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;


$sql = "SELECT a.tg_id,a.tg_name ,a.tg_face,a.tg_date, group_concat(b.tg_url) tg_images FROM tg_dir a  cross join  tg_photo b 
on a.tg_id = b.tg_sid 
group by a.tg_id 
order by a.tg_date DESC  limit ".$offset.",".$pageSize;

try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}


$result = mysql_query($sql,$connect);

$photos = array();

while ($photo = mysql_fetch_assoc($result)){
	$photo['tg_images']= explode(',', $photo['tg_images']);
	$photos[] = $photo; 
}


if($photos){
	return Response::show(200,"相片列表获取成功",$photos);
}else{
	return Response::show(400,"相片列表获取失败");
}
