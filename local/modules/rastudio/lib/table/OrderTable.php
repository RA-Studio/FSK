<?php

namespace RaStudio\Table;

use \Bitrix\Main\Application;
use Bitrix\Main;
use \Bitrix\Main\Mail\Event as Event;

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
    
    public static function  getTableName() {
        return self::TABLE_NAME;
    }
    public static function  getMap() {
        return [
            'ID' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => \Bitrix\Main\Localization\Loc::getMessage('ORDERS_ENTITY_ID_FIELD'),
            ],
            new \Bitrix\Main\Entity\TextField(self::COL_PRODUCT, [
                'save_data_modification' => function () {
                    return [ function ($value) { return serialize($value); } ];
                },
                'fetch_data_modification' => function () {
                    return [
                        function ($value) {
                            return unserialize($value);
                        }
                    ];
                }
            ]),
            self::COL_USER_ID => array(
                'data_type' => 'float',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_USER_FIELD'),
			),
			self::COL_EMAIL => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_EMAIL_FIELD'),
			),
			self::COL_PHONE => array(
                'data_type' => 'text',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_PHONE_FIELD'),
			),
			self::COL_USER_NAME => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_USER_NAME_FIELD'),
			),
			self::COL_SECOND_NAME => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_SECOND_NAME_FIELD'),
			),
			self::COL_COMMENT => array(
                'data_type' => 'text',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_COMMENT_FIELD'),
			),
			self::COL_IP_ADRESS => array(
                'data_type' => 'text',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_IP_ADRESS_FIELD'),
			),
			self::COL_BASKET => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_BASKET_FIELD'),
			),
			self::COL_PRICE => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_PRICE_FIELD'),
            ),
            self::COL_DATA_CREATED => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_DATA_CREATED_FIELD'),
			),
			self::COL_DATA_UPDATE => array(
                'data_type' => 'text',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_DATA_UPDATE_FIELD'),
            ),
            self::COL_HASH => array(
                'data_type' => 'text',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_DATA_CREATED_FIELD'),
			),
            self::COL_HASH_CONFIRM => array(
                'data_type' => 'text',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_DATA_CREATED_FIELD'),
            ),
            self::COL_HASH_CONFIRM => array(
                'data_type' => 'text',
                'required' => false,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_DATA_CREATED_FIELD'),
            ),
            self::COL_STATUS => array(
                'data_type' => 'integer',
                'required' => true,
				'title' => \Bitrix\Main\Localization\Loc::getMessage('_ENTITY_UF_STATUS_FIELD'),
			),
        ];
    }
    public static function getItemsByUserId($userId) {
        if (empty($userId)) {
            return  false;
        }
        $param = [
            'order' => [
                'ID' => "DESC",
            ],
            'filter' => [
                self::COL_USER_ID => $userId,
            ],
        ];
        $orders = self::getList($param)->fetchAll();
        return $orders;
    }
    public static function getOrderList($params) {
        if (empty($params)) {
            return  false;
        }
        $param = [
            'order' => [
                'ID' => "DESC",
            ],
            'filter' => $params,
        ];
        $orders = self::getList($param)->fetchAll();
        return $orders;
    }
    public static function getOrderById($id) {
        if (empty($id)) {
            return  false;
        }
        $param = [
            'order' => [
                'ID' => "DESC",
            ],
            'filter' => ['ID'=>$id],
        ];
        $orders = self::getList($param)->fetchAll();
        return array_pop($orders);
    }
    public static function getItemByHash($hash) {
        if (empty($hash)) {
            return  false;
        }
        $param = [
            'filter' => [
                self::COL_HASH => $hash,
            ],
        ];
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
            ],
        ];
        $result = self::add($data);
        $arResult = [
            'result' => $result,
            self::COL_HASH => $data['fields'][self::COL_HASH],
            self::COL_HASH_CONFIRM => $data['fields'][self::COL_HASH_CONFIRM],
        ];
        return $arResult;
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
            'PROPERTY_PRICE',
        );
        $arElement = [];
        if (\CModule::IncludeModule("iblock")) {
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arElement = $ob->GetFields();
            }
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
            "ARTICLE"=>$arElement['CODE'],
            "ORDER_ID"=>$orderId,
            "EVENT_NAME" => "RESERVE_SUCCESS",

        );
        $sent = Event::send(array(
            "EVENT_NAME" => "RESERVE_SUCCESS",
            "LID" => "s1",
            "C_FIELDS" => $arEventFields,
        ));

        //return print_r($sent);
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
        $arElement = [];
        if (\CModule::IncludeModule("iblock")) {
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array(),$arSelect);
             if($ob = $res->GetNextElement()){
                 $arElement = $ob->GetFields();
             }
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

         );
         $sent = Event::send(array(
             "EVENT_NAME" => "RESERVE_ERROR",
             "LID" => "s1",
             "C_FIELDS" => $arEventFields,
         ));

         return $sent;
    }

    public static function orderCancel($orderId, $status){
        self::update($orderId, array('ID'=>$orderId,'UF_STATUS'=>$status));
    }

}