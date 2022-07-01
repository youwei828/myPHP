<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改已添加商品信息</title>
</head>

<body>
	<?php
	$link=mysqli_connect("127.0.0.1","root","123456","ec");
	$id = $_GET["id"];
	$select_sql = "select * from product where id=$id";
	$select_result=mysqli_query($link,$select_sql);
	while($result=mysqli_fetch_array($select_result)){
	?>
	<h1 align="center" style="color:#FC0">请修改商品信息！</h1><br>
	<center>
    <form action="modify_check.php" method="post">
	<table>
    	<tr><td>请输入商品名称：</td><td><input type="text" name="name" size="25" value="<?=$result["gs_name"]?>"></td></tr>
        <tr><td>请输入商品分类：</td><td><input type="text" name="class" size="25"value="<?=$result["gs_class"]?>"></td></tr>
        <tr><td>请输入商品描述：</td><td><input type="text" name="desc" size="25"value="<?=$result["gs_desc"]?>"></td></tr>
        <tr><td>请输入商品价格：</td><td><input type="text" name="price" size="25"value="<?=$result["gs_price"]?>"></td></tr>
        <tr><td>请输入商品库存：</td><td><input type="text" name="stock" size="25"value="<?=$result["gs_stock"]?>">
			<input type="hidden" name="id" value="<?=$id?>"></td></tr>
        <tr><td><input type="submit" name="submit" size="25" value="提交"></td><td><input type="reset" name="reset" value="重置" size="25"></td></tr>
    </table>
    </form>
    </center>
	<?	
	}
	?>
</body>
</html>