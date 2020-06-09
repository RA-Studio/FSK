<?php
namespace RaStudio\Ajax;

use RaStudio\Api\LoggerAdapter as LoggerAdapter;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;


class AjaxReview {

    public static function actionCreateElement() {
        $request = \RaStudio\Ajax\Response::getRequestObj();
        Loader::includeModule("iblock");
        Loader::includeModule("catalog");
        global $USER;

        $PROP = array();
        $PROP['UF_ADVANTAGES'] = $request['postList']['advantages'];
        $PROP['UF_DISADVANTAGES'] = $request['postList']['disadvantages'];
        $PROP['UF_USE']=$request['postList']['use'];
        $PROP['UF_COMMENTS']=$request['postList']['comments'];
        $PROP['UF_PRODUCT']=$request['postList']['product'];
        $el = new \CIBlockElement;
        $arLoadProductArray = Array(
            "MODIFIED_BY"    => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => 87,
            "NAME"           => $request['postList']['name'],
            "ACTIVE"         => "N",
            "PROPERTY_VALUES"=> $PROP,
        );
        if($el->Add($arLoadProductArray)) {
            return $request['response']->shapeOk($arLoadProductArray,"Сообщение отправлено");
        } else {
            return $request['response']->shapeError([],"Сообщение для отправки пустое");
        }
    }

}