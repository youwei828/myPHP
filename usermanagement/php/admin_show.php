<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户管理中心！</title>
<link rel="stylesheet" href="../css/admin_show.css">
</head>
<body>

<!-- 头部开始 -->
<div id="header">
        <div class="header">
            <div class="header_left">
                <div>
                    <span>
                        <?php
                            session_start();
                            if(!isset($_COOKIE["visits"]))
                            {
                                echo "欢迎您首次访问信息管理中心！";
                                $visits=1;
                                setcookie("visits",$visits,time()+3600*24*365);
                                }
                            else{
                                $visits=$_COOKIE["visits"]+1;
                                echo "欢迎您，您是管理员用户，这是您第".$visits."次访问信息管理中心！";
                                setcookie("visits",$visits,time()+3600*24*365);
                                }
                        ?>
                    </span>
                </div>    
            </div>
            <div class="header_right">
                <div>
                    <span><a href="add.php">添加用户</a></span>
                    <span><a href="out.php">退出登录</a></span>
                </div>
            </div>
        </div>
    </div>
    <!-- 头部结束 -->
    <br class="clearfix_header">                 <!-- 清除浮动 -->

		<table border="1">
			<tr><th>用户编号</th><th>用户名</th><th>密码</th><th>电话</th><th>邮箱</th><th>性别</th><th colspan="2">操作</th></tr>
			<?PHP
			$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
			$select_sql="select * from users";
			$select_result=mysqli_query($link,$select_sql);
			while($row=mysqli_fetch_array($select_result))
			{
				echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><a href='modify_show.php?id=".$row[0]."'>修改</a></td><td><a href='del.php?id=".$row[0]."'>删除</a></td></tr>";
				}
			?>
		</table>	



</body>
</html>