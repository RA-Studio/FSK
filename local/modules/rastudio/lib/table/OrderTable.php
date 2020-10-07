<?php

namespace RaStudio\Table;

use \Bitrix\Main\Application;
use Bitrix\Main;
use \Bitrix\Main\Mail\Event as Event;
use RaStudio\Api\LoggerAdapter;
use RaStudio\Api\ShopWorker;
use RaStudio\Api\ApiController;


class OrderTable extends Main\Entity\DataManager {

    const TABLE_NAME = 'ordertable';

    const COL_USER_ID = 'UF_USER'; //false
    const COL_EMAIL = 'UF_EMAIL'; //true
    const COL_PHONE = 'UF_PHONE'; //false
    const COL_USER_NAME = 'UF_USER_NAME'; //true
    const COL_SECOND_NAME = 'UF_SECOND_NAME'; //true
    const COL_COMMENT = 'UF_COMMENT'; //false
    const COL_IP_ADRESS = 'UF_IP_ADRESS'; //false
    const COL_PRODUCT = 'UF_PRODUCT'; //true
    const COL_BASKET = 'UF_BASKET'; //true
    const COL_PRICE = 'UF_PRICE'; //true
    const COL_DATA_CREATED = 'UF_DATA_CREATED'; //true
    const COL_DATA_UPDATE = 'UF_DATA_UPDATE'; //true
    const COL_HASH = "UF_HASH"; //false
    const COL_HASH_CONFIRM = "UF_HASH_CONFIRM"; //false
    const COL_STATUS = "UF_STATUS"; //true
    const COL_RESERVE = "UF_RESERVE"; // false
    const COL_ORDER_INFO = "UF_ORDER_INFO"; // false
    const COL_MORTGAGE_MODE = "UF_MORTGAGE_MODE"; //false
    const COL_ORDER_FILE = "UF_ORDER_FILE"; //false
    const COL_PAY_TYPE = "UF_PAY_TYPE"; //false
    const COL_DDU_FILE = "UF_DDU_FILE"; //false
    const COL_CONTACT_CONFIRM = "UF_CONTACT_CONFIRM"; // false
    const COL_1C_FILE = "UF_1C_FILE"; //false
    const COL_STATUS_MODE = "UF_STATUS_MODE";//false
    const COL_RESERVE_DATE = "UF_RESERVE_DATE";//false

    public static $orderField = [
        'ID' => 'order',
        self::COL_BASKET => 'basket',
        self::COL_COMMENT => 'comment',
        self::COL_EMAIL => 'email',
        self::COL_MORTGAGE_MODE => 'mortgageMode',
        self::COL_ORDER_FILE => 'file',
        self::COL_ORDER_INFO => 'userInfo',
        self::COL_DATA_CREATED => 'create',
        self::COL_PHONE => 'phone',
        self::COL_PRICE => 'price',
        self::COL_PRODUCT => 'apartment',
        self::COL_RESERVE => 'reserve',
        self::COL_SECOND_NAME => 'secondName',
        self::COL_STATUS => 'status',
        self::COL_USER_NAME => 'firstName',
        self::COL_PAY_TYPE => 'payType',
        self::COL_DDU_FILE => 'dduFile',
        self::COL_1C_FILE => 'file1C',
        self::COL_STATUS_MODE => 'statusMode',
        self::COL_RESERVE_DATE => "reserveDate"
    ];

    public static $statuses = [
        0 => 'Отмена',
        1 => 'Бронь',
        2 => 'Бронь оплаченая',
    ];

    public static function  getTableName() {
        return self::TABLE_NAME;
    }
    public static function getMap() {
        $required = array( 'data_type' => 'text', 'required' => true, 'title' => '');
        $notRequired = array( 'data_type' => 'text', 'required' => false, 'title' => '');
        return [
            'ID' => [ 'data_type' => 'integer', 'primary' => true, 'autocomplete' => true, 'title' => '' ],
            new \Bitrix\Main\Entity\TextField(self::COL_PRODUCT, [
                'save_data_modification' => function () { return [ function ($value) { return serialize($value); } ]; },
                'fetch_data_modification' => function () { return [ function ($value) { return unserialize($value); } ]; }
            ]),
            self::COL_USER_ID => $notRequired,
			self::COL_EMAIL => $required,
			self::COL_PHONE => $notRequired,
			self::COL_USER_NAME => $required,
			self::COL_SECOND_NAME => $required,
			self::COL_COMMENT => $notRequired,
			self::COL_IP_ADRESS => $notRequired,
			self::COL_BASKET => $required,
			self::COL_PRICE => $required,
            self::COL_DATA_CREATED => $required,
			self::COL_DATA_UPDATE => $required,
            self::COL_HASH => $notRequired,
            self::COL_HASH_CONFIRM => $notRequired,
            self::COL_HASH_CONFIRM => $notRequired,
            self::COL_STATUS => $required,
            self::COL_RESERVE => $notRequired,
            self::COL_ORDER_INFO => $notRequired,
            self::COL_MORTGAGE_MODE => $notRequired,
            self::COL_ORDER_FILE => $notRequired,
            self::COL_PAY_TYPE => $notRequired,
            self::COL_DDU_FILE => $notRequired,
            self::COL_CONTACT_CONFIRM => $notRequired,
            self::COL_1C_FILE => $notRequired,
            self::COL_STATUS_MODE => $notRequired,
            self::COL_RESERVE_DATE => $notRequired
        ];
    }
    public static function setStatus($orderID, $status, $data = [], $from1C = false) {
        $order = self::getOrderById($orderID, [ 'ID', self::COL_RESERVE, self::COL_DATA_CREATED, self::COL_ORDER_FILE, self::COL_MORTGAGE_MODE, self::COL_ORDER_INFO, self::COL_PAY_TYPE ]);
        if($from1C === false) {
            ShopWorker::sendStatusFrom1C($order, $status);
        }
        if($from1C === true) {
            ApiController::smsToStatus($status, $order);
        }
        LoggerAdapter::add("Заказ № `$orderID` изменение статуса на `$status`");
        self::updateData($orderID, [self::COL_STATUS => $status, self::COL_STATUS_MODE => $data['statusMode'] ? : ""]);
    }
    public static function getItemsByUserId($userId) {
        if (empty($userId)) return  false;
        $param = [
            'order' => [ 'ID' => "DESC" ],
            'filter' => [ self::COL_USER_ID => $userId ],
        ];
        $orders = self::getList($param)->fetchAll();
        return $orders;
    }
    public static function getOrderList($params) {
        if (empty($params)) return  false;
        $param = [
            'order' => [ 'ID' => "DESC" ],
            'filter' => $params,
        ];
        $orders = self::getList($param)->fetchAll();
        return $orders;
    }
    public static function getLastOrderByUserIDFullAnket($userId) {
        if (empty($userId)) return false;
        $param = [
            'order' => [
                'ID' => "DESC",
            ],
            'limit' => 1,
            'filter' => [
                "!".self::COL_ORDER_INFO => false,
                self::COL_USER_ID => $userId,
                ">".self::COL_STATUS => 0
            ],
        ];
        $orders = self::getList($param)->fetchAll();
        return array_pop($orders);
    }
    public static function getOrderById($id, $select = false) {
        if (empty($id)) {
            return  false;
        }
        $param = [ 'filter' => ['ID'=> $id] ];
        if($select !== false) $param['select'] = $select;
        $orders = self::getList($param)->fetchAll();
        return array_pop($orders);
    }
    public static function getOrderByReserve($reserve) {
        if (empty($reserve)) {
            return  false;
        }
        $param = [
            'filter' => [self::COL_RESERVE=>$reserve],
        ];
        $orders = self::getList($param)->fetchAll();
        return array_pop($orders);
    }
    public static function getItemByHash($hash) {
        if (empty($hash)) return false;
        $param = [ 'filter' => [ self::COL_HASH => $hash ] ];
        $orders = self::getList($param)->fetch();
        return $orders;
    }
    public static function save($fields) {
        if (empty($fields)) return false;
        $time = time();
        $data = [
            'fields' => [
                self::COL_USER_ID => $fields['user'],
                self::COL_DATA_CREATED => $time,
                self::COL_DATA_UPDATE => $time,
                self::COL_EMAIL => $fields['email'] ,
                self::COL_USER_NAME => $fields['first_name'],
                self::COL_SECOND_NAME => $fields['last_name'],
                self::COL_PRODUCT => $fields['product'],
                self::COL_BASKET => $fields['basket'],
                self::COL_PRICE => $fields['price'],
                self::COL_PHONE => $fields['phone'],
                self::COL_COMMENT => $fields['comment'],
                self::COL_IP_ADRESS => $_SERVER['REMOTE_ADDR'],
                self::COL_HASH => md5($fields['user'].$fields['email'].$time."link"),
                self::COL_HASH_CONFIRM => md5($fields['user'].$fields['email'].$time."confirm"),
                self::COL_STATUS => 1,
                self::COL_RESERVE => $fields['reservation'],
                self::COL_PAY_TYPE => $fields['payType']
            ],
        ];
        $result = self::add($data);
        $arResult = [
            'result' => $result,
            'id' => $result->getId(),
            self::COL_HASH => $data['fields'][self::COL_HASH],
            self::COL_HASH_CONFIRM => $data['fields'][self::COL_HASH_CONFIRM],
        ];
        return $arResult;
    }
    public static function updateData($orderId, $data) {
        if (empty($data) || empty($orderId))  return false;
        $data[self::COL_DATA_UPDATE] = time();
        $data['fields'] = $data;
        $result = self::update($orderId, $data);
        return $result;
    }
    public static function sendSuccess($orderId){
        $order = self::getOrderById($orderId);
        $PRODUCT_ID = $order['UF_PRODUCT'];
        $arFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y", "ID" => $PRODUCT_ID);
        $arSelect = array (
            "ID",
            "IBLOCK_ID",
            "NAME",
            "CODE",
            "IBLOCK_SECTION_ID",
            "SECTION_ID",
            'PROPERTY_*',
        );

        $arElement = array();
        $section = array();
        //скидка в %
        $discount = 1;
        if (\CModule::IncludeModule("iblock")) {
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arElement = $ob->GetFields();
                $arElement['PROPERTIES'] = $ob->GetProperties();
                if ($arElement['PROPERTIES']['category']['VALUE'] == 'flat'){
                    $price = $arElement['PROPERTIES']['priceOnline100']['VALUE'];
                }else{
                    $price = $arElement['PROPERTIES']['price100']['VALUE'];
                }
                //$arElement['PROPERTIES']['price100']['VALUE'] = round($arElement['PROPERTIES']['price100']['VALUE']*(1-$discount/100));
            }
        }
        $nav = \CIBlockSection::GetNavChain(false, $arElement['IBLOCK_SECTION_ID']);
        $arSectionPath = $nav->GetNext();

       /* $arFilter = array('IBLOCK_ID' => $arElement['IBLOCK_ID'], 'ID'=>$arSectionPath['ID']);
        $rsSections = \CIBlockSection::GetList(array(), $arFilter);
        if ($arSection = $rsSections->Fetch())
        {
            $section = $arSection;
        }*/
        $mess = "
            <p>".$order['UF_USER_NAME']." ".$order['UF_SECOND_NAME'].", Вы успешно забронировали квартиру!</p>
            <p>Наш менеджер свяжется с Вами в ближайшее время.</p>
        ";

        $arEventFields = array(
            "MESSAGE" => $mess,
            "EMAIL" => $order['UF_EMAIL'],
            "NAME" => $order['UF_USER_NAME'],
            "LAST_NAME"=>$order['UF_SECOND_NAME'],
            "PHONE"=>$order['UF_PHONE'],
            "PRICE"=>$order['UF_PRICE'],
            "ARTICLE"=>$arElement['CODE'],
            "ORDER_RESERVE_DATE"=>$order['UF_RESERVE_DATE'],
            "ORDER_ID"=>$orderId,
            "EVENT_NAME" => "RESERVE_SUCCESS",
            "BASKET"=>json_encode($arElement),
            "OBJECT_NAME"=> explode(',',$arElement['NAME'])[0],
            "OBJECT_LC"=>$arSectionPath['NAME'],
            "OBJECT_SECTION"=>$arElement['PROPERTIES']['section']['VALUE'],
            "OBJECT_BUILDING_SECTION"=>$arElement['PROPERTIES']['buildingsection']['VALUE'],
            "OBJECT_PRICE"=>\CurrencyFormat($price, 'RUB'),
            "OBJECT_FLOOR"=>$arElement['PROPERTIES']['floor']['VALUE'],
            "OBJECT_FLAT"=>$arElement['PROPERTIES']['numberflat']['VALUE'],
            "OBJECT_AREA"=>$arElement['PROPERTIES']['area']['VALUE'].' м<sup>2</sup>',
            "OBJECT_ID"=> \CurrencyFormat($arElement['CODE'], 'NUN'),
            "OBJECT_PLAN_IMAGE"=> 'https://fsknw.ru'.\CFile::GetPath($arElement['PROPERTIES']['image']['VALUE'][0]),
        );
        $sent = Event::send(array(
            "EVENT_NAME" => "RESERVE_SUCCESS",
            "LID" => "s1",
            "C_FIELDS" => $arEventFields,
        ));
        return $sent;
    }

    public static function sendError($orderId){
        $order = self::getOrderById($orderId);
         $PRODUCT_ID = $order['UF_PRODUCT'];
         $arFilter = Array("IBLOCK_ID"=>1, "ID" => $PRODUCT_ID);
         $arSelect = array (
             "ID",
             "IBLOCK_ID",
             "NAME",
             "CODE",
             'PROPERTY_PRICE',
         );
        $arElement = array();
        $section = array();
        if (\CModule::IncludeModule("iblock")) {
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arElement = $ob->GetFields();
                $arElement['PROPERTIES'] = $ob->GetProperties();
            }
        }
        $nav = \CIBlockSection::GetNavChain(false, $arElement['IBLOCK_SECTION_ID']);
        $arSectionPath = $nav->GetNext();

        $arFilter = array('IBLOCK_ID' => $arElement['IBLOCK_ID'], 'ID'=>$arSectionPath['ID']);
        $rsSections = \CIBlockSection::GetList(array(), $arFilter);
        if ($arSection = $rsSections->Fetch())
        {
            $section = $arSection;
        }
         $mess = "
             <p>".$order['UF_USER_NAME']." ".$order['UF_SECOND_NAME'].", Вы успешно забронировали квартиру!</p>
             <p>Наш менеджер свяжется с Вами в ближайшее время.</p>
         ";

         $arEventFields = array(
             "MESSAGE" => $mess,
             "EMAIL" => $order['UF_EMAIL'],
             "NAME" => $order['UF_USER_NAME'],
             "LAST_NAME"=>$order['UF_SECOND_NAME'],
             "PHONE"=>$order['UF_PHONE'],
             "PRICE"=>$order['UF_PRICE'],
             "ARTICLE"=>$arElement['CODE']?$arElement['CODE']:"",
             "ORDER_ID"=>$orderId,
             "EVENT_NAME" => "RESERVE_ERROR",
             "OBJECT_NAME"=> explode(',',$arElement['NAME'])[0],
             "OBJECT_LC"=>$section['NAME'],
             "OBJECT_SECTION"=>$arElement['PROPERTIES']['section']['VALUE'],
             "OBJECT_BUILDING_SECTION"=>$arElement['PROPERTIES']['buildingsection']['VALUE'],
             "OBJECT_PRICE"=>\CurrencyFormat($arElement['PROPERTIES']['price100']['VALUE'], 'RUB'),
             "OBJECT_FLOOR"=>$arElement['PROPERTIES']['floor']['VALUE'],
             "OBJECT_AREA"=>$arElement['PROPERTIES']['area']['VALUE'].' м<sup>2</sup>',
             "OBJECT_ID"=> \CurrencyFormat($arElement['CODE'], 'NUN'),
             "OBJECT_PLAN_IMAGE"=> 'https://fsknw.ru'.\CFile::GetPath($arElement['PROPERTIES']['image']['VALUE'][0]),

         );
         $sent = Event::send(array(
             "EVENT_NAME" => "RESERVE_ERROR",
             "LID" => "s1",
             "C_FIELDS" => $arEventFields,
         ));

         return $sent;
    }

    public static function orderCancel($orderId, $status,$error){
        self::update($orderId, array('ID'=>$orderId,'UF_STATUS'=>$status));
    }
    public static function getDduFileByOrder($id){
        if (empty($id)) {
            return  false;
        }
        $param = [
            'filter' => ['ID'=>$id],
            'select' => [self::COL_DDU_FILE],
        ];
        $orders = self::getList($param)->fetchAll();
        return $orders[0][self::COL_DDU_FILE];
    }
    public static function formateOrderData($order, $lastOrder = false) {
        $arResult = [];
        foreach(self::$orderField as $key => $value) {
            if(self::$orderField['UF_DATA_CREATED'] == $value) {
                $timeEnd = $order[$key] + 604800 * 2;
                $order[$key] = date("d.m.Y", $order[$key]);
                $arResult['reservationData'] = date("d.m.Y", $timeEnd);
            }
            if(self::$orderField['UF_PRICE'] == $value) $order[$key] = number_format($order[$key], 0, '.', ' ');
            $arResult[$value] = $order[$key];
        }
        $arResult['userInfo'] = $arResult['userInfo'] ? : $lastOrder['userInfo'];
        $arResult['file'] = $arResult['file'] ? : $lastOrder['file'];
        return $arResult;
    }
    public static function getItemsByApartment($apartmentID) {
        if(empty($apartmentID)) return false;
        $param = [
            'filter' => [
                self::COL_BASKET => $apartmentID,
                "!".self::COL_STATUS => 0
            ],
        ];
        $orders = self::getList($param)->fetchAll();
        return $orders;
    }
}
