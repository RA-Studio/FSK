<?php

namespace RaStudio\Ajax;

use Bitrix\Sale;
use \Bitrix\Main\Application;
use Bitrix\Main\Loader;
use \Bitrix\Catalog\Product\Basket;
use RaStudio\Api\LoggerAdapter;

class AjaxBasket {

    const quantity = 1;

    public static function getRequestObj(){
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        return [ "response" =>  $response, "postList" => $postList ];
    }

    //Добаляем товар в корзину по ID
    public static function actionAddInBasketById($ID = false, $prop = [], $quantity = 1) {
        $request = self::getRequestObj();

        if(!Loader::includeModule("catalog")) {
            return $request['response']->shapeError([],"Не найден модуль catalog");
        }
        if(!$request['postList']['ID']) {
            return $request['response']->shapeError([],"Нельзя добавить в корзину без ID товара");
        }

        $fields = [
            'PRODUCT_ID' => $request['postList']['ID'],
            'QUANTITY' => $quantity > 0 ? $quantity : self::quantity,
            'PROPS' => $request['postList']['PROPERTIES'],
        ];

        $arResult = \Bitrix\Catalog\Product\Basket::addProduct($fields);
        $arResult = $arResult->isSuccess() ? $arResult : $arResult->getErrorMessages();
        return $request['response']->shapeOk($arResult,"Товар успешно добавлен в корзину");
    }

    //Добаляем товар в корзину по ID
    public static function actionAddInBasketByIdNew() {
        $request = self::getRequestObj();
        if(!Loader::includeModule("catalog")) {
            return $request['response']->shapeError([],"Не найден модуль catalog");
        }
        if(!$request['postList']['ID']) {
            return $request['response']->shapeError([],"Нельзя добавить в корзину без ID товара");
        }
        if (Loader::includeModule("sale")) {
            $arFields = array(
                "PRODUCT_ID" => $request['postList']['ID'],
                "PRODUCT_PRICE_ID" => 0,
                "CURRENCY" => "RUB",
                "WEIGHT" => 0,
                "QUANTITY" => 1,
                "LID" => LANG,
                "DELAY" => "N",
                "CAN_BUY" => "Y",
                //"CALLBACK_FUNC" => "MyBasketCallback",
                //"MODULE" => "my_module",
                //"NOTES" => "",
                //"ORDER_CALLBACK_FUNC" => "MyBasketOrderCallback",
                //"DETAIL_PAGE_URL" => "/".LANG."/detail.php?ID=51"
            );

            if($request['postList']['NAME']) {
                $arFields["NAME"] = $request['postList']['NAME'];
            }
            if($request['postList']['NAME']) {
                $arFields["PRICE"] = $request['postList']['PRICE'];
            }
            if($request['postList']['PROPERTIES']){
                $arFields["PROPS"] = $request['postList']['PROPERTIES'];
            }
            return $request['response']->shapeOk(\CSaleBasket::Add($arFields),"Товар успешно добавлен в корзину");
        }

    }

    //Получить корзину пользователя
    public static function actionGetBasketObj() {
        $request = self::getRequestObj();

        if(!Loader::includeModule("sale")) {
            return $request['response']->shapeError([],"Не найден модуль sale");
        }
        
        return Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), \Bitrix\Main\Context::getCurrent()->getSite());
    }

    //Получить корзину заказа по объекту заказа
    public static function actionGetBasketObjByOrderObj($order) {
        if(!$order) return ["ERROR" => "Для корректной работы необходим объект заказа"];
        return $basket = \Sale\Basket::loadItemsForOrder($order);
    }

    //Получить корзину заказа по номеру заказа
    public static function actionGetBasketObjByOrderNum($ordernum) {
        if(!$ordernum) return ["ERROR" => "Для корректной работы необходим номер заказа"];
        return $basket = \Sale\Basket::loadItemsForOrder($ordernum);
    }

    //Краткий массив данных корзины
    public static function actionGetDataBasket(){
        $basket = self::actionGetBasketObj();
        return $basket->getListOfFormatText();
    }

    public static function actionGetCountInBasket() {
        $request = self::getRequestObj();
        $basket = self::actionGetBasketObj();
        return $request['response']->shapeOk(array_sum($basket->getQuantityList()),"Товара в корзине");
    }



}