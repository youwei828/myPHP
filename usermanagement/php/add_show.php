<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户注册页面</title>
<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="css/reg.css">
</head>
<body>
    <div class="maxbox">
        <h2>Please register!</h2>
        <form name="reg" action="php/reg_check.php" method="post" enctype="multipart/form-data">
        <div class="form">
            <div class="item">
                <span><label for="001"><i class="fa fa-user-circle-o" aria-hidden="true"></i></label></span>
                <span><input type="text" id="001" name="username" placeholder="Username"></span>
            </div>
            <div  class="item">
                <span><label for="002"><i class="fa fa-key" aria-hidden="true"></i></label></span>
                <span><input type="text" id="002" name="password1" placeholder="Password"></span>
            </div>
            <div  class="item">
                <span><label for="003"><i class="fa fa-key" aria-hidden="true"></i></label></span>
                <span><input type="text" id="003" name="password2" placeholder="Again Password"></span>
            </div>
            <div  class="item">
                <span><label for="004"><i class="fa fa-phone" aria-hidden="true"></i></label></span>
                <span><input type="text" id="004" name="telephone" placeholder="Telephone"></span>
            </div>
            <div  class="item">
                <span><label for="005"><i class="fa fa-envelope" aria-hidden="true"></i></label></span>
                <span><input type="text" id="005" name="email" placeholder="E-mail"></span>
            </div>
            <div  class="item">
                <span><label for="007"><i class="fa fa-user-o" aria-hidden="true"></i></label></span>
                <span><input type="file" id="007" name="image" ></span>
            </div>
            <div  class="item">
                <span style="position: relative;bottom:33px;right: 2px;"><label for="006"><i class="fa fa-venus-mars" aria-hidden="true"></i></label>
                </span>
                <span>
                    <select name="gender" id="006" size="2" style="width: 22rem;">
                    <option value="famale">famale</option>
                    <option value="male">male</option>
                    </select>
                </span>
            </div>
            
            <div  class="item">
                <span></span><input type="submit" name="submit" value="REGISTER"></span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><input type="reset" value="RESET"/></span>
            </div>
        </div>
    </form>
    </div>

</body>
</html>