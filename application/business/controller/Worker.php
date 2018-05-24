<?php

namespace app\business\controller;

use think\Controller;

class Worker extends Base
{
    //员工
    public function index()
    {
        $page   = input('get.page');
        $page   = empty($page) ? 1 : $page;
        $worker = model('worker');
        $list   = $worker->sel_worker($page,20);

        $this->assign('page',$page);
        $this->assign('count',$list['count']);
        $this->assign('worker_list',$list['data']);
		return $this->fetch();
    }

    //添加员工
    public function add_worker(){
        if(request()->isPost()){
            $account_pwd    = input('post.account_pwd');
            $realname       = input('post.realname');
            $mobile         = input('post.mobile');
            $position       = input('post.position');
            $status         = input('post.status');
            //判断是否为空
            if(!isset($account_pwd) || !isset($realname) || !isset($mobile) || !isset($position) || !isset($status)){
                json_return(1002,"请把员工资料填写完整","");
            }
            //手机号长度验证
            if(strlen($mobile) !== 11){
                json_return(1002,"请填写正确的手机号","");
            }
            //身份参数的验证
            if($position != 1 && $position != 2 && $position != 3 ){
                json_return(1002,"请选择正确的身份","");
            }
            //状态参数的验证
            if($status != 0 && $status != 1){
                json_return(1002,"请选择正确的状态","");
            }			
            $add_data['account_pwd'] = $account_pwd;
            $add_data['realname']    = $realname;
            $add_data['mobile']      = $mobile;
            $add_data['position']    = $position;
            $add_data['status']      = $status;
            $add_data['create_time'] = time();
            //插入数据
            $worker = model('worker');
            $ins_res= $worker->add_data($add_data);
            if($ins_res){
                json_return(1,"添加成功","");
            }else{
                json_return(1001,"添加失败","");
            }
        }else{
            json_return(1001,"添加失败","");
        }
    }
	
	public function auth(){
		$id   = input('get.id');
		if(!isset($id)){
			$this->error('请选择操作的数据',url('worker/index'));
		}	
		$worker     = model('worker');
        $sel_res    = $worker->sel_one_data($id);
        $sel_res['account_auth'] = explode(",",$sel_res['account_auth']);
        
        $this->assign('edit_data',$sel_res);		
		return $this->fetch();
	}

    //权限分配
    public function edit_auth(){
		if(request()->isPost()){
			$id   = input('post.id');
			$auth = input('post.account_auth/a');
            if(!isset($id)){
                $this->error('请选择操作的数据',url('worker/index'));
            }
			if(empty($auth)){
				$auth = null;
			} else {
				$auth = implode(",",$auth);
			}
			$data_id['id'] = $id;
			$data['account_auth'] = $auth;
			
            //更新数据
            $worker = model('worker');
            $edit_res= $worker->edit_data($data,$data_id);
			
            if($edit_res){
                json_return(1,"修改成功","");
            }else{
                json_return(1001,"修改失败","");
            }		
		}else{
            json_return(1001,"修改失败","");
        }
    }

    //修改员工数据
    public function edit(){
        if(input('get.action') == "edit"){
            $id             = input('post.id');
            $account_pwd    = input('post.account_pwd');
            $realname       = input('post.realname');
            $mobile         = input('post.mobile');
            $position       = input('post.position');
            $status         = input('post.status');

            //判断是否为空
            if(!isset($account_pwd) || !isset($realname) || !isset($mobile) || !isset($position) || !isset($status)){
                json_return(1002,"请把员工资料填写完整","");
            }
            //手机号长度验证
            if(strlen($mobile) !== 11){
                json_return(1002,"请填写正确的手机号","");
            }
            //身份参数的验证
            if($position != 1 && $position != 2 && $position != 3 ){
                json_return(1002,"请选择正确的身份","");
            }
            //状态参数的验证
            if($status != 0 && $status != 1){
                json_return(1002,"请选择正确的状态","");
            }
            $data_id['id']       = $id;
            $data['account_pwd'] = $account_pwd;
            $data['realname']    = $realname;
            $data['mobile']      = $mobile;
            $data['position']    = $position;
            $data['status']      = $status;
            $data['create_time'] = time();

            //更新数据
            $worker = model('worker');
            $edit_res= $worker->edit_data($data,$data_id);
            if($edit_res){
                json_return(1,"修改成功","");
            }else{
                json_return(1001,"修改失败","");
            }
        }
        $id = input('get.id');
        if(empty($id)){
            $this->error('请选择操作的数据',url('worker/index'));
        }
        //查询输出数据
        $worker     = model('worker');
        $sel_res    = $worker->sel_one_data($id);
        
        $this->assign('edit_data',$sel_res);
        return $this->fetch();
    }

    //删除员工数据
    public function del(){
        $id = input('post.ids');
        $id = explode(",",$id);
        foreach($id as $k => $v){
            if(empty($v)){
                unset($id[$k]);
            }
        }
        //删除数据
        $worker     = model('worker');
        $del_res    = $worker->del_data($id);
        if($del_res){
            json_return(1,"删除成功","");
        }else{
            json_return(1001,"删除失败","");
        }
    }
}