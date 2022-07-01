<?php
//连接数据库；
$conn = mysqli_connect("127.0.0.1","root","root");
//创建数据库；
$cd_ec = "create database ec";
$ec_res = mysqli_query($conn,$cd_ec);
//选择ec数据库；
mysqli_select_db($conn,"ec");
//设置字符集；
mysqli_set_charset($conn,"utf8");
//创建用户详情信息表；
$ct_users = "CREATE TABLE users (
id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
username varchar(25) NOT NULL,
password varchar(25) NOT NULL,
telephone varchar(25) DEFAULT NULL,
email varchar(50) DEFAULT NULL,
gender varchar(10) DEFAULT NULL,
level varchar(10) NOT NULL,
path varchar(255) ,
lid int ,
regtime datetime DEFAULT NULL) CHARSET=gbk";
$users_res = mysqli_query($conn,$ct_users);
if ($users_res){
//默认插入三条数据；
$insert_sql="INSERT INTO users VALUES (null, '张三', 'zhangsan', '123', 'zhangsan@123.com', 'male','二级用户', 't1.jpg',2, now()),(null, '李四', 'lisi', '456', 'lisi@123.com', 'famale', '二级用户', 't2.jpg',2, now()),(null, '王五', 'wangwu', '789', 'wangwu@123.com', 'famale', '二级用户', 't3.jpg',2, now())";
$insert_result=mysqli_query($conn,$insert_sql);
echo "<script>alert('数据连接成功！')</script>";
echo "<script>window.location.href = '../login.html';</script>";
}else{
echo "<script>alert('数据库连接失败！');history.go(-1)</script>";
}
// 创建用户级别信息表；
$ct_level = "create table level(id int primary key auto_increment ,lev_name varchar(20) not null unique)";
$level_res1 = mysqli_query($conn,$ct_level);
$insert_level = "INSERT INTO level VALUES (null,'一级用户'),(null,'二级用户')";
$level_res2 = mysqli_query($conn,$insert_level);
// 进行外键连接；
$foeeign_sql = "alter table users add constraint level_id foreign key (lid) references level (id)";
$sql_res = mysqli_query($conn,$foeeign_sql);
//关闭数据库；
mysqli_close($conn);

//修改某个用户的权限；
//update users set lid = 1 where username= "li";
//进行两个表的数据更新语句；
//update users s join level l on s.lid = l.id  set s.lev = "三级权限" where s.lid =3;
// 建立插入语句的触发器,插入username表的之后自动插入level表；
// DELIMITER $$
// CREATE TRIGGER insert_users AFTER INSERT ON users FOR EACH ROW
// IF new.lid=1 THEN
//     INSERT INTO level VALUES(null , "username1" , "一级权限");
// ELSE
//     INSERT INTO level VALUES(null , "username2" , "二级权限");
// END IF
// $$
// DELIMITER ;
//删除插入语句的触发器;
// DROP TRIGGER insert_users;
?>