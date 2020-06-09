<?php

namespace RaStudio;

use \Bitrix\Main\Service\GeoIp;

class GeoLocation {

    public static function getIP() {
        return GeoIp\Manager::getRealIp();
    }
    public static function getGeoCity($lang = "ru") { 
        return GeoIp\Manager::getCityName(self::getIP(), $lang); /*Город*/
    }
    public static function getGeoCountry($lang = "ru") { 
        return GeoIp\Manager::getCountryName(self::getIP(), $lang); /*Страна*/
    }
    public static function getGeoCountryCode($lang = "ru") {
        return GeoIp\Manager::getCountryCode(self::getIP(), $lang); /*Код страны*/
    }
    public static function getGeoPosition($lang = "ru") {
        return GeoIp\Manager::getGeoPosition(self::getIP(), $lang); /*Данные о геопозиции*/
    }
    public static function getGeoAll($lang = "ru") {
        return (array)GeoIp\Manager::getDataResult(self::getIP(), $lang)->getGeoData(); /*Вывести все*/
    }

}