<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1400px, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../Public/Image/logo.png">

    <title>修改密码</title>

    <!-- Bootstrap core CSS -->
    <link href="../../Public/Css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../Public/Css/HomeCss/index.css" rel="stylesheet">
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
        jQuery(function(){
            //初始话界面
            $("#form1").show();
            $("#form2").hide();
            $("#form3").hide();
            $(".progress-bar").css({
                width:"30%"
            }).text("30%");

            // 验证码生成
            var captcha_img = $('#form1').find('img');
            var verifyimg = captcha_img.attr("src");
            captcha_img.attr('title', '点击刷新');
            captcha_img.click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(this).attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
            $("#changepass1").click(function(){
                //检测用户名和验证码是否正确
                $.post('checkVerify',$(".captcha").serialize(),function(data,status){
                    if(data=='true'){
                        $("#form1").hide();
                        $("#form2").show();
                        $("#form3").hide();
                        $(".progress-bar").css({
                            width:"60%"
                        }).text("60%");
                    }else{
                        //验证提醒

                    }
                });
            });
            $("#changepass2").click(function(){
                alert("shen");
                //检测用户名和验证码是否正确
                $.post('changepassword',$("#form2").serialize(),function(data,status){
                    if(data=='true'){
                        $("#form1").hide();
                        $("#form2").hide();
                        $("#form3").show();
                        $(".progress-bar").css({
                            width:"100%"
                        }).text("100%");
                    }else{
                        //验证提醒

                    }
                });
            });
            $("#changepass3").click(function(){
                location="<?php echo U('../index');?>";
            });
        });

    </script>
</head>
<body>
<div class="container">
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
            30%
        </div>
    </div>
    <form class="top15 captcha " id="form1" style="margin: auto 30%;">
        <label for="inputUser" class="sr-only">用户名</label>
        <input name="username"id="inputUser" style="margin: 10px 0px;height:50px;" class="form-control" placeholder="用户名" required autofocus>
        <input name="verify" style="width:50%;height:50px;margin:10px 0px;margin-right: 10px;border: 1px solid #ccc;
        border-radius: 4px;padding: 6px 12px;"   placeholder="验证码" type="text">
        <img width="40%" class="left15"  alt="验证码" src="<?php echo U('Home/Index/verify',array());?>" title="点击刷新">

        <button id="changepass1" class="btn btn-lg btn-primary btn-block" type="button">下一步</button>

    </form>
    <form class="top15 captcha " style="margin: auto 30%;" id="form2">
        <label for="inputPassword1" class="sr-only">密码</label>
        <input name="password1" style="height: 50px;margin: 10px 0px;" type="password" id="inputPassword1" class="form-control" placeholder="密码" required>
        <label for="inputPassword2" class="sr-only">密码</label>
        <input name="password2" style="height: 50px;margin: 10px 0px;" type="password" id="inputPassword2" class="form-control" placeholder="重复密码" required>
        <button id="changepass2" class="btn btn-lg btn-primary btn-block" type="button">下一步</button>

    </form>
    <form class="top15 captcha " style="margin: auto 30%;" id="form3">
        <div class="page-header">
            <h1>修改密码成功！</h1>
        </div>
        <button id="changepass3" class="btn btn-lg btn-primary btn-block" type="button">下一步</button>

    </form>
</div>
</body>
</html>