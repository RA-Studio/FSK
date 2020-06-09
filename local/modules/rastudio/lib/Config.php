<?php

namespace RaStudio;

class Config {

    const SITE_ID = 's1';

    const IB_TYPE_REALTY = 'kompleks';

    const IB_ID_APARTMENTS = 15;


    public static $aIBlockIds = [
        self::IB_TYPE_REALTY => [
            'obekty' => self::IB_ID_APARTMENTS,
        ],
    ];


    // Rabbit connection
    const RABBIT_HOST     = 'localhost';//'rabbitmq';
    const RABBIT_PORT     = '5672';
    const RABBIT_USER     = 'guest';
    const RABBIT_PASSWORD = 'guest';
    const RABBIT_V_HOST   = '/';

    const DEMO_RABBIT_HOST = 'rabbitmq';
    const DEMO_RABBIT_USER = 'kvs';
    const DEMO_RABBIT_PASSWORD = 'kvs';
    const DEMO_RABBIT_V_HOST = '/vhost';
}
