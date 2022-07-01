<?php
$link=mysqli_connect("127.0.0.1","root","root");
if ($link){
	echo "数据连接成功！";
	}
else{
	echo "数据库连接失败！";	
	}
#创建数据库和数据表
$cd="create database ec";
$cdresult=mysqli_query($link,$cd);
mysqli_select_db($link,"ec");
$ct="create table users(id int primary key auto_increment,username varchar(20) not null unique,password varchar(20) not null, telephone varchar(15), email varchar(50),regtime datetime)";
$ctresult=mysqli_query($link,$ct);

?>