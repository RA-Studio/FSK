<?php

namespace RaStudio;
/**
Ссылка на сайт http://ip-api.com/docs/
**/

class GeoLocationExternal {

    public static function getInfo($getJSON = false, $getfild = ""){
        $geodata = $_SESSION["RaGeoLocationData"];

        if(!$geodata && $geodata !== false){
            $IP_USER = $_SERVER['REMOTE_ADDR'];
            $url = "http://ip-api.com/json/$IP_USER?fields=status,message,country,countryCode,region,regionName,city,zip,lat,lon,timezone,isp,org,as,query&lang=ru";
            $geodata = @file_get_contents($url);
            if($geodata['status'] != "success") {
                $_SESSION["RaGeoLocationData"] = $geodata;
            } else {
                $_SESSION["RaGeoLocationData"] = false;
                return false;
            }
        }

        if($geodata === false){
            return false;
        }

        if(!$getJSON) {
            $geodata = json_decode($geodata, true);
        }
        return $geodata;
    }

    public static function getIP() {
        $data = self::getInfo();
        if($data === false) return false;
        return $data['query'];
    }

    public static function getGeoCity() {
        $data = self::getInfo();
        if($data === false) return false;
        return $data['city']; /*Город*/
    }

    public static function getGeoCountry() {
        $data = self::getInfo();
        if($data === false) return false;
        return $data['country']; /*Страна*/
    }

    public static function getGeoCountryCode() {

    }

    public static function getGeoPosition() {
        $data = self::getInfo();
        if($data === false) return false;
        $result = [
            "lat" => $data['lat'],
            "lon" => $data['lon'],
        ];
        return $result;
    }
    public static function resetGeoData(){
        $data = self::getInfo();
        if($data === false) return false;
        $IP_USER = $_SERVER['REMOTE_ADDR'];
        $url = "http://ip-api.com/json/$IP_USER?fields=status,message,country,countryCode,region,regionName,city,zip,lat,lon,timezone,isp,org,as,query&lang=ru";
        $geodata = @file_get_contents($url);
        $_SESSION["RaGeoLocationData"] = $geodata;
    }

    public static function getGeoPostalСode() {
        $data = self::getInfo();
        if($data === false) return false;
        return $data['zip']; /*Страна*/
    }

    public static function getGeoAll() {
        $data = self::getInfo();
        if($data === false) return false;
        return $data; /*Вывести все*/
    }
    public static function setGeo ( $lat, $long, $city ) {

        if( !$lat || !$long || !$city ) return false;

        $geodata = $_SESSION["RaGeoLocationData"];
        $geodata = json_decode($geodata, true);

        $geodata['city'] = $city;
        $geodata['lat'] = $lat;
        $geodata['lon'] = $long;

        $_SESSION["RaGeoLocationData"] = json_encode($geodata);
        
    }

}