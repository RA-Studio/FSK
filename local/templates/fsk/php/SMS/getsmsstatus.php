<?php
require_once './sms.class.php';

$state = new \Sms\Xml\State('login', 'password');
$state->setUrl('https://sms.targetsms.ru');
$state->addIdSms(1143291555);
$state->addIdSms(1143703872);

if (!$state->send()) {
    echo $state->getError();
} else {
    print_r($state->getResponse());
}
