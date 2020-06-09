<?php

namespace RaStudio\Ajax;

use \Bitrix\Main\Application;
use Bitrix\Main\Loader;
use RaStudio\GeoLocationExternal;
use RaStudio\Ajax\Response;


class AjaxLocationExternal extends GeoLocationExternal {

    public static function actionSetGeo () {
        $response = \RaStudio\Ajax\Response::getRequestObj();

        if( !$response['postList']['lat'] || !$response['postList']['long'] || !$response['postList']['city'] ) {
            $response['response']->shapeError([],"Нет обазательных полей");
        }

        $geodata = $_SESSION["RaGeoLocationData"];
        $geodata = json_decode($geodata, true);

        $geodata['city'] = $response['postList']['city'];
        $geodata['lat'] = $response['postList']['lat'];
        $geodata['lon'] = $response['postList']['long'];

        $_SESSION["RaGeoLocationData"] = json_encode($geodata);

        return $response['response']->shapeOk([],"Адрес успешно изменен");
    }

}