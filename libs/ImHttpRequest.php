<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/28
 * Time: 23:12
 */
namespace libs;

class ImHttpRequest{
    public static function request($url,$params,$method = 'GET'){
        $response   = null;
        if($url){
            $method     = strtoupper($method);
            if($method == 'POST'){

            }elseif($method == 'PUT'){

            }elseif($method == 'DELETE'){

            }else{
                if(is_array($params) and count($params)){
                    if(strrpos($url,'?')){
                        $url    = $url.'&'.http_build_query($params);
                    }else{
                        $url    = $url.'?'.http_build_query($params);
                    }
                    $response   = file_get_contents($url);

                   /* $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $response = curl_exec($ch);
                    curl_close($ch);*/
                }
                return $response;
            }
        }
    }
}