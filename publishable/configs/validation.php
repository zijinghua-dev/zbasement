<?php
return [
    'rules'=>[
        'base'=>[
            'search'=>[
                [
                    'rule'=>[
                        'required',
                        'new \Zijinghua\Zbasement\Rules\JsonItem:field,value,filter,algothm',
                    ],
                    'action'=>[
                        'fetch','index',
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
        ],


    ],
    'messages'=>[
        'base'=>[
            'search'=>
                [
                    [
                        'message'=>[
                            'required'=>'必须输入Json格式的搜索数据，以“search”为键名。',
                            'JsonItem'=>'必须符合搜索的json结构。',
                        ],
                        'action'=>[
                            'fetch','index',
                        ]
                    ],
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
        ],
        ],

];