<?php
return [
    'usercenter' => [
        'host' => env('USERCENTER_HOST'),
        'api' => [
            'fetch'=>[
                'uri' => '/api/user/fetch',
                'action'=>'post'
            ],
            'store'=>[
                'uri' => '/api/user/',
                'action'=>'post'
            ],
            'show'=>[
                'uri' => '/api/user/',
                'action'=>'get'
            ],
            'index'=>[
                'uri' => '/api/user/index',
                'action'=>'post'
            ],
            'update'=>[
                'uri' => '/api/user',
                'action'=>'put'
            ],
            'fields'=>[
                'uri' => '/api/user/fields',
                'action'=>'post'
            ],
            'search'=>[
                'uri' => '/api/user/search',
                'action'=>'post'
            ],
            'transferkey'=>[
                'uri' => '/api/user/transferkey',
                'action'=>'post'
            ],
        ],

    ],
    'api' => [
        'version'=>'v1',
    ],
    'search'=>[
        'perpage'=>15,
        'perpagemax'=>100,
    ],
    'slug'=>[
        'index'=>env('SLUG_INDEX',1),
        ],
];