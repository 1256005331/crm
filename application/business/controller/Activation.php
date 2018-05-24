<?php

namespace app\business\controller;

use think\Controller;

class Activation extends Base
{
    //激活
    public function index()
    {
        $data['page']               = input('get.page');
        $data['limit']              = 20;
        $data['plat_id']            = input('get.plat_name');
        $data['custom_id']          = input('get.customer_name');
        foreach($data as $k => $v){
            if(!isset($v)){
                if($k == 'page'){
                    $data[$k] = 1;
                }else{
                    $data[$k] = '';
                }
            }
        }
        $activation_time               = input('get.activation_time');
        if(!empty($activation_time)){
            $activation_time_arr = explode(' , ',$activation_time);
            $data['activation_begintime']  = strtotime($activation_time_arr[0]." 00:00:00");
            $data['activation_endtime']    = strtotime($activation_time_arr[1]." 23:59:59");
        }
        $activation = model('activation');
        $res_data   = $activation->sel_list_data($data);
        $this->assign('activation_list',$res_data['data']);
        $this->assign('count',$res_data['count']);
        $this->assign('page',$data['page']);
        $this->assign('plat_id',$data['plat_id']);
        $this->assign('customer_name',$data['custom_id']);
        $this->assign('activation_time',$activation_time);
        //输出客户名称
        $customer   = model('customer');
        $customer_name = $customer->sel_all();
        $this->assign('customer_name_list',$customer_name);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
        //输出所有销售姓名
        $worker     = model('worker');
        $sale       = $worker->sel_user_type(3);
        $this->assign('sale',$sale);
	    return $this->fetch();
    }

    public function del(){
        $id = input('post.ids');
        $id = explode(",",$id);
        $service = model('activation');
        $res      = $service->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
    }

        //添加
        public function add(){
            if(request()->isPost()){
                $data['custom_id']	    =   input('post.custom_id');//int(11)
                $data['plat_id']	    =   input('post.plat_id');//int(11)
                $data['activation_num']	=   input('post.activation_num');//int(11)
                $data['activation_time']=   strtotime(input('post.activation_time'));//int(11)
                $data['belong']	        =   input('post.belong');//varchar(80)
                $data['remark']	        =   input('post.remark');//varchar(255)
                $data['create_time']    =   time();
                if(in_array('',$data)){
                    json_return(1001,"请把添加的资料填写完整","");
                }
                $activation = model('activation');
                $add_res    = $activation->add($data);
                if($add_res){
                    json_return(1,"添加成功","");
                }else{
                    json_return(1002,"添加失败","");
                }
            }else{
                json_return(1002,"添加失败","");
            }
        }

    //激活统计
    public function total()
    {
        $page           = input('get.page');
        $create_time    = input('get.create_time');
        $plat_name      = input('get.plat_name');
        $page           = isset($page) ? $page : 1 ;
        $create_time               = input('get.create_time');
            if(!empty($create_time)){
                $create_time_arr = explode(' , ',$create_time);
                $data['create_begintime']  = strtotime($create_time_arr[0]);
                $data['create_endtime']    = strtotime($create_time_arr[1]);
            }else{
                $data['create_begintime']  = '';
                $data['create_endtime']    = '';
            }
        $plat_name      = isset($plat_name) ? $plat_name : "" ;

        $Activation     = model('Activation');
        $data           = $Activation->sel_data($page,20,$create_time,$plat_name,$data);
		
        //输出客户名称
        $customer   = model('customer');
        $customer_name = $customer->sel_all();
        $this->assign('customer_name_list',$customer_name);
		
        $this->assign('page',$page);
        $this->assign('create_time',$create_time);
        $this->assign('plat_name',$plat_name);
        $this->assign('plat_list_select',$data['plat']);
        $this->assign('activation_list',$data['data']);
        $this->assign('all_num',$data['all_num']);
        $this->assign('count',$data['count']);
        return $this->fetch();
    }

    public function edit(){
        if(input('get.action') == 'edit'){
            $data['id']             =   input('post.id');	    //int(11)			
            $data['custom_id']	    =   input('post.custom_id');//int(11)
            $data['plat_id']	    =   input('post.plat_id');//int(11)
            $data['activation_num']	=   input('post.activation_num');//int(11)
            $data['activation_time']=   input('post.activation_time');//int(11)
            $data['belong']	        =   input('post.belong');//varchar(80)
            $data['remark']	        =   input('post.remark');//varchar(255)
            if(in_array('',$data)){
                json_return(1001,"请把修改的资料填写完整","");
            }
            $service = model('activation');
            $res     = $service->edit($data);
            if($res){
                json_return(1,"修改成功","");
            }else{
                json_return(1002,"修改失败","");
            }
        }
        $id = input('get.id');
        if(empty($id)){
            $this->error('请选择操作的数据',url('activation/index'));
        }
        $service = model('activation');
        $res      = $service->edit_sel($id);
        //输出客户名称
        $customer   = model('customer');
        $customer_name = $customer->sel_all();
        $this->assign('customer_name_list',$customer_name);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
        //输出所有销售姓名
        $worker     = model('worker');
        $sale       = $worker->sel_user_type(3);
        $this->assign('sale',$sale);
        $this->assign('edit_data',$res);
        return $this->fetch();
    }
}