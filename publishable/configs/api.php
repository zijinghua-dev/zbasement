<?php
return [
    'usercenter' => [
        'host' => env('USERCENTER_HOST'),
        'api' => [
            'fetch'=>[
                'uri' => '/api/v1/user/fetch',
                'action'=>'post'
            ],
            'store'=>[
                'uri' => '/api/v1/user/',
                'action'=>'post'
            ],
        ],

    ],
    'api' => [
        'version'=>'v1',
    ]
];