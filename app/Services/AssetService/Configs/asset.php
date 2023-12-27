<?php

return [
    'transaction_mount' => [
        'min' => env('MINIMUM_TRANSACTION_AMOUNT', 1000),
        'max' => env('MAXIMUM_TRANSACTION_AMOUNT', 50000000),
    ],
    'wage' => env('WAGE_AMOUNT_RIAL', 5000),
    'lock' => [
        'seconds' => env('LOCK_DB_FOR_SECONDS', 10),
    ],
];
