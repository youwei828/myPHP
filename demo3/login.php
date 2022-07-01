<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录页面</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION["username"])){
	echo "已经登录，无须重复登录，请进入<a href='management.php'>管理中心</a>";
	}
else{
	if(isset($_COOKIE["name"])){
?>
	<center>
    	<div>
        	<div>请填写注册信息！</div>
            <form name="form" action="login_check.php" method="post">
            	<div>用户名：<input type="text" name="username" size="20" value="<?=$_COOKIE["name"]?>"></div>
                <div>密码：<input type="text" name="password" size="20"  value="<?=$_COOKIE["password"]?>"></div>
                <div>是否自动登录：是<input type="radio" name="auto" value="yes">否<input type="radio" name="auto" value="no" checked></div>
                <div><input type="submit" name="submit" value="登录"><input type="reset" name="reset" value="重置"></div>
            </form>
        </div>
    </center>
<?php
	}
	else{
?>
	<center>
    	<div>
        	<div>请填写注册信息！</div>
            <form name="form" action="login_check.php" method="post">
            	<div>用户名：<input type="text" name="username" size="20"></div>
                <div>密码：<input type="text" name="password" size="20"></div>
                <div>是否自动登录：是<input type="radio" name="auto" value="yes">否<input type="radio" name="auto" value="no" checked></div>
                <div><input type="submit" name="submit" value="登录"><input type="reset" name="reset" value="重置"></div>
            </form>
        </div>
    </center>
<?php
	}
}
?>
</body>
</html>