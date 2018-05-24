<?php

namespace app\business\controller;

use think\Controller;

class Service extends Base
{
    //维修
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
        $arrival_time               = input('get.arrival_time');
        if(!empty($arrival_time)){
            $arrival_time_arr = explode(' , ',$arrival_time);
            $data['arrival_begintime']  = strtotime($arrival_time_arr[0]);
            $data['arrival_endtime']    = strtotime($arrival_time_arr[1]);
        }
        $service                    = model('service');
        $res_data                   = $service->sel_data($data);
        $this->assign('service_list',$res_data['data']);
        $this->assign('count',$res_data['count']);
        $this->assign('page',$data['page']);
        $this->assign('plat_id',$data['plat_id']);
        $this->assign('customer_name',$data['custom_id']);
        $this->assign('arrival_time',$arrival_time);
        //输出客户名称
        $customer   = model('customer');
        $customer_name = $customer->sel_all();
        $this->assign('customer_name_list',$customer_name);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
	    return $this->fetch();
    }

    //添加
    public function add(){
        if(request()->isPost()){
            $data['custom_id']      =   input('post.custom_id');	    //int(11)			
            $data['plat_id']	    =   input('post.plat_id');          //int(11)			
            $data['card_id']	    =   input('post.card_id');          //varchar(20)			
            $data['arrival_time']	=   strtotime(input('post.arrival_time'));     //int(11)			
            $data['send_time']	    =   strtotime(input('post.send_time'));        //int(11)			
            $data['reason']	        =   input('post.reason');           //varchar(255)			
            $data['status']	        =   input('post.status');           //tinyint(1)			
            $data['is_complete']	=   input('post.is_complete');      //tinyint(1)			
            		
            $data['create_time']	=   time();                         //int(11)
            if(in_array('',$data)){
                json_return(1001,"请把添加的资料填写完整","");
            }
            $data['remark']	        =   input('post.remark');           //varchar(255)	
            $service = model('service');
            $add_res = $service->add($data);
            if($add_res){
                json_return(1,"添加成功","");
            }else{
                json_return(1002,"添加失败","");
            }
        }else{
            json_return(1002,"添加失败","");
        }
    }

    public function del(){
        $id = input('post.ids');
        $id = explode(",",$id);
        $service = model('service');
        $res      = $service->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
    }

    public function edit(){
        if(input('get.action') == 'edit'){
            $data['id']             =   input('post.id');	    //int(11)			
            $data['custom_id']      =   input('post.custom_id');	    //int(11)			
            $data['plat_id']	    =   input('post.plat_id');          //int(11)			
            $data['card_id']	    =   input('post.card_id');          //varchar(20)			
            $data['arrival_time']	=   strtotime(input('post.arrival_time'));     //int(11)			
            $data['send_time']	    =   strtotime(input('post.send_time'));        //int(11)			
            $data['reason']	        =   input('post.reason');           //varchar(255)			
            $data['status']	        =   input('post.status');           //tinyint(1)			
            $data['is_complete']	=   input('post.is_complete');      //tinyint(1)			
            if(in_array('',$data)){
                json_return(1001,"请把修改的资料填写完整","");
            }
            $data['remark']	        =   input('post.remark');           //varchar(255)	
            $service = model('service');
            $res     = $service->edit($data);
            if($res){
                json_return(1,"修改成功","");
            }else{
                json_return(1002,"修改失败","");
            }
        }
        $id = input('get.id');
        if(empty($id)){
            $this->error('请选择操作的数据',url('service/index'));
        }
        $service = model('service');
        $res      = $service->edit_sel($id);
        //输出客户名称
        $customer   = model('customer');
        $customer_name = $customer->sel_all();
        $this->assign('customer_name_list',$customer_name);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
        $this->assign('edit_data',$res);
        return $this->fetch();
    }
}