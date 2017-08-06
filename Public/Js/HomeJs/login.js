/**
 * login 界面脚本
 */
/**
 * 脚本初始化
 */
jQuery(function() {
    var win = $(window);
    $("#loginIn").css({
        height: win.height()
    });
    /**
     * 点击忘记密码
     */
    $("#forgotpass").click(function () {
        location = "changepass";
    });

    /**
     * 弹出提示
     * @param id 弹出提示的元素的id
     * @param dataContent 弹出提示的内容
     */
    function showWarning(id,dataContent){
        $(id).attr({
            "data-container":"body",
            "data-content":dataContent
        });
        $(id).popover('show');
    }
    /**
     * 检查用户名
     * @param id UserId
     * @param username 用户名
     */
    function checkUser(id,username){
        $.post("checkUser?username="+username+"",null, function (data, status) {
            if(data=='user_true'){
                checkUserAndPass()
            }else{
                showWarning(id,"用户名不存在，请注册！");
            }
        });
    }

    /**
     * 登录检查
     * @param id PasswordId
     * @param username 用户名
     * @param password 密码
     * @param rememberPass 记住密码
     */
    function checkUserAndPass(){
        var UserId="#inputUser";
        var PasswordId="#inputPassword";
        var RememberPassId="#rememberPass";
        $.get("checkLogin", {username:$(UserId).val(),password:$(PasswordId).val(),rememberPass:$(RememberPassId).prop('checked')==true?1:0}, function (data, status) {
            if(!data){
                showWarning(PasswordId,"密码错误");
            }else{
                location="../../index";
            }
        });
    }
    /**
     * 登陆验证
     */
    $("#login").click(function () {
        //检测用户名
        var UserId="#inputUser";
        var PasswordId="#inputPassword";
        var RememberPassId="#rememberPass";
        if($(UserId).val()==""){
            showWarning(UserId,"用户名为空！");
        }else if($(PasswordId).val()==""){
            showWarning(PasswordId,"密码为空！")
        }else{
            checkUser(UserId,$(UserId).val());
        }
    });
});