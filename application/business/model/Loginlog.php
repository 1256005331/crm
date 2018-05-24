<?php
namespace app\business\model;

use think\Model;

class Loginlog extends Model
{
    //插入登录记录
    public function add_loginlog($username){
        $data['worker_id']     = $username;
        $data['login_time']    = time();
        $data['login_ip']      = getip();
        $install_log = db('loginlog')->insert($data);
        return $install_log;
    }

    //查询用户最后一次登录时间
    public function last_login_time($username_id){
        $where['worker_id'] = $username_id;
        $last_time = db('loginlog')->where($where)->order('id desc')->limit(0,1)->field('login_time')->find();
        if(empty($last_time)){
            $last_time = date("Y-m-d H:i:s");
        }else{
            $last_time = date("Y-m-d H:i:s",$last_time['login_time']);
        }
        return $last_time;
    }
}