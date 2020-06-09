<?php
require_once './sms.class.php';

$state = new \Sms\Xml\Balance('login', 'password');
$state->setUrl('https://sms.targetsms.ru');

if (!$state->send()) {
    echo $state->getError();
} else {
    print_r($state->getResponse());
}