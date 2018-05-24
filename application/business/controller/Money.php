<?php

namespace app\business\controller;

use think\Controller;

class Money extends Base
{
    //红利
    public function index()
    {
        $data['page']       = input('get.page');
        $data['limit']      = 20;
        $data['plat_id']    = input('get.plat_name');
        $data['belong']     = input('get.belong');
        foreach($data as $k => $v){
            if(!isset($v)){
                if($k == 'page'){
                    $data[$k] = 1;
                }else{
                    $data[$k] = '';
                }
            }
        }
        $months       = input('get.months');
        if(!empty($months)){
            $months_arr = explode(' , ',$months);
            $data['months_begin']  = strtotime($months_arr[0]);
            $data['months_end']    = strtotime($months_arr[1]);
        }
        $money = model('money');
        $res_data = $money->sel_data($data);
        $this->assign('money_list',$res_data['data']);
        $this->assign('count',$res_data['count']);
        $this->assign('page',$data['page']);
        $this->assign('plat_id',$data['plat_id']);
        $this->assign('belong',$data['belong']);
        $this->assign('months',$months);
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

    //删除客户信息
    public function del(){
        $id = input('post.ids');
        $id = explode(",",$id);
        $money = model('money');
        $res      = $money->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
    }

    public function add(){
        if(request()->isPost()){
            $data['plat_id']        =   input('post.plat_id');//int(11)
            $data['belong']	        =   input('post.belong');//varchar(80)
            $data['bonus']	        =   input('post.bonus');//varchar(10)
        	$data['total_money']    =   input('post.total_money');//decimal(12,2)
        	$data['down_money']	    =   input('post.down_money');//decimal(12,2)
        	$data['bonus_money']	=   input('post.bonus_money');//decimal(12,2)
            $data['months']	        =   strtotime(input('post.months'));//int(11)
            $data['remark']	        =   input('post.remark');//varchar(255)
        	$data['create_time']    =   time();
            if(in_array('',$data)){
                json_return(1001,"请把添加的资料填写完整","");
            }
            $money = model('money');
            $add_res = $money->add($data);
            if($add_res){
                json_return(1,"添加成功","");
            }else{
                json_return(1002,"添加失败","");
            }
        }else{
            json_return(1002,"添加失败","");
        }
    }

    public function edit(){
        if(input('get.action') == 'edit'){
            $data['id']             =   input('post.id');	    //int(11)			
            $data['plat_id']        =   input('post.plat_id');//int(11)
            $data['belong']	        =   input('post.belong');//varchar(80)
            $data['bonus']	        =   input('post.bonus');//varchar(10)
        	$data['total_money']    =   input('post.total_money');//decimal(12,2)
        	$data['down_money']	    =   input('post.down_money');//decimal(12,2)
        	$data['bonus_money']	=   input('post.bonus_money');//decimal(12,2)
            $data['months']	        =   strtotime(input('post.months'));//int(11)
            
            if(in_array('',$data)){
                json_return(1001,"请把修改的资料填写完整","");
            }
            $data['remark']	        =   input('post.remark');//varchar(255)
            $money   = model('money');
            $res     = $money->edit($data);
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
        $money    = model('money');
        $res      = $money->edit_sel($id);
        //查询所有销售姓名
        $worker     = model('worker');
        $sale       = $worker->sel_user_type(3);
        $this->assign('sale',$sale);
        //输出平台名称
        $plat       = model('platform');
        $palt_name  = $plat->sel_all();
        $this->assign('plat_list_select',$palt_name);
        $this->assign('edit_data',$res);
        return $this->fetch();
    }
}