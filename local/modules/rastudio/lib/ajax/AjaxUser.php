<?
namespace RaStudio\Ajax;

require_once ($_SERVER['DOCUMENT_ROOT']."/local/modules/rastudio/lib/smsAuth/sms.auth.class.php");

use RaStudio\Api\LoggerAdapter as LoggerAdapter;
use RaStudio\User as User;
use \Bitrix\Main\Application;
use RaStudio\Api\RestApi as RestApi;
use RaStudio\Helper;
class AjaxUser {
    public static function actionLoginUserBySMS() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global   $USER ;
        if(!isset($postList['phone']) || empty($postList['phone'])) {
            return $response->shapeError([], 'Не правильно введен телефон');
        }
        if(!isset($postList['sms']) || empty($postList['sms'])) {
            return $response->shapeError([], 'Поле смс пусто');
        }

        $phone = Helper::parsePhone($postList['phone']);
        $sms = hash('md5', $postList['sms']);
        if($_SESSION['authSMS'] == $sms) {
            $rsUser = \CUser::GetByLogin($phone);
            $arUser = $rsUser->Fetch();
            $USER ->Authorize($arUser['ID']);
            return $response->shapeOk([], 'Вы успешно авторизированы');
        } else {
            return $response->shapeError([], 'Не верно веден код');
        }
    }
    public static function actionSendSMSCheck() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        $authCode = new \TargetSMS\SmsAuth('Fsknwsms','fsk123');
        $phone = Helper::parsePhone($postList['phone']);
        $rsUser = \CUser::GetByLogin($phone);
        $arUser = $rsUser->Fetch();

        if(!isset($arUser['ID']) || empty($arUser['ID'])) {
            return $response->shapeError([], 'Вход доступен клиентам, забронировавшим квартиру');
        }

        $result = $authCode->generateCode($phone,'FSKNW',4,'Код авторизации: {код}');
        $code = $result->success->attributes()['code'];// сгенерированный код
        //$id_sms = $result->success->attributes()['id_sms'];// id смс для проверки статуса доставки
        $status = $result->success->attributes()['status'];// статус доставки
        $_SESSION['authSMS'] = hash('md5', $code);
        if($status[0] == 'send') {
            return $response->shapeOk(['status' => $status], 'Смс отправлено');
        } else {
            return $response->shapeError([], 'Произошла ошибка отправки попробуйте снова');
        }

    }
    public static function actionSendSMSOrderConfirm() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        $authCode = new \TargetSMS\SmsAuth('Fsknwsms','fsk123');
        $phone = Helper::parsePhone($postList['tel']);
        $result = $authCode->generateCode($phone,'FSKNW',4,'Код авторизации: {код}');
        $code = $result->success->attributes()['code'];// сгенерированный код
        //$id_sms = $result->success->attributes()['id_sms'];// id смс для проверки статуса доставки
        $status = $result->success->attributes()['status'];// статус доставки
        $_SESSION['authSMS'] = hash('md5', $code);
        if($status[0] == 'send') {
            return $response->shapeOk(['status' => $status], 'Смс отправлено');
        } else {
            return $response->shapeError([], 'Произошла ошибка отправки попробуйте снова');
        }
    }
    public static function actionRegisterOrAuthorizeForReserveForm() {

    }
    public static function actionUpdateInfoLk() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global $USER;
        $userID = $USER->GetID();
        $postList['phone'] = Helper::parsePhone($postList['phone']);
        $field = User::formateDataFromLk($postList, true);
        User::Update($userID, $field);
        return $response->shapeOk($field, 'Успешно сохранено');
    }
    public static function actionGetUserDataForLk () {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();

        global $USER;
        $userID = $USER->GetID();
        $user = User::getDataByID($userID);

        return $response->shapeOk(User::formateDataFromLk($user), 'Данные получены');
    }
    public static function actionIsAuthorize() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();

        global $USER;
        if ($USER->IsAuthorized()) {
            return $response->shapeOk([], 'Вы успешно зарегистрированны');
        } else {
            return $response->shapeError([], 'Не задан пароль');
        }
    }
    public static function actionRegisterUser () {

        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();



        if(!isset($postList['fio']) || empty($postList['fio'])) {
            return $response->shapeError([], 'Не верный формат ФИО');
        }
        if(!isset($postList['phone']) || empty($postList['phone'])) {
            return $response->shapeError([], 'Не правильно введен телефон');
        }
        if(!isset($postList['password']) || empty($postList['password'])) {
            return $response->shapeError([], 'Не задан пароль');
        }

        $fio = explode(' ', $postList['fio']);
        if(!$fio[2]) $fio[2] = '';

        $phone = Helper::parsePhone($postList['phone']);

        if(strlen($phone) != 11) {
            return $response->shapeError([], 'Не правильно введен телефон');
        }
        if($postList['password'] !== $postList['password_change']) {
            return $response->shapeError([], 'Пароли не совпадают');
        }

        $res = User::registerUser($phone, $fio, $postList['password'], $postList['password_change']);

        if($res['TYPE'] == 'ERROR') {
            return $response->shapeError([], str_replace("<br>", "\n", $res['MESSAGE']));
        }

        $dataSend = array( "lastName" => $fio[0], "firstName" => $fio[1], "secondName" => $fio[2], "phone" => $phone );

        $result1C = RestApi::simple_curl('/client','POST',$dataSend);

        User::updateUser($res['ID'], [
            'SECOND_NAME' => $fio[2],
            'XML_ID' => $result1C['guid'],
        ]);

        return $response->shapeOk($result1C, 'Вы успешно зарегистрированны');
    }
    public static function actionLoginUser () {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();

        if(!isset($postList['phone']) || empty($postList['phone'])) {
            return $response->shapeError([], 'Не правильно введен телефон');
        }
        if(!isset($postList['password']) || empty($postList['password'])) {
            return $response->shapeError([], 'Не задан пароль');
        }

        $phone = preg_replace("/[^0-9]/", '', $postList['phone']);

        if(strlen($phone) != 11) {
            return $response->shapeError([], 'Не правильно введен телефон');
        }
        $res = User::loginUser($phone, $postList['password']);
        if($res['TYPE'] == 'ERROR') {
            return $response->shapeError([], str_replace("<br>", "\n", $res['MESSAGE']));
        }
        return $response->shapeOk([], 'Вы успешно авторизированы');
    }
    public static function actionLogout() {
        $response = new Response();
        $res = User::logOutUser();
        return $response->shapeOk([], '');
    }
}
