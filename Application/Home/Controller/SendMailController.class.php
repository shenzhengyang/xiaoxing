<?php
namespace Home\Controller;
use Think\Controller;
class SendMailController extends Controller {
    public function index($to,$username)
    {
        $title='孝行修改密码';
        $content='尊敬的用户：'.$username.'请点击以下链接完成密码修改：<br/>'.
        "<a href='localhost:8009:xiaoxing/index.php/Index/changepass'>localhost:8009:xiaoxing/index.php/Index/changepass</a>";
        $flag = sendMail1($to,$title,$content);
        if($flag){
            echo "发送邮件成功！";
        }else{
            echo "发送邮件失败！";
        }
    }
}
