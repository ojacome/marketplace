<?php

return [
    "client_id" => env('PAYPAL_CLIENT_ID'),
    "secret" => env('PAYPAL_SECRET'),

    "settings" => [
        'mode' =>env('PAYPAL_MODE', 'sandbox'),//sandbox cuentas desarrollo, live produccion
        'http.connectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('/logs/paypal.log'),
        'log.LogLevel' => 'Error'
    ]

];