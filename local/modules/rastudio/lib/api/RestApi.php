<?php

namespace RaStudio\Api;

use \Bitrix\Main\Application;
use RaStudio\Api\LoggerAdapter;

class RestApi {

    const METHOD = "ALL";
    const USER = "itservice";
    const PASSWORD = "Wer34rd56";
    const URL = "https://terminal.scloud.ru/03/sc81501_base03/hs/siteExchange";

    public static function simple_curl($uri, $method='GET', $data=null, $curl_headers=array(), $curl_options=array()) {
        
        $uri = self::URL . $uri;

        $default_curl_options = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 100,
        );
        $authf = "Authorization: Basic ".base64_encode(self::USER . ":" . self::PASSWORD);
        $default_headers = array(
            $authf,
        );

        if(!$method) {
            return ["ERROR" => true, "ERROR_MESSAGE" => "method is empty."];
        }

        // validate input
        $method = strtoupper(trim($method));
        $allowed_methods = array('GET', 'POST', 'PUT', 'DELETE');

        if(!in_array($method, $allowed_methods)) {
            return ["ERROR" => true, "ERROR_MESSAGE" => "'$method' is not valid cURL HTTP method."];
        }

        if($method == 'GET') {
            $uri  = $uri."?".http_build_query($data);
        }

        $curl = curl_init($uri);
        curl_setopt_array($curl, $default_curl_options);
        $data = json_encode($data, JSON_NUMERIC_CHECK);
        
        switch($method) {
            case 'GET':
 
            break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            break;
        }
        curl_setopt_array($curl, $curl_options);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge($default_headers, $curl_headers));
        $result = curl_exec($curl);
        $raw = rtrim($result);
        $lines = explode("\r\n", $raw);
        $headers = array();
        $content = '';
        $write_content = false;
        if(count($lines) > 3) {
            foreach($lines as $h) {
                if($h == '')
                    $write_content = true;
                else {
                    if($write_content)
                        $content .= $h."\n";
                    else
                        $headers[] = $h;
                }
            }
        }

        $error = curl_error($curl);
        $httpcode = curl_getinfo($curl);

        curl_close($curl);


        // if( $method == self::METHOD || self::METHOD === "ALL" ) {

        //     $log = "=====================`REQUEST`====================\n";
        //     $log .= "*Method* = `$method`\n";
        //     $log .= "*URL* = `".$httpcode['url']."`\n";
        //     $log .= "*content_type* = `" . $httpcode['content_type']. "`\n";
        //     $log .= "*http_code* = `" . $httpcode['http_code']. "`\n";
        //     $log .= "*body*\n```" . $data. "```\n";
        //     $log .= "*request_header*\n```" . $httpcode['request_header']. "```";
        //     $log .= "======================`END`======================\n\n\n\n!";
        //     LoggerAdapter::add($log, "https://hooks.slack.com/services/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");

        // }


        if($error) {
            return ["ERROR" => true, "ERROR_MESSAGE" => $error ];
        }

        return json_decode($content,true);
    }
    // public static function searchInArray(&$array) {

    //     if( !is_array($array) ) {
    //         if($array === 'true') {
    //             $array = true;
    //         } elseif ($array === 'false'){
    //             $array = false;
    //         }
    //         return $array;
    //     }

    //     foreach ($array as &$arrayItem) {
    //         self::searchInArray($arrayItem);
    //     }

    // }
    /*
    public static function actionProxySend() {

        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();

        $error = true;

        $requestUri = $postList['url'];
        $requestParams = $postList['body'];
        $headers = $postList['headers'];
        $method = $postList['method'];

        $log = "==================`SEND_ARRAY`====================\n";
        $log .= "*body*\n```" . print_r($postList,true). "```\n";
        $log .= "======================`END`======================\n\n\n\n!";
        LoggerAdapter::add($log, "https://hooks.slack.com/services/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");

        if($requestParams) {
            self::searchInArray($requestParams);
            //LoggerAdapter::add(print_r($requestParams,true), "https://hooks.slack.com/services/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");
        }

        $head = [];

        foreach ($headers as $name => $value) {
            $head[] = "$name:$value";
        }

        $result = self::simple_curl($requestUri,$method,$requestParams,$head);

        if($result["ERROR"] === true) {

            $log = "=======================`ERROR`======================\n";
            //$log .= "*postList*\n```" . print_r($postList,true). "```\n";
            $log .= "*ERROR* = `" . $result["ERROR_MESSAGE"] . "` `SERVER` \n";
            $log .= "======================`END`======================\n\n\n\n!";

            if($error) {
                LoggerAdapter::add($log, "https://hooks.slack.com/services/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");
            }

            return $response->shapeError([], $result["ERROR_MESSAGE"]. " FROM KVADO");
        }

        $result = json_decode($result);

        if($result->result == "error") {

            $log = "=======================`ERROR`======================\n";
            //$log .= "*postList*\n```" . print_r($postList,true). "```\n";
            $log .= "*ERROR* = `" . $result->message . "` `KVADO`" . "\n";
            $log .= "======================`END`======================\n\n\n\n!";

            if($error) {
                LoggerAdapter::add($log, "https://hooks.slack.com/services/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");
            }

            return $response->shapeError([], $result->message);
        }

        return $response->shapeOk($result, '');
    }
    public static function actionGetInfo() {
        $response = new Response();
        $user = new \CUser;
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();

        if(!$postList['action'] || empty($postList['action'])){
            return $response->shapeError([], "Не задан праметре action");
        }

        LoggerAdapter::add([
            'action' => "RegisterUser",
        ], "https://hooks.slack.com/services/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");

        switch ($postList['action']) {
            case "addToken":
                $fields = ["UF_TOKEN" => $postList['token']];
                $user->Update($user->GetID(), $fields);

                $apartmentName = $postList['apartmentName'] ? : false;

                $res = \StatisticsKvado::saveAction("RegisterUser", false);

                if($res) {
                    LoggerAdapter::add([
                        'action' => "RegisterUser",
                        'apartmentName' => $apartmentName,
                    ], "https://hooks.slack.com/services/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");
                } else {
                    LoggerAdapter::add([
                        'action' => "RegisterUser",
                        'apartmentName' => $apartmentName,
                    ], "https://hooks.slack.com/services/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");
                }

                return $response->shapeOk([], 'Токен сохранен');
            break;
            case "getToken":
                $rsUsers = \CUser::GetByID($user->GetID());
                $token = false;
                while ($arUser = $rsUsers->Fetch()) {
                    $token = $arUser["UF_TOKEN"];
                }
                if($token){
                    return $response->shapeOk([
                        'token' => $token
                    ], 'Токен получен');
                } else {
                    return $response->shapeError([], 'Токен отсутствует');
                }

            break;
            case "deleteInfo":
                $fields = [
                    "UF_TOKEN" => '',
                ];
                $user->Update($user->GetID(), $fields);
                return $response->shapeOk([], 'Поля очищены');
            break;
        }

    }
    */
}
