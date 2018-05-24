<?php
namespace app\business\model;

use think\Model;

class Trade extends Model
{

    //查询平台数据
    public function sel_data($page,$limit,$create_time,$plat_id,$data){
        $create_time            = strtotime($create_time);
        $where['create_time']       = !empty($data['create_begintime']) ? array('between',"".$data['create_begintime'].",".$data['create_endtime']."") : array('like',"%%");
        $where['plat_id']       = array('like',"%$plat_id%");
        $sel_res                = db('trade')->where($where)->page($page,$limit)->order('id desc')->select();
        if($sel_res){
            $plat_id = array();
            foreach($sel_res as $k => $v){
                $plat_id[] = $v['plat_id'];
                
            }
            $plat_id       = implode(',',$plat_id);
            $plat   =   model('platform');
            $plat_name = $plat->sel_plat_name($plat_id);
    
            foreach($plat_name as $k => $v){
                foreach($sel_res as $a => $b){
                    if($v['id'] == $b['plat_id']){
                        $sel_res[$a]['plat_id'] = $plat_name[$k]['plat_name'];
                    }
                }
            }


            $count_res     = db('trade')->where($where)->count();
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
        //查出总计并输出
        $data['all_num'] = db('trade')->where($where)->sum('money');
        return $data;
    }

    public function add($data){
        if(is_array($data)){
            //查询plat_id 是否存在在plat/platform表中    数据基于plat/platform表

            $platform = model('platform');
            $chk_platform_res = $platform->edit_sel($data['plat_id']);
            if(empty($chk_platform_res['id'])){
                json_return(1002,'不存在该平台','');
            }
            $add_trade = db('trade')->insert($data);
            return $add_trade;
        }
    }
}