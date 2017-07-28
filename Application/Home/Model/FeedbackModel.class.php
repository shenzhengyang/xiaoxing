<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/10/15
 * Time: 19:51
 */
namespace Home\Model;

use Think\Model;
class FeedbackModel extends Model
{
    public function get_feedback(){
        $result=$this->select();
        return $result;
    }
    public function add_feedback(){

    }
    public function delete_feedback(){

    }
    public function update_feedback(){

    }
}