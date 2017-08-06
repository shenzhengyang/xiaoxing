/**
 * 主界面脚本
 */
jQuery(function(){
    /**
     * 初始化
     */
    $("#login_bt").css({
        color:"#ffffff"
    });
    if($("#login_bt").text()!='登录'){
        $("#login_bt").attr({
            href:"#"
        });
    }else{
        $(".dropdown-menu").hide();
        toLogin();
    }
    $("#chagePass").bind('click',function(){
        location='index.php/User/changepass';
    });
    $("#loginOut").bind('click',function(){
        loginOut();
    });
    //跳转数据分析架子
    $("#dataAnalysis").click(function(){
        $.post('index.php/Index/checkSession',null,function(data,status){
            if(data){
                location='index.php/Analysis/dataAnalysis';
            }else{
                alert("您还未登录！")
            }
        });
    });
});
/**
 * 跳转到登录界面
 */
function toLogin(){
    $("#login_bt").bind('click',function(){
        location='index.php/User/login';
    });
}
/**
 * 退出登录
 */
function loginOut(){
    location="index.php/Index/loginOut"
}


