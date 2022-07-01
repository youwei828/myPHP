<?php
//连接并选择数据；
$conn=mysqli_connect("127.0.0.1","root","root","ec");
//判断用户是否已经注册，未注册进行注册，已经注册过提示用户名已存在或者跳转登录页面；
if(isset($_POST["submit"])){
    $un = $_POST["username"];
    $pw1 = $_POST["password1"];
    $pw2 = $_POST["password2"];
    if($un == "" || $pw1 == ""){
        echo "<script>alert('用户名或密码不能为空！');history.go(-1)</script>";
    }else{
        if($pw1!=$pw2){
            echo "<script>alert('两次输入的密码必须一致！');history.go(-1)</script>";
        }else{
            $select_sql = "select * from users where username = '$un'";
            $sql1_res = mysqli_query($conn,$select_sql);
            $pass = mysqli_fetch_row($sql1_res);     //判断pass是否存在；
            if($pass){
                echo "<script>alert('用户名已存在，请更换用户名！');history.go(-1)</script>";
            }else{
                $username=$_POST["username"];
                $password=$_POST["password1"];
                $telephone=$_POST["telephone"];
                $email=$_POST["email"];
                $image=$_FILES["image"];
                $path ="../img/upload/" . $image["name"];
                move_uploaded_file($image["tmp_name"],$path);
                $gender = $_POST["gender"];
                $insert_sql="INSERT INTO users VALUES (null, '$username', '$password', '$telephone', '$email', '$gender',  '二级用户','$path',2, now())";
                $insert_result=mysqli_query($conn,$insert_sql);
                if(!$insert_result){
                   die("注册失败！".mysqli_erro($conn));
                }
                else
                    echo "<script>window.location.href = 'admin_show.php';</script>";
            }
        }
        
    }
}
mysqli_close($conn);
?>
