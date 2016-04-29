<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/28
 * Time: 22:22
 */
class autoload
{
    public static function load($className)
    {
        $fileName   = sprintf('%s.php',str_replace('\\','/',$className));
        if(is_file($fileName))require_once $fileName;

    }
}
spl_autoload_register(['autoload','load']);






















