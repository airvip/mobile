<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/29
 * Time: 12:36
 */

namespace libs;


class ImRedis
{
    private static $redis;

    public static function getRedis(){
        if(!(self::$redis instanceof \Redis)){
            self::$redis    = new \Redis();
            self::$redis->connect('127.0.0.1',6379);
        }
        return self::$redis;
    }
}