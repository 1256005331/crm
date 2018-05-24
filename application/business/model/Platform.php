<?php
namespace app\business\model;

use think\Model;

class Platform extends Model
{
	
    //查出所有的plat_name
    public function sel_all(){
        $all_data = db('platform')->select();
        return $all_data;
    }
	
	public function sel_plat_name($plat_id_str){
        $where['id'] = array('in',$plat_id_str);
        $sel_res = db('platform')->where($where)->field('plat_name,id')->select();
        return $sel_res;
    }	
	
    //查询平台数据
    public function sel_data($page,$limit,$plat_id){
        $where['id'] = !empty($plat_id) ? $plat_id : array('like',"%%");
        $sel_res          = db('platform')->where($where)->page($page,$limit)->select();
        //echo('<pre/>');print_r($sel_res);exit;
        $count_res     = db('platform')->where($where)->count();
        $data['data']  = $sel_res;
        $data['count'] = $count_res;
        return $data;
    }

    //插入平台数据
    public function add($data){
        //查询是否已存在该数据
        $where['plat_name']     = $data['plat_name'];
        $sel_res = db('platform')->where($where)->field('id')->find();
        if(empty($sel_res['id'])){
            //插入数据
            $add_res = db('platform')->insert($data);
            if($add_res){
                return true;
            }else{
                return false;
            }
        }else{
            json_return(1002,"已添加过这条信息,请校验确认！","");
        }
    }
    //删除数据
    public function del_data($id){
        $id = implode(',',$id);
        $chk_where['plat_id'] = array('in',$id);
        //查询删除的数据是否在其他上层存在，不存在提示删除
        $data['activation'] = db('activation')->where($chk_where)->field('id')->limit(1)->select();
        $data['customer']   = db('customer')->where($chk_where)->field('id')->limit(1)->select();
        $data['money']      = db('money')->where($chk_where)->field('id')->limit(1)->select();
        $data['service']    = db('service')->where($chk_where)->field('id')->limit(1)->select();
        $data['sku']        = db('sku')->where($chk_where)->field('id')->limit(1)->select();
        $data['trade']      = db('trade')->where($chk_where)->field('id')->limit(1)->select();
        if(!empty($data['activation']) || !empty($data['customer']) || !empty($data['money']) || !empty($data['service']) || !empty($data['sku']) || !empty($data['trade'])){
            json_return(1001,'请先删除基于该平台的数据',"");
        }
        $where['id'] = array('in',$id);
        $del_data = db('platform')->where($where)->delete();
        return $del_data;
    }

    //查询需要修改的数据
    public function edit_sel($id){
        $where['id'] = $id;
        $sel_data = db('platform')->where($where)->find();
        return $sel_data;
    }

    //修改查询
    public function edit($data,$data_id){
        if(is_array($data)){
            //查询是否有重复的用户名
            $data['id'] = $data_id['id'];
            $sel_res = db('platform')->where($data)->field('id')->find();
            if(empty($sel_res['id'])){
                $ins_res = db('platform')->where($data_id)->update($data);
                return ($ins_res == true) ? true : false ;
            }else{
                json_return(1002,"您未做任何修改","");
            }
        }else{
            return false;
        }
    }
/*


    //删除查询
    public function del_sel($id){
        $where['plat_id'] = $id;
        $sel_res = db('platform')->where($where)->field('id')->find();
        return $sel_res['id'];
    }

    //删除员工数据
    public function del_data($id){
        $id = implode(',',$id);
        $where['id'] = array('in',$id);
        $del_data = db('platform')->where($where)->delete();
        return $del_data;
    }*/

}