<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改页面</title>
    <link rel="stylesheet" href="../css/modify_show.css">
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION["a_username1"])&&!isset($_SESSION["a_username2"])&&!isset($_SESSION["a_username3"])){
        echo "非法用户，请登录";
        }
    else{
        $link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
        $id=$_GET["id"];
        $select_sql="select * from users where id=$id";
        $select_result=mysqli_query($link,$select_sql);
        while($row=mysqli_fetch_array($select_result)){
        ?>
        <!-- 头部开始 -->
    <div id="header">
        <div class="header">
            <div class="header_left">
                <div>
                    <span>返回<a href="admin_show.php">信息管理中心</a></span>
                </div>    
            </div>
            <div class="header_right">
                <div>
                    <span><a href="out.php">退出登录</a></span>
                </div>
            </div>
        </div>
    </div>
    <!-- 头部结束 -->
    <!-- 清除浮动 -->
    <br class="clearfix_header">                 
                <!-- 内容开始 -->
    <div id="center">
        <div class="tip">
            <p>请修改该用户的个人信息</p>
        </div>
        <div class="center">
            <form action="modify_check.php" method="post" enctype="multipart/form-data">
            <div style="height:10px"></div>
            <div class="item_one">
                <div>Username</div>
                <div><input type="text"  name="username" value=<?=$row[1]?>></div>
            </div>
            <div class="item_one">
                <div>Gender</div>
                <div> <select name="gender"   style="width: 22rem;">
                    <option value="famale">famale</option>
                    <option value="male">male</option>
                    </select></div>
            </div>
            <div class="item_one">
                <div>Telephone</div>
                <div><input type="text"  name="telephone" value=<?=$row[3]?>></div>
            </div>
            <div class="item_one">
                <div>E-mail</div>
                <div><input type="text"  name="email" value=<?=$row[4]?> ></div>
            </div>
            <div class="item_two">
                <div>image</div>
                <div>
                    <div class="img">
                        <img src="../img/<?=$row[7]?> " alt="您的照片" >
                    </div>
                </div>
            </div>
            <div class="item_three">
            <div>
                <span>modify image</span>
                <span><input type="file"  name="image" ></span>
            </div>
            <div><input type="submit" value="SUBMIT"></div>
            </div>
            <input type="hidden" name="id" value="<?=$id?>">
            </form>     
        </div>

        <?php	
            }
        
        }
    ?>    

</body>
</html>