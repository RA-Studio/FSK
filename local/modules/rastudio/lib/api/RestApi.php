<?php

namespace RaStudio\Api;

use \Bitrix\Main\Application;
use RaStudio\Api\LoggerAdapter;

class RestApi {

    const METHOD = "ALL";
    const USER = "itservice";
    const PASSWORD = "Wer34rd56";
    const DEVURL = "https://terminal.scloud.ru/03/sc81501_base03/hs/siteExchange";
    const URL = "https://terminal.scloud.ru/03/sc81501_base07/hs/siteExchange/";

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
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

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

        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);

        $raw = rtrim($result);
        $lines = explode("\r\n", $raw);
        $headers = array();
        $content = '';
        $write_content = false;

        if(count($lines) > 3) {
            foreach($lines as $h) {
                if($h == '') {
                    $write_content = true;
                } else {
                    if($write_content) {
                        $content .= $h."\n";
                    } else {
                        $headers[] = $h;
                    }
                }
            }
        }

        $error = curl_error($curl);
        $httpcode = curl_getinfo($curl);

        curl_close($curl);


         if( $method == self::METHOD || self::METHOD === "ALL" ) {
             $log = "=====================`REQUEST`====================\n";
             $log .= "*Method* = `$method`\n";
             $log .= "*URL* = `".$httpcode['url']."`\n";
             $log .= "*content_type* = `" . $httpcode['content_type']. "`\n";
             $log .= "*http_code* = `" . $httpcode['http_code']. "`\n";
             $log .= "*request_header*\n```" . $httpcode['request_header']. "```";
             $log .= "*body*\n```" . $body . "```";
             $log .= "======================`END`======================\n\n\n\n";
             LoggerAdapter::add($log);
         }
         //oggerAdapter::add($data);
         if($error) {
            return ["ERROR" => true, "ERROR_MESSAGE" => $error ];
        }
        return json_decode($body,true);
    }
}
