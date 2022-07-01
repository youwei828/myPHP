<?php
//连接数据库；
$conn = mysqli_connect("127.0.0.1","root","root");
if ($conn){
	echo "数据连接成功！请跳转至<a href='reg.html'>注册页面</a>";
	}
else{
	echo "数据库连接失败！";	
	}
//创建数据库；
$cd_ec = "create database ec";
$ec_res = mysqli_query($conn,$cd_ec);
//选择ec数据库；
mysqli_select_db($conn,"ec");
//创建用户详情信息表；
$ct_users = "create table users(id int primary key auto_increment,username varchar(20) not null unique,password varchar(20) not null, telephone varchar(15), email varchar(50),lid int, lev varchar(10) ,regtime datetime)";
$users_res = mysqli_query($conn,$ct_users);
//创建用户级别信息表；
$ct_level = "create table level(id int primary key,lev_name varchar(10))";
$level_res = mysqli_query($conn,$ct_level);
//进行外键连接；
$foeeign_sql = "alter table users add constraint level_id foreign key (lid) references level (id)";
$sql_res = mysqli_query($conn,$foeeign_sql);

//修改某个用户的权限；
//update users set lid = 1 where username= "li";
//进行两个表的数据更新语句；
//update users s join level l on s.lid = l.id  set s.lev = "三级权限" where s.lid =3;
?>