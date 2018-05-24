<?php
namespace app\business\controller;
use think\Controller;
class Base extends Controller
{	//检测是否登录
	public function _initialize()
	{
		$username = cookie('username');
		$time     = cookie('time');
		$sign     = cookie('sign');
		$chk_sign = md5(substr($time,3).$username);
		if($sign !== $chk_sign){
			$this->error('请先登录',url('index/index'));
		}
		
		$user = db('worker')->where('mobile',$username)->find();
		$user['account_auth'] = explode(",",$user['account_auth']);
		$this->assign('user',$user);
		
		$route = request()->controller() . '/' . request()->action();
		array_push($user['account_auth'],"Common/index","Common/clear");
		$allow = $user['account_auth'];
		if($user['position'] !== 1){
			if(!in_array($route,$allow)){
				$this->error('您没有访问权限！',url('common/index'));
			}
		}		
	}
}
