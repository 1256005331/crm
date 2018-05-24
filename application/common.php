<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用公共文件
//json返回
function json_return($code,$msg,$data){
    $data = array(
        'code' => $code,
        'msg'  => $msg,
        'data' => $data
    );
    if(!isset($msg)){
        unset($data['msg']);
    }else if(!isset($data)){
        unset($data['data']);
    }
    echo(json_encode($data));exit;
}
//获得客户端真实的IP地址
function getip()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else
        if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else
            if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
                $ip = getenv("REMOTE_ADDR");
            } else
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $ip = "unknown";
                }
    return ($ip);
}
//城市代码转换成名称
function sel_city($citycode){
    $str = file_get_contents(ROOT_PATH.'public/static/json/citydata.json');//echo($str);
    $arr = json_decode($str,true);
    $arr['北京市'] = '110000';
    $arr['天津市'] = '120000';
    $arr['上海市'] = '310000';
    $res = array_search($citycode,$arr);
    return $res;
}
//城市名称转换成代码
function sel_citycode($city){
    $str = file_get_contents(ROOT_PATH.'public/static/json/citydata.json');//echo($str);
    $arr = json_decode($str,true);
    $arr['北京市'] = '110000';
    $arr['天津市'] = '120000';
    $arr['上海市'] = '310000';
    foreach($arr as $k => $v){
        if($k == $city){
            return $v;exit;
        }
    }
    return $res;
}
//$arr->传入数组   $key->判断的key值  
function array_unset_tt($arr,$key){     
    //建立一个目标数组  
    $res = array();        
    foreach ($arr as $value) {           
       //查看有没有重复项
       if(isset($res[$value[$key]])){  
             //有：销毁
             unset($value[$key]);
       }  
       else{  
            $res[$value[$key]] = $value;  
       }    
    }  
    return $res;  
}  