<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /**
     * 主界面
     */
    public function index()
    {
        $this->user="登录";
        if(session('?username')){
            $session='欢迎，'.session('username').'!';
            $this->user=$session;
        }else if(cookie('xiaoxing_user')!=null){
            $cookie = cookie('xiaoxing_user');
            $UserController=A('User');
            if($UserController->checkLogin($cookie[0],$cookie[1])){
                $this->display();
            }
        }
        $this->display();
    }
    /**
     *退出登录
     */
    public function loginOut(){
        if(session('?username')){
            session('username',null);
        }else if(cookie('xiaoxing_user')!=null){
            cookie('xiaoxing_user',null);
        }
        $this->redirect('../index');
    }

    /**
     *检查是否已登录
     */
    function checkSession(){
        $this->ajaxReturn(session('?username'));
    }






    /*
     * 生成验证码函数
     */
    function verify(){
        $Verify = new \Think\Verify();
        //$Verify->fontSize = 18;
        //$Verify->length   = 4;
        //$Verify->useNoise = false;
        //$Verify->codeSet = '0123456789qwertyuiopasdfghjklzxcvbnm';
        //$Verify->imageW = 100;
        //$Verify->imageH = 50;
        //$Verify->expire = 600;
        $Verify->entry();
    }
    /*
     * check验证码
     */
    function checkVerify(){
        $UserTRUE=false;
        $verifyTURE=false;
        // 检查验证码
        $verify = I('param.verify','');
        $username=I('param.username','');
        $result=$this->checkUser($username);
        if($result!=null){
            echo 'user_true';
            $UserTRUE=true;
        }
        else if(check_verify($verify)){
            //$this->error("亲，验证码输错了哦！",$this->site_url,9);
            echo 'verify_true';
            $verifyTURE=true;
        } else if($UserTRUE==true&&$verifyTURE==true){
            echo 'true';
        }
        else{
            echo 'false';
        }
    }
    /*
     * 完成修改密码函数
     */
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
    /*
     * 修改密码界面
     */
    function chagepass(){

        $this->display();
    }
	public function login(){

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
    function checkUser($username){
        $UserModel=M("User");
        $result=$UserModel->where("username='%s'",$username)->select();
        if($result!==null){
            return $result;
        }else{
            return $result;
        }
    }
	function checkLong($username,$password){

        $UserModel=M("User");
        $result=$UserModel->where("username='%s' and password='%s'",$username,$password)->select();
        if($result!==null){
            return $result;
        }else{
            return $result;
        }
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
    }
	public function regist(){
		$this->display();
	}



























	//以下没用了
    public function equip(){
        $EquipModel=D('Equip');
        $equip=$EquipModel->get_equip();
        $this->assign('equip',$equip);
        $count = count($equip);
        $data_time=array();
        $data_count=array();
        $num=1;
        $postStr = isset($GLOBALS["HTTP_RAW_DATA"]);
        echo $GLOBALS["HTTP_RAW_DATA"];
        for ($i = 0; $i < $num; $i++)
        {
            array_push($data_count,$count);
        }
        $json_count=json_encode($data_count);
        $this->assign('count',$json_count);
        $this->display();
    }
    public function equipment(){
        $EquipmentModel=D('Equipment');
        $equipment=$EquipmentModel->get_equipment();
        $this->assign('equipment',$equipment);
        $this->display();
    }
    public function feedback(){
        $FeedbackModel=D('Feedback');
        $feedback=$FeedbackModel->get_feedback();
        $this->assign('feedback',$feedback);
        $this->display();
    }
    public function position(){
        $PostionModel=D('Position');
        $position=$PostionModel->get_position();
        $this->assign('position',$position);
        $count = count($position);
        $data_time=array();
        $data_count=array();
        for ($i = 0; $i < $count; $i++)
        {
            $time=$position[$i]['time'];
            array_push($data_time,$time);
//            array_push($data_time,$count);
            array_push($data_count,$count);
        }
        $json_time=json_encode($data_time);
        $json_count=json_encode($data_count);
        $this->assign('time',$json_time);
        $this->assign('count',$json_count);
        $this->display();
    }
    public function rail(){
        $RailModel=D('Rail');
        $rail=$RailModel->get_rail();
        $this->assign('rail',$rail);
        //解析数组
        $count_json = count($rail);
        $data=array();
        for ($i = 0; $i < $count_json; $i++)
        {
            $data_item=array();
            $lat = $rail[$i]['lat'];
            $lng = $rail[$i]['lng'];
//            $radius = $rail[$i]['radius'];
            $radius=0.9;
            array_push($data_item,$lat,$lng,$radius);
            array_push($data,$data_item);
        }
        $json_data=json_encode($data);
        $this->assign('data',$json_data);
        $this->display();
    }
    public function user(){
        $UserModel=D('user');
        $user=$UserModel->get_User();
        $this->assign('user',$user);
        $this->display();
    }
    public function versioninfo(){
        $VersioninfoModel=D('Versioninfo');
        $versioninfo=$VersioninfoModel->get_versioninfo();
        $this->assign('versioninfo',$versioninfo);
        $this->display();
    }
    public function click()
    {

        $this->redirect('User/user');
        //$this->error('马上跳转！','../User/index',1);
    }
}