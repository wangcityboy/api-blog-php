<?php
require_once("header.php");
require_once("../global.php");
require_once(SITE_PATH."/model/User.php");

class  useradmin
{
	function getData()
	{
		$user = new User();
		$data = $user->getUser();
		
		$_htmllist = array();
		while (!!$item = _fetch_array_list($data)){
			$_htmllist[] = array(
					"id"=>$item['tg_id'],
					"username"=>$item['tg_username'],
					"email"=>$item['tg_email'],
					"qq"=>$item['tg_qq'],
					"url"=>$item['tg_url'],
					"sex"=>$item['tg_sex'],
					"face"=>$item['tg_face'],
			);
		
		}
		
		return $_htmllist;
	}
}
$user = new useradmin();
$data = $user->getData();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>云飞凌风个人博客后台系统</title>
    </head>
 <body> 
<table border="1">
<tr>
	<td>ID号</td>
	<td>用户名</td>
	<td>邮件</td>
	<td>QQ</td>
	<td>主页</td>
	<td>性别</td>
	<td>头像</td>
</tr>
<?php 
foreach ($data as $item)
{
	
	if ($item['sex'] == 1){
		$_sex ="男";
	}else{
		$_sex ="女";
	}
?>
<tr>
	<td><?php echo $item['id']; ?></td>
	<td><?php echo $item['username']; ?></td>
	<td><?php echo $item['email']; ?></td>
	<td><?php echo $item['qq']; ?></td>
	<td><?php echo $item['url']; ?></td>
	<td><?php echo $_sex; ?></td>
	<td><?php echo $item['face']; ?></td>
</tr>
<?php 
}
?>
</table>
</body>
</html>
