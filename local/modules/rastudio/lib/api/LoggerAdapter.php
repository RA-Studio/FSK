<?php

namespace RaStudio\Api;


class LoggerAdapter
{
    public static function add($message) {
        $postString = json_encode([
            'text' => $message,
        ]);

        $ch = curl_init();

        $options = [
            CURLOPT_URL => 'https://hooks.slack.com/services/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',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_POSTFIELDS => $postString
        ];

        $options[CURLOPT_SSL_VERIFYHOST] = false;
        if (defined('CURLOPT_SAFE_UPLOAD')) {
            $options[CURLOPT_SAFE_UPLOAD] = true;
        }

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    public static function addFile($message, $file = false) {

        if($file === false) {
            $filepath = LOG_MODULE_DIR."logstandart.txt";
        } else {
            $filepath = LOG_MODULE_DIR.$file;
        }

        file_put_contents($filepath, $message);
    }

}
