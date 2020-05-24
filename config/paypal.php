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
    ],

    "msgState" => [
        'created' => 'La transacción fue creada con éxito. Falta aprobación del usuario',
        'approved' => 'Transacción exitosa, pronto te contactaremos para coordinar la entrega.',
        'failed' => 'Disculpa, la transacción ha fallado.',
        'unknown' => 'Algo ha salido mal, inténtalo mas tarde.'
    ]
];