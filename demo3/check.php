<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>注册信息写入页面</title>
</head>
<body>
<?php
$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
$username=$_POST["username"];
$password=$_POST["password"];
$telephone=$_POST["telephone"];
$email=$_POST["email"];
$insert_sql="insert into users(username,password,telephone,email,regtime) values('$username','$password','$telephone','$email',now())";
$insert_result=mysqli_query($link,$insert_sql);
if($insert_result){
	echo "注册成功，返回<a href='login.php'>登录</a>！";
	}
else{
	echo "注册失败，返回<a href='reg.php' target='new'>注册页面</a>，重新填写！";
	}
?>
</body>
</html>