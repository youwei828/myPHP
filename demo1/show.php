<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品展示界面</title>
</head>
<body>
<table border="1">
	<tr><td>商品编号</td><td>商品名称</td><td>商品分类</td><td>商品描述</td><td>商品价格</td><td>商品库存</td><td>上传时间</td>
    <td>删除</td><td>修改</td></tr><a onClick="del()"></a>
<?php
	$link=mysqli_connect("127.0.0.1","root","123456","ec");
	$select_sql = "select * from product";
	$select_result = mysqli_query($link,$select_sql);
	while($result=mysqli_fetch_array($select_result)){
		echo"<tr><td>".$result[0]."</td><td>".$result[1]."</td><td>".$result[2]."</td><td>".$result[3]."</td><td>".$result[4]."</td><td>".$result[5]."</td><td>".$result[6]."</td>
    <td><a href='modify.php?id=".$result[0]."'>修改</a></td><td><a href='delete.php?id=".$result[0]."' onClick='del()'>删除</a></td></tr>";	
	}
?>
	<!--删除弹窗语句；-->
	<script language="javascript">
    function del() {
        if (confirm("确认删除吗？")) {
            window.location.href = 'show.php';
        } else {
            return false;
        }
    }
</script>
</table>
</body>
</html>