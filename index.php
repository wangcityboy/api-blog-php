<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>云飞凌风个人博客后台系统</title>
    </head>
    <body>
    <?php
    	require_once("global.php");
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            $name = "";
            $welcome = "欢迎来到我的家园！";
            if(isset($_SESSION['nickname']))
            {
                $name = $_SESSION['nickname'];
                $welcome  .= "大家好，我叫".htmlspecialchars($name);
            }
            
            echo $welcome;
            
            if(isset($_SESSION['admin']))
            {
                $admin = $_SESSION['admin'];
                if($admin == 1)
                {
                    echo "<div style='float:right'><a href='logout.php'>退出登录</a>|<a href='admin/index.php?name=".urlencode($name)."&admin=".$admin."'>管理后台</a></div>";
                }else{
                	echo "<div style='float:right;margin-left:10px;'><a href='./admin/index.php'>登录后台</a></div>";
                	echo "<div style='float:right;margin-left:10px;'><a href='logout.php'>注销登录</a></div>";
                }
            }
		    else
		    {	
				if(!isset($_SESSION['uid']) || !$_SESSION['uid'])
				{
				       echo "<div style='float:right;margin-left:10px;'><a href='register.php'>游客注册</a>|<a href='login.php'>用户登录</a></div>";
				}
				else
				{
				       echo "<div style='float:right;margin-left:10px;'><a href='login.php'>登录后台</a>|<a href='logout.php'>注销登录</a></div>";           
				}
		    }
            
        ?>
        
        <h1>欢迎使用云飞凌风个人博客接口管理系统</h1>
        <h2>#:已开发完成的接口地址,返回Json格式数据</h2>    
        <p>获取所有日志列表：<a href="http://wanghaifeng.net/api/api.php?act=article">http://wanghaifeng.net/api/api.php?act=article</a></p>
        <p>获取所有用户列表：<a href="http://wanghaifeng.net/api/api.php?act=user">http://wanghaifeng.net/api/api.php?act=user</a></p>
        <p>获取所有相册列表：<a href="http://wanghaifeng.net/api/api.php?act=dir">http://wanghaifeng.net/api/api.php?act=dir</a></p>
        <p>获取相册下的相片列表：<a href="http://wanghaifeng.net/api/api.php?act=photo&sid=36">http://wanghaifeng.net/api/api.php?act=photo&sid=36</a></p>
        
        <h2>#:以下为iOS手机端接口地址,返回Json格式数据</h2> 
        <p>获取项目列表：<a href="http://wanghaifeng.net/api/ios/project.php">http://wanghaifeng.net/api/ios/project.php</a></p>
 		<p>获取相册列表：<a href="http://wanghaifeng.net/api/ios/photos.php">http://wanghaifeng.net/api/ios/photos.php</a></p>
 		<p>获取广告列表：<a href="http://wanghaifeng.net/api/ios/advertise.php">http://wanghaifeng.net/api/ios/advertise.php</a></p>
 		<p>获取背景图片：<a href="http://wanghaifeng.net/api/ios/background.php">http://wanghaifeng.net/api/ios/background.php</a></p>
 		<p>获取用户资料：<a href="http://wanghaifeng.net/api/ios/userInfo.php?username=wanghaifeng">http://wanghaifeng.net/api/ios/userInfo.php?username=wanghaifeng</a></p>
        
</html>
