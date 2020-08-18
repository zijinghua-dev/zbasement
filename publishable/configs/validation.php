<?php
return [
    'rules' => [
        'base' => [
            'search' => [
                [
                    'rule' => [
                        'required',
                        'new \Zijinghua\Zbasement\Rules\JsonItem:field,value,filter,algorithm',
                    ],
                    'action' => [
                        'fetch',
                    ],
                ],
                [
                    'rule' => [
                        'new \Zijinghua\Zbasement\Rules\JsonItem:field,value,filter,algorithm',
                    ],
                    'action' => [
                        'index',
                    ],
                ],
            ],
            'currentPage' => [
                [
                    'rule' => [
                        'integer',
                        'min:0',
                    ],
                    'action' => [
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
                    'action' => [
                        'index'
                    ],
                ]
            ],
        ],
        'user' => [
            'store' => [
                [
                    'rule' => [
                        'required',
                        'new \Zijinghua\Zbasement\Rules\User\Store',
                        'new \Zijinghua\Zbasement\Rules\Unique',
                    ],
                    'action' => [
                        'store',
                    ],
                ],
            ],
            'update' => [
                [
                    'rule' => [
                        'required',
                        'new \Zijinghua\Zbasement\Rules\User\Update:id',
                    ],
                    'action' => [
                        'update',
                    ],
                ],
            ]
        ],
    ],
    'messages' => [
        'base' => [
            'search' =>
                [
                    [
                        'message' => [
                            'required' => '必须输入Json格式的搜索数据，以“search”为键名。',
                            'JsonItem' => '必须符合搜索的json结构。',
                        ],
                        'action' => [
                            'fetch', 'index',
                        ]
                    ],
                ],
            'currentPage' => [
                [
                    'message' => [
                        'integer' => '必须是大于等于0的整数',
                        'min' => '不能小于0',
                    ],
                    'action' => [
                        'index',
                    ],
                ],
            ],
            'pageSize' => [
                [
                    'message' => [
                        'integer' => '必须是大于等于0的整数',
                        'min' => '不能小于0',
                    ],
                    'action' => [
                        'index',
                    ],
                ]

            ],
        ],
        'user' => [
            'store' =>
                [
                    [
                        'message' => [
                            'required' => '字段不能为空',
                            'store' => '数据验证失败',
                        ],
                        'action' => [
                            'store',
                        ]
                    ],
                ],
        ],
    ],

];
