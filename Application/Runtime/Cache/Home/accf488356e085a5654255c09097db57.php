<?php if (!defined('THINK_PATH')) exit();?>

    <div class="container">

      <form class="form-signin" >
        <h2 class="form-signin-heading" style="text-align:center;">登录</h2>
        <label for="inputEmail" class="sr-only">用户名</label>
        <input id="inputUser" class="form-control" name="username" placeholder="用户名" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" class="form-control" name="password"placeholder="密码" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> 记住密码
          </label>
		  <label >
             忘记密码?
          </label>
        </div>
        <button id="login" class="btn btn-lg btn-primary btn-block">登录</button>
		<div class="regist">
		  <label style="width:100%;">
             还没有账号?<a style="color:#428bca;">马上注册</a>
          </label>
        </div>
      </form>

    </div> <!-- /container -->
	<script type="text/javascript">
		jQuery(function(){
			
			
			//跳转注册页面
			$("a").click(function(){
			$("body").load("http://localhost:9000/xiaoxing/index.php/Index/regist.html")
			});
			
		});
		//验证登录
			$("login").click(function(){
			alert("shen");
			$.post("http://localhost:8080/testWeb/LoginIn",$(".form-signin").serialize(),function(data,status){
					console.log(data);
				});
			});
	</script>