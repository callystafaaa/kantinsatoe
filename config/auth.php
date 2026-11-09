<?php

use App\Models\Pembeli;
use App\Models\Kantin;

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'pembeli'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'pembeli'),
    ],

    'guards' => [
        'pembeli' => [
            'driver' => 'session',
            'provider' => 'pembeli',
        ],
        'kantin' => [
            'driver' => 'session',
            'provider' => 'kantin',
        ],
    ],

    'providers' => [
        'pembeli' => [
            'driver' => 'eloquent',
            'model' => Pembeli::class,
        ],
        'kantin' => [
            'driver' => 'eloquent',
            'model' => Kantin::class,
        ],
    ],

    'passwords' => [
        'pembeli' => [
            'provider' => 'pembeli',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];