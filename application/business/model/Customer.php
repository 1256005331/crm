<?php

namespace app\business\model;

use think\Model;
use think\Db;

class Customer extends Model
{
    public function sel_data($page,$limit,$belong,$plat_id,$mobile){
        $plat_id_like = 's:1:"'.$plat_id.'"';
        //exit($plat_id_like);
        $where_plat_id = !empty($plat_id) ? "`plat_id` Like '%".$plat_id_like."%'" : "`plat_id` LIKE '%%'";
        $where_belong  = !empty($belong) ? "`belong` = '".$belong."'" : "`belong` LIKE '%%'";
        $OR_mobile  = !empty($mobile) ? "`mobile` = '".$mobile."'" : "`mobile` LIKE '%%'";
        $OR_customer_name  = !empty($mobile) ? "`customer_name` = '".$mobile."'" : "`customer_name` LIKE '%%'";
        $sel_data       = db::query("SELECT * FROM `crm_customer` WHERE $where_plat_id AND $where_belong AND ($OR_mobile OR $OR_customer_name) LIMIT 0,20");
        // echo Db::getLastSql();
        // echo('<pre/>');print_r($sel_data);exit;
        if(!$sel_data){
            $data['data']  = '';
            $data['count'] = '';
            return $data;
            exit;
        }
        foreach($sel_data as $k => $v){
            $belong_arr[] = $v['belong'];
            if(!empty($v['plat_id'])){
                $plat_id_arr = unserialize($v['plat_id']);
                $plat_id_str = implode(',',$plat_id_arr);
                $plat        = model('platform');
                $plat_name   = $plat->sel_plat_name($plat_id_str);
                foreach($plat_name as $a => $b){
                    $plat_name_arr[] = $b['plat_name'];
                    $sel_data[$k]['plat_id'] = implode('、',$plat_name_arr);
                }
                unset($plat_name);
                unset($plat_name_arr);
            }else{
                $plat_id = '空';
                $sel_data[$k]['plat_id'] = $plat_id;
            }
        }
        $belong_str  = implode(',',$belong_arr);
        $worker      = model('worker');
        $realname    = $worker->sel_data($belong_str);
        if(empty($realname)){
            return false;exit;
        }
        foreach($realname as $k => $v){
            foreach($sel_data as $a => $b){
                if($v['id'] == $b['belong']){
                    $sel_data[$a]['belong'] = $realname[$k]['realname'];
                }
            }
        }
        $count = db::query("SELECT count(*) FROM `crm_customer` WHERE $where_plat_id AND $where_belong AND ($OR_mobile OR $OR_customer_name)");
        $count = $count[0]['count(*)'];
        $data['data']  = $sel_data;
        $data['count'] = $count;
        return $data;
    }

    public function add($data){
        //首先查询是否存在该客户名称
        $where_chk['customer_name'] = $data['customer_name'];
        $chk_res = db('customer')->where($where_chk)->find();
        if(empty($chk_res)){
            //插入数据
            $add_res = db('customer')->insert($data);
            return $add_res;
        }else{
            json_return(1001,"该客户已存在,请检查核对！","");
        }
    }

    public function del($id){
        if(is_array($id)){
            $id = implode(',',$id);
        }
        $where['id'] = array('in',$id);
        $chk_where['custom_id'] = array('in',$id);
        //查询删除的数据是否在其他上层存在，不存在提示删除
        $data['activation'] = db('activation')->where($chk_where)->field('id')->limit(1)->select();
        $data['service']    = db('service')->where($chk_where)->field('id')->limit(1)->select();
        $data['sku']        = db('sku')->where($chk_where)->field('id')->limit(1)->select();
        if(!empty($data['activation']) || !empty($data['service']) || !empty($data['sku'])){
            json_return(1001,'请先删除基于该平台的数据',"");
        }
        $del_data = db('customer')->where($where)->delete();
        return $del_data;
    }

    public function edit_sel($id){
        $where['id'] = $id;
        $sel_data = db('customer')->where($where)->select();
        foreach($sel_data as $k => $v){
            $sel_data[$k]['province'] = sel_citycode($v['province']);
            $sel_data[$k]['city']     = sel_citycode($v['city']);
            $sel_data[$k]['plat_id']  = !empty($v['plat_id']) ? unserialize($v['plat_id']) : '' ;
            if(!empty($sel_data[$k]['plat_id'])){
                $plat_id_str = implode(',',$sel_data[$k]['plat_id']);
                $plat        = model('platform');
                $plat_name   = $plat->sel_plat_name($plat_id_str);
                $sel_data[$k]['plat_id'] = $plat_name;
            }else{
                $sel_data[$k]['plat_id'] = array(0 => array('id' => ''));
            }
        }
        //echo('<pre/>');print_r($sel_data);//exit;
        return $sel_data;
    }

    public function edit($data){
        $where['id'] = $data['id'];
        $chk = db('customer')->where($data)->select();
        if(empty($chk)){
            //更新数据
            $updata = db('customer')->where($where)->update($data);
            return ($updata == true) ? true : false ;
        }else{
            json_return(1002,"您未做任何修改","");
        }
    }

    public function sel_all(){
        //查询所有客户名称
        $res = db('customer')->field('id,customer_name')->select();
        return $res;
    }

    //根据id查询客户名称和id   id string
    public function sel_name($id){
        $where['id'] = array('in',$id);
        $res = db('customer')->where($where)->field('id,customer_name')->select();
        return $res;
    }
}