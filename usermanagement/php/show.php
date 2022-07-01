<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //开启session；
        session_start();
         
            if(isset($_SESSION["a_username1"])){
                //管理员界面；
                include("admin_show.php");
            }else{
                if(isset($_SESSION["a_username2"])){
                    //管理员界面；
                    include("admin_show.php");
                }else{
                    if(isset($_SESSION["a_username3"])){
                        //管理员界面；
                        include("admin_show.php");
                    }else{
                        if(isset($_SESSION["username"])){
                            //用户界面；
                             include("user_show.php");
                        }else{
                            echo "<script>alert('非法用户！请您重新登录！')</script>";
                            echo "<script>window.location.href = '../login.html';</script>";
                        }

                    }
                }
            }

    ?>

</body>
</html>