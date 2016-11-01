<?php
require_once("header.php");
require_once("../global.php");
require_once(SITE_PATH."/model/PhotoDir.php");
class  photo_dir
{
	function getPhotoDir()
	{
		$dir = new PhotoDir();
		
		$data = $dir->getPhotoDirList();
		
		$_htmllist = array();
		while (!!$item = _fetch_array_list($data)){
			$_htmllist[] = array(
					"id"=>$item['tg_id'],
					"name"=>$item['tg_name'],
					"type"=>$item['tg_type'],
					"content"=>$item['tg_content'],
					"face"=>$item['tg_face'],
					"dir"=>$item['tg_dir'],
					"date"=>$item['tg_date'],
			);
		
		}
		
		return $_htmllist;
		
	}
}


$photo_dir = new photo_dir();
$data = $photo_dir->getPhotoDir();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>云飞凌风个人博客系统-相册管理</title>
    </head>
<body> 

<table border="1">
<tr>
	<td>相册ID</td>
	<td>相册名称</td>
	<td>加密与否</td>
	<td>相册简介</td>
	<td>相册封面路径</td>
	<td>相册所在目录</td>
	<td>创建日期</td>
</tr>
<?php 
foreach ($data as $item)
{
	if($item['type']==1){
		$_str = "已加密";
	}else {
		$_str = "未加密";
	}
?>
<tr>
	<td><?php echo $item['id']; ?></td>
	<td><?php echo $item['name']; ?></td>
	<td><?php echo $_str; ?></td>
	<td><?php echo $item['content']; ?></td>
	<td><?php echo $item['face']; ?></td>
	<td><?php echo $item['dir']; ?></td>
	<td><?php echo $item['date']; ?></td>
</tr>
<?php 
}
?>
</table>
</body>
</html>
