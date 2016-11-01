<?php
require_once("header.php");
require_once("../global.php");
require_once(SITE_PATH."/model/Photo.php");
class  photo_manage
{
	function getPhotoList()
	{
		$photo = new Photo();
		
		$data = $photo->getUserPhotoList();
		
		$_htmllist = array();
		while (!!$item = _fetch_array_list($data)){
			$_htmllist[] = array(
					"id"=>$item['tg_id'],
					"name"=>$item['tg_name'],
					"url"=>$item['tg_url'],
					"content"=>$item['tg_content'],
					"sid"=>$item['tg_sid'],
					"username"=>$item['tg_username'],
					"readcount"=>$item['tg_readcount'],
					"date"=>$item['tg_date'],
			);
		
		}
		
		return $_htmllist;
		
	}
}


$photo_manage = new photo_manage();
$data = $photo_manage->getPhotoList();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>云飞凌风个人博客系统-相片管理</title>
    </head>
<body> 

<table border="1">
<tr>
	<td>相片ID</td>
	<td>相片名称</td>
	<td>相片相对路径</td>
	<td>相片简介</td>
	<td>父目录ID</td>
	<td>相片上传者</td>
	<td>浏览量</td>
	<td>创建日期</td>
</tr>
<?php 
foreach ($data as $item)
{
	
?>
<tr>
	<td><?php echo $item['id']; ?></td>
	<td><?php echo $item['name']; ?></td>
	<td><?php echo $item['url']; ?></td>
	<td><?php echo $item['content']; ?></td>
	<td><?php echo $item['sid']; ?></td>
	<td><?php echo $item['username']; ?></td>
	<td><?php echo $item['readcount']; ?></td>
	<td><?php echo $item['date']; ?></td>
</tr>
<?php 
}
?>
</table>
</body>
</html>
