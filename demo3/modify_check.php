<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改信息写入</title>
</head>
<body>
<?php
$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
$id=$_POST["id"];
$username=$_POST["username"];
$password=$_POST["password"];
$telephone=$_POST["telephone"];
$email=$_POST["email"];
$update_sql="update users set username='$username', password='$password',telephone='$telephone',email='$email' where id=$id";
$update_result=mysqli_query($link,$update_sql);
if($update_result){
	echo "信息修改成功,可进入<a href='management.php'>管理中心</>功！";
	}
else{
	echo "信息修改失败！";
	}
?>
</body>
</html>