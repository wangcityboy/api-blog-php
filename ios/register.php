<?php
require_once("../include/Response.php");
require_once("../include/DbServer.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 6;

if (!is_numeric($page) || !is_numeric($pageSize)){
	 return Response::show(401,'数据不合法');
}

$offset = ($page - 1) * $pageSize;

$sql = "insert `tg_user`(`tg_id`,`tg_username`,`tg_password`,`tg_email`,`tg_qq`,`tg_url`,`tg_sex`,`tg_face`,`tg_switch`,`tg_autograph`,`tg_level`) 
		values(1,'测试','f8e8d66ffa0a87367104b9786d17c7502cdb2eaa','wangcityboy@163.com','273262403','http://wanghaifeng.net','男','face/m01.gif',1,'既来之，则安之～',1)";


try{
	$connect = DbServer::getInstance()->connect();
}catch(Exception $e){
	return Response::show(403,"数据库连接失败");
}


$result = mysql_query($sql,$connect);



if($result){
	return Response::show(200,"注册成功");
}else{
	return Response::show(400,"注册失败");
}