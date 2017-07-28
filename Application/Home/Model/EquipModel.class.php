<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class EquipModel extends Model
{
    public function get_equip(){
        $result=$this->select();
        return $result;
    }
    public function add_equip(){

    }
    public function delete_equip(){

    }
    public function update_equip(){

    }
}