<?php

require_once 'sms.auth.class.php';

$authCode = new \TargetSMS\SmsAuth(
    'Fsknwsms',// логин в системе TargetSMS
    'fsk123'// пароль в системе TargetSMS
);

try {
    $result = $authCode->generateCode(
        '79992373291',// номер телефона получателя
        'FSKNW',// подпись отправителя
        4,// длина кода
        'Код авторизации: {код}'// текст персонификации
    );
    $code = $result->success->attributes()['code'];// сгенерированный код
    $id_sms = $result->success->attributes()['id_sms'];// id смс для проверки статуса доставки
    $status = $result->success->attributes()['status'];// статус доставки

    echo json_encode([
        'msg' => $result,
        'success' => true
    ]);
} catch (Exception $e) {
    $error = $e->getMessage();//ловим ошибку от сервера

    echo json_encode([
        'msg' => $error,
        'success' => false
    ]);
}
