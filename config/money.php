<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     */
    'locale' => config('app.locale', 'id_ID'),
    'defaultCurrency' => config('app.currency', 'IDR'),
    'defaultFormatter' => null,
    'isoCurrenciesPath' => __DIR__ . '/../vendor/moneyphp/money/resources/currency.php',
    'currencies' => [
        'iso' => 'all',
        'bitcoin' => 'all',
        'custom' => [
            'MY1' => 2,
            'MY2' => 0,
            'RP.' => 0,
        ],
    ],
];