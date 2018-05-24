<?php

namespace app\business\model;

use think\Model;

class Activation extends Model

{
    public function sel_data($page,$limit,$create_time,$plat_name,$data){
        $where['plat_id']           = array('like',"%$plat_name%");
        $where['activation_time']       = !empty($data['create_begintime']) ? array('between',"".$data['create_begintime'].",".$data['create_endtime']."") : array('like',"%%");
        $sel_res                    = db('activation')->where($where)->page($page,$limit)->order('id desc')->select();
        
        if($sel_res){
            $plat_id = array();
            foreach($sel_res as $k=> $v){
                $plat_id[]  = $v['plat_id'];
                $id[]       = $v['belong'];
            }
            $plat_id    = implode(',',$plat_id);
            $id         = implode(',',$id);
            $plat       =   model('platform');
            $plat_name  = $plat->sel_plat_name($plat_id);
            $worker     =   model('worker');
            $realname   =   $worker->sel_data($id);
            foreach($plat_name as $k => $v){
                foreach($sel_res as $a => $b){
                    if($v['id'] == $b['plat_id']){
                        $sel_res[$a]['plat_id'] = $plat_name[$k]['plat_name'];
                    }
                }
            }
            foreach($realname as $k => $v){
                foreach($sel_res as $a => $b){
                    if($v['id'] == $b['belong']){
                        $sel_res[$a]['belong'] = $realname[$k]['realname'];
                    }
                }
            }
            $count_res     = db('activation')->where($where)->count();
            $data['data']  = $sel_res;
            $data['count'] = $count_res;
        }else{
            $data['data']  = "";
            $data['count'] = "";
        }
        //查询平台名称输出
        $plat = model('platform');
        $plat_all = $plat->sel_all();
        if($plat_all){
            $data['plat']  = $plat_all;
        }else{
            $data['plat']  = "";
        }
        $data['all_num'] = db('activation')->where($where)->sum('activation_num');
        return $data;
    }

    public function sel_list_data($data){
        $where['plat_id']           = !empty($data['plat_id']) ? $data['plat_id'] : array('like',"%%");
        $where['custom_id']         = !empty($data['custom_id']) ? $data['custom_id'] : array('like',"%%");
        $where['activation_time']   = !empty($data['activation_begintime']) ? array('between',"".$data['activation_begintime'].",".$data['activation_endtime']."") : array('like',"%%");
        $sel_data                   = db('activation')->where($where)->page($data['page'],$data['limit'])->select();
        
        $data = array();
        if(empty($sel_data)){
            $data['data']  = '';
            $data['count'] = '';
            return $data;
            exit;
        }
        
        foreach($sel_data as $k => $v){
            $belong_arr[]       = $v['belong'];
            $plat_id_arr[]      = $v['plat_id'];
            $custom_id_arr[]    = $v['custom_id'];
        }
        $belong_str     = implode(',',$belong_arr);
        $plat_id_str    = implode(',',$plat_id_arr);
        $custom_id_str  = implode(',',$custom_id_arr);
        $customer       = model('customer');
        $customer_name  = $customer->sel_name($custom_id_str);
        $worker         = model('worker');
        $realname       = $worker->sel_data($belong_str);
        $plat           = model('platform');
        $plat_name      = $plat->sel_plat_name($plat_id_str);
        if(empty($realname) || empty($plat_name) || empty($customer_name)){
            return false;exit;
        }
        foreach($realname as $k => $v){
            foreach($sel_data as $a => $b){
                if($v['id'] == $b['belong']){
                    $sel_data[$a]['belong'] = $realname[$k]['realname'];
                }
            }
        }
        foreach($plat_name as $k => $v){
            foreach($sel_data as $a => $b){
                if($v['id'] == $b['plat_id']){
                    $sel_data[$a]['plat_id'] = $plat_name[$k]['plat_name'];
                }
            }
        }
        foreach($customer_name as $k => $v){
            foreach($sel_data as $a => $b){
                if($v['id'] == $b['custom_id']){
                    $sel_data[$a]['custom_id'] = $customer_name[$k]['customer_name'];
                }
            }
        }
        //echo('<pre/>');print_r($sel_data);exit;
        $count = db('activation')->where($where)->count();
        $data['data']  = $sel_data;
        $data['count'] = $count;
        return $data;
    }

    public function del($id){
        if(is_array($id)){
            $id = implode(',',$id);
        }
        $where['id'] = array('in',$id);
        $del_data = db('activation')->where($where)->delete();
        return $del_data;
    }

    public function add($data){
            $add = db('activation')->insert($data);
            return $add;
    }

    public function edit_sel($id){
        $where['id'] = $id;
        $sel_data = db('activation')->where($where)->find();
        $sel_data['activation_time'] = date('Y-m-d',$sel_data['activation_time']);
        return $sel_data;
    }

    public function edit($data){
        $where['id'] = $data['id'];
        $chk = db('activation')->where($data)->find();
        if(empty($chk)){
            //更新数据
            $updata = db('activation')->where($where)->update($data);
            return $updata;
        }else{
            json_return(1002,"您未做任何修改","");
        }
    }
}