<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>数据库安装！</title>
</head>

<body>
<?php
	$link=mysqli_connect("127.0.0.1","root","123456");
	if($link){
		echo "数据库连接成功";
	}
	else{
		echo "数据库连接失败";
	}
	$cd = "create database ec";
	$cd_result = mysqli_query($link,$cd);
	mysqli_select_db($link,"ec");
	$ct = "create table product(
	id int primary key auto_increment,
	gs_name varchar(20) unique,
	gs_class varchar(16) not null,
	gs_desc varchar(100) not null,
	gs_price int not null,
	gs_stock int,
	gs_time datetime)charset gbk";
	$ct_result = mysqli_query($link,$ct);
?>

</body>
</html>