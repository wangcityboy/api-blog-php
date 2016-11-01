<?php
 session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>用户登录</title>
	</head>
<style type="text/css">
div{
	margin-top:10px;
}
</style>

<body>


<?php
require_once("global.php");
require_once(SITE_PATH."/include/Common.php");
require_once(SITE_PATH."/model/User.php");

$data = $_POST;

if(!empty($data))
{
	$user = new User();
	$user->username = $data['username'];
	$user->password = $data['password'];
	$ret = $user->checkUser();
	if($ret)
	{
		$_SESSION['username'] = $ret['tg_username'];
		$_SESSION['nickname'] = $ret['tg_nickname'];
		if($ret['tg_username'] == "wanghaifeng")
	    {
			$_SESSION['admin'] = 1;
		}
		echo '<script type="text/javascript">alert("Login Success!");window.location="index.php";</script>';
	}
	else
	{
		echo '<script type="text/javascript">alert("Login Failed!");window.location="login.php";</script>';
	}
	_close();
}
else
{
?>
		<div>
			<form action="login.php" method="POST">
				<div> 
					<label for="username">帐号:</label>
					<input type="text" name="username" id="username" value="" />
				</div>
				
				<div>
					<label for="password">密码:</label>
					<input type="password" name="password" id="password" value="" />
				</div>
				
				<div>
					<input type="submit" name="submit" value="用户登录"/>
				</div>
				
			</form>
		</div>
<?php
}
?>

</body>
</html>
