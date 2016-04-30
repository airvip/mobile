<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/29
 * Time: 13:36
 */

namespace libs;


class ImMysqli
{
    private static $mysqli;
    public static function getMysqli(){
        if(!(self::$mysqli instanceof \Mysqli)){
            self::$mysqli    = new \Mysqli();
            self::$mysqli->connect('127.0.0.1','root','wzb','mobile');
        }
        return self::$mysqli;
    }

}