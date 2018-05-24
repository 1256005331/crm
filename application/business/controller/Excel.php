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
        $objActSheet->setTitle('客户列表');
        //设置excel的标题
        $objActSheet->setCellValue('A1', '客户列表');
        $objActSheet->setCellValue('A2', '导出时间:' . date('Y-m-d H:i:s'));
        //现在开始输出列头了
        $objActSheet->setCellValue('A3', 'ID');
        $objActSheet->setCellValue('B3', '平台名称');
        $objActSheet->setCellValue('C3', '客户名称');
        $objActSheet->setCellValue('D3', '省份');
        $objActSheet->setCellValue('E3', '城市');
        $objActSheet->setCellValue('F3', '手机号码');
        $objActSheet->setCellValue('G3', '地址');
        $objActSheet->setCellValue('H3', '所属销售');
        $objActSheet->setCellValue('I3', '备注');
        $objActSheet->setCellValue('J3', '创建时间');
        //具体有多少列，有多少就写多少，跟下面的填充数据对应上就可以
        //现在就开始填充数据了 （从数据库中）
        $belong = input('get.belong');
        $plat_id = input('get.plat_id');
        $phone = input('get.phone');
        $where['belong'] = !empty($belong) ? $belong : array('like', '%%');
        $where['plat_id'] = !empty($plat_id) ? array('like', "%s:1:\"{$plat_id}\"%") : array('like', "%%");
        $where['mobile'] = array('like', "%{$phone}%");
        $list = db('customer')->where($where)->select();
        //echo('<pre/>');print_r($list);
        if (empty($list)) {
            exit('<script>alert("没有数据导出");</script>');
        }
        $baseRow = 4;
        //数据从N-1行开始往下输出 这里是避免头信息被覆盖
        foreach ($list as $k => $v) {
            if (empty($v['plat_id'])) {
                $list[$k]['plat_id'] = '空';
            } else {
                $plat_id = unserialize($v['plat_id']);
                $plat_id = implode(',', $plat_id);
                $where_plat_id['id'] = array('in', $plat_id);
                $platform = db('platform')->where($where_plat_id)->field('id,plat_name')->select();
                foreach ($platform as $a => $b) {
                    $new_platform[] = $b['plat_name'];
                }
                $list[$k]['plat_id'] = implode('、', $new_platform);
                unset($where);
                unset($plat_id);
                unset($new_platform);
            }
            //echo($v['belong']);exit;
            $sel_realname_where['id'] = $v['belong'];
            $belong_res = db('worker')->where($sel_realname_where)->find();
            //echo('<pre/>');print_r($v['belong']);exit;
            $list[$k]['belong'] = $belong_res['realname'];
            $list[$k]['create_time'] = date("Y-m-d H:i:s", $v['create_time']);
        }
        foreach ($list as $r => $dataRow) {
            $row = $baseRow + $r;
            //将数据填充到相对应的位置，对应上面输出的列头
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $dataRow['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $dataRow['plat_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $dataRow['customer_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $dataRow['province']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $dataRow['city']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $dataRow['mobile']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $dataRow['address']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $dataRow['belong']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $dataRow['remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $dataRow['create_time']);
        }
        //导出
        $filename = sha1('表格数据' . time()) . '.xlsx';
        //excel文件名称
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '');
        header('Cache-Control: max-age=0');
        $PHPWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
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
        $objActSheet->setTitle('激活列表');
        //设置excel的标题
        $objActSheet->setCellValue('A1', '激活列表');
        $objActSheet->setCellValue('A2', '导出时间:' . date('Y-m-d H:i:s'));
        //现在开始输出列头了
        $objActSheet->setCellValue('A3', 'ID');
        $objActSheet->setCellValue('B3', '客户名称');
        $objActSheet->setCellValue('C3', '平台名称');
        $objActSheet->setCellValue('D3', '激活数量');
        $objActSheet->setCellValue('E3', '激活日期');
        $objActSheet->setCellValue('F3', '所属销售');
        $objActSheet->setCellValue('G3', '备注');
        $objActSheet->setCellValue('H3', '创建时间');
        //具体有多少列，有多少就写多少，跟下面的填充数据对应上就可以
        //现在就开始填充数据了 （从数据库中）
        $plat_id = input('get.plat_name');
        $customer_name = input('get.customer_name');
        $activation_time = input('get.activation_time');
        if (!empty($activation_time)) {
            $activation_time_arr = explode(' , ', $activation_time);
            $data['activation_begintime'] = strtotime($activation_time_arr[0]);
            $data['activation_endtime'] = strtotime($activation_time_arr[1]);
        }
        $where['plat_id'] = !empty($plat_id) ? $plat_id : array('like', '%%');
        $where['custom_id'] = !empty($customer_name) ? $customer_name : array('like', "%%");
        $where['activation_time'] = !empty($data['activation_begintime']) ? array('between', "" . $data['activation_endtime'], $data['activation_endtime'] . "") : array('like', "%%");
        $list = db('activation')->where($where)->select();
        //var_dump($list);
        if (empty($list)) {
            exit;
        }
        $baseRow = 4;
        //数据从N-1行开始往下输出 这里是避免头信息被覆盖
        foreach ($list as $k => $v) {
            $customer = db('customer')->where('id', $v['custom_id'])->find();
            $list[$k]['custom_id'] = $customer['customer_name'];
            $platform = db('platform')->where('id', $v['plat_id'])->find();
            $list[$k]['plat_id'] = $platform['plat_name'];
            $belong = db('worker')->where('id', $v['belong'])->find();
            $list[$k]['belong'] = $belong['realname'];
            $list[$k]['activation_time'] = date("Y-m-d", $v['activation_time']);
            $list[$k]['create_time'] = date("Y-m-d H:i:s", $v['create_time']);
        }
        foreach ($list as $r => $dataRow) {
            $row = $baseRow + $r;
            //将数据填充到相对应的位置，对应上面输出的列头
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $dataRow['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $dataRow['custom_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $dataRow['plat_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $dataRow['activation_num']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $dataRow['activation_time']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $dataRow['belong']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $dataRow['remark']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $dataRow['create_time']);
        }
        //导出
        $filename = sha1('表格数据' . time()) . '.xlsx';
        //excel文件名称
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '');
        header('Cache-Control: max-age=0');
        $PHPWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $PHPWriter->save('php://output');
        exit;
    }
    public function read_excal()
    {
        $file = request()->file('file');
        import('phpexcel.PHPExcel', EXTEND_PATH);
        $objPHPExcel = new \PHPExcel();
        //获取表单上传文件
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'runtime' . DS . 'uploads');
        if ($info) {
            $exclePath = $info->getSaveName();
            //获取文件名
            $file_name = ROOT_PATH . 'runtime' . DS . 'uploads' . DS . $exclePath;
            //上传文件的地址
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $obj_PHPExcel = $objReader->load($file_name, $encode = 'utf-8');
            //加载文件内容,编码utf-8
            if (!$obj_PHPExcel) {
                json_return(1001, '只支持Excel2007表格数据上传', '');
            }
            //echo "<pre>";
            $excel_array = $obj_PHPExcel->getsheet(0)->toArray();
            
            //转换为数组格式
            if (!$excel_array) {
                json_return(1001, '只支持Excel2007表格数据上传', '');
            }
            array_shift($excel_array);
            //删除第一个数组(标题);
            $field = array('customer_name','card_id1','card_id2');
            //unset($excel_array[0]);
            
            $data_res = array();
            foreach ($excel_array as $k => $v) {
                if (!empty($v[1])) {
                    foreach ($field as $a => $b) {
                        if ($b == 'customer_name') {
                            $data_res[$k]['custom_id'] = $v[$a];
                        } else {
                            $data_res[$k][$b] = $v[$a];
                        }
                    }
                }
            }

            $data_res = array_merge($data_res);
            $all_card_id_data = array();
            $i = 0;
            foreach ($data_res as $k => $v) {
                if(empty($v['custom_id'])){json_return(1001, "客户名称不存在", '');}
                $sel_customer = db('customer')->where('customer_name', $v['custom_id'])->field('id')->find();
                if (empty($sel_customer)){json_return(1001, "客户名称不存在", '');}
                $Front = "";
                if(is_numeric($v['card_id1']) && is_numeric($v['card_id2'])){
                    $card_id1 = $v['card_id1'];
                    $card_id2 = $v['card_id2'];
                }else{
                    preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/', $v['card_id1'], $card_id1_arr);
                    preg_match_all('/(.*?)[1-9]{1,}[0-9]{1,}$/', $v['card_id2'], $card_id2_arr);

                    if (!empty($card_id1_arr[1][0]) && !empty($card_id2_arr[1][0])) {
                        $Front = (string) $card_id1_arr[1][0];
                    }
                    $card_id1 = substr($v['card_id1'],strlen($Front));
                    $card_id2 = substr($v['card_id2'],strlen($Front));
                }
                if (strlen($card_id1) != strlen($card_id2)) {
                    json_return(1001, '序列号错误，请检查后重新导入', '');
                }
                if (!empty($card_id1) && !empty($card_id2)) {
                    while ($card_id1 <= $card_id2) {
                        $chk_card_id = $Front . (int) $card_id1;
                        $all_card_id_data[] = $chk_card_id;
                        $card_id1++;
                    }
                }
                $card_id_str = implode(',', $all_card_id_data);
                $data_res[$k]['card_id'] = $card_id_str;
                $chk_where['card_id'] = array('in', $card_id_str);
                $chk_where['state'] = array('in','1,4');
                //查询序列号是否存在在表中
                $chk_sel = db('sku')->where($chk_where)->field('card_id')->select();
                if ($chk_sel) {
                    $chk_arr = explode(',', $card_id_str);
                    foreach ($chk_sel as $k => $v) {
                        if (!in_array($v['card_id'], $chk_arr)) {
                            $not_error[] = $v['card_id'];
                        }
                    }
                } else {
                    json_return(1001, "序列号校验错误:<br/>{$card_id_str}<br/>如上序列号发现错误", '');
                }
                $where['card_id'] = array('in', $card_id_str);
                $data['custom_id'] = $sel_customer['id'];
                $data['out_time'] = time();
                $data['state'] = 2;
                $update = db('sku')->where($where)->update($data);
                if (!$update) {
                    $update_error[] = $card_id_str;
                }
                $i = $i + $update;
            }
            if (empty($not_error) && empty($update_error)) {
                json_return(1, "上传数据成功,已成功导入 $i 条出库数据", ''); 
            } elseif (!empty($not_error)) {
                json_return(1002, "已成功导入 $i 条出库数据,导入数据中如下序列号不存在：" . implode(',', $not_error) . "", '');
            }
            if (!empty($update_error)) {
                json_return(1002, "已成功导入 $i 条出库数据,导入数据中如下序列号更新失败：" . implode(',', $update_error) . "", '');
            } else {
                json_return(1002, "已成功导入 $i 条出库数据,导入数据中如下序列号不存在：" . implode(',', $not_error) . "<br/>导入数据中如下序列号更新失败：" . implode(',', $update_error) . "", '');
            }
            // echo('<pre/>');print_r($data_res);exit;
            // $update_error = '';
            // $not_error = '';
            // foreach ($data_res as $k => $v) {
            //     $sel_customer = db('customer')->where('customer_name', $v['custom_id'])->field('id')->find();
            //     if (!$sel_customer) {
            //         json_return(1001, "客户名称不存在", '');
            //     }
            //     $data_res[$k]['custom_id'] = $sel_customer['id'];
            //     $card_id_arr = explode("|", $v['card_id']);
            //     if (is_array($card_id_arr)) {
            //         $all_card_id_data = array();
            //         foreach ($card_id_arr as $a => $b) {
            //             if (!empty($b)) {
            //                 $card_arr = explode(',', $b);
            //                 //var_dump($card_arr);exit;
            //                 $card_id1 = $card_arr[0];
            //                 $card_id2 = $card_arr[1];
            //                 if (strlen($card_id1) != strlen($card_id2)) {
            //                     json_return(1001, '序列号错误，请检查后重新导入', '');
            //                 }
            //                 preg_match_all('/^(.*?)[1-9]/', $card_id1, $card_id1_arr);
            //                 preg_match_all('/^(.*?)[1-9]/', $card_id2, $card_id2_arr);
            //                 //echo('<pre/>');print_r($card_id1_arr);exit;
            //                 $Front = "";
            //                 if (!empty($card_id1_arr[1][0]) && !empty($card_id2_arr[1][0])) {
            //                     $Front = (string) $card_id1_arr[1][0];
            //                 }
            //                 if (!empty($card_id1) && !empty($card_id2)) {
            //                     while ($card_id1 <= $card_id2) {
            //                         $chk_card_id = $Front . (int) $card_id1;
            //                         $all_card_id_data[] = $chk_card_id;
            //                         $card_id1++;
            //                     }
            //                 }
            //             }
            //         }
            //         $card_id_str = implode(',', $all_card_id_data);
            //         $data_res[$k]['card_id'] = $card_id_str;
            //         $chk_where['card_id'] = array('in', $card_id_str);
            //         $chk_where['state'] = 1;
            //         //查询序列号是否存在在表中
            //         $chk_sel = db('sku')->where($chk_where)->field('card_id')->select();
            //         if ($chk_sel) {
            //             $chk_arr = explode(',', $card_id_str);
            //             foreach ($chk_sel as $k => $v) {
            //                 if (!in_array($v['card_id'], $chk_arr)) {
            //                     $not_error[] = $v['card_id'];
            //                 }
            //             }
            //         } else {
            //             json_return(1001, "序列号校验错误:<br/>{$card_id_str}<br/>如上序列号发现错误", '');
            //         }
            //         $where['card_id'] = array('in', $card_id_str);
            //         $data['custom_id'] = $sel_customer['id'];
            //         $data['out_time'] = time();
            //         $data['state'] = 2;
            //         $update = db('sku')->where($where)->update($data);
            //         if (!$update) {
            //             $update_error[] = $card_id_str;
            //         }
            //     } else {
            //         json_return(1001, '序列号错误，请检查后重新导入', '');
            //     }
            // }
            // if (empty($not_error) && empty($update_error)) {
            //     json_return(1, '上传数据成功', '');
            // } elseif (!empty($not_error)) {
            //     json_return(1002, "导入数据中如下序列号不存在：" . implode(',', $not_error) . "", '');
            // }
            // if (!empty($update_error)) {
            //     json_return(1002, "导入数据中如下序列号更新失败：" . implode(',', $update_error) . "", '');
            // } else {
            //     json_return(1002, "导入数据中如下序列号不存在：" . implode(',', $not_error) . "<br/>导入数据中如下序列号更新失败：" . implode(',', $update_error) . "", '');
            // }
        } else {
            // 上传失败获取错误信息
            json_return(1001, '上传表格失败', '');
        }
    }
}