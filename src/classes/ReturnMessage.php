<?php
/**
 * Created by PhpStorm.
 * User: Pim Hakkert
 * Date: 06/11/2019
 * Time: 11:38
 */

class ReturnMessage
{
    public static function sendOk($message) {
        echo json_encode(array('API_code'=>'OK','message'=>$message),JSON_FORCE_OBJECT);
    }

    public static function sendError($code,$message) {
        echo json_encode(array('API_code'=>$code,'message'=>$message),JSON_FORCE_OBJECT);
    }
}