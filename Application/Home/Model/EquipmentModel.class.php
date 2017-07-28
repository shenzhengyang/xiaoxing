<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class EquipmentModel extends Model
{
    public function get_equipment(){
        $result=$this->select();
        return $result;
    }
    public function add_equipment(){

    }
    public function delete_equipment(){

    }
    public function update_equipment(){

    }
}