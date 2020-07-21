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
            'show'=>[
                'uri' => '/api/v1/user/',
                'action'=>'get'
            ],
            'index'=>[
                'uri' => '/api/v1/user/index',
                'action'=>'post'
            ],
            'update'=>[
                'uri' => '/api/v1/user',
                'action'=>'put'
            ],
            'fields'=>[
                'uri' => '/api/v1/user/fields',
                'action'=>'post'
            ],
        ],

    ],
    'api' => [
        'version'=>'v1',
    ]
];