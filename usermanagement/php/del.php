<?php
    $conn=mysqli_connect("127.0.0.1","root","root","ec");
    $id = $_GET["id"];
    $select_sql = "delete from users where id = '$id'";
    $sql_res = mysqli_query($conn,$select_sql);
    echo "<script>window.location.href = 'admin_show.php';</script>";
    //关闭数据库；
    mysqli_close($conn);    
?>