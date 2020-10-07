<?php

namespace RaStudio\Api;

use \RaStudio\Config as ConfigMain;
use \RaStudio\Api\Config as ConfigAPI;
use \RaStudio\Api\ShopWorker;
use \RaStudio\Table\OrderTable;
use RaStudio\User;
use \RaStudio\Helper;
use RaStudio\Cart;

class ApiController {
    public static function action($method, $entity, $data)
    {
        try {
            $data = json_decode($data, true);
            self::methodInstanceIntegration1C($data['method'], $data['data']);
            $isCheck = true;
            if ($isCheck) {
                return [ConfigAPI::RESPONSE_STATUS_OK, print_r(json_decode($data, true),true)];
            } else {
                LoggerAdapter::add("ApiController Code:$code, $text");
                return [ConfigAPI::RESPONSE_STATUS_ERROR, '<?xml version="1.0" encoding="UTF-8"?><Ошибка><КодОшибки>'.$code.'</КодОшибки><Сообщение>'.$text.'</Сообщение></Ошибка>'];
            }
        } catch (\Exception $e) {
            LoggerAdapter::add("ApiController Code:40, " . $e->getMessage());
            return [ConfigAPI::RESPONSE_STATUS_ERROR, '<?xml version="1.0" encoding="UTF-8"?><Ошибка><КодОшибки>40</КодОшибки><Сообщение>Не известная ошибка</Сообщение></Ошибка>'];
        }
    }
    public static function formateFileArray($files, $user, $typeDocument) {
        $fileData = [
            'userID' => $user,
            'fileType' => $typeDocument,
        ];
        foreach ($files['name'][$user][$typeDocument] as $key => $value) {
            $fileData['files'][$key] = [
                'name' => $value,
                'type' => $files['type'][$user][$typeDocument][$key],
                'tmp_name' => $files['tmp_name'][$user][$typeDocument][$key],
                'error' => $files['error'][$user][$typeDocument][$key],
                'size' => $files['size'][$user][$typeDocument][$key],
            ];
        }
        return $fileData;
    }
    public static function methodAddDdu($reserve, $base64, $fileType) {
        $location = ConfigAPI::FILE_DIR;
        $path = $_SERVER['DOCUMENT_ROOT'].$location;
        $file = base64_decode($base64);
        $filePath = "/$reserve/";
        $fileName = "contract.".$fileType;
        if (!is_dir($path.$filePath) && !mkdir($path.$filePath, 0755, true)) {
            LoggerAdapter::add(" не создалась  деррикторию ".$path.$filePath);
        }
        file_put_contents($path.$filePath.$fileName, $file);
        return [ 'local' => $location.$filePath.$fileName ];
    }
    public static function saveFileOrder($reserve, $block = '/file/', $fileName = false, $fileDir = false, $base64Mode = false) {
        if($fileDir === false || $fileName === false) return false;
        $location = ConfigAPI::FILE_DIR;
        $path = $_SERVER['DOCUMENT_ROOT'].$location."/$reserve".$block;
        if (!is_dir($path) && !mkdir($path, 0755, true)) {
            LoggerAdapter::add(" не создалась  деррикторию ".$location."/$reserve".$block);
        }
        $type = explode('.', $fileName)[1];
        $str = $base64Mode ? $fileDir : file_get_contents($fileDir);
        file_put_contents($path.$fileName, $str);
        return $location."/$reserve".$block.$fileName;
    }
    public static function checkStatus($status = false, $order = false) {
        if($order[OrderTable::COL_PAY_TYPE] == "mortgage" && $status === 7) {
            if($order[OrderTable::COL_ORDER_INFO]) {
                $users = json_decode($order[OrderTable::COL_ORDER_INFO], true);
                $checkMerried = false;
                foreach ($users as $user) {
                    if($user['data']['familyStatus']['value'] === 'True') {
                        $checkMerried = true;
                    }
                }
                $status = $checkMerried ? $status : 8;
            }
        }
        if($order[OrderTable::COL_PAY_TYPE] == "full" && $status === 6) {
            if($order[OrderTable::COL_ORDER_INFO]) {
                $users = json_decode($order[OrderTable::COL_ORDER_INFO], true);
                $checkMerried = false;
                foreach ($users as $user) {
                    if($user['data']['familyStatus']['value'] === 'True') {
                        $checkMerried = true;
                    }
                }
                $status = $checkMerried ? 8 : $status;
            }
        }
        return $status;
    }
    public static function smsToStatus($status = false, $order = false) {
        if($order === false || $status === false) return false;
        if($status == $order[OrderTable::COL_STATUS]) return false;
        $messageArray = [
            "11full" => "Ваши документы поданы на регистрацию, ожидайте извещения о готовности (от 5 дней).",
            "12full" => "Поздравляем, ваш договор успешно зарегистрирован! Спасибо, что выбрали нашу компанию.",

            "3mortgage" => "В вашей анкете на приобретение недвижимости допущена ошибка. Пожалуйста, зайдите в личный кабинет и внесите исправление.",
            "5mortgage" => "Ваши документы прошли проверку, перейдите в личный кабинет для оформления анкеты на ипотеку.",
            "7mortgage" => "Доступен новый этап в личном кабинете – пожалуйста, зайдите в свой аккаунт.",
            "9mortgage" => "Ваши документы успешно прошли проверку, ожидайте звонка специалиста.",
            "10mortgage" => "Ваши документы поданы на регистрацию, ожидайте извещения о готовности (от 5 дней).",
            "11mortgage" => "Поздравляем, ваш договор успешно зарегистрирован! Спасибо, что выбрали нашу компанию",
        ];
        $message = $messageArray[$status.$order[OrderTable::COL_PAY_TYPE]] ? : false;
        if($message !== false) {
            LoggerAdapter::sendSms( $order[OrderTable::COL_PHONE], $message );
        }
    }
    public static function smsToFile($type = false, $order = false) {
        if($order === false || $type === false) return false;
        $messageArray = [
            "заявлениеукэп" => "Ваше заявление на эл. подпись сформировано в личном кабинете.",
            "выпусксертификатаукэп" => "Вам выпущена электронная подпись, необходимо проверить личный кабинет.",
            "заявлениеакредетив" => "Ваши документы успешно прошли проверку, перейдите в личный кабинет для оформления оплаты.",
        ];
        $message = $messageArray[$type] ? : false;
        if($message !== false) {
            LoggerAdapter::sendSms( $order[OrderTable::COL_PHONE], $message );
        }
    }
    public static function errorStatus($message = "") {
        echo(json_encode([
            'status' => 'error',
            'message' => $message
        ], JSON_UNESCAPED_UNICODE));
        return false;
    }
    public static function okStatus($data = [], $message = "") {
        echo(json_encode([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], JSON_UNESCAPED_UNICODE));
        return true;
    }
    public static function methodInstanceIntegration1C($method, $data) {
        LoggerAdapter::add("Вызван метод: `$method`");
        try {
            $reserve = $data['reserve'];
            $order = OrderTable::getOrderByReserve($reserve);
            switch ($method) {
                case "confirmProfile":
                    $confirm = $data['confirm'];
                    if($confirm === true) {
                        $sendTo1C = ShopWorker::formattingOrderDataFromPurchase($order['ID'], $order);
                        $request = ShopWorker::purchaseCreate($sendTo1C);
                        if($request['status'] == "ok") {
                            OrderTable::setStatus($order['ID'],3);
                        }
                    } else {
                        OrderTable::setStatus($order['ID'],2);
                        LoggerAdapter::sendSms(
                            $order[OrderTable::COL_PHONE],
                            "В вашей анкете на приобретение недвижимости допущена ошибка. Пожалуйста, зайдите в личный кабинет и внесите исправление."
                        );
                    }
                    break;
                case "changeOrderStatus":
                    $payType = $order[OrderTable::COL_PAY_TYPE];
                    $status = ShopWorker::$statusFrom1C[$payType][$data['status']];

                    if($order[OrderTable::COL_STATUS] < $status) {
                        OrderTable::updateData($order['ID'], [
                            OrderTable::COL_COMMENT => ''
                        ]);
                    }

                    if($status) {
                        $status = self::checkStatus($status, $order);
                        OrderTable::setStatus($order['ID'],$status, [], true);
                        self::smsToStatus($status, $order);
                    }
                    break;
                case "sendMessage":
                    OrderTable::updateData($order['ID'], [ OrderTable::COL_COMMENT => $data['message'] ]);
                break;
                case "attachOrderDDU":
                    $file = self::methodAddDdu($reserve, $data['base64'], $data['fileType']);
                    OrderTable::updateData($order['ID'], [ OrderTable::COL_DDU_FILE => $file['local'] ]);
                    LoggerAdapter::add("Резерв № $reserve пришел договор. Путь: ".$file['local']);
                    LoggerAdapter::sendSms(
                        $order[OrderTable::COL_PHONE],
                        "Ваш договор на приобретение недвижимости сформирован и ожидает согласования в личном кабинете."
                    );
                break;
                case "setStatusApartments":
                    $slackInfo = "У `квартир` был сменен *статус* на:\n";
                    if(count($data['apartmentStatus']) < 1) return false;
                    $ids = [];
                    foreach ($data['apartmentStatus'] as $key => $apartmentInfo) {
                        $slackInfo .= "`".$apartmentInfo['id']."`: *".$apartmentInfo['status']."*\n";
                        $ids[$apartmentInfo['id']] = $apartmentInfo['status'];
                    }
                    $arSelect = Array("ID", "IBLOCK_ID","XML_ID");
                    $arFilter = Array(
                        "XML_ID" => array_keys($ids)
                    );
                    $freeApartment = [];
                    if(\CModule::IncludeModule("iblock")) {
                        $res = \CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
                        while ($ob = $res->GetNextElement()) {
                            $field = $ob->GetFields();
                            if($ids[$field['XML_ID']] != 'Ожидание' && $ids[$field['XML_ID']]) {
                                $status = $ids[$field['XML_ID']] == "ВСвободнойПродаже" ? "" : "31";
                                \CIBlockElement::SetPropertyValuesEx($field['ID'], $field['IBLOCK_ID'], array(113 => $status));
                                if(
                                    $ids[$field['XML_ID']] == "ВСвободнойПродаже" ||
                                    $ids[$field['XML_ID']] == "РезервПредварительный" ||
                                    $ids[$field['XML_ID']] == "БроньР"
                                ) {
                                    $freeApartment[] = $field['ID'];
                                }
                            }
                        }
                        $data['free'] = $freeApartment;
                        if(!empty($freeApartment)) {
                            foreach ($freeApartment as $ID) {
                                $canceledOrder = OrderTable::getItemsByApartment($ID);
                                foreach ($canceledOrder as $orderCanceled) {
                                    OrderTable::updateData($orderCanceled['ID'], [
                                        OrderTable::COL_STATUS => 0,
                                    ]);
                                }
                            }
                        }
                    }
                    LoggerAdapter::add($slackInfo);
                    break;
                case "addFiles":
                    $files = $data['files'];
                    $includeType = [];
                    $fileArray = $order[OrderTable::COL_1C_FILE] ? json_decode($order[OrderTable::COL_1C_FILE],true) : [];
                    foreach ($files as $file) {
                        $fileType = $file['fileType'];
                        $includeType[$fileType] = true;
                        $fullFileName = basename(str_replace("\\", "/", $file['fullfilename']));
                        $encodeFiles = base64_decode($file['encodeFiles']);
                        $path = self::saveFileOrder($reserve, "/1C/$fileType/", $fullFileName, $encodeFiles, true);
                        $fileArray[$fileType][$fullFileName] = $path;
                    }
                    foreach ($includeType as $key => $v) {
                        self::smsToFile($key, $order);
                    }
                    OrderTable::updateData($order['ID'], [ OrderTable::COL_1C_FILE => json_encode($fileArray, JSON_UNESCAPED_UNICODE) ]);
                    break;
                case "createdOrder":
                    $errorMessage = [
                        'getUser' => "При обработке пользователя произошла ошибка",
                        'getApartment' => "При обработке информации по квартире произошла ошибка"
                    ];
                    $data['phone'] = Helper::parsePhone($data['phone']);

                    $order = OrderTable::getOrderByReserve($data['orderGuid']);
                    if(!empty($order)) {
                        return self::errorStatus('Такой заказ уже есть');
                    }

                    if(empty($data['lastName']) || empty($data['firstName'])) {
                        return self::errorStatus("Не заполнено имя/фамилия");
                    }

                    if($order !== false)

                    if(empty($data['phone'])) {
                        return self::errorStatus('Неверный формат телефона');
                    }
                    if(empty($data['clientGuid'])) {
                        return self::errorStatus('Не задан guid клиента');
                    }
                    $user = User::getByLogin($data['phone']);
                    if($user === false) {
                        $register = User::registerUser(
                            $data['phone'],
                            [ $data['lastName'],  $data['firstName'] ],
                            $data['phone'],
                            $data['phone']
                        );
                        if(!empty($register['ID'])) {
                            User::updateUser($register['ID'],[ 'XML_ID' => $data['clientGuid']]);
                        }
                        $user = User::getByLogin($data['phone']);
                    }
                    if($user === false) {
                        return self::errorStatus($errorMessage['getUser'].": ".$register['MESSAGE']);
                    }
                    $userID = false;
                    if($user['ID']) $userID = $user['ID'];
                    if($userID === false) {
                        return self::errorStatus($errorMessage['getUser'].": Не возможно получить ID пользователя в системе");
                    }
                    $apartmentID = Cart::getIDByNum($data['flatID']);
                    if($apartmentID === false) {
                        return self::errorStatus($errorMessage['getApartment'].": Не удалось получить ID квартиры");
                    }

                    $field = [
                        'user' => $userID,
                        'email' => $user['EMAIL'],
                        'first_name' => $user['NAME'],
                        'last_name' => $user['LAST_NAME'],
                        'product'=> $apartmentID,
                        'basket' => $apartmentID,
                        'price' => 30000,
                        'phone' => $data['phone'],
                        'comment' => '',
                        'reservation' => $data['orderGuid'],
                        'payType' => '',
                    ];

                    //LoggerAdapter::add(print_r($data,true));

                    $orderResult = OrderTable::save($field);
                    $orderGuid = $data['orderGuid'];
                    $CURRENT_PAGE = (\CMain::IsHTTPS()) ? "https://" : "http://";
                    $CURRENT_PAGE .= $_SERVER["HTTP_HOST"];
                    $orderID = $orderResult['id'];
                    if(empty($orderID)) {
                        return self::errorStatus($errorMessage['getApartment'].": Заказа не был создан");
                    }
                    $link = "$CURRENT_PAGE/reserve/oplata.php?ORDER_XMLID=$orderGuid";
                    LoggerAdapter::sendSms($data['phone'], "Вы успешно забронировали квартиру! Ваша бесплатная бронь действительна 24 часа.\n".$link);
                    return self::okStatus($data);
                break;
                default:
                    self::errorStatus('Метод не определен');
                    return false;
                break;
            }
            return self::okStatus($data, "метод $method отработал корректно");
        } catch (\Exception $e) {
            return self::errorStatus('Ошибка в работе скрипта');
        }

    }
}
