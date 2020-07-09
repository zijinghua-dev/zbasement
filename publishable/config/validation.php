<?php
return [
    'rules'=>[
        'user'=>[
            'username' =>[
                [
                    'rule'=>[
                        'nullable',
                        'min:2',
                        'max:255',
                    ],
                    'action'=>[
                        'login','store'
                    ],
                ],
                [
                    'rule'=>[
                        'required_without_all:email,mobile,account,wechat_id',
                    ],
                    'action'=>[
                        'login',
                    ],
                ],
                [
                    'rule'=>[
                        'required_without_all:email,mobile,wechat_id',
                    ],
                    'action'=>[
                        'store'
                    ],
                ],
                [
                    'rule'=>[
                        'new \Zijinghua\Zbasement\Rules\Unique:username,mobile',
                    ],
                    'action'=>[
                        'store'
                    ],
                ]

            ],
            'email' =>[
                [
                    'rule'=>[
                        'nullable',
                        'email',
                    ],
                    'action'=>[
                        'login','store'
                    ],
                ],
                [
                    'rule'=>[
                        'new \Zijinghua\Zbasement\Rules\Unique',
                    ],
                    'action'=>[
                        'store'
                    ],
                ]
            ],
            'mobile' => [
                [
                    'rule'=>[
                        'nullable',
                        'regex:/^(1(([3456789][0-9])|(47)|[8][01236789]))\d{8}$/' ,
                        'min:8',
                        'max:255',
                    ],
                    'action'=>[
                        'login','store'
                    ],
                ],
                [
                    'rule'=>[
                        'new \Zijinghua\Zbasement\Rules\Unique',
                    ],
                    'action'=>[
                        'store'
                    ],
                ],
            ],
            'account'=>[
                [
                    'rule'=>[
                        'nullable',
                        'min:2',
                        'max:255',
                    ],
                    'action'=>[
                        'login',
                    ],
                ],

            ],
            'password' => [
                [
                    'rule'=>[
                        'min:6',
                        'max:255',
                    ],
                    'action'=>[
                        'login','store'
                    ],
                ],
                [
                    'rule'=>[
                        'required_with:username,email,mobile,account'
                    ],
                    'action'=>[
                        'login'
                    ],
                ],
                [
                    'rule'=>[
                        'required_with:username,email,mobile'
                    ],
                    'action'=>[
                        'store'
                    ],
                ],
                [
                    'rule'=>[
                        'required'
                    ],
                    'action'=>[
                        'updatePassword',
                    ],
                ],
            ],
            'pre_password' => [
                [
                    'rule'=>[
                        'min:6',
                        'max:255',
                        'required'
                    ],
                    'action'=>[
                        'updatePassword',
                    ],
                ],
            ],
            'wechat_id' => [
                [
                    'rule'=>[
                        'nullable',
                        'min:6',
                        'max:255',
                    ],
                    'action'=>[
                        'login','store'
                    ],
                ],
                [
                    'rule'=>[
                        'new \Zijinghua\Zbasement\Rules\Unique',
                    ],
                    'action'=>[
                        'store'
                    ],
                ],
            ],
            'currentPage' => [
                [
                    'rule' => [
                        'integer',
                        'min:0',
                    ],
                    'action'=>[
                        'index'
                    ],
                ]
            ],
            'pageSize' => [
                [
                    'rule' => [
                        'integer',
                        'min:0',
                    ],
                    'action'=>[
                        'index'
                    ],
                ]

            ],
            'uuid' => [
                [
                    'rule' => [
                        'required',
                        'regex:/[A-Za-z0-9]{8}-[A-Za-z0-9]{4}-[A-Za-z0-9]{4}-[A-Za-z0-9]{4}-[A-Za-z0-9]{12}/',
                    ],
                    'action'=>[
                        'show','update','updatePassword'
                    ],
                ]


            ],
        ],
    ],
    'messages'=>[
        'user' => [
            'username'=>[
                [
                    'message'=>[
                        'min'=>'username最少2个字符。',
                        'max'=>'username最多不超过255个字符。',
                        'nullable' =>'username不能为null。',
                    ],
                    'action'=>[
                        'login','store'
                    ]
                ],
                [
                    'message'=>[
                        'required_without_all'=>'至少使用username,email,mobile,微信账号当中的一种登录方式'
                    ],
                    'action'=>[
                        'login','store',
                    ]
                ],
            ],
            'email'=>[
                [
                    'message'=>[
                        'nullable' =>'email不能为null。',
                        'email'=>'必须符合Email格式要求。',
                    ],
                    'action'=>[
                        'login','store'
                    ]
                ]

            ],
            'mobile'=>[
                [
                    'message'=>[
                        'nullable' => 'mobile不能为null。',
                        'regex'=> '必须符合手机号码格式要求。' ,
                    ],
                    'action'=>[
                        'login','store'
                    ]
                ]

            ],
            'password' => [
                [
                    'message' => [
                        'min'=>'password最少6位。',
                        'max'=>'password最长255位。',
                        'required_with'=>'必须输入密码。',
                    ],
                    'action'=>[
                        'login','store','updatePassword'
                    ]
                ]

            ],
            'wechat_id' => [
                [
                    'message'=>[
                        'nullable' => 'wechat_id不能为null。',
                        'min'=> 'wechat_id最少6位。',
                        'max'=> 'wechat_id最长255个字符。',
                    ],
                    'action'=>[
                        'login','store',
                    ]
                ]

            ],
            'currentPage'=> [
                [
                    'message' => [
                        'integer' => '必须是大于等于0的整数',
                        'min' => '不能小于0',
                    ],
                    'action'=>[
                        'index',
                    ],
                ],
            ],
            'pageSize'=>[
                [
                    'message' => [
                        'integer' => '必须是大于等于0的整数',
                        'min' => '不能小于0',
                    ],
                    'action'=>[
                        'index',
                    ],
                ]

            ],
            'uuid'=>[
                [
                    'message'=>[
                        'regex' => 'uuid格式不正确!',
                        'has'=>'不存在！',
                    ],
                    'action'=>[
                        'show','update','updatePassword'
                    ],
                ]

            ],
        ],
    ]
];