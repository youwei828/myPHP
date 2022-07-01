<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户注册页面</title>
</head>
<body>
	<center>
    	<div>
        	<div>请填写注册信息！</div>
            <form name="register" action="check.php" method="post">
            	<div>用户名：<input type="text" name="username" size="20"></div>
                <div>密码：<input type="text" name="password" size="20"></div>
                <div>电话：<input type="text" name="telephone" size="20"></div>
                <div>邮箱：<input type="text" name="email" size="20"></div>
                <div><input type="submit" name="submit" value="注册"><input type="reset" name="reset" value="重置"></div>
            </form>
        </div>
    </center>
</body>
</html>