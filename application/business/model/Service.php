<?php

namespace app\business\model;

use think\Model;

class Service extends Model

{

    public function sel_data($data){
        $where['plat_id']       = !empty($data['plat_id']) ? $data['plat_id'] : array('like',"%%");
        $where['custom_id']     = !empty($data['custom_id']) ? $data['custom_id'] : array('like',"%%");
        $where['arrival_time']  = !empty($data['arrival_begintime']) ? array('between',"".$data['arrival_begintime'].",".$data['arrival_endtime']."") : array('like',"%%");
        $sel_data = db('service')->where($where)->page($data['page'],$data['limit'])->select();
        if(empty($sel_data)){
            $data['data']  = '';
            $data['count'] = '';
            return $data;
            exit;
        }
        foreach($sel_data as $k => $v){
            $custom_id_arr[] = $v['custom_id'];
            $plat_id_arr[] = $v['plat_id'];
        }
        $custom_id_str  = implode(',',$custom_id_arr);
        $plat_id_str = implode(',',$plat_id_arr);
        $customer      = model('customer');
        $customer_name    = $customer->sel_name($custom_id_str);
        $plat        = model('platform');
        $plat_name   = $plat->sel_plat_name($plat_id_str);
        //echo('<pre/>');print($plat_id_str);exit;
        if(empty($customer_name) || empty($plat_name)){
            return false;exit;
        }
        foreach($sel_data as $k => $v){
            switch($v['status']){
                case 0:
                $sel_data[$k]['status'] = '未处理';
                break;
                case 1:
                $sel_data[$k]['status'] = '处理中';
                break;
                case 2:
                $sel_data[$k]['status'] = '已完成';
                break;
            }
            $sel_data[$k]['is_complete'] = ($v['is_complete'] == 0) ? '否' : '是' ;
        }
        foreach($customer_name as $k => $v){
            foreach($sel_data as $a => $b){
                if($v['id'] == $b['custom_id']){
                    $sel_data[$a]['custom_id'] = $customer_name[$k]['customer_name'];
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
        $count = db('service')->where($where)->count();
        $data = array();
        $data['data'] = $sel_data;
        $data['count'] = $count;
        return $data;
    }
    public function add($data){
        //是否已存在该序列号的数据
        $where['card_id'] = $data['card_id'];
        $chk = db('service')->where($where)->find();
        if(empty($chk)){
            $add = db('service')->insert($data);
            return $add;
        }
    }

    public function del($id){
        if(is_array($id)){
            $id = implode(',',$id);
        }
        $where['id'] = array('in',$id);
        $del_data = db('service')->where($where)->delete();
        return $del_data;
    }

    public function edit_sel($id){
        $where['id'] = $id;
        $sel_data = db('service')->where($where)->find();
        $sel_data['send_time'] = date('Y-m-d',$sel_data['send_time']);
        $sel_data['arrival_time'] = date('Y-m-d',$sel_data['arrival_time']);
        return $sel_data;
    }

    public function edit($data){
        $where['id'] = $data['id'];
        $chk = db('service')->where($data)->find();
        if(empty($chk)){
            //更新数据
            $updata = db('service')->where($where)->update($data);
            return $updata;
        }else{
            json_return(1002,"您未做任何修改","");
        }
    }

}