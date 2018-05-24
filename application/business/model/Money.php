<?php

namespace app\business\model;

use think\Model;

class Money extends Model

{
    public function sel_data($data){
        $where['plat_id'] = !empty($data['plat_id']) ? $data['plat_id'] : array('like',"%%");
        $where['belong']  = !empty($data['belong']) ? $data['belong'] : array('like',"%%");
        $where['months']  = !empty($data['months_begin']) ? array('between',"".$data['months_begin'].",".$data['months_end']."") : array('like',"%%");
        $sel_data = db('money')->where($where)->page($data['page'],$data['limit'])->select();
        if(empty($sel_data)){
            $data['data']  = '';
            $data['count'] = '';
            return $data;
            exit;
        }
        foreach($sel_data as $k => $v){
            $belong_arr[] = $v['belong'];
            $plat_id_arr[] = $v['plat_id'];
        }
        $belong_str  = implode(',',$belong_arr);
        $plat_id_str = implode(',',$plat_id_arr);
        $worker      = model('worker');
        $realname    = $worker->sel_data($belong_str);
        $plat        = model('platform');
        $plat_name   = $plat->sel_plat_name($plat_id_str);
        //echo('<pre/>');print($plat_id_str);exit;
        if(empty($realname) || empty($plat_name)){
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
        //echo('<pre/>');print_r($sel_data);exit;
        $count = db('money')->where($where)->count();
        $data['data']  = $sel_data;
        $data['count'] = $count;
        return $data;
    }

    public function del($id){
        if(is_array($id)){
            $id = implode(',',$id);
        }
        $where['id'] = array('in',$id);
        $del_data = db('money')->where($where)->delete();
        return $del_data;
    }

    public function add($data){
            $add = db('money')->insert($data);
            return $add;
    }

    public function edit_sel($id){
        $where['id'] = $id;
        $sel_data = db('money')->where($where)->find();
        $sel_data['months'] = date('Y-m',$sel_data['months']);
        return $sel_data;
    }

    public function edit($data){
        $where['id'] = $data['id'];
        $chk = db('money')->where($data)->find();
        if(empty($chk)){
            //更新数据
            $updata = db('money')->where($where)->update($data);
            return $updata;
        }else{
            json_return(1002,"您未做任何修改","");
        }
    }
}