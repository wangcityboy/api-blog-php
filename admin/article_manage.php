<?php
require_once("header.php");
require_once("../global.php");
require_once(SITE_PATH."/include/Common.php");
require_once(SITE_PATH."/model/Article.php");
class  article_manage
{
	function getData()
	{
		$article = new Article();
		$data = $article->getArticleList();
		
		$_htmllist = array();
		while (!!$item = _fetch_array_list($data)){
			$_htmllist[] = array(
					"id"=>$item['tg_id'],
					"username"=>$item['tg_username'],
					"classify"=>$item['tg_classify'],
					"title"=>$item['tg_title'],
					"content"=>$item['tg_content'],
					"image"=>$item['tg_image'],
					"readcount"=>$item['tg_readcount'],
					"date"=>$item['tg_date'],
			);		
		}
		
		return $_htmllist;
	}
}

$article = new article_manage();
$data = $article->getData();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>云飞凌风后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>


<table border="1">
<tr>
	<td>ID号</td>
	<td>作者</td>
	<td>日志分类</td>
	<td>日志标题</td>
	<td>日志封面</td>
	<td>浏览量</td>
	<td>发表时间</td>
</tr>
<?php 
foreach ($data as $item)
{
	if($item['classify']==1){
		$_str = "iOS开发";
	}else if($item['classify']==2){
		$_str = "安卓开发";
	}else if($item['classify']==3){
		$_str = "后台开发";
	}else if($item['classify']==4){
		$_str = "前端开发";
	}else if($item['classify']==5){
		$_str = "测试开发";
	}else if($item['classify']==6){
		$_str = "信息技术";
	}else if($item['classify']==7){
		$_str = "生活随笔";
	}else if($item['classify']==8){
		$_str = "网络文摘";
	}
?>
<tr>
	<td><?php echo $item['id']; ?></td>
	<td><?php echo $item['username']; ?></td>
	<td><?php echo $_str; ?></td>
	<td><?php echo $item['title']; ?></td>
	<td><?php echo $item['image']; ?></td>
	<td><?php echo $item['readcount']; ?></td>
	<td><?php echo $item['date']; ?></td>
</tr>
<?php 
}
?>
</table>
</body>
</html>
