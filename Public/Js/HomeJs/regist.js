/**
 * 注册界面脚本
 */
jQuery(function(){
    //初始化
    var UserId="#inputUser";
    var Pass1Id="#inputPassword";
    var Pass2Id="#inputPassword2";
    var XieYiId="#xieyi";
    $("#form2").hide();
    $("#form1").show();
    $(Pass1Id).css({
        marginBottom:"0px"
    });
    /**
     * 注册前的相关检查
     * 用户名是否为空
     * 密码是否一致
     * post 请求注册
     */

    $("#registBt").click(function(){
        if(checkBlank(UserId)){
            showWarning(UserId,"用户名为空！");
        }else if(checkBlank(Pass1Id)){
            showWarning(Pass1Id,"密码为空！");
        }else if(checkBlank(Pass2Id)){
            showWarning(Pass2Id,"密码重复为空！");
        }else if(check2Pass(Pass1Id,Pass2Id)){
            showWarning(Pass2Id,"两次密码输入不一致！");
        }else if(checkXieYi(XieYiId)){
            showWarning(XieYiId,"未接收用户协议！");
        }
        else{
            $.post("checkUser",{username:$(UserId).val()},function(data,status){
                if(data=='user_true'){
                    showWarning(UserId,"该用户已注册！")
                }else{
                    /**
                     * post 保存用户
                     * post 回调函数
                     * @param data
                     * @param status
                     */
                    //var mdata,mstatus;
                    $.post("saveUser",{username:$(UserId).val(),password:$(Pass1Id).val()},function (data,status){
                        if(data){
                            $("#form1").hide();
                            $("#form2").show();
                            $("#registContent").text("注册成功！账号为："+$("#inputUser").val()+",密码为："+$("#inputPassword").val()+"");
                            $("#registSuccess").bind('click',function(){
                                location='../../index';
                            });
                        }else{
                            alert("注册失败！");
                        }
                    });
                }
            });
        }
    });
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
 * 检测表单是否为空
 * @param id 表单Id
 * @returns {boolean}
 */
function checkBlank(id){
    if($(id).val()==""){
        return true;
    }
    return false;
}
/**
 * 检查两次密码输入一致性
 * @param id1
 * @param id2
 * @ returns{boolean}
 */
function check2Pass(id1,id2){
    return $(id1).val()!=$(id2).val()?true:false;
}
/**
 * 检查是否接收用户协议
 * @param id
 * @returns {boolean}
 */
function checkXieYi(id){
    return $(id).prop('checked')!=true?true:false;
}


