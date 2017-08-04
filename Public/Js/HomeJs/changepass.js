/**
 * 更换密码脚本
 */
jQuery(function(){
    //初始化
    $("#form1").show();
    $("#form2").hide();
    $("#form3").hide();
    $(".progress-bar").css({
        width:"30%"
    }).text("30%");

    /**
     * 点击获取验证码
     * @type {any}
     */
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
     * 验证用户名&验证码
     */
    $("#changepass1").click(function(){
        var UserId="#inputUser";
        var VerifyId="#Verify";
        if($(UserId).val()==""){
            showWarning(UserId,"用户名为空！");
        }else if($(VerifyId).val()==""){
            showWarning(VerifyId,"验证码为空！");
        }else{
            $.post('checkUser',{username:$(UserId).val()},function(data,status){
                if(data!='user_true'){
                    showWarning(UserId,"用户名不存在！");
                }else{
                    $.post('checkVerify',{code:$(VerifyId).val()},function(data,status){
                        if(data){
                            $("#form1").hide();
                            $("#form2").show();
                            $("#form3").hide();
                            $(".progress-bar").css({
                                width:"60%"
                            }).text("60%");
                        }else{
                            showWarning(VerifyId,"验证码不正确！");
                        }
                    });
                }
            });
        }
    });
    /**
     * 检查两次输入的密码是否一致
     * 修改密码
     */
    $("#changepass2").click(function(){
        var UserId="#inputUser";
        var Pass1Id="#inputPassword1";
        var Pass2Id="#inputPassword2";
        if($(Pass1Id).val()==""){
            showWarning(Pass1Id,"密码为空！");
        }else if($(Pass2Id).val()==""){
            showWarning(Pass2Id,"重复密码为空！");
        }else if($(Pass1Id).val()!=$(Pass2Id).val()){
            showWarning(Pass2Id,"两次密码不一致！");
        }else{
            $.get("updateUserPass",{username:$(UserId).val(),password:$(Pass1Id).val()},function(data,status){
                if(data){
                    $("#form1").hide();
                    $("#form2").hide();
                    $("#form3").show();
                    $(".progress-bar").css({
                        width:"100%"
                    }).text("100%");
                }else{
                    alert('修改失败!');
                }
            });
        }
    });
    /**
     * 点击修改完成按钮
     */
    $("#changepass3").click(function(){
        location="../../index";
    });
});
