<?php

namespace RaStudio\Api;

use \Bitrix\Main\Application;
use RaStudio\Api\LoggerAdapter;
use RaStudio\Api\Config;
use \RaStudio\Table\OrderTable;
use \RaStudio\User;
use \RaStudio\Cart;



class ShopWorker {

    const METHOD_CLIENT = '/client';
    const METHOD_FLAT = '/flat';
    const METHOD_PURCHASE = '/purchase';
    const METHOD_FILES = '/files';
    const METHOD_RESERVATION = '/reservation';

    const METHOD_FLAT_GETFREE = self::METHOD_FLAT.'/getFree';
    const METHOD_FLAT_GETALL = self::METHOD_FLAT.'/getAll';

    const METHOD_RESERVATION_CREATE = self::METHOD_RESERVATION.'/create';
    const METHOD_RESERVATION_CONFIRM = self::METHOD_RESERVATION.'/confirm';
    const METHOD_RESERVATION_CANCEL = self::METHOD_RESERVATION.'/cancel';

    const METHOD_PURCHASE_CREATE = self::METHOD_PURCHASE.'/create';
    const METHOD_PURCHASE_SET_STATUS = self::METHOD_PURCHASE.'/setStatus';

    const METHOD_PURCHASE_CREATE_PROFILE = self::METHOD_PURCHASE.'/createProfile';

    const METHOD_FILES_AGREEMENT = self::METHOD_FILES.'/add';

    const METHOD_CLIENT_CREATE = self::METHOD_CLIENT.'/create';
    const METHOD_CLIENT_UPDATE = self::METHOD_CLIENT.'/update';

    const PAYMENT_TYPE_FULL = 'полная';
    const PAYMENT_TYPE_MORTGAGE = 'ипотека';
    const PAYMENT_TYPE_INSTALLMENT = 'рассрочка';

    public static $statusIn1C = [
        "AnketaConfirm" => "КлиентПодтвердилДоговор",
        "SendУкэп" => "ПодписаниеУКЭП",
    ];
    public static $payType = [
        self::PAYMENT_TYPE_FULL => 'full',
        self::PAYMENT_TYPE_MORTGAGE => 'mortgage',
        self::PAYMENT_TYPE_INSTALLMENT => 'installment'
    ];
    public static $statusFrom1C = [
        'full' => [
            "АнкетаДляДоговора" => 3,
            "ДоговорОтправленКлиенту" => 3,
            "ЗаявлениеУКЭП" => 4,
            "ВыпускСертификатаУКЭП" => 5,
            "ТождественностьСогласия" => 6,
            "КомплектДокументовПодтвержден" => 7,
            "ЗаявлениеНаАккредитив" => 8,
            "ПодготовкаКРегистрации" => 9,
            "ОтправкаНаРегистрацию" => 10,
            "ДокументыПоданыВРосреестр" => 11,
            "ДоговорЗарегистрирован" => 12,
        ],
        "mortgage" => [
            "АнкетаДляДоговора" => 3,
            "ПолученыИпотечныеАнкеты" => 4,
            "ИпотекаОдобрена" => 5,
            "ДоговорОтправленКлиенту" => 5,
            "КлиентПодтвердилДоговор" => 6,
            "ПодписанКредитныйДоговор" => 7,
            "ТождественностьСогласия" => 7,
            "КомплектДокументовПодтвержден" => 8,
            "ОтправкаНаРегистрацию" => 9,
            "ДокументыПоданыВРосреестр" => 10,
            "ДоговорЗарегистрирован" => 11,
        ]
    ];
    /**
    * Confirm anket
    * @param array $dataSend : function formattingDataPurchase()
    * @return array
    */
    public static function purchaseCreate($dataSend = false){
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_PURCHASE_CREATE, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    /**
     * Create user in 1С
     * @param array $dataSend required key : (order_guid, client_guid, flat_id, form)
     * @return array information created user from 1C
     */
    public static function createProfile($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_PURCHASE_CREATE_PROFILE, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    /**
     * Create user in 1С
     * @param array $dataSend required key : (order_guid, status)
     * @return array information created user from 1C
     */
    public static function purchaseSetStatus($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_PURCHASE_SET_STATUS, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    public static function addFiles($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_FILES_AGREEMENT, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    /**
    * Create user in 1С
    * @param array $dataSend required key : (firstName, secondName, lastName, phone)
    * @return array information created user from 1C
    */
    public static function createdUser($dataSend = false){
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_CLIENT_CREATE, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    public static function getUser($guid){
        return $guid !== false ? RestApi::simple_curl( self::METHOD_CLIENT."?guid=".$guid, Config::METHOD_TYPE_CREATE, []) : false;
    }
    public static function getFreeApartment() {
        return RestApi::simple_curl(self::METHOD_FLAT_GETFREE, Config::METHOD_TYPE_GET );
    }
    public static function getAllApartment() {
        return RestApi::simple_curl(self::METHOD_FLAT_GETALL, Config::METHOD_TYPE_GET );
    }
    /**
    * Create reservation in 1С
    * @param array $dataSend required key : (client_guid, flat_id, order_guid)
    * @return array
    */
    public static function createReservation ($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_RESERVATION_CREATE, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    /**
    * Create reservation in 1С
    * @param array $dataSend required key : (client_guid, flat_id, order_guid, pay_type)
    * @return array (reserve_dataEnd, reserve, flat_status, status)
    */
    public static function confirmReservation ($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_RESERVATION_CONFIRM, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    /**
    * Create reservation in 1С
    * @param array $dataSend required key : (client_guid, flat_id, order_guid)
    * @return array
    */
    public static function canselReservation ($dataSend = false) {
        return $dataSend !== false ? RestApi::simple_curl( self::METHOD_RESERVATION_CANCEL, Config::METHOD_TYPE_CREATE, $dataSend ) : false;
    }
    public static function addInArchive($filesLink = false, $name = false, $saveTo = false) {
        if($filesLink === false) return [ "error" => [ "text" => "Необходимо указать массив с ссылками на файлы"] ];
        if($name === false) return [ "error" => [ "text" => "Укажите имя архива"] ];
        if($saveTo === false) return [ "error" => [ "text" => "Укажите када необходимо сохранить файл"] ];
        $zip = new \ZipArchive();
        $fileDir = "$saveTo$name.zip";
        $filePath = $_SERVER['DOCUMENT_ROOT'].$fileDir;
        $res = $zip->open($filePath, \ZipArchive::CREATE);

        if ($res === TRUE) {
            foreach ($filesLink as $key => $file) {
                if($file['location']) {
                    $zip->addFromString($file['location'], file_get_contents($_SERVER['DOCUMENT_ROOT'].$file['path']));
                }
            }
            $zip->close();
            return $fileDir;
        } else return [ "error" => [ "text" => "Ошибка в создание архива", "value" => "1"] ];
    }

    public static function formatDataProfileFrom1C($postList, $userGuid, $orderFile) {
        $users = $postList['data'];
        $orderData = $postList['orderData'];
        $reserve = $orderData['reserve'];
        $profile = [
            'order_guid' => $reserve,
            'client_guid' => $userGuid,
            'flat_id' => preg_replace('/\D/', '', $orderData['apartmentNum']),
            'form' => '',
        ];

        $htmlTable = [];
        foreach ($users as $keyUser => $user) {
            foreach ($user['data'] as $key => $field) {
                $htmlTable['field'][$key] = $field['lable'];
            }
            $htmlTable['user'][$keyUser] = $user['data'];
        }
        $htmlTable['field'] = array_unique($htmlTable['field']);
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $profile['form'] .= '<html><body>';
        $profile['form'] .= '<table border=\'1\' width=\'100%\' style=\'max-width: 600px; margin: 0 auto\'><tbody>';
        foreach ($htmlTable['field'] as $keyField => $field) {
            $profile['form'] .= '<tr>';
            $profile['form'] .= '<td style=\'text-align: center\'>'.$field.'</td>';
            foreach ($htmlTable['user'] as $key => $user){
                switch ($user[$keyField]['value']) {
                    case 'True':
                        $userVal = 'Да';
                        break;
                    case 'False':
                        $userVal = 'Нет';
                        break;
                    default:
                        $userVal = $user[$keyField]['value'];
                        break;
                }
                $profile['form'] .= '<td style=\'text-align: center\'>'.$userVal.'</td>';
            }
            $profile['form'] .= '</tr>';
        }
        $profile['form'] .= '</tbody></table>';
        $profile['form'] .= '<br><div style="max-width: 600px;margin: 0 auto;text-align: center;"><h1>Файлы</h1></div><br>';
        $profile['form'] .= '<table border=\'1\' width=\'100%\' style=\'max-width: 600px; margin: 0 auto\'><tbody>';
            $arrayTypeArhive = [
                "scanPassport" => 'Парспорт',
                "scanSNILS" => 'СНИЛС',
                "scanTIN" => 'ИНН',
            ];
            $arhive = [];
            foreach ($orderFile['ddu'] as $userKey => $user) {
                $lastName = $htmlTable['user'][$userKey]['lastName']['value'];
                $middleName = $htmlTable['user'][$userKey]['middleName']['value'];
                $firstName = $htmlTable['user'][$userKey]['firstName']['value'];
                foreach ($user as $type => $files) {
                    $type = $arrayTypeArhive[$type] ? : $type;
                    foreach ($files as $index => $filePath) {
                        $fileName = basename($filePath);
                        $arhive[] = [
                            'location' => "$lastName $middleName $firstName/$type/$fileName",
                            'path' => $filePath,
                        ];
                    }
                }
            }
            $arhivePath = self::addInArchive($arhive, 'ddu', "/upload/order/$reserve/");
            $profile['form'] .= '<tr><td style=\'text-align: center\'><a href="'.$actual_link.$arhivePath.'">Архив файлов</a></td></tr>';

        $profile['form'] .= '</tbody></table>';
        $profile['form'] .= '</body></html>';
        return $profile;
    }
    public static function getNameFrom1C($name) {
        return [
            "scanSNILS" => "снилс",
            "scanPassport" => "паспорт",
            "scanTIN" => "инн",
            "approval" => "ипотечнаяАнкета",
            "ukep" => "укэп",
            "ukepStatement" => "заявлениеУкэп",
            "scanIdentity" => "тождественность",
            "electronicSignature" => "ЭлектроннаяПодпись",
            "paymentCredit" => "ПодписанноеЗаявлениеНаАккредитив",
        ][$name] ? : 'другие';
    }
    public static function formatDateFrom1C ($date) {
        $date = explode('.', $date);
        return $date[2]."-".$date[1]."-".$date[0]."T00:00:00Z";
    }
    public static function formattingOwner($data = false, $userFile = []) {
        if($data === false) return [];
        $sendFiles = [];
        foreach ($userFile as $fileKey => $files) {
            foreach ($files as $file) {
                $sendFiles[] = [
                    'fileType' => self::getNameFrom1C($fileKey),
                    'fullfilename' => basename($file),
                    "firstName" => $data['firstName']['value'],
                    "secondName" =>$data['middleName']['value'],
                    "lastName" => $data['lastName']['value'],
                    'encodedFile' => base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].$file)),
                ];
            }
        }
        return [
            "firstName" => $data['firstName']['value'],
			"secondName" =>$data['middleName']['value'],
			"lastName" => $data['lastName']['value'],
			"birthdate" => self::formatDateFrom1C($data['dateBirth']['value']),
			"gender" => $data['gender']['value'],
			"phone" => $data['phone']['value'],
			"mail" => $data['email']['value'],
			"inn" => $data['numberTIN']['value'],
			"snils" =>  $data['numberSNILS']['value'],
			"married" => $data['familyStatus']['value'],
			"marriageСontract" => $data['familyStatus']['value'],
            "passport" => [
                "birthplace" => $data['placeBirth']['value'],
				"citizenship" => $data['citizenship']['value'],
				"series" => $data['serial']['value'],
				"number" => $data['number']['value'],
				"departmentcode" => $data['unitCode']['value'],
				"issuedate" => self::formatDateFrom1C($data['datePassport']['value']),
				"issuedby" => $data['issued']['value'],
				"registration" => $data['registration']['value'],
			],
            "files" => $sendFiles,
        ];
    }
    public static function formattingOrderDataFromPurchase($orderID, $order = false) {
        global $USER;

        if($order === false) $order = OrderTable::getOrderById($orderID);
        $orderData = $order;
        $userID = $orderData[OrderTable::COL_USER_ID];
        $orderFile = [];
        $users = [];

        if($orderData[OrderTable::COL_ORDER_INFO]) {
            $users = json_decode($orderData[OrderTable::COL_ORDER_INFO], true);
        } else return 'Нет информации по клиентам';

        if($orderData[OrderTable::COL_ORDER_FILE]) {
            $orderFile = json_decode($orderData[OrderTable::COL_ORDER_FILE], true);
        }

        if(!$userID) return 'Не указан ID пользователя';

        $owners = [];
        foreach ($users as $key => $user) {
            $owners[] = self::formattingOwner($user['data'], $orderFile['ddu'][$key]);
        }
        $arResult = [
            'order_guid' => $orderData[OrderTable::COL_RESERVE],
            'client_guid' => User::getUserXmlIdByID($userID),
            'flat_id' => Cart::getApartment1CNumByID($orderData[OrderTable::COL_BASKET]),
            'pay_type' => $orderData[OrderTable::COL_PAY_TYPE] == "full" ? "полная" : "ипотека",
            'owners' => $owners,
        ];
        return $arResult;
    }
    public static function formattingDataPurchase($data = false,  $orderFile = []) {
        $orderData = $data['orderData'];
        $users = $data['data'];
        $owners = [];
        foreach ($users as $key => $user) {
            $owners[] = self::formattingOwner($user['data'], $orderFile['ddu'][$key]);
        }

        $arResult = [
            'order_guid' => $orderData['reserve'],
            'client_guid' => $orderData['userGUID'],
            'flat_id' => preg_replace('/\D/', '', $orderData['apartmentNum']),
            'pay_type' => $data['payTape'] == "full" ? "полная" : "ипотека",
            'owners' => $owners,
        ];
        return $arResult;
    }//old
    public static function sendStatusFrom1C($order, $status) {
        $payType = $order[OrderTable::COL_PAY_TYPE];
        $check = "$status$payType";
        $status = [
            '4mortgage' => 'ПолученыИпотечныеАнкеты',
            '6mortgage' => 'КлиентПодтвердилДоговор',

            '4full' => 'КлиентПодтвердилДоговор',
            '5full' => 'УКЭППодписан',
            '6full' => 'ПодписаниеСертификатаУКЭП',
            '7full' => 'КомплектДокументовПодтвержден',
            '9full' => 'ПодписаниеЗаявленияНаАккредитив',
        ][$check];
        if(!$status || empty($status)) return false;
        self::purchaseSetStatus([
            "order_guid" => $order[OrderTable::COL_RESERVE],
            "status" => $status
        ]);
    }
}
