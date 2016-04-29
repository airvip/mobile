<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/28
 * Time: 21:39
 */
namespace application;

use libs\ImHttpRequest;
class QueryPhone{

    const TAOBAO_API    = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';

    public static function query($phone){
        if(self::verifyPhone($phone)){
            $response   = ImHttpRequest::request(self::TAOBAO_API,['tel'=>$phone]);
            p($response);
            self::formatData($response);

        }
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

    public static function formatData($data = null){
        $res    = false;
        if($data){
            preg_match_all("/(\w+):'([^']+)/", $data, $res);
            p($res);
        }
    }

    public static function test(){
        QueryIp::query();
       var_dump('测试');
    }

}