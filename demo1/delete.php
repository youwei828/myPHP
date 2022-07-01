<?php
    $id = $_GET['id'];
    $link = mysqli_connect('127.0.0.1','root','123456','ec');
	$del_sql="delete from product where id = $id";
    $del_result = mysqli_query($link, $del_sql);
	if($del_result){
		echo"删除成功！请返回<a href='show.php'>展示界面</a>";
	}
	else{
		echo"修改失败！";
	}
?>