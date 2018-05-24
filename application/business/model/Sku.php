<?php
namespace app\business\model;
use think\Model;
use think\Db;
class Sku extends Model
{
    public function add($data){
        $chk_count1 = count($data);
        $error_data = array();
        $data = array_unset_tt($data,'card_id');
        $data = array_merge($data);
        $chk_count2 = count($data); 
        if($chk_count1 != $chk_count2){
            json_return(1001,"数据存在重复,添加失败","");
        }
        foreach($data as $k => $v){
            $where = array();
            $where['card_id'] = $v['card_id'];
            $chk_res = db('sku')->where($where)->find();
            if(!empty($chk_res)){
                $error_data[] = $v['card_id'];
                unset($data[$k]);
            }else{
                $data[$k]['put_operator'] = cookie('realname');
            }
        }
        
        if(!empty($data)){
            $add = db('sku')->insertAll($data);
            $count = count($data);
        }else{
            $add = false;
            $count = 0;
        }
        $add_data['add']   = $add;
        $add_data['count']   = count($data);
        $add_data['error'] = $error_data;
        return $add_data;
    }

    public function save_data($all_data,$data){
        $error = array();
        $chk = array();
        $be = array();
        $card_id_arr = array();
        foreach($all_data as $k => $v){
            $card_id_arr[] = $v['card_id'];
            //查询是否已存在该记录\
            $where_chk['card_id'] = $v['card_id'];
            $where_chk['state']   = $data['state'];
            $chk_res = db('sku')->where($where_chk)->find();
            if($chk_res){
                $chk[] = $v['card_id'];
            }
            $where_chk['state']   = $data['state'] == 2 ? array('in','1,4') : 2;
            $be_res = db('sku')->where($where_chk)->find();
            if(!$be_res){
                $be[] = $v['card_id'];
            }else{
                if($be_res['state'] != 1){
                    unset($data['out_operator']);
                }
            }
        }
        if(!empty($chk)){
            json_return(1002,"已存在该序列号数据，序列号分别是<br/>".implode(',',$chk),"");
        }
        if(!empty($be)){
            json_return(1002,"您添加的数据不存在，序列号分别是<br/>".implode(',',$be),"");
        }
        $count = count($card_id_arr);
            $where['card_id'] = array('in',implode(',',$card_id_arr));
            $update_res = db('sku')->where($where)->update($data);
            if($update_res == count($card_id_arr)){
                $update_res = true;
            }else{
                $update_res = false;
            }
            if($data['state'] != 2){
                $state_log = $data['state'];
                $log['card_id'] = implode(',',$card_id_arr);
                $log['active'] = $state_log == 2 ? 5 : 6;
                $log['query_code'] = "[更新库存状态]state=$state_log";
                $log['run_type'] = $update_res == true ? 0 : 1 ;
                $this->sku_log($log);
            }
        return $update_res;
    }

    public function del($id){
        if(is_array($id)){
            $id = implode(',',$id);
        }
        $where['id'] = array('in',$id);
        $del_data = db('sku')->where($where)->delete();
        $query_sql = Db::table('sku')->getLastSql();
        $log['card_id'] = '[删除的ID]'.$id;
        $log['active'] = 2;
        $log['query_code'] = $query_sql;
        $log['run_type'] = $del_data == true ? 0 : 1 ;
        $this->sku_log($log);
        return $del_data;
    }

    public function sel_data($data){
        $where['plat_id']       = !empty($data['plat_id']) ? $data['plat_id'] : array('like',"%%");
        $where['custom_id']       = !empty($data['custom_id']) ? $data['custom_id'] : array('like',"%%");
        $begin_check_time = strtotime(date('Y-m-d')." 00:00:00");
        if($data['day'] == 0){
            $end_check_time = strtotime(date('Y-m-d')." 23:59:59");
            
        }else{
            $end_check_time   = strtotime(date('Y-m-d', strtotime("+".$data['day']." days"))." 23:59:59");
        }
        $end_check_time = $data['day'] == 0 ? strtotime(date('Y-m-d')." 23:59:59") : time()+$data['day']*60*60*24 ;
        $where['check_time']    = !empty($data['day']) ? array('between',"".strtotime(date('Y-m-d')." 00:00:00").",$end_check_time") : array('like',"%%");
        $where['order_num']     = !empty($data['order_num']) ? $data['order_num'] : array('like',"%%");
        $where['state']         = array('in',$data['state']);
        $where['card_id']       = !empty($data['card_id']) ? (string)$data['card_id'] : array('like',"%%");
        $where['in_time']       = !empty($data['in_time_begin']) ? array('between',"".$data['in_time_begin'].",".$data['in_time_end']."") : array('like',"%%");
        $where['out_time']      = !empty($data['out_time_begin']) ? array('between',"".$data['out_time_begin'].",".$data['out_time_end']."") : array('like',"%%");
        $where['return_time']   = !empty($data['return_time_begin']) ? array('between',"".$data['return_time_begin'].",".$data['return_time_end']."") : array('like',"%%");
        
        $sel_data = db('sku')->where($where)->page($data['page'],$data['limit'])->order('id desc')->select();
        
        if(!$sel_data){
            $data['data']  = '';
            $data['count'] = '';
            return $data;
            exit;
        }
        foreach($sel_data as $k => $v){
            $plat_id_arr[]      = $v['plat_id'];
            if($v['custom_id'] == 0){
                $custom_id_arr      = '';
            }else{
                $custom_id_arr[]    = $v['custom_id'];
            }
           
            $sel_data[$k]['status']  = $v['status'] == 1 ? '新' : '旧' ;
            switch($sel_data[$k]['state']){
                case 3:
                    $sel_data[$k]['state'] = '已挂起';
                    break;
                case 4:
                    $sel_data[$k]['state'] = '已退库';
                    break;
                default:
                    $sel_data[$k]['state'] = '';
            }

        }
        
        $plat_id_str = implode(',',$plat_id_arr);
        if(!empty($custom_id_arr)){
            $custom_id_str = implode(',',$custom_id_arr);
            $customer      = model('customer');
            $customer_name = $customer->sel_name($custom_id_str);
        }
        $plat        = model('platform');
        $plat_name   = $plat->sel_plat_name($plat_id_str);
        foreach($plat_name as $k => $v){
            foreach($sel_data as $a => $b){
                if($v['id'] == $b['plat_id']){
                    $sel_data[$a]['plat_id'] = $plat_name[$k]['plat_name'];
                }
            }
        }
        if(!empty($custom_id_arr)){
            foreach($customer_name as $k => $v){
                foreach($sel_data as $a => $b){
                    if($v['id'] == $b['custom_id']){
                        $sel_data[$a]['custom_id'] = $customer_name[$k]['customer_name'];
                    }
                }
            }
        }
        
        $count = db('sku')->where($where)->count();
        $data = array();
        $data['data'] = $sel_data;
        $data['count'] = $count;
        //echo('<pre/>');print_r($data);exit;
        return $data;
    }

    public function toble($data){
        //$where['order_num'] = !empty($data['order_num']) ? $data['order_num'] : array('like',"%%");
         $chk_where['plat_id'] = !empty($data['plat_id']) ? $data['plat_id'] : array('like',"%%");
        // $begin_check_time = strtotime(date('Y-m-d')." 00:00:00");
        // if($data['day'] == 0){
        //     $end_check_time = strtotime(date('Y-m-d')." 23:59:59");
            
        // }else{
        //     $end_check_time   = strtotime(date('Y-m-d', strtotime("+".$data['day']." days"))." 23:59:59");
        // }
        // $end_check_time = $data['day'] == 0 ? strtotime(date('Y-m-d')." 23:59:59") : time()+$data['day']*60*60*24 ;
        // $where['check_time']    = !empty($data['day']) ? array('between',"$begin_check_time,$end_check_time") : array('like',"%%");
        $sel_data = db('sku')->distinct(true)->where($chk_where)->field('plat_id')->page($data['page'],$data['limit'])->order('id desc')->select();
        if(!$sel_data){
            $data['data']   = '';
            $data['all']    = '';
            $data['count']  = '';
            return $data;exit;
        }
        foreach($sel_data as $k => $v){
            $sel_data[$k]['id'] = $k+1;
            $where['plat_id'] = $v['plat_id'];
            $platform = model('platform');
            $plat_name = $platform->sel_plat_name($v['plat_id']);
            $sel_data[$k]['plat_id'] = $plat_name[0]['plat_name'];
            $where['state'] = array('like',"%%");
            $put_num = db('sku')->where($where)->count();
            $sel_data[$k]['put'] = $put_num;

            $where['state'] = 2;
            $out_num = db('sku')->where($where)->count();
            $sel_data[$k]['out'] = $out_num;

            $where['state'] = 3;
            $quit_num = db('sku')->where($where)->count();
            $sel_data[$k]['quit'] = $quit_num;

            $sel_data[$k]['stock'] = $put_num - $out_num - $quit_num;
        }
        $all_where['state'] = array('like',"%%");
        $put_num = db('sku')->where($all_where)->count();
        $all['put'] = $put_num;

        $all_where['state'] = 2;
        $out_num = db('sku')->where($all_where)->count();
        $all['out'] = $out_num;

        $all_where['state'] = 3;
        $quit_num = db('sku')->where($all_where)->count();
        $all['quit'] = $quit_num;

        $all['stock'] = $put_num - $out_num - $quit_num;
        $data['data'] = $sel_data;
        $data['all'] = $all;

        $count = db('sku')->distinct(true)->where($chk_where)->field('plat_id')->select();
        $count = count($count);
        $data['count'] = $count;
        return $data;
    }

    //记录日志   1、增  2、删 3、该  4、查
    public function sku_log($data){
        $data['username'] = cookie('username');
        $data['log_time'] = time();
        //插入记录
        $add_log = db('sku_log')->insert($data);
    }
}