<?php

namespace app\business\controller;
use think\Db;
use think\Controller;

class Sku extends Base
{
    //入库
    public function put(){
		$data['day']	   = input('get.day');
		$data['plat_id']   = input('get.plat_name');
		$data['order_num'] = input('get.order_num');
		$in_time   		   = input('get.in_time');
        if(!empty($in_time)){
            $in_time_arr = explode(' , ',$in_time);
            $data['in_time_begin']  = strtotime($in_time_arr[0]);
            $data['in_time_end']    = strtotime($in_time_arr[1]);
		}

		$data['limit']	   = 20; 
		$data['state']	   = '1,4';
		$data['card_id']   =	input('get.card_id');    	//varchar(20)   选其一      xxxx
		$data['page']	   = input('get.page');
		if(empty($data['page'])){
			$data['page'] = 1;
		}
		$sku = model('sku');
		$res_data = $sku->sel_data($data);
		$this->assign('put_list',$res_data['data']);
        $this->assign('count',$res_data['count']);
        $this->assign('page',$data['page']);
        $this->assign('plat_id',$data['plat_id']);
		$this->assign('day',$data['day']);
		$this->assign('card_id',$data['card_id']);
        $this->assign('in_time',$in_time);
        $this->assign('order_num',$data['order_num']);
		//输出平台名称
		$plat       = model('platform');
		$palt_name  = $plat->sel_all();
		$this->assign('plat_list_select',$palt_name);
		return $this->fetch();
    }
    //出库
    public function out(){
		$data['day']	   = input('get.day');
		$data['plat_id']   = input('get.plat_name');
		$data['order_num'] = input('get.order_num');
		$data['custom_id'] = input('get.custom_id');
		$out_time   	   = input('get.out_time');
        if(!empty($out_time)){
            $out_time_arr = explode(' , ',$out_time);
            $data['out_time_begin']  = strtotime($out_time_arr[0]);
            $data['out_time_end']    = strtotime($out_time_arr[1]);
		}
		$data['page']	   = input('get.page');
		$data['limit']	   = 20; 
		$data['state']	   = 2; 
		$data['card_id']	    =	input('get.card_id');    	//varchar(20)   选其一      xxxx
		if(empty($data['page'])){
			$data['page'] = 1;
		}
		$sku = model('sku');
		$res_data = $sku->sel_data($data);
		$this->assign('out_list',$res_data['data']);
        $this->assign('count',$res_data['count']);
        $this->assign('page',$data['page']);
        $this->assign('custom_id',$data['custom_id']);
        $this->assign('plat_id',$data['plat_id']);
		$this->assign('out_time',$out_time);
		$this->assign('card_id',$data['card_id']);
        $this->assign('day',$data['day']);
        $this->assign('order_num',$data['order_num']);		
		//输出平台名称
		$plat       = model('platform');
		$palt_name  = $plat->sel_all();
		$this->assign('plat_list_select',$palt_name);
		//输出客户名称
		$customer   = model('customer');
		$customer_name = $customer->sel_all();
		$this->assign('customer_name_list',$customer_name);
        return $this->fetch();
    }
    //退库
    public function quit(){
		$data['day']	   = input('get.day');
		$data['plat_id']   = input('get.plat_name');
		$data['order_num'] = input('get.order_num');
		$data['custom_id'] = input('get.custom_id');
		$return_time   	   = input('get.return_time');
        if(!empty($return_time)){
            $return_time_arr = explode(' , ',$return_time);
            $data['return_time_begin']  = strtotime($return_time_arr[0]);
            $data['return_time_end']    = strtotime($return_time_arr[1]);
		}
		$data['page']	   = input('get.page');
		$data['limit']	   = 20; 
		$data['state']	   = 3; 
		$data['card_id']	    =	input('get.card_id');    	//varchar(20)   选其一      xxxx
		if(empty($data['page'])){
			$data['page'] = 1;
		}
		$sku = model('sku');
		$res_data = $sku->sel_data($data);
		$this->assign('quit_list',$res_data['data']);
		$this->assign('card_id',$data['card_id']);
        $this->assign('count',$res_data['count']);
		$this->assign('page',$data['page']);
		$this->assign('custom_id',$data['custom_id']);
        $this->assign('plat_id',$data['plat_id']);
        $this->assign('return_time',$return_time);
        $this->assign('order_num',$data['order_num']);
		//输出平台名称
		$plat       = model('platform');
		$palt_name  = $plat->sel_all();
		$this->assign('plat_list_select',$palt_name);
		//输出客户名称
		$customer   = model('customer');
		$customer_name = $customer->sel_all();
		$this->assign('customer_name_list',$customer_name);
		return $this->fetch();
    }
    public function put_add(){
		if(request()->isPost()){
			$data['plat_id']	    =	input('post.plat_id');    	//int(11)
			$data['order_num']	    =	input('post.order_num');	//varchar(20)
			$data['in_time']	    =	strtotime(input('post.in_time'));    	//int(11)
			$data['check_time']	    =	strtotime(input('post.check_time'));	//int(11)
			$data['status']	        =	input('post.status');		//tinyint(1)
			$data['state']			=	1;    						//tinyint(1)
			$data['create_time']	=	strtotime(date('Y-m-d'));    					//int(11)
			$data['put_operator']   =   cookie('realname');
			if(in_array("",$data)){
				json_return(1001,"请把入库资料填写完整","");
			}
			$card_id1	    =	input('post.card_id1/a');
			$card_id2	    =	input('post.card_id2/a');
			$card_id	    =	input('post.card_id');
			$all_data		=	array();
			if(!empty($card_id1[0]) && !empty($card_id2[0])){
				foreach($card_id1 as $k => $v){
					$card_id_arr[$k][] = $v;
					$card_id_arr[$k][] = $card_id2[$k];
				}
				unset($card_id1);
				unset($card_id2);
				foreach($card_id_arr as $k => $v){
					$Front          =	"";
					if(is_numeric($v[0]) && is_numeric($v[0])){
						$card_id1 = $v[0];
						$card_id2 = $v[1];
					}else{
						preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/',$v[0],$card_id1_arr);
						preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/',$v[1],$card_id2_arr);
						if(!empty($card_id1_arr[1][0]) && !empty($card_id2_arr[1][0])){
							if($card_id1_arr[1][0] != $card_id2_arr[1][0]){
								json_return(1001,'序列号错误，请检查后重新输入1',''); 
							}
							$Front = (string)$card_id1_arr[1][0];
							$card_id1 = substr($v[0],strlen($Front));
							$card_id2 = substr($v[1],strlen($Front));
						}else{
							$card_id1 = $v[0];
							$card_id2 = $v[1];
						}
					}
					if(strlen($card_id1) != strlen($card_id2)){
						json_return(1001,'序列号错误，请检查后重新输入2',''); 
					}
					if($card_id2-$card_id1 > 50000){
						json_return(1001,'单次添加序列号不能超过5万条',''); 
					}
					if(!empty($card_id1) && !empty($card_id2)){
						while($card_id1 <= $card_id2){
							$data['card_id'] = $Front.(int)$card_id1;
							$all_data[] = $data;
							$card_id1++;
							unset($data['card_id']);
						}
					}
				}
			}else if(!empty($card_id)){
				$data['card_id'] = $card_id;
				$all_data[] = $data;
			}else{
				json_return(1001,'请输入序列号','');
			}
			$sku = model('sku');
			$add_res = $sku->add($all_data);
			if(!$add_res['add']){
				if($add_res['error']){
					json_return(1,"添加成功,已添加".$add_res['count']."条,您有如下序列号重复".implode(",",$add_res['error']),"");
				}else{
					json_return(1002,"添加失败","");
				}
			}else{
				if(empty($add_res['error']) && $add_res['add']){
					json_return(1,"添加成功,已添加".$add_res['count']."条","");
				}else{
					json_return(1002,"添加失败","");
				}
			}
		}else{
			json_return(1001,"添加失败","");
		}
    }

    public function out_add(){
		if(request()->isPost()){
			$data['custom_id']	    =	input('post.custom_id');    	//int(11)
			$data['out_time']	    =	strtotime(input('post.out_time'));	//varchar(20)
			$data['state']			=	2;    						//tinyint(1)
			$data['create_time']	=	strtotime(date('Y-m-d'));    					//int(11)
			$data['out_operator']   =   cookie('realname');
			if(in_array("",$data)){
				json_return(1001,"请把入库资料填写完整","");
			}
			$card_id1	    =	input('post.card_id1');    	//varchar(20)   选其一      xxxx , xxxx
			$card_id2	    =	input('post.card_id2');    	//varchar(20)   选其一      xxx
			$card_id	    =	input('post.card_id');    	//varchar(20)   选其一      xxx
			if(!empty($card_id1) && !empty($card_id2)){
				$Front          =	"";
				if(is_numeric($card_id1) || is_numeric($card_id2)){
					$card_id1 = $card_id1;
					$card_id2 = $card_id2;
				}else{
					preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/',$card_id1,$card_id1_arr);
					preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/',$card_id2,$card_id2_arr);
					if(!empty($card_id1_arr[1][0]) && !empty($card_id2_arr[1][0])){
						$Front = (string)$card_id1_arr[1][0];
					}
					$card_id1 = substr($card_id1,strlen($Front));
					$card_id2 = substr($card_id2,strlen($Front));
				}
				if(strlen($card_id1) != strlen($card_id2)){
					json_return(1001,'序列号错误，请检查后重新输入',''); 
				}
				if(($card_id2-$card_id1) > 50000){
					json_return(1001,"不能超过5万条序列号同时添加","");
				}
				if(!empty($card_id1) && !empty($card_id2)){
					while($card_id1 <= $card_id2){
						$all_data[]['card_id'] = $Front.(int)$card_id1;
						$card_id1++;
					}
				}
			}else if(!empty($card_id)){
					$all_data[]['card_id'] = $card_id;
			}else{
				json_return(1001,"请填写序列号","");
			}
			//echo('<pre/>');print_r($all_data);exit;
			$sku = model('sku');
			$add_res = $sku->save_data($all_data,$data);
				if($add_res){
					json_return(1,"添加成功","");
				}else{
					json_return(1002,"添加失败","");
				}
		}else{
			json_return(1001,"添加失败","");
		}
    }

    public function quit_add(){
		if(request()->isPost()){
			$data['return_time']	=	strtotime(input('post.return_time'));	//varchar(20)
			$data['remark']	    	=	input('post.remark');    	//int(11)
			$data['state']			=	3;    						//tinyint(1)
			if(empty($data['return_time'])){
				json_return(1001,"请把入库资料填写完整","");
			}
			$card_id1	    =	input('post.card_id1');    	//varchar(20)   选其一      xxxx , xxxx
			$card_id2	    =	input('post.card_id2');    	//varchar(20)   选其一      xxx
			$card_id	    =	input('post.card_id');    	//varchar(20)   选其一      xxx
			if(!empty($card_id1) && !empty($card_id2)){
				$Front          =	"";
				if(is_numeric($card_id1) || is_numeric($card_id2)){
					$card_id1 = $card_id1;
					$card_id2 = $card_id2;
				}else{
					preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/',$card_id1,$card_id1_arr);
					preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/',$card_id2,$card_id2_arr);
					if(!empty($card_id1_arr[1][0]) && !empty($card_id2_arr[1][0])){
						$Front = (string)$card_id1_arr[1][0];
					}
					$card_id1 = substr($card_id1,strlen($Front));
					$card_id2 = substr($card_id2,strlen($Front));
				}
				if(strlen($card_id1) != strlen($card_id2)){
					json_return(1001,'序列号错误，请检查后重新输入',''); 
				}
				if(($card_id2-$card_id1) > 50000){
					json_return(1001,"不能超过5万条序列号同时添加","");
				}
				if(!empty($card_id1) && !empty($card_id2)){
					while($card_id1 <= $card_id2){
						$all_data[]['card_id'] = $Front.(int)$card_id1;
						$card_id1++;
					}
				}
			}else if(!empty($card_id)){
					$all_data[]['card_id'] = $card_id;
			}else{
				json_return(1001,"请填写序列号","");
			}
			$sku = model('sku');
			$add_res = $sku->save_data($all_data,$data);
				if($add_res){
					json_return(1,"添加成功","");
				}else{
					json_return(1002,"添加失败","");
				}
		}else{
			json_return(1001,"添加失败","");
		}
    }
	
	public function put_del(){
        $id  = input('post.ids');
        $id  = explode(",",$id);
        $sku = model('sku');
        $res = $sku->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
	}
	
	public function out_del(){
        $id  = input('post.ids');
        $id  = explode(",",$id);
        $sku = model('sku');
        $res = $sku->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
    }
    
    public function quit_del(){
        $id  = input('post.ids');
        $id  = explode(",",$id);
        $sku = model('sku');
        $res = $sku->del($id);
        if($res){
            json_return(1,"删除成功","");
        }else{
            json_return(1002,"删除失败","");
        }
	}
	
	//修改退库挂机请求
	public function edit_state(){
		if(request()->isPost()){
			$data['id'] 	= input('post.ids');
		}else{
			json_return(1001,"修改状态失败","");
		}
			$data['state'] 	= input('get.state');
			$data['create_time'] 	= time();
			if(in_array('',$data)){
				json_return(1001,"修改状态失败","");
			}
			$where['id'] = $data['id'];
			$chk_res = db('sku')->where($where)->find();
			$update_res = db('sku')->where($where)->update($data);
			$query_sql = Db::table('sku')->getLastSql();
			$log['card_id'] = $chk_res['card_id'];
			$log['active'] = 7;
			$log['query_code'] = $query_sql;
			$log['run_type'] = $update_res == true ? 0 : 1 ;
			$sku = model('sku');
			$sku->sku_log($log);
			if($update_res){
				json_return(1,"修改状态成功","");
			}else{
				json_return(1002,"修改状态失败","");
			}
	}
	
	//库存管理
	public function total(){
		$data['page'] 		= input('get.page');
		$data['plat_id'] 	= input('get.plat_id');
		//$data['day'] 		= input('get.day');
		$data['limit'] 		= 20;
		//$data['order_num']  = input('get.order_num');
		$data['page']		= !empty($data['page']) ? input('get.page') : 1 ;
		$sku = model('sku');
		$sel_res = $sku->toble($data);
		$this->assign('page',$data['page']);
		$this->assign('plat_id',$data['plat_id']);
		$this->assign('total_list',$sel_res['data']);
		$this->assign('all_list',$sel_res['all']);
		$this->assign('count',$sel_res['count']);
		//输出平台名称
		$plat_id_res = db('sku')->field('plat_id')->DISTINCT(true)->select();
		foreach($plat_id_res as $k => $v){
			$plat_id_arr[] = $v['plat_id'];
		}
		$plat_id_str = implode(',',$plat_id_arr);
		$platform = model('platform');
		$plat_name = $platform->sel_plat_name($plat_id_str);
		$this->assign('plat_list_select',$plat_name);
		return $this->fetch();
	}	

	public function dolog(){
		$log_time 	= input('get.log_time');
        if(!empty($log_time)){
            $log_time_arr = explode(' , ',$log_time);
            $log_time_begin  = strtotime($log_time_arr[0]);
            $log_time_end    = strtotime($log_time_arr[1]);
		}
		$card_id 	= input('get.card_id');
		$card_id 	= !empty($card_id) ? trim($card_id) : '' ;
		$page 		= input('get.page');
		$limit		= 20;
		
		if(empty($page)){
			$page = 1;
		}
		$where['card_id'] = array('like',"%$card_id%");
		$where['log_time'] = !empty($log_time) ? array('between',"$log_time_begin,$log_time_end") : array('like',"%%");
		$res_data = db('sku_log')->where($where)->page($page,$limit)->field('id,active,username,card_id,log_time')->order('id desc')->select();
        $count1 = db('sku_log')->where($where)->count();
        if(!empty($res_data)){
			foreach($res_data as $k => $v){
				switch($v['active']){
					case 1:
						$res_data[$k]['active'] = '添加入库';break;
					case 2:
						$res_data[$k]['active'] = '删除';break;
					case 5:
						$res_data[$k]['active'] = '添加出库';break;
					case 6:
						$res_data[$k]['active'] = '添加退库';break;
					case 7:
						$res_data[$k]['active'] = '修改退库状态';break;
				}
				$worker = model('worker');
				$username = $worker->username_id($v['username']);
				$res_data[$k]['username'] = $username['realname'];
            }
        }
			if(count($res_data) != $limit){
				$limit = $limit - count($res_data);
				unset($where['log_time']);
				$where['state'] = array('in','1,2');
				$where['create_time'] = !empty($log_time) ? array('between',"$log_time_begin,$log_time_end") : array('like',"%%");
				$res_data1 = db('sku')->where($where)->page($page,$limit)->field('id,card_id,state,put_operator,out_operator,create_time')->order('id desc')->select();
                    
                if(empty($res_data1)){
                    $this->assign('log_list',$res_data);
                    $this->assign('page',$page);
                    $this->assign('card_id',$card_id);
                    $this->assign('log_time',$log_time);
                    $this->assign('count',0);
                    return $this->fetch();exit;
                }
                
                foreach($res_data1 as $k => $v){
						$res_data2[$k]['id']      = $v['id'];
						$res_data2[$k]['card_id'] = $v['card_id'];
						$res_data2[$k]['active']  = $v['state'] == 1 ? '入库操作' : '出库操作';
						$realname1 = empty($v['put_operator']) ? '' : $v['put_operator'].'操作入库';
						$realname2 = empty($v['out_operator']) ? '' : $v['out_operator'].'操作出库';
						$res_data2[$k]['username']  = $realname1.','.$realname2;
						$res_data2[$k]['log_time']  = $v['create_time'];
					}
				$count2 = db('sku')->where($where)->count();
			}else{
				$res_data2 = array();
				$count = 0;
			}
        $this->assign('log_list',array_merge($res_data,$res_data2));
        $this->assign('page',$page);
        $this->assign('log_time',$log_time);
        $this->assign('card_id',$card_id);
        $this->assign('count',$count1+$count2);
        return $this->fetch();
	}

	//logID   查询操作card_id
	public function log_content(){
		$id = input('get.id');
		if(empty($id)){
			echo "编号错误";
		}
		$content = db('sku_log')->where('id',$id)->field('card_id')->find();
		if($content){
			$dataarr = explode(",",$content['card_id']);
			echo "<div style='word-wrap:break-word;padding:10px'>";
			foreach($dataarr as $v){
				echo $v.'<br>';
			}
			echo "</div>";
		}else{
			echo "<div style='word-wrap:break-word;padding:10px'>查看失败</div>";
		}
	}
}