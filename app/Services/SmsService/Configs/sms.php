<?php

return [
    'third-party' => [
        'provider' => env('SMS_PROVIDER_SLUG', 'KavehNegar'),
        'url' => env('KAVEHNEGAR_URL'),
        'SENDER' => env('PROVIDER_SENDER_NUMBER'),
    ],
];
