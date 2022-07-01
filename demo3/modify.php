<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改页面</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["username"])){
	echo "非法用户，请登录";
	}
else{
	$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
	$id=$_GET["id"];
	$select_sql="select * from users where id=$id";
	$select_result=mysqli_query($link,$select_sql);
	while($row=mysqli_fetch_array($select_result)){
	?>
			<div>
				<div>请填写注册信息！</div>
				<form name="modify" action="modify_check.php" method="post">
					<div>用户名：<input type="text" name="username" size="20" value="<?=$row["username"]?>"></div>
					<div>密码：<input type="text" name="password" size="20"  value="<?=$row["password"]?>"></div>
					<div>电话：<input type="text" name="telephone" size="20" value="<?=$row["telephone"]?>"></div>
					<div>邮箱：<input type="text" name="email" size="20" value="<?=$row["email"]?>"><input type="hidden" name="id" value="<?=$id?>"></div>
					<div><input type="submit" name="submit" value="修改"><input type="reset" name="reset" value="重置"></div>
				</form>
			</div>
	<?php	
		}
	
	}

?>
</body>
</html>