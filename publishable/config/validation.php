<?php
return [
    'fields' => [
        'internal'=>[
            'username' => [
                'nullable',
                'min:2',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'mobile' => [
                'nullable',
                'regex:/^(1(([3456789][0-9])|(47)|[8][01236789]))\d{8}$/' ,
                'min:8',
                'max:255',
            ],
        ],
        'account'=>[
            'account'=>[
                'nullable',
                'min:2',
                'max:255',
            ],
        ],
        'password' => [
            'password' => [
                'min:6',
                'max:255',
            ],
        ],
        'external' => [
            'wechat_id' => [
                'nullable',
                'min:6',
                'max:255',
            ],
        ],
        'pagination' => [
            'currentPage' => [
                'integer',
                'min:0',
            ],
            'pageSize' => [
                'integer',
                'min:0',
            ],
        ],
        'uuid' => [
            'uuid' => [
                'regex:/[A-Za-z0-9]{8}-[A-Za-z0-9]{4}-[A-Za-z0-9]{4}-[A-Za-z0-9]{4}-[A-Za-z0-9]{12}/',
            ],
        ],
    ],

    'message'=>[
        'internal' => [
            'username'=>[
                'nullable' =>'username不能为null。',
//            'username.required_without_all'=>'至少输入username,email,mobile,account,wechat_id当中的一个' ,
                'min'=>'username最少2个字符。',
                'max'=>'username最多不超过255个字符。',
            ],
            'email'=>[
                'nullable' =>'email不能为null。',
                'email'=>'必须符合Email格式要求。',
            ],
            'mobile'=>[
                'nullable' => 'mobile不能为null。',
                'regex'=> '必须符合手机号码格式要求。' ,
            ],
        ],
        'password' => [
            'password' => [
                'min'=>'password最少6位。',
                'max'=>'password最长255位。',
                'required_with'=>'必须输入密码。',
            ],
        ],
        'external' => [
            'wechat_id'=>[
                'nullable' => 'wechat_id不能为null。',
                'min'=> 'wechat_id最少6位。',
                'max'=> 'wechat_id最长255个字符。',
            ]
        ],
        'pagination'=> [
            'validation'=>[
                'currentPage' => [
                    'integer' => '必须是大于等于0的整数',
                    'min' => '不能小于0',
                ],
                'pageSize'=>[
                    'integer' => '必须是大于等于0的整数',
                    'min' => '不能小于0',
                ]
            ],
        ],
        'uuid'=>[
            'uuid'=>[
                'regex' => 'uuid格式不正确!',
                'has'=>'不存在！',
            ],
        ],
        'field'=>[
            'has'=>[
                'value'=>'不存在！',
            ],
        ],
    ],
];