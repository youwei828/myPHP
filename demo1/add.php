<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加商品信息</title>
</head>

<body>
	<h1 align="center" style="color:#FC0">请添加商品信息！</h1><br>
	<center>
    <form action="add_check.php" method="post">
	<table>
    	<tr><td>请输入商品名称：</td><td><input value="不超过20个字符" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue; this.style.color='#999'}" style="color:#999"type="text" name="name" size="25"></td></tr>
        <tr><td>请输入商品分类：</td><td><input value="不超过10字符" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue; this.style.color='#999'}" style="color:#999" type="text" name="class" size="25" ></td></tr>
        <tr><td>请输入商品描述：</td><td><input value="商品描述尽量详细且真实" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue; this.style.color='#999'}" style="color:#999" type="text" name="desc" size="25"></td></tr>
        <tr><td>请输入商品价格：</td><td><input value="输入内容为数字，金额默认为元" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue; this.style.color='#999'}" style="color:#999" type="text" name="price" size="25"></td></tr>
        <tr><td>请输入商品库存：</td><td><input value="输入内容为数字，库存最高为9999" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue; this.style.color='#999'}" style="color:#999" type="text" name="stock" size="25"></td></tr>
        <tr><td><input type="submit" name="submit" size="25" value="提交"></td><td><input type="reset" name="reset" value="重置" size="25"></td></tr>
    </table>
    </form>
    </center>
</body>
</html>