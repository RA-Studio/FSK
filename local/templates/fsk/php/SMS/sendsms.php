<?php
require_once './sms.class.php';

if (isset($_POST['phone']) && $_POST['phone']) {

    $get = 'https://sms.targetsms.ru/sendsms.php?
user=Fsknwsms&pwd=fsk123&name_delivery=название_рассылки&sadr=FSKNW&dadr=79992373291&text=текст';

    /*$param = array(
        'security' => array('login' => 'Fsknwsms', 'password' => 'fsk123'),
         'type' => 'sms',
         'message' => array(
             array(
                 'type' => 'sms',
                 'sender' => '79650512592',
                 'text' => 'Текст сообщения 1',
                 'name_delivery' => 'Рассылка 1',
                 'translite' => '1',
                 'abonent' => array(
                     array('phone' => $_POST['phone'], 'number_sms' => '0', 'client_id_sms' =>
                         '100', 'time_send' => '2016-11-09 12:40', 'validity_period' => '2016-11-09 13:30')
                 )
             )
         )
);*/
    /*$param = array(
        'security' => array('login' => 'Fsknwsms', 'password' => 'fsk123'),
        'type' => 'originator'
    );*/
/*    $param_json = json_encode($param, true);

    $href = 'https://sms.targetsms.ru/sendsmsjson.php'; // адрес сервера
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','charset=utf8','Expect:'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param_json);
    curl_setopt($ch, CURLOPT_TIMEOUT, 600);
    curl_setopt($ch, CURLOPT_URL, $href);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $res = curl_exec($ch);
    $result = json_decode($res, true);
    curl_close($ch);
    print_r($result);*/


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