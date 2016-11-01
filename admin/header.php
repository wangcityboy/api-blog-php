<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
           $url ="../index.php";
           $url = $url."?name={$_GET['name']}&admin={$_GET['admin']}";
        ?>
        <div style='float:right;'>  
	       <a href='user_manage.php'>用户管理</a>
	       |<a href='article_manage.php'>日志管理</a>
	       |<a href='photoDir_manage.php'>相册管理</a>
	       |<a href='photo_manage.php'>相片管理</a>
	       |<a href='<?php echo $url; ?>'>返回前台</a>
        </div>
        <?php
        	echo '<h1>欢迎使用云飞凌风个人博客接口后台管理系统</h1>';
        ?>
        
</body>
</html>

