<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/22
 * Time: 13:40
 */

namespace Home\Controller;
use Think\Controller;

class AnalysisController extends Controller
{
    public function analysis(){
        $this->display();
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