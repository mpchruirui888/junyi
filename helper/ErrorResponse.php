<?php
/**
 * Created by PhpStorm.
 * User: lrving
 * Date: 2019/10/29
 * Time: 17:38
 */
namespace app\helper;

class ErrorResponse
{
    public static  function response($array)
    {
        $error = array();
        foreach ($array as $key => $value){
            foreach ($array[$key] as $k =>$val){
               array_push($error,$val);
            }
        }
        return json_encode(['code'=>400, 'errMsg'=>$error]);
    }
}