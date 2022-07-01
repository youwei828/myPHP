<?php
session_start();
$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
$username=$_POST["username"];
$password=$_POST["password"];
$auto=$_POST["auto"];

#是否记录账号密码，如果是，则写入到cookie
if($auto=="yes"){
	setcookie("name",$username);
	setcookie("password",$password);
	}

$select_sql="select password from users where username='$username'";
$select_result=mysqli_query($link,$select_sql);
while($result=mysqli_fetch_array($select_result))
{
	if($result){
		if($password==$result["password"]){
			echo "登陆成功！可进入<a href='management.php'>管理中心</a>";
			$_SESSION["username"]=$username;
			$_SESSION["password"]=$password;
			}
		else{
			echo "密码错误,，返回<a href='login.php'>登录</a>！";
			}
		}
	else{
		echo "用户名错误,，返回<a href='login.php'>登录</a>！";
		}
	}

?>