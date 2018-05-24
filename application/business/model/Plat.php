<?php
namespace app\business\model;

use think\Model;

class Plat extends Model
{
    //分页 渲染plat表数据 页数  条数  平台名模糊查询
    /*public function sel_data($page,$limit,$plat_name){
        $where['plat_name'] = array("like","%$plat_name%");
        $sel_res    = db('plat')->where($where)->page($page,$limit)->select();
        $count_res  = db('plat')->count();
        $data['count'] = $count_res;
        $data['data'] = $sel_res;
        return $data;
    }

    //通过ID  批量查询平台名称
    */public function sel_plat_name($plat_id_str){
        $where['id'] = array('in',$plat_id_str);
        $sel_res = db('platform')->where($where)->field('plat_name,id')->select();
        return $sel_res;
    }/*

    //添加数据
    public function add($plat_name){
        $where['plat_name'] = $plat_name;
        $sel_res = db('plat')->where($where)->field('id')->find();
        if(isset($add_res['id'])){
            json_return(1001,'已存在该平台','');
        }
        $add_res = db('plat')->insert($where);
        return $add_res;
    }
    //删除数据
    public function del($id){
        $id = implode(',',$id);
        $where['id'] = array('in',$id);
        //查询该平台是否有相关的平台信息存在，存在的话不允许删除
        $plat  = model('platform');
        $sel_res = $plat->del_sel($where['id']);
        if($sel_res){
            json_return(1002,"存在基于该平台的其他相关数据,请先进行处理相关数据在进行删除","");
        }
        $del_data = db('plat')->where($where)->delete();
        return $del_data;
    }

    //修改数据
    public function edit($data){
        //查询是否经过修改
        $sel_res = db('plat')->where($data)->field('id')->find();
        if(empty($sel_res['id'])){
            //进行更新数据
            $where['id'] = $data['id'];
            $updata_res  = db('plat')->where($where)->update($data);
            return $updata_res;
        }else{
            json_return(1001,'您未做任何改动!','');
        }
    }*/


}