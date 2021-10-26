<?php

return [
    'defaults' => [
        'guard' => 'admin',
        'passwords' => 'admins',
    ],

    'guards' => [
        'admin' => [
            'driver' => 'jwt',
            'provider' => 'admins',
        ],
        'member' => [
            'driver' => 'jwt',
            'provider' => 'members',
        ]
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class
        ],
        'members' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Member::class
        ]
    ],

    'expires_in'=> env('EXPIRES_IN', 60)
];
