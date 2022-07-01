<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户管理中心</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["username"])){
	echo "非法用户，请登录";
	}
else{
	
	if(!isset($_COOKIE["visits"]))
	{
		echo "欢迎您首次访问管理中心！";
		$visits=1;
		setcookie("visits",$visits,time()+3600*24*365);
		}
	else{
		$visits=$_COOKIE["visits"]+1;
		echo "欢迎您第".$visits."次访问管理中心！";
		setcookie("visits",$visits,time()+3600*24*365);
		}
	echo "<a href='logout.php'>退出登录。</a>"
	?>
		<table border="1">
			<tr><td>用户编号</td><td>用户名</td><td>密码</td><td>电话</td><td>邮箱</td><td>注册时间</td><td>修改</td><td>删除</td></tr>
			<?PHP
			$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
			$select_sql="select * from users";
			$select_result=mysqli_query($link,$select_sql);
			while($row=mysqli_fetch_array($select_result))
			{
				echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><a href='modify.php?id=".$row[0]."'>修改</a></td><td><a href='delete.php?id=".$row[0]."'>删除</a></td></tr>";
				}
			?>
		</table>	
<?php
	}
?>


</body>
</html>