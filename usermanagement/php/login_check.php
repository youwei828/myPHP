<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册检测页面！</title>
</head>
<body>
    <?php
    //开启session；
    session_start();
    //连接并选择数据；
    $conn=mysqli_connect("127.0.0.1","root","root","ec");
    //定义管理员账户,管理员为一级用户，比二级用户拥有更高的权限；
    //设置字符集；
mysqli_set_charset($conn,"utf8");

    //管理员1:
    $un1="admin1";
    $pw1="admin1";
    //管理员2:
    $un2="admin2";
    $pw2="admin2";
    //管理员3:
    $un3="admin3";
    $pw3="admin3";

    //获取的表单信息；
    $un = $_POST["username"];
    $pw = $_POST["password"];
    
        //判断密码
        if($un==""||$pw==""){
            echo "<script>alert('账号或者用户名不能为空！');history.go(-1)</script>";
        }
        else{
                if(($un==$un1&&$pw==$pw1)){
                        $_SESSION["a_username1"]=$un1;
                        $_SESSION["a_password1"]=$pw1;
                        $remember = $_POST["remember"];
                    // 创建cookie
                    // 过期时间被设置为一个月（60 秒 * 60 分 * 24 小时 * 30 天）
                    $expire = time() + 60 * 60 * 24 * 30;
                    setcookie("a_username1", $un1, $expire);
                    setcookie("a_password1", $pw1, $expire);
                    echo "<script>alert('登录成功!您为一级管理员，可以进行信息更新！')</script>";
                    echo "<script>window.location.href = 'show.php';</script>";
                }else{
                    if($un==$un2&&$pw==$pw2){
                        $_SESSION["a_username2"]=$un2;
                        $_SESSION["a_password2"]=$pw2;
                        // 创建cookie
                        // 过期时间被设置为一个月（60 秒 * 60 分 * 24 小时 * 30 天）
                        $expire = time() + 60 * 60 * 24 * 30;
                        setcookie("a_username2", $un2, $expire);
                        setcookie("a_password2", $pw2, $expire);
                        echo "<script>alert('登录成功!您为一级管理员，可以进行信息更新！')</script>";
                        echo "<script>window.location.href = 'show.php';</script>";
                    }else{
                        if($un==$un3&&$pw==$pw3){
                            $_SESSION["a_username3"]=$un3;
                            $_SESSION["a_password3"]=$pw3;
                            // 创建cookie
                            // 过期时间被设置为一个月（60 秒 * 60 分 * 24 小时 * 30 天）
                            $expire = time() + 60 * 60 * 24 * 30;
                            setcookie("a_username3", $un3, $expire);
                            setcookie("a_password3", $pw3, $expire);
                            echo "<script>alert('登录成功!您为一级管理员，可以进行信息更新！')</script>";
                            echo "<script>window.location.href = 'show.php';</script>";
                        }else{
                            $select_sql = "select password from users where username = '$un'";
                            $sql_res = mysqli_query($conn,$select_sql);
                            if(mysqli_num_rows($sql_res)!=0){
                            while($res = mysqli_fetch_array($sql_res)){
                                if($pw == $res["password"]){
                                    //设置二级用户权限的session；
                                    $_SESSION["username"]=$un;
                                    $_SESSION["password"]=$pw;
                                    // 创建cookie
                                    // 过期时间被设置为一个月（60 秒 * 60 分 * 24 小时 * 30 天）
                                    $expire = time() + 60 * 60 * 24 * 30;
                                    setcookie("username", $un, $expire);
                                    setcookie("password", $pw, $expire);
                                    echo "<script>alert('登录成功!您为二级用户，可以查看自己的信息！')</script>";
                                    echo "<script>window.location.href = 'show.php';</script>";
                                }
                                else{
                                            echo "<script>alert('密码错误，请重新登录！');history.go(-1)</script>";
                                            }
                                        }
                                    }
                        else{
                            echo "<script>alert('用户不存在！');history.go(-1)</script>";
                                } 
                            }
                    }
                }
            }
            //关闭数据库；
            mysqli_close($conn);
    ?>
</body>
</html>