<?php
	$link=mysqli_connect("127.0.0.1","root","123456","ec");
	$id=$_POST["id"];
	$name=$_POST["name"];
	$class=$_POST["class"];
	$desc=$_POST["desc"];
	$price=$_POST["price"];
	$stock=$_POST["stock"];
	$update_sql="update product set gs_name='$name',gs_class='$class',gs_desc='$desc',gs_price='$price',gs_stock='$stock' where id=$id";
	$update_result = mysqli_query($link,$update_sql);
	if($update_result){
		echo"修改成功！请返回<a href='show.php'>展示界面</a>";
	}
	else{
		echo"修改失败！";
	}
?>