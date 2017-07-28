<?php
function sendMail1($to,$title,$content){
    //$to=$_GET[usermail];
    //$to='3060289135@qq.com';
    //$username=$_GET[username];
    //$username='shen';
    //$title='孝行密码修改';
    //$content='尊敬的用户：'.$username.'请点击以下链接完成密码修改：<br/>'.
        //U('localhost:8009/xiaoxing/index.php/Index/changepass?username='.$username.'&flag=1');
    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
    require_once("class.phpmailer.php");
    require_once("class.smtp.php");
    //实例化PHPMailer核心类
    $mail = new phpmailer();

    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';

    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

    //设置smtp的helo消息头 这个可有可无 内容任意
    // $mail->Helo = 'Hello smtp.qq.com Server';

    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    //$mail->Hostname = 'http://www.lsgogroup.com';

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '孝行服务中心';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='3294625658@qq.com';

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'alxsqfoeriyzcicb';

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = '3294625658@qq.com';

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to,'孝行修改密码');

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','lsgo在线通知');

    //添加该邮件的主题
    $mail->Subject = $title;

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //简单的判断与提示信息
    if($status) {
        return true;
    }else{
        return false;
    }
}
function makeImageCode(){

    //11>设置session,必须处于脚本最顶部
    session_start();
    $image = imagecreatetruecolor(100, 30);    //1>设置验证码图片大小的函数
    //5>设置验证码颜色 imagecolorallocate(int im, int red, int green, int blue);
    $bgcolor = imagecolorallocate($image,255,255,255); //#ffffff
    //6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
    imagefill($image, 0, 0, $bgcolor);
    //10>设置变量
    $captcha_code = "";
    //7>生成随机的字母和数字
    for($i=0;$i<4;$i++){
        //设置字体大小
        $fontsize = 8;
        //设置字体颜色，随机颜色
        $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
        //设置需要随机取的值,去掉容易出错的值如0和o
        $data ='abcdefghigkmnpqrstuvwxy3456789';
        //取出值，字符串截取方法  strlen获取字符串长度
        $fontcontent = substr($data, rand(0,strlen($data)),1);
        //10>.=连续定义变量
        $captcha_code .= $fontcontent;
        //设置坐标
        $x = ($i*100/4)+rand(5,10);
        $y = rand(5,10);
        imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
    }
    //10>存到session
    $_SESSION['authcode'] = $captcha_code;
    //8>增加干扰元素，设置雪花点
    for($i=0;$i<200;$i++){
        //设置点的颜色，50-200颜色比数字浅，不干扰阅读
        $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));
        //imagesetpixel — 画一个单一像素
        imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
    }
    //9>增加干扰元素，设置横线
    for($i=0;$i<4;$i++){
        //设置线的颜色
        $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
        //设置线，两点一线
        imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
    }

    //2>设置头部，image/png
    header('Content-Type: image/png');
    //3>imagepng() 建立png图形函数
    imagepng($image);
    //4>imagedestroy() 结束图形函数 销毁$image
    imagedestroy($image);
}
/*
* 验证验证码
*/
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}