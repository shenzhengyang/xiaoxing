<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/22
 * Time: 13:40
 */
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class AnalysisController extends Controller
{
    /**
     * 根据用户名查询用户id
     * @return int|mixed
     */
    function QueryUserId(){
        $USERNOLOGIN=0;
        $QUERYUSEREXCEPTION=-1;
        try {
            $UserModel = M('User');
            if (session('?username')) {
                $username = session('username');
                $id=$UserModel->where("username='%s'", $username)->getField('id');
                return $id;
            }
            return $USERNOLOGIN;
        }catch (Exception $exception){
            return $QUERYUSEREXCEPTION;
        }
        return  0;
    }

    /**
     * 根据uid查询eid
     * @param $uid 用户id
     * @return eid 设备id
     */
    function Query_eid_By_uid($uid){
        try{
            $EquipmentModel=M('Equipment');
            $data=$EquipmentModel->where("uid='%s'",$uid)->getField('eid');
            return $data;
        }catch(Exception $exception){
            echo $exception->getMessage();
            return '0000';
        }
        return '0000';
    }

    /**
     * 根据uid查询equipment
     * @param $uid 用户id
     * @return string
     */
    function Query_equipment_By_uid($uid){
        try{
            $EquipmentModel=M('Equipment');
            $data=$EquipmentModel->where("uid='%s'",$uid)->select();
            $this->ajaxReturn($data);
        }catch(Exception $exception){
            echo $exception->getMessage();
            return '0000';
        }
        return '0000';
    }

    /**
     * 根据eid查询最近的定位位置position
     * @param $eid
     */
    function Query_position_By_eid($eid="867967020135929"){
        try{
            $PositionModel=M('Position');
            $data=$PositionModel->where("eid='%s'",$eid)->select();
            $this->ajaxReturn($data);
        }catch(Exception $exception){
            $this->ajaxReturn(false);
        }
        $this->ajaxReturn(false);
    }

    /**
     * 根据eid查询最近的定位位置position
     * @param $eid
     */
    function Query_position_By_eid2(){
        try{
            $eid=$this->Query_eid_By_uid($this->QueryUserId());
            $PositionModel=M('Position');
            $data=$PositionModel->where("eid='%s'",$eid)->select();
            $this->ajaxReturn($data);
        }catch(Exception $exception){
            $this->ajaxReturn(false);
        }
        $this->ajaxReturn(false);
    }

    /**
     * 根据eid查询设备的位置和半径rail
     * @param $eid
     */
    function Query_rail_By_eid(){
        try{
            $eid=$this->Query_eid_By_uid($this->QueryUserId());
            $RailModel=M('Rail');
            $data=$RailModel->where("eid='%s'",$eid)->order('id desc')->limit(1)->select();
            $this->ajaxReturn($data);
        }catch(Exception $exception){
            $this->ajaxReturn(false);
        }
        $this->ajaxReturn(false);
    }

    /**
     * 更新电子围栏数据
     * @param $eid 设备的id
     * @param $lat 电子围栏的圆点纬度
     * @param $lng 电子围栏的圆点经度
     * @param $radius 电子围栏的半径
     */
    function Add_rail($eid,$lat,$lng,$radius){
        try{
            $RailModel = M("Rail"); // 实例化User对象
            $data['eId'] = $eid;
            $data['lat'] = $lat;
            $data['lng'] = $lng;
            $data['radius'] = $radius;
            $result=$RailModel->add($data);
            if($result) return $this->ajaxReturn(true);
        }catch(Exception $exception){
            dump($exception->getMessage());
            $this->ajaxReturn(false);
        }
        $this->ajaxReturn(false);
    }






    public function versioninfo(){
        $VersioninfoModel=D('Versioninfo');
        $versioninfo=$VersioninfoModel->get_versioninfo();
        $this->assign('versioninfo',$versioninfo);
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
    public function user(){
        $UserModel=D('User');
        $user=$UserModel->getAllUser();
        dump($user);
        /*$this->assign('user',$user);
        $this->display();*/
    }
}