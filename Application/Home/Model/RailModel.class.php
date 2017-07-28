<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class RailModel extends Model
{
    public function get_rail(){
        $result=$this->select();
        return $result;
    }
    public function add_rail(){

    }
    public function delete_rail(){

    }
    public function update_rail(){

    }
}