<?php
$link=mysqli_connect("127.0.0.1","root","root","ec");#连接并选择数据
//判断用户是否已经注册，未注册进行注册，已经注册过提示用户名已存在或者跳转登录页面；
if(isset($_POST["submit"])){
    $un = $_POST["username"];
    $pw = $_POST["password"];
    if($un == "" || $pw == ""){
        echo "<script>alert('用户名或密码不能为空！');history.go(-1)</script>";
    }else{
        $select_sql1 = "select * from users where username = '$un'";
        $sql1_res = mysqli_query($link,$select_sql1);
        $pass = mysqli_fetch_row($sql1_res);     //判断pass是否存在；
        if($pass){
            echo "<script>alert('用户名已存在，请更换用户名！');history.go(-1)</script>";
        }else{
            $username=$_POST["username"];
            $password=$_POST["password"];
            $telephone=$_POST["telephone"];
            $email=$_POST["email"];
            $insert_sql="insert into users(username,password,telephone,email,regtime) values('$username','$password','$telephone','$email',now())";
            $insert_result=mysqli_query($link,$insert_sql);
            if(!$insert_result){
               die("注册失败！".mysqli_erro($link));
            }
            else
                echo "<script>alert('注册成功!点击确定跳转至登录页面。')</script>";
                echo "<script>window.location.href = 'login.php';</script>";
        }
    }
}
mysqli_close($link);
?>