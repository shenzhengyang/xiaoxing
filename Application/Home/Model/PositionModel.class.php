<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class PositionModel extends Model
{
    public function get_position(){
        $result=$this->select();
        return $result;
    }
    public function add_postion(){

    }
    public function delete_postion(){

    }
    public function update_postion(){

    }
}