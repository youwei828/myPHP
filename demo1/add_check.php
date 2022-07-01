<?php
	$link=mysqli_connect("127.0.0.1","root","123456","ec");
	$name=$_POST["name"];
	$class=$_POST["class"];
	$desc=$_POST["desc"];
	$price=$_POST["price"];
	$stock=$_POST["stock"];
	$inster_sql="insert into product	
		(gs_name,gs_class,gs_desc,gs_price,gs_stock,gs_time) values
		('$name','$class','$desc','$price','$stock',now())";
	$inster_result=mysqli_query($link,$inster_sql);
	if($inster_result){
		echo"提交成功！<br/>";
		echo"可跳转至<a href = 'show.php'>展示页面<a/><br/>";
		echo"或<a href = 'add.php'>继续添加</a>";
	}
	else{
		echo"提交失败！";
	}
?>