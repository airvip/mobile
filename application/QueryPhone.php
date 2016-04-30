<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/28
 * Time: 21:39
 */
namespace application;

use libs\ImHttpRequest;
use libs\ImMysqli;
class QueryPhone{

    const TAOBAO_API    = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';
    const CACHE_KEY     = 'PHONE:INFO';
    public static function query($phone){
        $res = json_encode(array('code'=>0,'data'=>'','mess'=>'数据查询失败...'));
        if(self::verifyPhone($phone)){
            $mts        = substr($phone,0,7);
            $resource   = ImMysqli::getMysqli();
            if(!$resource->set_charset('UTF8')){
                //如果设置字符集错误
                $res = json_encode(array( 'code'  => 0, 'data'  =>  'ERROR:'.$resource->error, 'mess'  => ''));
            }else{
                $sql_find   = "SELECT * FROM mobile WHERE mts='{$mts}' LIMIT 1";
                $result = $resource->query($sql_find);

                if($result && $result->num_rows>0){
                    $row = $result->fetch_assoc();

                    $data = array(
                        'mts'        => $row['mts'],
                        'province'  => $row['province'],
                        'catName'   => $row['cat_name'],
                        'telString' => $phone,
                        'carrier'   => $row['carrier'],
                        'msg'      => '由AirBlog提供数据'
                    );
                    $res   = json_encode(array('code'  => 1,'data'  => $data,'mess'  => ''));
                    // $res    = json_decode($phoneInfo,true);
                    //$res['msg'] = '由AirBlog提供数据';
                }else{
                    $response   = ImHttpRequest::request(self::TAOBAO_API,['tel'=>$phone]);
                    $data   = self::formatData($response);
                    if($data){
                        $data['msg']  = '由阿里巴巴提供数据';
                        $sql_add    = "INSERT mobile(`mts`,`province`,`cat_name`,`carrier`) VALUES('{$data['mts']}','{$data['province']}','{$data['catName']}','{$data['carrier']}')";
                        $resource->query($sql_add);
                        //ImRedis::getRedis()->hSet(self::CACHE_KEY,$redisKey,$json);
                        $res   = json_encode(array('code'  => 1,'data'  => $data,'mess'  => ''));
                    }
                }
            }
            $resource->close();
        }
        return $res;
    }

    /**
     * 校验手机号码合法性
     * @param null $phone
     * @return bool
     */
    public static function verifyPhone($phone = null){
        $res    = false;
        if($phone && preg_match('/^1[34578]{1}\d{9}/',$phone)){
            $res    = true;
        }
        return $res;
    }
    //格式化
    public static function formatData($data = null){
        $res    = [];
        if($data){
            preg_match_all("/(\w+):'([^']+)/", $data, $ret);
            $temp    = array_combine($ret[1],$ret[2]);
            foreach($temp as $key=>$val){
                $res[$key]  = iconv('GB2312','UTF-8',$val);
            }
        }
        return $res;
    }

    public static function test(){
        QueryIp::query();
       var_dump('测试');
    }

}