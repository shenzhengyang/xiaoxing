<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class VersioninfoModel extends Model
{
    public function get_versioninfo(){
        $result=$this->select();
        return $result;
    }
    public function add_versioninfo(){

    }
    public function delete_versioninfo(){

    }
    public function update_versioninfo(){

    }
}