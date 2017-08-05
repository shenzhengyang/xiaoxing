<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2017/7/28
 * Time: 9:43
 */

namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class UserController extends Controller
{
    /**
     * 检查user是否存在
     * @param $username 用户名
     * @return user_true or user_false
     */
    function checkUser($username=""){
        $UserModel=M("User");
        $result=$UserModel->where("username='%s'",$username)->select();
        if($result){
            $data = user_true;
        }else{
            $data = user_false;
        }
        $this->ajaxReturn($data);
    }
    /**
     * 验证用户名和密码是否一致
     * @param $username 用户名
     * @param $password 密码
     * @return true or false
     */
    function checkUserAndPass($username,$password){
        $UserModel=M("User");
        $result=$UserModel->where("username='%s' and password='%s'",$username,$password)->select();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 登录检验
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $rememberPass 记住密码
     */
    public function checkLogin($username="",$password="",$rememberPass=""){
        if(!$this->checkUserAndPass($username,$password)){
            $this->ajaxReturn(false);
        }else{
            session('username',$username);
            if($rememberPass==1){
                cookie('xiaoxing_user',array($username,$password),3600);
            }
            $this->ajaxReturn(true);
        }
    }

    /**
     * 生成验证码
     */
    function verify(){
        $Verify = new \Think\Verify();
        //$Verify->fontSize = 18; //以下为验证码的配置项
        //$Verify->length   = 4;
        //$Verify->useNoise = false;
        //$Verify->codeSet = '0123456789qwertyuiopasdfghjklzxcvbnm';
        //$Verify->imageW = 100;
        //$Verify->imageH = 50;
        //$Verify->expire = 600;
        $Verify->entry();
    }

    /**
     * 检查验证码
     * @param string $code 输入的验证码
     * @param string $id 空
     */
    function checkVerify($code='',$id=''){
        $verify = new \Think\Verify();
        $this->ajaxReturn($verify->check($code,$id));
    }

    /**
     * 修改密码
     * @param $username 用户名
     * @param $password 密码
     */
    function updateUserPass($username,$password){
        $UserModel=M('User');
        $UserModel->password=$password;
        $result=$UserModel->where("username='%s'",$username)->save();
        if($result){
            $this->ajaxReturn(true);
        }
        $this->ajaxReturn(false);
    }

    /**
     * 注册新用户
     * @param $username
     * @param $password
     */
    function saveUser($username,$password){
        try{
            $UserModel=M('User');
            $data['username']=$username;
            $data['password']=$password;
            $result=$UserModel->add($data);
        }catch(Exception $exception){
            $this->ajaxReturn(false);
        }finally{
            if($result){
                session('username',$username);
                $this->ajaxReturn(true);
            }
            $this->ajaxReturn(false);
        }
    }
    /*
    //以下函数不在使用
    function changepassword(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $UserModel=M("User");
        $UserModel->username=$username;
        $UserModel->password=$password;
        $result=$UserModel->save();
        if($result!=null){
            echo 'true';
        }
    }

   function checkLong($username,$password){

        $UserModel=M("User");
        $result=$UserModel->where("username='%s' and password='%s'",$username,$password)->select();
        if($result){
            return $result;
        }else{
            return $result;
        }
    }

    public function loginCheck(){

        $username=$_POST['username'];
        $password=$_POST['password'];
        $result=$this->checkLong($username,$password);
        $rememberme=$_POST['rememberme'];
        if ($result!=null&&$rememberme!=null){
            cookie('xiaoxing_user',array($result[0]['username'],$result[0]['password']),3600);
        }else if($result[0]['username']!=null){
            session('username',result[0]['username']);
        }
        $result[0]['password']='***';
        echo json_encode($result);
    }
    public function saveuserinf(){
        $username=$_POST['username'];
        $password1=$_POST['password1'];
        if($username!=null&&$password1!=null){
            $UserModel=M("User");
            $UserModel->username=$username;
            $UserModel->password=$password1;
            $result=$UserModel->add();
            echo $result;
        }
    }*/
}