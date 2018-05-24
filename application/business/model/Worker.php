<?php
namespace app\business\model;

use think\Model;

class Worker extends Model
{
	//登录查询
    public function chk_login($mobile,$password){
        $where['mobile']			= $mobile;
        $where['account_pwd']		= $password;
        $where['status']				= 0;
        $chk_log = db('worker')->where($where)->find();
        return $chk_log;
    }

    //查询该用户对应的id
    public function username_id($mobile){
        //查询出改用户对应的id
        $where['mobile'] = $mobile;
        $username_id = db('worker')->where($where)->field('id,position,realname')->find();
        switch($username_id['position']){
            case 1:
                $position = "管理员";
                break;
            case 2:
                $position = "操作员";
                break;
            case 3:
                $position = "销售员";
                break;
        }
        $data['id']          = $username_id['id'];
        $data['position']    = $position;
        $data['realname']    = $username_id['realname'];
        return $data;
    }
    //查询出所有员工数据
    public function sel_worker($page,$limit){
        $worker_list = db('worker')->page($page,$limit)->select();
        $worker_count= db('worker')->count();
        foreach($worker_list as $k => $v){
            foreach($v as $a => $b){
                if($a == "status"){
                    $worker_list[$k]['status'] = ($b == 0) ? '使用中' : '已禁用';
                }
                if($a == "position"){
                    switch($b){
                        case 1:
                            $worker_list[$k]['position'] = "管理员";
                            break;
                        case 2:
                            $worker_list[$k]['position'] = "操作员";
                            break;
                        case 3:
                            $worker_list[$k]['position'] = "销售员";
                            break;
                    }
                }
            }
        }
        $worker_data['count'] = $worker_count;
        $worker_data['data'] = $worker_list;
        return $worker_data;
    }

    //添加员工数据
    public function add_data($add_data){
        if(is_array($add_data)){
            //查询是否有重复的用户名
            $where['mobile'] = $add_data['mobile'];
            $sel_res = db('worker')->where($where)->field('id')->find();
            if(empty($sel_res['id'])){
                $ins_res = db('worker')->insert($add_data);
                return ($ins_res == true) ? true : false ;
            }else{
                json_return(1002,"已存在该账号,请重新填写账号。","");
            }
        }else{
            return false;
        }
    }

    //查询员工数据
    public function sel_data($id){
		$where['id'] = array('in',$id);
        $data = db('worker')->where($where)->select();
        return $data;
    }

    //查询员工数据
    public function sel_one_data($id){
        $where['id'] = $id;
        $data = db('worker')->where($where)->find();
        return $data;
    }
	
    //修改员工数据
    public function edit_data($data,$data_id){
        if(is_array($data)){
            //查询是否有重复的用户名
            $data['id'] = $data_id['id'];
            $sel_res = db('worker')->where($data)->field('id')->find();
            if(empty($sel_res['id'])){
                $ins_res = db('worker')->where($data_id)->update($data);
                return ($ins_res == true) ? true : false ;
            }else{
                json_return(1002,"您未做任何修改","");
            }
        }else{
            return false;
        }
    }
    //删除员工数据
    public function del_data($id){
        $id = implode(',',$id);
        $chk_where['belong'] = array('in',$id);
        //查询删除的数据是否在其他上层存在，不存在提示删除
        $data['activation'] = db('activation')->where($chk_where)->field('id')->limit(1)->select();
        $data['customer'] = db('customer')->where($chk_where)->field('id')->limit(1)->select();
        $data['money'] = db('money')->where($chk_where)->field('id')->limit(1)->select();
        if(!empty($data['activation']) || !empty($data['customer']) || !empty($data['money'])){
            json_return(1001,'请先删除基于该销售的数据',"");
        }
        $where['id'] = array('in',$id);
        $del_data = db('worker')->where($where)->delete();
        return $del_data;
    }
    //查询出所有销售
    public function sel_user_type($type){
        $where['position'] = $type;
        $sel_res = db('worker')->where($where)->field('id,realname')->select();
        return $sel_res;
    }
}