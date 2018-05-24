<?php

namespace app\business\controller;

use think\Controller;

class Platform extends Base
{
    //---平台---
        //渲染平台页
        public function index(){
            $page       = input('get.page');
            $page       = isset($page) ? $page : 1 ;
            $plat_name  = input('get.plat_name');
            $plat_name  = isset($plat_name) ? $plat_name : "" ;
            $platform   = model('platform'); 
            $data       = $platform->sel_data($page,20,$plat_name);
            //查询出所有平台数据
            $plat       =   model('platform');
            $all_plat   =   $plat->sel_all();
            $this->assign('plat_list_select',$all_plat);
            $this->assign('page',$page);
            $this->assign('plat_name',$plat_name);
            $this->assign('plat_list',$data['data']);
            $this->assign('count',$data['count']);
            return $this->fetch();
        }

        //自动完成
        public function autocomplete(){
            $plat_name          = input('get.term');
            $plat_name          = isset($plat_name) ? $plat_name : "" ;
            $where['plat_name'] = array('like',"%$plat_name%");
            $auto_data          = db('plat')->where($where)->field('plat_name')->select();
            $data = array();
            foreach($auto_data as $k => $v){
                $data[]         = $v['plat_name'];
            }
            return json($data);
        }

        //平台名称修改
        public function plat_edit(){
            if(input('action') == "edit"){
                $id         = input('post.id');
                $plat_name  = input('post.plat_name');
                if(!isset($id) || !isset($plat_name)){
                    $this->error('请选择正确的修改项',url('platform/plat'));
                }
                $data['plat_name']  =   $plat_name;
                $data['id']         =   $id;
                $plat = model('Plat');
                $edit_res  = $plat->edit($data);
                if($edit_res){
                    json_return(1,'修改成功','');
                }else{
                    json_return(1002,'修改失败','');
                }
            }
            //模版赋值输出
            $id = input('get.id');
            !isset($id) ? json_return('1001',"请选择正确的修改项","") : "" ;
            //查询修改项数据
            $plat          = model('plat');
            $plat_data     = $plat->sel_plat_name($id);
            if(empty($plat_data[0]['id'])){
                $this->error('请选择正确的修改项',url('platform/plat'));
            }
            $this->assign('edit_data',$plat_data[0]);
            return $this->fetch();
        }

        //平台名称添加
        public function plat_add(){
            if(request()->isPost()){
                $plat_name = input('post.plat_name');
                if(!isset($plat_name)){
                    json_return(1001,"请把添加信息填写完整","");
                }
                $plat = model('plat');
                $add_res = $plat->add($plat_name);
                if($add_res){
                    json_return(1,'添加成功','');
                }else{
                    json_return(1002,'添加失败','');
                }
            }else{
                json_return(1002,"添加失败","");
            }
        }

        //platform新增数据
        public function add(){
            if(request()->isPost()){
                $plat_id        = input('post.plat_name');      //平台名称
                $company_name   = input('post.company_name');   //公司名称
                $telephone      = input('post.telephone');      //联系方式
                $remark         = input('post.remark');         //备注
                if(empty($plat_id)){
                    json_return(1002,"请选择平台名称","");
                }
                $data['plat_name']       =   $plat_id;
                $data['company_name']  =   $company_name;
                $data['telephone']     =   $telephone;
                $data['remark']        =   $remark;
                $platform = model('Platform');
                $add_res  = $platform->add($data);
                if($add_res){
                    json_return(1,"添加成功","");
                }else{
                    json_return(1001,"添加失败","");
                }
            }else{
                json_return(1001,"添加失败","");
            }
        }

        //platform修改数据
        public function edit(){
            if(input('get.action') == "edit"){
                $id             = input('post.id');             //平台名称
                $plat_id        = input('post.plat_name');      //平台名称
                $company_name   = input('post.company_name');   //公司名称
                $telephone      = input('post.telephone');      //联系方式
                $remark         = input('post.remark');         //备注
                if(empty($company_name) || empty($plat_id) || empty($telephone)){
                    json_return(1002,"请把修改信息填写完整","");
                }
                $data_id['id']          =   $id;
                $data['plat_name']      =   $plat_id;
                $data['company_name']   =   $company_name;
                $data['telephone']      =   $telephone;
                $data['remark']         =   $remark;
                $platform               =   model('Platform');
                $edit_res               =   $platform->edit($data,$data_id);
                if($edit_res){
                    json_return(1,"修改成功","");
                }else{
                    json_return(1001,"修改失败","");
                }
            }
            $id = input('get.id');
            if(empty($id)){
                $this->error('请选择操作的数据',url('platform/index'));
            }
            //查询输出数据
            $platform   = model('platform');
            $sel_res    = $platform->edit_sel($id);
            if(empty($sel_res)){
                $this->error('请选择正确的修改项',url('platform/index'));
            }
            $this->assign('edit_data',$sel_res);
            return $this->fetch();
        }

        //(platform/plat)修改数据
        public function del(){
            $id = input('post.ids');
            $id = explode(",",$id);
            foreach($id as $k => $v){
                if(empty($v)){
                    unset($id[$k]);
                }
            }
            //删除数据
            if(input('get.action') == "plat"){
                $plat     = model('plat');
                $del_res  = $plat->del($id);
            } elseif(input('get.action') == "platform") {
                $platform     = model('platform');
                $del_res      = $platform->del_data($id);
            }
            if($del_res){
                json_return(1,"删除成功","");
            }else{
                json_return(1001,"删除失败","");
            }
        }
    //---平台---

    //交易统计
        public function total()
        {
            $plat_id      = input('get.plat_name');
            $plat_id      = isset($plat_id) ? $plat_id : '' ;
            $create_time  = input('get.create_time');
            $create_time  = isset($create_time) ? $create_time : "" ;
            $create_time               = input('get.create_time');
            if(!empty($create_time)){
                $create_time_arr = explode(' , ',$create_time);
                $data['create_begintime']  = strtotime($create_time_arr[0]);
                $data['create_endtime']    = strtotime($create_time_arr[1]);
            }else{
                $data['create_begintime']  = '';
                $data['create_endtime']    = '';
            }
            $page         = input('get.page');
            $page         = isset($page) ? $page : 1 ;
            $trade        = model('trade');
            $data         = $trade->sel_data($page,20,$create_time,$plat_id,$data);
            $this->assign('page',$page);
            $this->assign('plat_name',$plat_id);
            $this->assign('create_time',$create_time);
            $this->assign('plat_list_select',$data['plat']);
            $this->assign('trade_list',$data['data']);
            $this->assign('all_num',$data['all_num']);
            $this->assign('count',$data['count']);
            return $this->fetch();
        }

        //添加交易量
        public function total_add(){
            if(request()->isPost()){
                $data['plat_id']     = input('post.plat_id');
                $data['money']       = input('post.money');
                $data['create_time'] = strtotime(input('post.create_time'));
                if(array_search('',$data)){
                    json_return(1001,"请把添加信息填写完整","");
                }
                $trade   = model('trade');
                $add_res = $trade->add($data);
                if($add_res){
                    json_return(1,'添加成功','');
                }else{
                    json_return(1002,'添加失败','');
                }
            }
        }
		
		//修改交易量
		public function total_edit(){
            if(input('get.action') == 'edit'){
                $data['id']          = input('post.id');
                $data['plat_id']     = input('post.plat_id');
                $data['money']       = input('post.money');
                $data['create_time'] = strtotime(input('post.create_time'));
                if(array_search('',$data)){
                    json_return(1001,"请把添加信息填写完整","");
                }
                //查询是否修改过该数据
                $chk_res = db('trade')->where($data)->field('id')->find();
                if(empty($chk_res)){
                    $update_res = db('trade')->where('id',$data['id'])->update($data);
                    if($update_res){
                        json_return(1,"修改成功","");
                    }else{
                        json_return(1002,"修改失败","");
                    }
                }else{
                    json_return(1002,"您未做任何修改","");
                }
                if($add_res){
                    json_return(1,'添加成功','');
                }else{
                    json_return(1002,'添加失败','');
                }
            }
            $id = input('get.id');
            if(empty($id)){
                $this->error('请选择操作的数据',url('platform/total'));
            }
            //查询输出数据
            $sel_res = db('trade')->where('id',$id)->find();
            if(empty($sel_res)){
                $this->error('请选择正确的修改项',url('platform/index'));
            }
            //输出平台名称
            $plat       = model('platform');
            $palt_name  = $plat->sel_all();
		$this->assign('plat_list_select',$palt_name);
            $this->assign('edit_data',$sel_res);
			return $this->fetch();
		}
}