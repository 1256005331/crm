<?php
namespace app\business\controller;
use think\Controller;
use think\Db;
use think\Loader;
use think\File;
class Excel extends Base
{
	public function index()
	{
		exit;
	}
	public function export_customer()
	{  
        Loader::import('phpexcel.PHPExcel');
        Loader::import('phpexcel.PHPExcel.IOFactory.PHPExcel_IOFactory');
		//创建对象  
        $objPHPExcel = new \PHPExcel();
        //获取当前活动的表
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->setTitle('客户列表');//设置excel的标题
        $objActSheet->setCellValue('A1','客户列表');
        $objActSheet->setCellValue('A2','导出时间:'.date('Y-m-d H:i:s'));
        //现在开始输出列头了
        $objActSheet->setCellValue('A3','ID');
        $objActSheet->setCellValue('B3','平台名称');
        $objActSheet->setCellValue('C3','客户名称');
		$objActSheet->setCellValue('D3','省份');
		$objActSheet->setCellValue('E3','城市');
		$objActSheet->setCellValue('F3','手机号码');
		$objActSheet->setCellValue('G3','地址');
		$objActSheet->setCellValue('H3','所属销售');
		$objActSheet->setCellValue('I3','备注');
		$objActSheet->setCellValue('J3','创建时间');
        //具体有多少列，有多少就写多少，跟下面的填充数据对应上就可以
		//现在就开始填充数据了 （从数据库中）
		$belong			=	input('get.belong');
		$plat_id		=	input('get.plat_id');
		$phone			=	input('get.phone');
		$where['belong']  = !empty($belong) ? $belong : array('like','%%');
		$where['plat_id'] = !empty($plat_id) ? array('like',"%s:1:\"$plat_id\"%") : array('like',"%%");
		$where['mobile']   = array('like',"%$phone%");
		$list = db('customer')->where($where)->select();
		//var_dump($list);
		if(empty($list)){
			exit('<script>alert("没有数据导出");</script>');
		}
        $baseRow = 4; //数据从N-1行开始往下输出 这里是避免头信息被覆盖
		foreach($list as $k=> $v){
			if($v['plat_id'] == 0){
				$list[$k]['plat_id'] = '空';
			}else{
				$plat_id = unserialize($v['plat_id']);
				$plat_id = implode(',',$plat_id);
				$where['id'] = array('in',$plat_id);
				$platform = db('platform')->where($where)->field('id,plat_name')->select();
				foreach($platform as $a => $b){
					$new_platform[] = $b['plat_name'];
				}
				$list[$k]['plat_id'] = implode('、',$new_platform);
				unset($where);
				unset($plat_id);
				unset($new_platform);
			}
			$belong = db('worker')->where('id',$v['belong'])->find();
			$list[$k]['belong'] = $belong['realname'];
			$list[$k]['create_time'] = date("Y-m-d H:i:s",$v['create_time']);
		}
        foreach($list as $r => $dataRow){
            $row = $baseRow + $r;
            //将数据填充到相对应的位置，对应上面输出的列头
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $dataRow ['id'] );
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $dataRow ['plat_id'] );
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $dataRow ['customer_name'] );
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $dataRow ['province'] );
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $dataRow ['city'] );
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $dataRow ['mobile'] );
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $dataRow ['address'] );
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $dataRow ['belong'] );
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $dataRow ['remark'] );
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $dataRow ['create_time'] );
        }
        //导出
        $filename = sha1('表格数据'.time()).'.xlsx';//excel文件名称
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename='.$filename.'');
		header('Cache-Control: max-age=0'); 
		$PHPWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');		
		$PHPWriter->save('php://output');
		exit;			
	}
	public function export_activation()
	{
        Loader::import('phpexcel.PHPExcel');
        Loader::import('phpexcel.PHPExcel.IOFactory.PHPExcel_IOFactory');		
		//创建对象  
        $objPHPExcel = new \PHPExcel();
        //获取当前活动的表
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->setTitle('激活列表');//设置excel的标题
        $objActSheet->setCellValue('A1','激活列表');
        $objActSheet->setCellValue('A2','导出时间:'.date('Y-m-d H:i:s'));
        //现在开始输出列头了
        $objActSheet->setCellValue('A3','ID');
        $objActSheet->setCellValue('B3','客户名称');
        $objActSheet->setCellValue('C3','平台名称');
		$objActSheet->setCellValue('D3','激活数量');
		$objActSheet->setCellValue('E3','激活日期');
		$objActSheet->setCellValue('F3','所属销售');
		$objActSheet->setCellValue('G3','备注');
		$objActSheet->setCellValue('H3','创建时间');
        //具体有多少列，有多少就写多少，跟下面的填充数据对应上就可以
        //现在就开始填充数据了 （从数据库中）
		$plat_id			=	input('get.plat_name');
		$customer_name		=	input('get.customer_name');
		$activation_time  	= 	input('get.activation_time');
        if(!empty($activation_time)){
            $activation_time_arr = explode(' , ',$activation_time);
            $data['activation_begintime']  = strtotime($activation_time_arr[0]);
            $data['activation_endtime']    = strtotime($activation_time_arr[1]);
        }
		$where['plat_id']  			= !empty($plat_id) ? $plat_id : array('like','%%');
		$where['custom_id'] 	= !empty($customer_name) ? $customer_name : array('like',"%%");
		$where['activation_time']  	= !empty($data['activation_begintime']) ? array('between',"".$data['activation_endtime'],$data['activation_endtime']."") : array('like',"%%");
		$list = db('activation')->where($where)->select();	
		//var_dump($list);
		if(empty($list)){
			exit;
		}
        $baseRow = 4; //数据从N-1行开始往下输出 这里是避免头信息被覆盖
		foreach($list as $k=> $v){
			$customer = db('customer')->where('id',$v['custom_id'])->find();
			$list[$k]['custom_id'] = $customer['customer_name'];			
			$platform = db('platform')->where('id',$v['plat_id'])->find();
			$list[$k]['plat_id'] = $platform['plat_name'];			
			$belong = db('worker')->where('id',$v['belong'])->find();
			$list[$k]['belong'] = $belong['realname'];			
			$list[$k]['activation_time'] = date("Y-m-d",$v['activation_time']);
			$list[$k]['create_time'] = date("Y-m-d H:i:s",$v['create_time']);
		}
        foreach($list as $r => $dataRow){
            $row = $baseRow + $r;
            //将数据填充到相对应的位置，对应上面输出的列头
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $dataRow ['id'] );
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $dataRow ['custom_id'] );
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $dataRow ['plat_id'] );
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $dataRow ['activation_num'] );
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $dataRow ['activation_time'] );
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $dataRow ['belong'] );
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $dataRow ['remark'] );
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $dataRow ['create_time'] );
        }
        //导出
        $filename = sha1('表格数据'.time()).'.xlsx';//excel文件名称
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename='.$filename.'');
		header('Cache-Control: max-age=0'); 
		$PHPWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');		
		$PHPWriter->save('php://output');
		exit;		
	}

	public function read_excal(){
		$file = request()->file('file');
		    // 移动到框架应用根目录/public/uploads/ 目录下
			if($file){
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				if($info){
					// 成功上传后 获取上传信息
					// 输出 jpg
					//echo $info->getExtension();
					// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
					$file_path = ROOT_PATH . 'public' . DS . 'uploads/'.$info->getSaveName();
					echo($file_path);
					// 输出 42a79759f284b767dfcb2a0197904287.jpg
					$filetempname = $info->getFilename(); 
				}else{
					// 上传失败获取错误信息
					echo $file->getError();
				}
			}
			//导入Excel文件  
			function uploadFile($file,$filetempname)   
			{
				Loader::import('phpexcel.PHPExcel');
				Loader::import('phpexcel.PHPExcel.IOFactory');
				Loader::import('phpexcel.PHPExcel.Writer.Excel5');
				Loader::import('phpexcel.PHPExcel.Writer.Excel2007');
				$PHPExcel_IOFactory = new \PHPExcel_IOFactory();
				//获取上传文件的扩展名  
				$extend=strrchr ($filetempname,'.');
					if($extend==".xlsx"){  
					$objReader = $PHPExcel_IOFactory->createReader('Excel2007');//use excel2007 for 2007 format   
				}else{  
					$objReader = $PHPExcel_IOFactory->createReader('Excel5');//use excel2007 for 2007 format   
				}  
					$objPHPExcel = $objReader->load($file);   
					$sheet = $objPHPExcel->getSheet(0);   
					$highestRow = $sheet->getHighestRow();           //取得总行数   
					$highestColumn = $sheet->getHighestColumn(); //取得总列数 
					return  $highestColumn;
			}
			var_dump(uploadFile($file_path,$filetempname));

	}
}