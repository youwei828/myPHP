<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户信息展示界面！</title>
    <link rel="stylesheet" href="../css/user_show.css">
</head>
<body>
    <?php
        session_start();
        //连接并选择数据；
        $conn=mysqli_connect("127.0.0.1","root","root","ec");
        //获取session；
        $s1 = $_SESSION["username"];
        //查询；
        $select_sql = "select * from users where username = '$s1'";
        $sql_res = mysqli_query($conn,$select_sql);
        $row = mysqli_fetch_array($sql_res);
    ?>

    <!-- 头部开始 -->
    <div id="header">
        <div class="header">
            <div class="header_left">
                <div>
                    <span> <?php
                            session_start();
                            if(!isset($_COOKIE["visits1"]))
                            {
                                echo "欢迎您首次访问信息管理中心！";
                                $visits1=1;
                                setcookie("visits1",$visits1,time()+3600*24*365);
                                }
                            else{
                                $visits1=$_COOKIE["visits1"]+1;
                                echo "欢迎您，亲爱的" . $row[1]  . "，您是二级用户，这是您第".$visits1."次访问！";
                                setcookie("visits1",$visits1,time()+3600*24*365);
                                }
                        ?></span>
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
    <br class="clearfix_header">                 <!-- 清除浮动 -->
    <!-- 内容开始 -->
    <div id="center">
        <div class="tip">
            <p>以下是您的本人信息，请确认是否正确。</p>
        </div>
        <div class="center">
            <div style="height:10px"></div>
            <div class="item_one">
                <div>Username</div>
                <div><? echo $row[1] ?></div>
            </div>
            <div class="item_one">
                <div>Gender</div>
                <div><? echo $row[5] ?></div>
            </div>
            <div class="item_one">
                <div>Telephone</div>
                <div><? echo $row[3] ?></div>
            </div>
            <div class="item_one">
                <div>E-mail</div>
                <div><? echo $row[4]?></div>
            </div>
            <div class="item_two">
                <div>image</div>
                <div>
                    <div class="img">
                        <img src="../img/<?=$row[7]?> " alt="您的照片" >
                    </div>
                </div>
            </div>
        </div>    
        <!-- 内容结束 -->
        <!-- 底部开始 内容暂未设置-->
        <div class="help">
            <span>
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=641531008&site=qq&menu=yes">若信息错误，请联系管理员进行修改。</a>
            </span>
        </div>
        <!-- 底部结束 -->
    </div>





    <!--确认退出弹窗语句；-->
	<script language="javascript">
    function outt(){
    var isRemove = confirm("删除是不可恢复的！\n您确认要删除吗？");
    console.log(isRemove?'确定删除!':'取消删除!');
    if(isRemove){
        return true; 
        window.location.href = 'out.php';
        } else {
        return false;
        }
    }
    </script>
    

        
        


    </div>


</body>
</html>