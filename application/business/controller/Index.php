<?php
namespace app\business\controller;

use think\Controller;

class Index extends Controller
{
    public function index(){
		$username = cookie('username');
		$time     = cookie('time');
		$sign     = cookie('sign');
		$chk_sign = md5(substr($time,3).$username);
		if($sign == $chk_sign){
			header('Location:'.url('common/index'));
			exit;
		}else{
			return $this->fetch();
		}
		
    }

    public function dologin(){
		if(request()->isPost()){
			$username = input('post.username');
			$password = input('post.password');
			empty($username) ? json_return(1002,'请输入用户名',"") : "" ;
			empty($password) ? json_return(1002,'请输入密码',"") : "" ;
			//查询用户表
			$worker = model('Worker');
			$chk_res= $worker->chk_login($username,$password);
			if($chk_res['position'] == 3){
				json_return(1001,'销售权限不能登录该平台',"");
			}
			empty($chk_res) ? json_return(1001,'账号不存在或密码错误',"") : "";
			//记录登录操作
			$loginlog = model('Loginlog');
			$log_res  = $loginlog->add_loginlog($chk_res['id']);
			if($log_res){
				$time = time();
				$sign = md5(substr($time,3).$username);
				cookie('username',$username,3600*24);
				cookie('time',$time,3600*24);
				cookie('sign',$sign,3600*24);
				cookie('realname',$chk_res['realname'],3600*24);
				json_return(1,'登录成功',url('common/index'));
			}else{
				json_return(1001,'登录失败',"");
			}
		}
	}
	
	//登出
	public function login_out(){
		cookie('username',null);
		cookie('time',null);
		cookie('sign',null);
		if(!cookie('username') && !cookie('time') && !cookie('sign')){
			$this->success('登出成功',url('index/index'));
		}else{
			$this->error('登出失败');
		}
	}
}
