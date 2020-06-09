<?php

namespace RaStudio\Ajax;

use RaStudio\Api\LoggerAdapter as LoggerAdapter;

class AjaxSlack {

    public static function actionSend() {
        $request = \RaStudio\Ajax\Response::getRequestObj();
        $message = $request['postList']['message'];

        if(is_array($message)){
            $message = print_r($message,true);
        }

        if($message) {
            LoggerAdapter::add("message: \n```$message```");
            return $request['response']->shapeOk($message,"Сообщение отправлено");
        } else {
            return $request['response']->shapeError([],print_r($request,true));
        }
    }

}
