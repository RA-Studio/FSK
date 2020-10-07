<?php
namespace RaStudio\Ajax;

use \Bitrix\Main\Application;
use \RaStudio\Helper;
use \RaStudio\User;
use \RaStudio\Table\OrderTable;
use \RaStudio\Api\LoggerAdapter;
use \Bitrix\Main\Mail\Event as Event;
use RaStudio\Api\RestApi as RestApi;
use RaStudio\Api\ShopWorker;
use \RaStudio\Cart;
use \RaStudio\Api\ApiController;

\CModule::IncludeModule("iblock");
\CModule::IncludeModule("main");

class AjaxOrder {

    public static function actionConfirmOrderDdu () {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        if(!isset($postList['orderID']) || empty($postList['orderID'])) return $response->shapeError([], 'Заказ не найден');
        $status = $postList['status'] ? : 4;

        OrderTable::updateData($postList['orderID'], [ OrderTable::COL_CONTACT_CONFIRM => 'Y' ]);
        OrderTable::setStatus($postList['orderID'], $status);
        return $response->shapeOk(['status' => $status], 'Данные подтверждены');
    }
    public static function actionSetStatus() { //not use
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        if(!isset($postList['orderID']) || empty($postList['orderID'])) return $response->shapeError([], 'Заказ не найден');
        if(!isset($postList['status']) || empty($postList['status'])) return $response->shapeError([], 'Нет статуса');
        OrderTable::setStatus($postList['orderID'], $postList['status']);
    }
    public static function actionCkeckDduFileByOrder() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        if(!isset($postList['orderID']) || empty($postList['orderID'])) {
            return $response->shapeError([], 'Заказ не найден');
        }
        $contract = OrderTable::getDduFileByOrder($postList['orderID']);
        if(!$contract) return $response->shapeError([], 'constractEmpty');
        return $response->shapeOk([ 'contract' => $contract ], 'Ваша заявка принята');
    }
    public static function actionSaveFileOrder() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();

        $reserve = $postList['reserve'];
        $dir = $postList['dir'] ? : 'ddu';
        $files = $_FILES['files'];
        $documentList = [];

        foreach ($files['name'] as $userKey => $fileType) {
            foreach ($fileType as $typeDocument => $file) {
                $fileData = ApiController::formateFileArray($files, $userKey, $typeDocument);
                foreach ($fileData['files'] as &$value) {
                    $value = ApiController::saveFileOrder($reserve, "/$dir/$userKey/$typeDocument/", $value['name'], $value['tmp_name']);
                    $documentList[$dir][$userKey][$typeDocument][] = $value;
                }
            }
        }
        if($postList['saveInOrder'] == "Y") {
            $order = OrderTable::getOrderByReserve($reserve);
            $orderFile = $order[OrderTable::COL_ORDER_FILE];
            $orderUsers = $order[OrderTable::COL_ORDER_INFO];
            $orderFile = json_decode($orderFile ? : "{}", true);
            $orderUsers = json_decode($orderUsers ? : "{}", true);
            $dataTo1C = [ "order_guid" => $reserve ];
            foreach($documentList as $dirKey => $dirArray) {
                foreach($dirArray as $userKey => $userArray) {
                    $user = $orderUsers[$userKey]['data'];
                    foreach($userArray as $typeKey => $documents) {
                        $orderFile[$dirKey][$userKey][$typeKey] = $documents;
                        foreach ($documents as $document) {
                            $dataTo1C['files'][] = [
                                'firstName' => $user['firstName']['value'],
                                'secondName' => $user['middleName']['value'],
                                'lastName' => $user['lastName']['value'],
                                'fileType' => ShopWorker::getNameFrom1C($typeKey),
                                'fullfilename' => basename($document),
                                'encodedFile' => base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].$document)),
                            ];
                        }
                    }
                }
            }
            $requestFrom1C = ShopWorker::addFiles($dataTo1C);
            if($requestFrom1C['status'] !== 'ok') {
                return $response->shapeError([], 'Ошибка, обратитесь к администратору');
            }
            $save = [ OrderTable::COL_ORDER_FILE => json_encode($orderFile, JSON_UNESCAPED_UNICODE) ];
            if($postList['status']) OrderTable::setStatus($order['ID'], $postList['status']);
            OrderTable::updateData($order['ID'], $save);
        }
        return $response->shapeOk($fileData, 'Файлы загружены');
    }
    public static function actionSaveFileAnketa() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        $reserve = $postList['reserve'];
        $dir = $postList['dir'] ? : 'ddu';
        $files = $_FILES['files'];
        $user = key($files['name']);
        $typeDocument = key($files['name'][$user]);
        $fileData = ApiController::formateFileArray($files, $user, $typeDocument);
        foreach ($fileData['files'] as &$value) {
            $value = ApiController::saveFileOrder($reserve, "/$dir/$user/$typeDocument/", $value['name'], $value['tmp_name']);
        }
        //LoggerAdapter::add("Файлы для заказа ($reserve) пользователя: $user");
        return $response->shapeOk($fileData, 'Файлы загружены');
    }
    public static function actionSaveAnketa() {

        global $USER;
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        $order = OrderTable::getOrderById($postList['orderData']['order']);
        $orderFile = json_decode($order[OrderTable::COL_ORDER_FILE] ? : "{}", true);
        $orderID = $postList['orderID'];
        $data = $postList['data'];

        foreach($postList['files'] as $value) {
            if($value['userID']) $orderFile['ddu'][$value['userID']][$value['fileType']] = array_values($value['files']);
        }

        if(!isset($orderID) || empty($orderID)) return $response->shapeError([], 'Заказ не найден');
        $userGuid = User::getUserXmlIdByID($USER->GetID());
        $postList['orderData']['userGUID'] = $userGuid ;

        /*
        $sendTo1C = ShopWorker::formattingDataPurchase($postList, $orderFile);
        $request = ShopWorker::purchaseCreate($sendTo1C);
        if($request === false || $request['status'] == 'error') {
            LoggerAdapter::add("Ошибка формирования договора:\n```".$request['description']."```");
            return $response->shapeError([], 'Ошибка формирования договора, пожалуйста обратитесь к администратору');
        }
        */

        $status = 3;
        OrderTable::updateData($orderID, [
            OrderTable::COL_PAY_TYPE => $postList['payType'],
            OrderTable::COL_ORDER_INFO => json_encode($data, JSON_UNESCAPED_UNICODE),
            OrderTable::COL_ORDER_FILE => json_encode($orderFile, JSON_UNESCAPED_UNICODE),
        ]);
        $data = [];
        if($postList['payType'] == 'mortgage') {
            $data = ['statusMode'=>"A"];
        }
        ///////////////////////////////////////////////////////////////////////////////////
        $profile = ShopWorker::formatDataProfileFrom1C($postList, $userGuid, $orderFile);
        $requestProfile1c = ShopWorker::createProfile($profile);
        ///////////////////////////////////////////////////////////////////////////////////
        if($requestProfile1c['status'] !== 'ok') {
            return $response->shapeError([], 'Ошибка формирования договора, пожалуйста обратитесь к администратору');
        }
        OrderTable::setStatus($orderID, $status, $data);
        return $response->shapeOk(['status' => $status], 'Ваша заявка принята');
    }
    private static function formationApartmentMass($apatmentID, $arResult) {
        $apartment = Cart::getApartmentByIDs($apatmentID, ['*', "PROPERTY_*"], true);
        foreach($arResult as $key => &$order) {
            $apart = $apartment[$order[OrderTable::$orderField['UF_PRODUCT']]];
            $order['apartmentName'] = $apart['NAME'];
            $order['apartmentNum'] = number_format($apart['CODE'], 0, '.', ' ');
            $order['apartmentLink'] = "/detail.php?ID=".$apart['ID'];
            $images = array();
            foreach($apart['PROPERTIES']['image']['VALUE'] as $keyImg => $idImage) {
                $images['big'][$apart['PROPERTIES']['image']['DESCRIPTION'][$keyImg]] = \CFile::GetPath($idImage);
                $images['min'][$apart['PROPERTIES']['image']['DESCRIPTION'][$keyImg]] = \CFile::ResizeImageGet($idImage, array("width" => 667, "height" => 586), BX_RESIZE_IMAGE_PROPORTIONAL, false)['src'];
            }
            $order['apartment'] = array(
                "name" => $apart['NAME'],
                "number" => number_format($apart['CODE'], 0, '.', ' '),
                "link" => "/detail.php?ID=".$apart['ID'],
                "status" => $apart['PROPERTIES']['UF_STATUS']['VALUE'],

                "area" => $apart['PROPERTIES']['area']['VALUE'],
                "kitchenSpace" => $apart['PROPERTIES']['kitchenspace']['VALUE'],
                "livingSpace" => $apart['PROPERTIES']['livingspace']['VALUE'],

                "builtYear" => $apart['PROPERTIES']['builtyear']['VALUE'],
                "category" => $apart['PROPERTIES']['category']['VALUE'],
                "apartments" => $apart['PROPERTIES']['apartments']['VALUE'],
                "rooms" => $apart['PROPERTIES']['rooms']['VALUE'],
                "studio" => $apart['PROPERTIES']['studio']['VALUE'],
                "floor" => $apart['PROPERTIES']['floor']['VALUE'],
                "floorsTotal" => $apart['PROPERTIES']['floorstotal']['VALUE'],
                "image" => $images,
                "price" => $apart['PROPERTIES']['price']['VALUE'],
                "price100" => $apart['PROPERTIES']['price100']['VALUE'],
                "priceGrant100" => $apart['PROPERTIES']['priceGrant100']['VALUE'],
                "priceOnline100" => $apart['PROPERTIES']['priceOnline100']['VALUE'],
                "propertyType" => $apart['PROPERTIES']['propertytype']['VALUE'],
                "renovation" => $apart['PROPERTIES']['renovation']['VALUE'],
            );
        }
        return $arResult;
    }
    public static function actionGetAllByID() {
        $start = microtime(true);
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global $USER;

        if (!$USER->IsAuthorized()) {
            return $response->shapeError(['message' => 'Ваша сессия закончилась'], 'authError');
        }

        $userId = $USER->GetID();
        $orders = OrderTable::getItemsByUserId($userId);
        $orderOld = OrderTable::getLastOrderByUserIDFullAnket($userId);
        $arResult = [];
        $apatmentID = [];
        foreach($orders as $keyOrder => $order) {
            $apatmentID[] = $order['UF_PRODUCT'];
            $arResult[$keyOrder] = OrderTable::formateOrderData($order, OrderTable::formateOrderData($orderOld));
        }
        $arResult = self::formationApartmentMass($apatmentID, $arResult);
        $time = microtime(true) - $start;
        return $response->shapeOk($arResult, 'ok_'.$time);
    }
    public static function actionGetByID() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global $USER;

        if (!$USER->IsAuthorized()) {
            return $response->shapeError(['message' => 'Ваша сессия закончилась'], 'authError');
        }
        $userId = $USER->GetID();
        $order = OrderTable::getOrderById($postList['orderID']);
        if(empty($order) || $order[OrderTable::COL_USER_ID] !== $userId) {
            return $response->shapeError([], 'Заказ не найден');
        }
        $arResult = [];
        $apatmentID = [];
        $apatmentID[] = $order['UF_PRODUCT'];
        $arResult[] = OrderTable::formateOrderData($order, []);
        $arResult = self::formationApartmentMass($apatmentID, $arResult);
        return $response->shapeOk($arResult[0], 'ok');
    }
    public static function actionSetStateOrder() { // not use

        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global $USER;

        if ($USER->IsAuthorized()) $userId = $USER->GetID();

        $order = OrderTable::getOrderById($postList['order']);
        $userGuid = User::getByLogin(Helper::parsePhone($order[OrderTable::COL_PHONE]))['XML_ID'];

        $arSelect = array (
            "ID",
            "IBLOCK_ID",
            "NAME",
            "DETAIL_PAGE_URL",
            "PREVIEW_PICTURE",
            "PROPERTY_GALLEREYA",
            'PROPERTY_PRICE',
            'CODE',
        );

        $arFilter = Array("IBLOCK_ID"=> 1, "ACTIVE"=>"Y", "ID" => $order[OrderTable::COL_BASKET]);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arElement = [];

        while($ob = $res->GetNextElement()){
            $arElement = $ob->GetFields();
            $arElement['PROPERTIES'] = $ob->GetProperties();
        }



        if($postList['type'] == 'success') {

            $request = ShopWorker::confirmReservation([
                'order_guid' => $order[OrderTable::COL_RESERVE],
                'client_guid' => $userGuid,
                'flat_id' => $arElement['CODE'],
                'pay_type' => 'Полная',
            ]);

            if($request['status'] == 'ok') {
                OrderTable::setStatus($order['ID'], 2);
                return $response->shapeOk($request, 'ok');
            } else {
                return $response->shapeError([
                    'message' => 'Ошибка, обратитесь к администратору'
                ], 'invalidType');
            }


        } else if ($postList['type'] == 'cancel') {

            $request = ShopWorker::canselReservation([
                'order_guid' => $order[OrderTable::COL_RESERVE],
                'client_guid' => $userGuid,
                'flat_id' => $arElement['CODE'],
            ]);

            if($request['status'] == 'ok') {
                OrderTable::setStatus($order['ID'], 0);
                return $response->shapeOk($request, 'ok');
            } else {
                return $response->shapeError([
                    'message' => 'Ошибка, обратитесь к администратору'
                ], 'invalidType');
            }

        }

        return $response->shapeError([
            'message' => 'Ошибка чтения данных'
        ], 'invalidType');
    }
    public static function actionCreatedOrder() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global $USER;

        if($postList['json']) {
            $postList = json_decode($postList['json'], true);
        }

        if(!$postList['first_name']) $error = "first_name";
        if(!$postList['last_name']) $error = "last_name";
        if(empty($postList['product']))  $error = "empty";
        if(empty($postList['email']))  $error = "email";
        if(empty($postList['tel']))  $error = "tel";

        if($error != false) {
            return $response->shapeError([], $error);
        }
        $userId = false;
        if($_SESSION['authSMS'] != hash('md5', $postList['sms'])) {
            return $response->shapeError([], 'notsms');
        } else {
            if (!$USER->IsAuthorized()) {
                $userData = User::registerUser(Helper::parsePhone($postList['tel']), [$postList['first_name'], $postList['last_name']], $postList['sms'], $postList['sms'], $postList['email']);
                if($userData['ID']) {
                    $USER->Authorize($userData['ID']);
                    $dataSend = array( "lastName" => $postList['last_name'], "firstName" => $postList['first_name'], "secondName" => '', "phone" => $postList['tel'] );
                    $result1C = ShopWorker::createdUser($dataSend);
                    if($result1C['status'] == 'ok') {
                        User::updateUser($userData['ID'], ['XML_ID' => $result1C['guid']]);
                    } else return $response->shapeError([], 'error1C');
                }
                if(!$userData['ID']) {
                    $ID = User::getByLogin(Helper::parsePhone($postList['tel']))['ID'];
                    $USER->Authorize($ID);
                    $userId = $ID;
                }
            }
        }

        if ($USER->IsAuthorized() && $userId === false) $userId = $USER->GetID();

        $error = false;
        $arSelect = array ("ID","IBLOCK_ID","NAME","DETAIL_PAGE_URL","PREVIEW_PICTURE","PROPERTY_GALLEREYA",'PROPERTY_PRICE','CODE');
        $arFilter = Array("IBLOCK_ID"=>$postList['iblock'], "ID" => $postList['product']);//, "ACTIVE"=>"Y"
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        $arElement = [];
        $basketPrice = 30000;
        $basket = [];
        while($ob = $res->GetNextElement()){
            $arElement = $ob->GetFields();
            $arElement['PROPERTIES'] = $ob->GetProperties();
        }

        global $USER;

        $userGuid = User::getByLogin(Helper::parsePhone($postList['tel']))['XML_ID'];

        //$userGuid = User::getUserXmlIdByID($USER->GetID());

        if(empty($arElement['CODE'])) {
            return $response->shapeError([], 'apartmentnotexist');
        }
        if(empty($userGuid)) {
            return $response->shapeError([], 'usernotregister');
        }

        $salt = uniqid('', true);
        $hash = substr(sha1($userGuid . $salt . $arElement['CODE']), 0, 36);


        $dataSend = array( "client_guid" => $userGuid, "flat_id" => $arElement['CODE'], 'order_guid' => $hash);
        $result = ShopWorker::createReservation($dataSend);

        if($result['status'] != 'ok' || empty($result['status']) || !isset($result['status'])) {
            return $response->shapeError([ 'message' => $result['description'] ], 'errorfrom1C');
        }

        $reservationGUID = $hash;

        if($basketPrice < 1) return $response->shapeError([], 'nonexistent');//94

        $email = $postList['email'];
        $field = [
            'user' => $userId,
            'email' => $email,
            'first_name' => $postList['first_name'],
            'last_name' => $postList['last_name'],
            'product'=> $postList['product'],
            'basket' => $postList['basket']?$postList['basket']:$postList['product'],
            'price' => $basketPrice,
            'phone' => Helper::parsePhone($postList['tel']),
            'comment' => str_replace('\n', '</br>', $postList['comment']),
            'reservation' => $reservationGUID,
            'payType' => $postList['payType'],
        ];

        $result = OrderTable::save($field);
        $order = $result['result'];
        $hash = $result[OrderTable::COL_HASH];

        if (!$order->isSuccess()) {
            return $response->shapeError([], $order->getErrorMessages());
        }
        $orderId = $order->getId();

        $CURRENT_PAGE = (\CMain::IsHTTPS()) ? "https://" : "http://";
        $CURRENT_PAGE .= $_SERVER["HTTP_HOST"];

        $mess = "
            <p>".$postList['first_name']." ".$postList['last_name'].", Вы успешно забронировали квартиру!</p>
            <p>Наш менеджер свяжется с Вами в ближайшее время.</p>
        ";
        if ($USER->IsAuthorized()) $mess .= " или в <a href='$CURRENT_PAGE/lk/order/'>личном кабинете";

        $arEventFields = array(
            "MESSAGE" => $mess,
            "EMAIL" => $postList['email'],
            "EVENT_NAME" => "Вы успешно забронировали квартиру!",
            "NAME" => $postList['first_name'],
            "LAST_NAME"=>$postList['last_name'],
            "PHONE"=>$postList['tel'],
            "PRICE"=>$postList['price'],
            "ARTICLE"=>$arElement['CODE'],
            "ORDER_ID"=>$orderId,
            "BASKET"=>json_encode($arElement),
        );
        /*Event::send(array(
            "EVENT_NAME" => "EVENT_SEND_MESSAGE",
            "LID" => "s1",
            "C_FIELDS" => $arEventFields,
        ));*/
        $_SESSION['RESERVE_SENT'] = '';
        $_SESSION['RESERVE_SEND_TIME']=time();


        return $response->shapeOk(['ORDER_ID'=>$orderId], 'ok');
        //return $response->shapeError(['user' => 'no'], 'пользователь не авторизирован');
    }
    public static function actionSavePayType() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        if(!$postList['orderID']) {
            return $response->shapeError([], 'Не задан номер заказа');
        }
        if(!$postList['payType']) {
            return $response->shapeError([], 'Не задан тип оплаты');
        }
        if(!$postList['email']) {
            return $response->shapeError([], 'email обязателен для заполнения');
        }
        OrderTable::updateData($postList['orderID'], [
            OrderTable::COL_PAY_TYPE => $postList['payType'],
            OrderTable::COL_EMAIL => $postList['email'],
        ]);
        return $response->shapeOk([], 'ok');
    }
}
?>
