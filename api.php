<?php
/**
 * Created by PhpStorm.
 * User: wzb
 * Date: 2016/4/28
 * Time: 22:08
 */
//use application;
require_once './common/function.php';
require_once "./autoload.php";

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
    $num    = $_POST['phone_number'];
    echo application\QueryPhone::query($num);
}else{
    echo json_encode(array(0,'','非法请求...'));
};




//p($info);
//application\QueryPhone::test();