<?php

namespace RaStudio\Ajax;

use \Bitrix\Main\Application;
use Bitrix\Main\Loader;


class AjaxSkuOffer {

    const defaultOption = [
        "SkuSelectFilds" => ["ID","NAME","IBLOCK_ID","CODE","catalog_PRICE_1","PROPERTY_KOLLEKTSIYA"],
        "SkuFilter" => ["ACTIVE" => "Y"],
        "SkuPropertyCode" => [
            "CODE" => [
                "TIP_OBIVKI",
                "KATEGORIYA_TSENY",
                "RGB_TSVET",
                "OSNOVNOY_TSVET",
                "KOLLEKTSIYA",
                "SSYLKA_NA_FOTO"
            ],
        ],
        "SkuNotEmptyProp" => [
            "!catalog_PRICE_1" => false,
            "!PROPERTY_KOLLEKTSIYA_VALUE" => false,
            "!PROPERTY_OSNOVNOY_TSVET_VALUE" => false,
            "!PROPERTY_TIP_OBIVKI_VALUE" => false,
            "!PROPERTY_SSYLKA_NA_FOTO_VALUE" => false,
        ],
    ];

    const selectProp = [
        "TIP_OBIVKI",
        "KATEGORIYA_TSENY",
    ];
    
    public static function getRequestObj() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        return [ "response" =>  $response, "postList" => $postList ];
    }

    private static function tempalateProductInfo($temp,$ID,$IBLOCK_ID) {
        $prop = [];
        global $USER;
        foreach($temp['PROPERTIES'] as $key => $value) {
            $prop[$key] = $value['VALUE'];
        }
        foreach($prop['UF_PICTURE'] as $key => $img) {
            $prop['UF_PICTURE'][$key] = \CFile::GetPath($img);
        }
        
        $arResult = [
            "NAME" => $temp['NAME'],
            "ID" => $temp['ID'],
            "CODE" => $temp['CODE'],
            "PROPERTIES" => $prop,
        ];
        $arPrice = \CCatalogProduct::GetOptimalPrice($ID, $IBLOCK_ID, $USER->GetUserGroupArray(), 'N');
        $arResult['PRICE'] = $arPrice;
        $arResult['PRICE']["PRICE_OUT"] = [
            "BASE_PRICE" => number_format($arPrice['RESULT_PRICE']['BASE_PRICE'], 0, '.', ' '),
            "DISCOUNT_PRICE" => number_format($arPrice['RESULT_PRICE']['DISCOUNT_PRICE'], 0, '.', ' '),
            "CURRENCY" => $arPrice['RESULT_PRICE']['CURRENCY'],
            "DISCOUNT" => number_format($arPrice['RESULT_PRICE']['DISCOUNT'], 0, '.', ' '),
            "SALE" => $arPrice['RESULT_PRICE']['BASE_PRICE'] != $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'] ? true : false,
        ];
        return $arResult;
    }

    public static function actionGetProductInfo() { //получаем всю информацию по товару
        $request = \RaStudio\Ajax\Response::getRequestObj();
        $ID = $request['postList']['ID'];
        $IBLOCK_ID = $request['postList']['IBLOCK_ID'];
        
        if(!Loader::includeModule("iblock")) {
            return $request['response']->shapeError([],"Не найден модуль iblock");
        }
        if(!$request['postList']['ID'] || !$request['postList']['IBLOCK_ID']) {
            return $request['response']->shapeError([],"Не хватает обязательных данных");
        }
        $arFilter = Array("IBLOCK_ID" => $request['postList']['IBLOCK_ID'], "ACTIVE"=>"Y", "ID" => $request['postList']['ID']);
        $res = \CIBlockElement::GetList(array(), $arFilter);
        while($ob = $res->GetNextElement()) {
            $arTemp = $ob->GetFields();
            $arTemp['PROPERTIES'] = $ob->GetProperties();
            $arResult = self::tempalateProductInfo($arTemp, $arTemp['ID'], $arTemp['IBLOCK_ID']);
        }

        return $request['response']->shapeOk($arResult,"");
    }

    public static function actionGetProductList() {
        $request = \RaStudio\Ajax\Response::getRequestObj();
        $ID = $request['postList']['ID'];
        $IBLOCK_ID = $request['postList']['IBLOCK_ID'];
        global $USER;
        if(!Loader::includeModule("iblock")) {
            return $request['response']->shapeError([],"Не найден модуль iblock");
        }
        if(!$request['postList']['IBLOCK_ID'] && !$request['postList']['LINK_ID']) {
            return $request['response']->shapeError([],"Не хватает обязательных данных");
        }
        $arFilter = Array("IBLOCK_ID" => $request['postList']['IBLOCK_ID'], "ACTIVE"=>"Y", "PROPERTY_CML2_LINK" => $request['postList']['LINK_ID']);
        
        if($request['postList']['filter']['default']) {
            foreach($request['postList']['filter']['default'] as $key => $value) {
                $arFilter[$key] = $value == "false" ? false : $value;
            }
        }
        if($request['postList']['filter']['value']){
            $arFilter += $request['postList']['filter']['value'];
        }

        $min = [];

        $res = \CIBlockElement::GetList(array(), $arFilter);
        while($ob = $res->GetNextElement()) {
            $arTemp = $ob->GetFields();
            $arTemp['PROPERTIES'] = $ob->GetProperties();
            $arTemp = self::tempalateProductInfo($arTemp, $arTemp['ID'], $arTemp['IBLOCK_ID']);
            
            $arResult[$arTemp['ID']] = $arTemp;
            
  
            $base = $arTemp['PRICE']["RESULT_PRICE"]['BASE_PRICE'];
            $discount = $arTemp['PRICE']["RESULT_PRICE"]['DISCOUNT_PRICE'];
            $price = $base != $discount ? $discount : $base;
            if($min) {
                if($min['PRICE'] > $price) {
                    $min = [
                        "PRICE" => $price,
                        "ELEM" => $arTemp,
                    ];
                }
            } else {
                $min = [
                    "PRICE" => $price,
                    "ELEM" => $arTemp,
                ];
            }


        }
        $temp = $arResult;
        $arResult = [];
        $arResult['list'] = $temp;
        $arResult['min'] = $min['ELEM'];

        return $request['response']->shapeOk($arResult,"");
    }

    public static function actionGetPropTopSkuByElementId() {
        $request = self::getRequestObj();
        $arResult = [];
        if(!Loader::includeModule("iblock")) {
            return $request['response']->shapeError([],"Не найден модуль iblock");
        }
        if(!$request['postList']['ID'] || !$request['postList']['IBLOCK_ID']) {
            return $request['response']->shapeError([],"Не хватает обязательных данных");
        }
        $arFilter = Array("IBLOCK_ID" => $request['postList']['IBLOCK_ID'], "ACTIVE"=>"Y", "PROPERTY_CML2_LINK" => $request['postList']['ID']);
        
        foreach($request['postList']['filter']['default'] as $key => $value) {
            $arFilter[$key] = $value == "false" ? false : $value;
        }
        $res = \CIBlockElement::GetList(Array(), $arFilter, ['PROPERTY_KOLLEKTSIYA', 'PROPERTY_TIP_OBIVKI']);
        while($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arResult[$arFields['PROPERTY_TIP_OBIVKI_VALUE']][] = $arFields['PROPERTY_KOLLEKTSIYA_VALUE'];
        }
        return $request['response']->shapeOk($arResult,"");
    }

    public static function actionGetPropDownSkuByElementId() {
        $request = self::getRequestObj();
        $arResult = [];
        if(!Loader::includeModule("iblock")) {
            return $request['response']->shapeError([],"Не найден модуль iblock");
        }
        if(!$request['postList']['ID'] || !$request['postList']['IBLOCK_ID']) {
            return $request['response']->shapeError([],"Не хватает обязательных данных");
        }
        $arFilter = Array("IBLOCK_ID" => $request['postList']['IBLOCK_ID'], "ACTIVE"=>"Y", "PROPERTY_CML2_LINK" => $request['postList']['ID']);
        
        foreach($request['postList']['filter']['default'] as $key => $value) {
            $arFilter[$key] = $value == "false" ? false : $value;
        }
        $res = \CIBlockElement::GetList(Array(), $arFilter, ['PROPERTY_KATEGORIYA_TSENY', 'PROPERTY_TIP_OBIVKI']);
        while($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arResult[$arFields['PROPERTY_TIP_OBIVKI_VALUE']][] = $arFields['PROPERTY_KATEGORIYA_TSENY_VALUE'];
        }
        return $request['response']->shapeOk($arResult,"");
    }

    public static function actionGetProductMinimalPriceByParams () {
        $request = \RaStudio\Ajax\Response::getRequestObj();
        $arFilter = [];
        if(!Loader::includeModule("iblock")) {
            return $request['response']->shapeError([],"Не найден модуль iblock");
        }
        if(!Loader::includeModule("catalog")) {
            return $request['response']->shapeError([],"Не найден модуль catalog");
        }
        if(!$request['postList']['IBLOCK_ID']) {
            return $request['response']->shapeError([],"Не хватает обязательных данных");
        }
        $iblock_info = \CCatalogSKU::GetInfoByProductIBlock($request['postList']['IBLOCK_ID']);
        $arFilter += array(
            "IBLOCK_ID" => $iblock_info["IBLOCK_ID"],
            "PROPERTY_" . $iblock_info["SKU_PROPERTY_ID"] => $request['postList']['ID'],
            "ACTIVE" => "Y",
        );
        if($request['postList']['filter']['default']) {
            foreach($request['postList']['filter']['default'] as $key => $value) {
                $arFilter[$key] = $value == "false" ? false : $value;
            }
        }
        if($request['postList']['filter']['value']){
            $arFilter += $request['postList']['filter']['value'];
        }
        $arFilter['!catalog_PRICE_1'] = false;
        $res = \CIBlockElement::GetList(
            array("catalog_PRICE_1" => "ASC"),
            $arFilter,
            false,
            array("nPageSize"=>1)
        );
        while($ob = $res->GetNextElement()) {
            $arTemp = $ob->GetFields();
            $arTemp['PROPERTIES'] = $ob->GetProperties();
            $arTemp = self::tempalateProductInfo($arTemp, $arTemp['ID'], $arTemp['IBLOCK_ID']);
            $arResult = $arTemp;
        }
        return $request['response']->shapeOk($arResult,"");
    }

    //-----------------------------------OLD------------------------------------------

    public static function actionGetMinPrice() {
        $request = \RaStudio\Ajax\Response::getRequestObj();
        $ID = $request['postList']['ID'];
        $IBLOCK_ID = $request['postList']['IBLOCK_ID'];
        $FILTER = $request['postList']['FILTER'];
        $FILTER["!PROPERTY_FILTER_COLOT"] = false;
        $getgroup = true;
        if($request['postList']['getgroup']) {
            $getgroup = $request['postList']['getgroup'];
        }
        return \RaStudio\SkuOffer::actionGetMinPrice($ID,$IBLOCK_ID,$FILTER,$getgroup);
    }

    public static function actionGetPriceSKU() {
        $request = self::getRequestObj();
        global $USER;
        if(!Loader::includeModule("catalog")) {
            return $request['response']->shapeError([],"Не найден модуль catalog");
        }
        if(!$request['postList']['ID'] || !$request['postList']['IBLOCK_ID']) {
            return $request['response']->shapeError([],"Не хватает обязательных данных");
        }
        $arResult = \CCatalogProduct::GetOptimalPrice($request['postList']['ID'], $request['postList']['IBLOCK_ID'], $USER->GetUserGroupArray(), 'N');
        $arResult["PRICE_OUT"] = [
            "BASE_PRICE" => number_format($arResult['RESULT_PRICE']['BASE_PRICE'], 0, '.', ' '),
            "DISCOUNT_PRICE" => number_format($arResult['RESULT_PRICE']['DISCOUNT_PRICE'], 0, '.', ' '),
            "CURRENCY" => $arResult['RESULT_PRICE']['CURRENCY'],
            "DISCOUNT" => number_format($arResult['RESULT_PRICE']['DISCOUNT'], 0, '.', ' '),
        ];
        return $request['response']->shapeOk($arResult,"Цена для ".$request['postList']['ID']);
    }



    public static function actionGetPrice($ID, $IBLOCK_ID) {
        $request = self::getRequestObj();
        if(!Loader::includeModule("catalog")) {
            return $request['response']->shapeError([],"Не найден модуль catalog");
        }
        if(!$ID || !$IBLOCK_ID) {
            return false;
        }
        global $USER;
        $price = \CCatalogProduct::GetOptimalPrice($ID, $IBLOCK_ID, $USER->GetUserGroupArray(), 'N');
        $price["PRICE_OUT"] = [
            "BASE_PRICE" => number_format($price['RESULT_PRICE']['BASE_PRICE'], 0, '.', ' '),
            "DISCOUNT_PRICE" => number_format($price['RESULT_PRICE']['DISCOUNT_PRICE'], 0, '.', ' '),
            "CURRENCY" => $price['RESULT_PRICE']['CURRENCY'],
            "DISCOUNT" => number_format($price['RESULT_PRICE']['DISCOUNT'], 0, '.', ' '),
        ];
        return $price;
    }

    public static function hexToRgb($hex, $alpha = false) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ( $alpha ) {
            $rgb['a'] = $alpha;
        }
        return $rgb;
    }

    public static function resizeImgByPath($path = false) {
        if(!$path) return false;
        $ToResizeImg = $_SERVER["DOCUMENT_ROOT"].$path;
        $tempFile = $_SERVER['DOCUMENT_ROOT']."/uploadnew".$path;
        $size = array('width'=>200,'height'=>200);
        if (!file_exists($tempFile)) {
            $rif = \CFile::ResizeImageFile(
                $ToResizeImg,
                $tempFile,
                $size
            );
        }
        unlink($ToResizeImg);
        rename($tempFile, $ToResizeImg);
        return $rif;
    }

}