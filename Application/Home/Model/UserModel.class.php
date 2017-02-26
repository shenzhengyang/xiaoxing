<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class UserModel extends Model
{
    public function get_equip(){
        $result=$this->select();
        return $result;
    }
    public function get_equipment(){
        $result=$this->select();
        return $result;
    }
    public function get_feedback(){
        $result=$this->select();
        return $result;
    }
    public function get_position(){
        $result=$this->select();
        return $result;
    }
    public function get_rail(){
        $result=$this->select();
        return $result;
    }
    public function get_User($username,$password){

        $result=$this->where("username='%s' and password='%s'",$username,$password)->select();
        return $result;
    }
    public function get_versioninfo(){
        $result=$this->select();
        return $result;
    }
}