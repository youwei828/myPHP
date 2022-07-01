<?php
//连接并选择数据；
$conn=mysqli_connect("127.0.0.1","root","root","ec");
    $id = $_POST["id"];
    $username=$_POST["username"];
    $telephone=$_POST["telephone"];
    $email=$_POST["email"];
    $gender = $_POST["gender"];
    $image=$_FILES["image"];
    if($image==null||empty($image)){
        //查询；
        $select_sql = "select * from users where id = '$id'";
        $sql_res = mysqli_query($conn,$select_sql);
        $row = mysqli_fetch_array($sql_res);
        $update_sql=" update users set username='$username',telephone='$telephone',email='$email',path='$row[7]' where id=$id";
        $update_result=mysqli_query($conn,$update_sql);
        if(!$update_result){
            die("修改失败！".mysqli_erro($conn));    
        }
        else{
            echo "<script>window.location.href = 'admin_show.php';</script>";
        }
    }
    else{
    $path ="../img/upload/" . $image["name"];
    move_uploaded_file($image["tmp_name"],$path);
    $update_sql1=" update users set username='$username',telephone='$telephone',email='$email' ,path='$path' where id=$id";
    $update_result1=mysqli_query($conn,$update_sql1);
    if(!$update_result1){
        die("修改失败！".mysqli_erro($conn));    
    }
        else{
        echo "<script>window.location.href = 'admin_show.php';</script>";
        }
        
    }
//关闭数据库；
mysqli_close($conn);
?>