<?php
require_once './sms.class.php';

if (isset($_POST['phone']) && $_POST['phone']) {

    $get = 'https://sms.targetsms.ru/sendsms.php?
user=Fsknwsms&pwd=fsk123&name_delivery=название_рассылки&sadr=FSKNW&dadr=79992373291&text=текст';


    $messages = new \Sms\Xml\Messages('Fsknwsms', 'fsk123');
    $messages->setUrl('https://sms.targetsms.ru');
    $mes = $messages->createNewMessage('FSKNW', 'Тестовое сообщение', 'sms');

    $abonent = $mes->createAbonent($_POST['phone']);
    $abonent->setNumberSms(0);
    $mes->addAbonent($abonent);

    /*$abonent = $mes->createAbonent($_POST['phone']);
    $abonent->setNumberSms(3);
    $abonent->setClientIdSms(1);
    $abonent->setTimeSend("2015-12-15 15:12");
    $abonent->setValidityPeriod("2015-12-16 16:00");
    $mes->addAbonent($abonent);*/

    $messages->addMessage($mes);
    if (!$messages->send()) {
        echo json_encode([
            'msg' => $messages->getError(),
            'success' => false
        ]);
    } else {
        echo json_encode([
            'msg' => $messages->getResponse(),
            'success' => true
        ]);
    }
}
