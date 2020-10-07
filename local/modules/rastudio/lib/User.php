<?
namespace RaStudio;

use RaStudio\Api\LoggerAdapter as LoggerAdapter;

class User {

    public static $lfField = [
        'lastName' => 'LAST_NAME',
        'firstName' => 'NAME',
        'middleName' => 'SECOND_NAME',
        'phone' => 'LOGIN',
        'email' => 'EMAIL',
        'serial' => 'UF_PASS_SERIES',
        'number' => 'UF_NUMBER_PASSPORT',
        'datePassport' => 'UF_PASSPORT_DATE',
        'issued' => 'UF_PASSPORT_ISSUED_BY',
        'unitCode' => 'UF_PASSPORT_UNIT_CODE',
        'citizenship' => 'UF_CITIZENSHIP',
        'placeBirth' => 'UF_PLACE_BIRTH',
        'registration' => 'UF_REGISTRATION',
    ];

    public static function registerUser($login, $userFIO, $password, $passwordConfirm, $email = false) {
        global $USER;
        if($email === false) $email = "temp@$login.ru";
        return  $USER->Register($login, $userFIO[0], $userFIO[1], $password,  $passwordConfirm, $email);
    }
    public static function loginUser ($login, $password) {
        global $USER;
        return $USER->Login($login, $password);
    }
    public static function logOutUser() {
        global $USER;
        return $USER->Logout();
    }
    public static function updateUser($ID, $fields) {
        global $USER;
        return $USER->Update($ID,$fields);
    }
    public static function getDataByID($ID) {
        return \CUser::GetByID($ID)->fetch();
    }
    public static function getUserXmlIdByID($ID) {
        return \CUser::GetByID($ID)->fetch()['XML_ID'];
    }
    public static function getByLogin($login){
        return \CUser::GetByLogin($login)->Fetch();
    }
    public static function formateDataFromLk($data, $back = false) {
        $arResult = [];
        foreach(self::$lfField as $key => $value) {
            if($back === false) {
                $arResult[$key] = $data[$value];
            } else {
                $arResult[$value] = $data[$key];
            }
        }
        return $arResult;
    }
    public static function Update($userID, $date) {
        $oUser = new \CUser;
        $oUser->Update($userID, $date);
    }
}
