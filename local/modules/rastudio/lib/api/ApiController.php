<?php

namespace RaStudio\Api;

use \RaStudio\Config as ConfigMain;
use \RaStudio\Api\Config as ConfigAPI;


class ApiController
{

    public static function action($method, $entity, $data)
    {
        try {
            $integration1C = self::getInstanceIntegration1C();
            LoggerAdapter::add($data);
            $isCheck = true;
            //list($isCheck, $code, $text) = $integration1C->transfer1cToBitrix($method, $entity, $data, [ChangeData::class, 'action'], [ChangeData::class, 'checker']);
            if ($isCheck) {
                return [ConfigAPI::RESPONSE_STATUS_OK, print_r(json_decode($data, true),true)];
            } else {
                LoggerAdapter::add("ApiController Code:$code, $text");
                return [ConfigAPI::RESPONSE_STATUS_ERROR, '<?xml version="1.0" encoding="UTF-8"?><Ошибка><КодОшибки>'.$code.'</КодОшибки><Сообщение>'.$text.'</Сообщение></Ошибка>'];
            }
        } catch (\Exception $e) {
            LoggerAdapter::add("ApiController Code:40, " . $e->getMessage());
            return [ConfigAPI::RESPONSE_STATUS_ERROR, '<?xml version="1.0" encoding="UTF-8"?><Ошибка><КодОшибки>40</КодОшибки><Сообщение>Не известная ошибка</Сообщение></Ошибка>'];
        }
    }

    public static function getInstanceIntegration1C() {
        // $connect = new \PhpAmqpLib\Connection\AMQPConnection(
        //     ConfigMain::RABBIT_HOST,    #host - имя хоста, на котором запущен сервер RabbitMQ
        //     ConfigMain::RABBIT_PORT,        #port - номер порта сервиса, по умолчанию - 5672
        //     ConfigMain::RABBIT_USER,        #user - имя пользователя для соединения с сервером
        //     ConfigMain::RABBIT_PASSWORD,        #password
        //     ConfigMain::RABBIT_V_HOST,
        //     60
        // );

        // $adapter = new QueueAdapter($connect);
        // return new Integration1C($adapter);
    }

}