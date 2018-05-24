<?php

namespace app\business\controller;

use think\Controller;

class Customer extends Base
{
    //客户
    public function index(){
        $belong     = input('get.belong');
        $plat_id    = input('get.plat_name');
        $page       = input('get.page');
        $mobile     = input('get.phone');
        $mobile     = isset($mobile) ? $mobile : '' ;
        $page       = isset($page) ? $page : 1 ;
        $belong     = isset($belong) ? $belong : '' ;
        $plat_id    = isset($plat_id) ? $plat_id : '' ;
        $customer   = model('customer');
        $data       = $customer->sel_data($page,20,$belong,$plat_id,$mobile);
        //查询所有销售姓名
        $worker     = model('worker');
        $sale       = $worker->sel_user_type(3);

        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
        $this->assign('page',$page);
        $this->assign('plat_name',$plat_id);
        $this->assign('belong',$belong);
        $this->assign('plat_id',$plat_id);
        $this->assign('sale',$sale);
        $this->assign('phone',$mobile);
        $this->assign('count',$data['count']);
        $this->assign('customer_list',$data['data']);
		return $this->fetch();
    }

    //添加客户信息
    public function add(){
        if(request()->isPost()){
            $customer_name  = input('post.customer_name');
            $province       = sel_city(input('post.province'));
            $city           = sel_city(input('post.city'));
            $mobile         = input('post.mobile');
            $address        = input('post.address');
            $belong         = input('post.belong');
            $remark         = input('post.remark');
            //为空过滤
            if(empty($customer_name) || empty($province) || empty($city) || empty($mobile) || empty($belong)){
                json_return(1002,"请把员工资料填写完整","");
            }
            //手机号长度验证
            if(strlen($mobile) !== 11){
                json_return(1002,"请填写正确的手机号","");
            }
            //调用model   入库
            $data['customer_name']  =   $customer_name;
            $data['province']       =   $province;
            $data['city']           =   $city;
            $data['mobile']         =   $mobile;
            $data['address']        =   $address;
            $data['belong']         =   $belong;
            $data['remark']         =   $remark;
            $data['create_time']    =   time();
            $customer               =   model('customer');
            $add_res                =   $customer->add($data);
            if($add_res){
                json_return(1,"添加成功","");
            }else{
                json_return(1002,"添加失败","");
            }
        }else{
            json_return(1002,"添加失败","");
        }
    }

    //删除客户信息
    public function del(){
        $id = input('post.ids');
        $id = explode(",",$id);
        $customer = model('customer');
        $res      = $customer->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
    }

    //修改
    public function edit(){
        if(input('get.action') == 'edit'){
            $data['id']             = input('post.id');
            $data['customer_name']  = input('post.customer_name');
            $data['province']       = sel_city(input('post.province'));
            $data['city']           = sel_city(input('post.city'));
            $data['mobile']         = input('post.mobile');
            $data['address']        = input('post.address');
            $data['belong']         = input('post.belong');
            $data['remark']         = input('post.remark');
            if(in_array('',$data)){
                json_return(1001,"请把修改的资料填写完整","");
            }
            $customer = model('customer');
            $res      = $customer->edit($data);
            if($res){
                json_return(1,"修改成功","");
            }else{
                json_return(1002,"修改失败","");
            }
        }elseif(input('get.action') == 'set'){
            $data['id']             = input('post.id');
            $data['plat_id']        = input('post.plat_id/a');
            $data['plat_id']        = empty($data['plat_id']) ? 0 : $data['plat_id'] ;
            if(is_array($data['plat_id'])){
                $data['plat_id'] = serialize($data['plat_id']);
            }
            if(empty($data['id'])){
                json_return(1001,"请把修改的资料填写完整","");
            }
            $customer = model('customer');
            $res      = $customer->edit($data);
            if($res){
                json_return(1,"修改成功","");
            }else{
                json_return(1002,"修改失败","");
            }
        }
        $id = input('get.id');
        if(empty($id)){
            $this->error('请选择操作的数据',url('customer/index'));
        }
        $customer = model('customer');
        $res      = $customer->edit_sel($id);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        //查询所有销售姓名
        $worker     = model('worker');
        $sale       = $worker->sel_user_type(3);
        $this->assign('plat_list_select',$palt_name);
        $this->assign('edit_data',$res[0]);
        $this->assign('sale',$sale);
        return $this->fetch();
    }
	
	//设置
	public function set(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('请选择操作的数据',url('customer/index'));
        }
        $customer = model('customer');
        $res      = $customer->edit_sel($id);
        $this->assign('edit_data',$res[0]['plat_id']);
        $this->assign('id',$res[0]['id']);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
        return $this->fetch();
    }
    
    //更换所属销售
    public function aaa(){
        if(request()->isPost()){
            $id = input('post.ids');
            if(empty($id)){
                json_return(1001,"请选择需要分配的客户","");
            }
            if(strlen($id) == 1){
                $id_arr = $id;
            }else{
                $id_arr = explode(',',$id);
                foreach($id_arr as $k => $v){
                    if(empty($v)){
                        unset($id_arr[$k]);
                    }
                }
                $id_arr = implode(',',$id_arr);
            }
            $data['belong'] = input('post.belong');
            if(empty($data['belong'])){
                json_return(1001,"请选择分配客户到哪一个销售","");
            }
            $where['id'] = array('in',$id_arr);
            $update_res = db('customer')->where($where)->update($data);
            if($update_res){
                json_return(1,"分配成功","");
            }else{
                json_return(1002,"分配失败","");
            }
        }else{
            json_return(1002,"分配失败","");
        }
    }
}