<?php

namespace app\business\controller;

use think\Controller;

class Common extends Base

{
    //HOME
    public function index()
    {
        $username = cookie('username');
        $ip       = getip();
        //查询用户id
        $realname = db('worker')->where('mobile',$username)->field('id,realname,position')->find();
        switch($realname['position']){
            case 1:
                $realname['position'] = '管理员';
                break;
            case 2:
                $realname['position'] = '管理员';
                break;
            case 3:
                $realname['position'] = '管理员';
                break;
        }
        //通过id查询用户最后一次登陆时间
        $loginlog       = model('Loginlog');
        $last_time      = $loginlog->last_login_time($realname['id']);
        if(empty($last_time)){
            $last_time = date("Y-m-d h:i:s");
        }

        //查询今日添加的客户数
        $add_customer   = db('customer')->count();
        $where['create_time'] = array('between',"".strtotime(date('Y-m-d')." 00:00:00").",".strtotime(date('Y-m-d')." 23:59:59")."");
        $add_activation = db('activation')->where($where)->count();
        $where['state'] = 1;
        $add_put = db('sku')->where($where)->count();
        $where['state'] = 2;
        $add_out = db('sku')->where($where)->count();
		$where['state'] = 3;
		$add_quit = db('sku')->where($where)->count();
        $this->assign('customer_num',$add_customer);
        $this->assign('activation_num',$add_activation);
        $this->assign('put_num',$add_put);
        $this->assign('out_num',$add_out);
		$this->assign('quit_num',$add_quit);

        $this->assign('username',$realname['realname']);
        $this->assign('position',$realname['position']);
        $this->assign('ip',$ip);
        $this->assign('last_time',$last_time);
        $begin_time_one     = strtotime(date('Y-m-d',strtotime('- 4 day'))." 00:00:00");
        $end_time_one       = strtotime(date('Y-m-d',strtotime('- 4 day'))." 23:59:59");
        $begin_time_two     = strtotime(date('Y-m-d',strtotime('- 3 day'))." 00:00:00");
        $end_time_two       = strtotime(date('Y-m-d',strtotime('- 3 day'))." 23:59:59");
        $begin_time_three   = strtotime(date('Y-m-d',strtotime('- 2 day'))." 00:00:00");
        $end_time_three     = strtotime(date('Y-m-d',strtotime('- 2 day'))." 23:59:59");
        $begin_time_four    = strtotime(date('Y-m-d',strtotime('- 1 day'))." 00:00:00");
        $end_time_four      = strtotime(date('Y-m-d',strtotime('- 1 day'))." 23:59:59");
        $begin_time_five    = strtotime(date('Y-m-d')." 00:00:00");
        $end_time_five      = strtotime(date('Y-m-d')." 23:59:59");
        //查询一周分红情况
        $one_week['create_time'] = array('between',"$begin_time_one,$end_time_one");
        $two_week['create_time'] = array('between',"$begin_time_two,$end_time_two");
        $three_week['create_time'] = array('between',"$begin_time_three,$end_time_three");
        $four_week['create_time'] = array('between',"$begin_time_four,$end_time_four");
        $five_week['create_time'] = array('between',"$begin_time_five,$end_time_five");
        $one_day    = db('money')->where($one_week)->count();
        $two_day    = db('money')->where($two_week)->count();
        $three_day  = db('money')->where($three_week)->count();
        $four_day   = db('money')->where($four_week)->count();
        $five_day   = db('money')->where($five_week)->count();
        $money_num = "[$one_day,$two_day,$three_day,$four_day,$five_day]";
        $this->assign('money_num',$money_num);
		return $this->fetch();
    }

    public function clear(){
        function delDirAndFile( $dirName )
        {
            if ( $handle = opendir( "$dirName" ) ) {
                while ( false !== ( $item = readdir( $handle ) ) ) {
                    if ( $item != "." && $item != ".." ) {
                        if ( is_dir( "$dirName/$item" ) ) {
                            delDirAndFile( "$dirName/$item" );
                        } else {
                            if( unlink( "$dirName/$item" ) );
                        }
                    }
                }
                closedir( $handle );
                if (rmdir($dirName)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        $dirName = RUNTIME_PATH;
        $res     = delDirAndFile($dirName);
        if($res){
            $this->success('更新缓存成功',url('common/index'));
        }else{
            $this->success('更新缓存失败',url('common/index'));
        }
    }
}

