<?php

namespace RaStudio\Api;

use \Bitrix\Main\Application;
use RaStudio\Api\LoggerAdapter;
use RaStudio\Api\Config;

class ShopWorker {
    

    const METHOD_CLIENT = '/client';

    const METHOD_FLAT = '/flat';
    const METHOD_FLAT_GETFREE = self::METHOD_FLAT.'/getFree';

    const METHOD_RESERVATION = '/reservation';
    const METHOD_RESERVATION_CREATE = self::METHOD_RESERVATION.'/create';
    const METHOD_RESERVATION_CONFIRM = self::METHOD_RESERVATION.'/confirm';
    const METHOD_RESERVATION_CANCEL = self::METHOD_RESERVATION.'/cancel';

    const PAYMENT_TYPE_FULL = 'полная';
    const PAYMENT_TYPE_MORTGAGE = 'ипотека';
    const PAYMENT_TYPE_INSTALLMENT = 'рассрочка';
    /**
    * Create user in 1С
    * @param array $dataSend required key : (firstName, secondName, lastName, phone)
    * @return array information created user from 1C
    */
    public static function createdUser($dataSend = false){
        return $dataSend !== false ? RestApi::simple_curl(
            self::METHOD_CLIENT, 
            Config::METHOD_TYPE_CREATE, 
            $dataSend
        ) : false;
    }

    public static function getUser($guid){
        return $dataSend !== false ? RestApi::simple_curl(
            self::METHOD_CLIENT."?guid=".$guid, 
            Config::METHOD_TYPE_CREATE, 
            $dataSend
        ) : false;
    }

    public static function getFreeApartment() {
        return RestApi::simple_curl(
            self::METHOD_FLAT_GETFREE, 
            Config::METHOD_TYPE_GET
        );
    }

    /**
    * Create reservation in 1С
    * @param array $dataSend required key : (client_guid, flat_id)
    * @return array
    */

    public static function createReservation ($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl(
            self::METHOD_RESERVATION_CREATE, 
            Config::METHOD_TYPE_CREATE, 
            $dataSend
        ) : false;
    }

    /**
    * Create reservation in 1С
    * @param array $dataSend required key : (client_guid, flat_id, order_guid, pay_type)
    * @return array
    */

    public static function confirmReservation ($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl(
            self::METHOD_RESERVATION_CONFIRM, 
            Config::METHOD_TYPE_CREATE, 
            $dataSend
        ) : false;
    }

    /**
    * Create reservation in 1С
    * @param array $dataSend required key : (client_guid, flat_id, order_guid)
    * @return array
    */

    public static function canselReservation ($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl(
            self::METHOD_RESERVATION_CANCEL, 
            Config::METHOD_TYPE_CREATE, 
            $dataSend
        ) : false;
    }
}