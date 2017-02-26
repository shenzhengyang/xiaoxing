<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1400px, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../Public/Image/logo.png">

    <title>注册</title>

    <!-- Bootstrap core CSS -->
    <link href="../../Public/Css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="../../Public/Css/HomeCss/loginin.css" rel="stylesheet">
    <!-- Custom javascript for this template -->
    <script src="../../Public/Js/jquery.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../Public/Js/HomeJs/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        jQuery(function () {
            $("#login").click(function(){
               location="<?php echo U('../index');?>";
            });
            $("#regist_bt").click(function(){
                if($("#inputPassword1").text()==$("#inputPassword2").text()){
                    $.post("saveuserinf",$(".form-signin").serialize(),function(data,status){
                        if(data!=null){
                            location="<?php echo U('../index');?>";
                        }
                    });
                }else{
                    //注册两次密码的验证
                    alert("shen");
                }
            });

        });



    </script>
</head>

<body>
    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading" style="text-align:center;">注册</h2>
        <label for="inputUser" class="sr-only">用户名</label>
        <input name="username"id="inputUser" class="form-control" placeholder="用户名" required autofocus>
        <label for="inputPassword1" class="sr-only">密码</label>
        <input name="password1" type="password" id="inputPassword1" class="form-control" placeholder="密码" required>
        <label for="inputPassword2" class="sr-only">密码</label>
        <input name="password2"type="password" id="inputPassword2" class="form-control" placeholder="重复密码" required>
        <button id="regist_bt" class="btn btn-lg btn-primary btn-block" type="button">马上注册</button>
		<div class="regist">
		  <label >
            <input type="checkbox" value="remember-me" name="serviceprotocol"> 接受用户服务协议
          </label>
		  <label style="width:44%; margin-left:20px;">
            已有账号?<a id="login" style="color:#428bca;" type="button">马上登录</a>
          </label>
        </div>
      </form>

    </div> <!-- /container -->

</body>
</html>