<!DOCTYPE head PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<title>用户注册</title>
</head>
<style type="text/css">
div{
	margin-top:10px;
}
</style>

<body>
<?php
require_once("./global.php");
require_once(SITE_PATH."/include/Common.php");
require_once(SITE_PATH."/model/User.php");
$data = $_POST;
if(!empty($data))
{
	print_r($data);
	$user = new User();
	$user->username = $data['username'];
	$user->nickname = $data['nickname'];
	$user->password = $data['password'];
	$user->sex = $data['sex'];
	$user->email = $data['email'];
	$user->qq = $data['qq'];
	$user->url = $data['url'];
	
	$ret = $user->addUser();
	if($ret)
	{
		echo '<script type="text/javascript">alert("Register Success!");</script>';
	}
	else
	{
		echo '<script type="text/javascript">alert("Register Failed");</script>';
	}
	_close();
}
else
{
?>
		<div>
			<form action="register.php" method="POST">
			
				<div> 
					<label for="username">帐号:</label>
					<input type="text" name="username" id="username" value="" />
				</div>
				
				<div> 
					<label for="nickname">用户名:</label>
					<input type="text" name="nickname" id="nickname" value="" />
				</div>
				
				<div>
					<label for="password">密码:</label>
					<input type="password" name="password" id="password" value="" />
				</div>
				
				<div>
					<label for="email">邮件:</label>
					<input type="email" required name="email" id="email" value="" />
				</div>
				
				<div>
					<label for="qq">QQ:</label>
					<input type="text" required name="qq" id="qq" value="" />
				</div>
				
				<div>
					<label for="url">主页:</label>
					<input type="text" required name="url" id="url" value="" />
				</div>
				
				<div>
					<label for="sex">性别:</label>
					 男<input type="radio" name="sex" id="sex_male" value="1" />
					 女<input type="radio" name="sex" id="sex_female" value="2" />
				</div>
				
				<div>
				<input type="submit" name="submit" value="Submit"/>
				</div>
				
			</form>
		</div>
<?php
}
?>

</body>
</html>