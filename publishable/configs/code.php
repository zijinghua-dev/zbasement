<?php
return [

    'index' => [
        'success' => [
            'http_code' => 200,
            'code' => 'ZBASEMENT_CODE_NDEX_SUCCESS',
            'status' => true,
            'message' => '获取列表成功!'
        ],
        'failed' => [
            'http_code' => 403,
            'code' => 'ZBASEMENT_CODE_INDEX_FAILED',
            'status' => false,
            'message' => '获取用户列表失败!'
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_INDEX_VALIDATION',
            'status' => false,
            'message' => '列表输入参数验证失败!'
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_INDEX_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '列表操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_INDEX_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '列表操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_INDEX_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '列表操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_INDEX_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '列表操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
    ],
    'fetch' => [
        'success' => [
            'http_code' => 200,
            'code' => 'ZBASEMENT_CODE_FETCH_SUCCESS',
            'status' => true,
            'message' => '获取单个记录成功!'
        ],
        'failed' => [
            'http_code' => 403,
            'code' => 'ZBASEMENT_CODE_FETCH_FAILED',
            'status' => false,
            'message' => '获取单个记录失败!'
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_FETCH_VALIDATION',
            'status' => false,
            'message' => '查找单个记录输入参数验证失败!'
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_FETCH_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '查找单个记录操作所需验证规则加载成功!'],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_FETCH_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '查找单个记录操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_FETCH_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '查找单个记录操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_FETCH_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '查找单个记录操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
    ],
    'show' => [
        'success' => [
            'http_code' => 200,
            'code' => 'ZBASEMENT_CODE_SHOW_SUCCESS',
            'status' => true,
            'message' => '获取详情信息成功!'
        ],
        'failed' => [
            'http_code' => 403,
            'code' => 'ZBASEMENT_CODE_SHOW_FAILED',
            'status' => false,
            'message' => '获取详情信息失败!'
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_SHOW_VALIDATION',
            'status' => false,
            'message' => '详情信息输入参数验证失败!'
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_SHOW_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '详情展示操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_SHOW_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '详情展示操作所需验证规则加载失败!'
                ],
            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_SHOW_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '详情展示操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_SHOW_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '详情展示操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
    ],
    'field'=>[
        'search'=>[
            'failed'=>[
                'http_code' => 500,
                'code' => 'ZBASEMENT_CODE_FIELD_SEARCH_FAILED',
                'status' => false,
                'message' => '数据模型中字段丢失!'
            ],
        ],
    ],
    'fields'=>[
        'search'=>[
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_FIELDS_SEARCH_SUCCESS',
                'status' => true,
                'message' => '数据模型中字段搜索成功!'
            ],
            'failed'=>[
                'http_code' => 500,
                'code' => 'ZBASEMENT_CODE_FIELDS_SEARCH_FAILED',
                'status' => false,
                'message' => '数据模型中字段搜索失败!'
            ],
        ],
    ],
    'store'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_STORE_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到数据插入提交申请!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_STORE_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '数据插入操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_STORE_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '数据插入操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_STORE_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '数据插入操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_STORE_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '数据插入操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_STORE_VALIDATION',
            'status' => false,
            'message' => '新建用户帐户时输入参数验证失败!'
        ],
    ],
    'update'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_UPDATE_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到数据更新提交申请!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_UPDATE_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '数据更新操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_UPDATE_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '数据更新操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_UPDATE_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '数据更新操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_UPDATE_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '数据更新操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_UPDATE_VALIDATION',
            'status' => false,
            'message' => '更新数据时输入参数验证失败!'
        ],
    ],
    'search'=>[
        'failed'=>[
            'code'=>'ZBASEMENT_CODE_SEARCH_FAILED',
            'http_code'=>'403',
            'message'=>'搜索失败！',
            'status'=>false,
            ],
        'success'=>[
            'code'=>'ZBASEMENT_CODE_SEARCH_SUCCESS',
            'http_code'=>'200',
            'message'=>'搜索成功！',
            'status'=>true,
        ]
    ],
    'authorize'=>[
        'failed'=>[
            'code'=>'ZBASEMENT_CODE_AUTHORIZE_FAILED',
            'http_code'=>'403',
            'message'=>'授权失败，用户无权限访问该资源！',
            'status'=>false,
        ],
        'success'=>[
            'code'=>'ZBASEMENT_CODE_AUTHORIZE_SUCCESS',
            'http_code'=>'200',
            'message'=>'授权成功！',
            'status'=>true,
        ]
    ],
    'delete'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_DELETE_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到批量数据删除提交申请!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_DELETE_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '批量数据删除操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_DELETE_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '批量数据删除操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_DELETE_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '批量数据删除操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_DELETE_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '批量数据删除操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_DELETE_VALIDATION',
            'status' => false,
            'message' => '批量删除数据时输入参数验证失败!'
        ],
    ],
    'destroy'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_DESTROY_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到数据删除提交申请!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_DESTROY_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '数据删除操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_DESTROY_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '数据删除操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_DESTROY_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '数据删除操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_DESTROY_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '数据删除操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_DESTROY_VALIDATION',
            'status' => false,
            'message' => '删除数据时输入参数验证失败!'
        ],
    ],
    'clear'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_CLEAR_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到组内数据移除提交申请!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_CLEAR_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '组内数据移除操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_CLEAR_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '组内数据移除操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_CLEAR_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '组内数据移除操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_CLEAR_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '组内数据移除操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_CLEAR_VALIDATION',
            'status' => false,
            'message' => '组内数据移除时输入参数验证失败!'
        ],
    ],
    'append'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_APPEND_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到组内数据添加提交申请!'
            ],
            'failed'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_APPEND_SUBMIT_FAILED',
                'status' => true,
                'message' => '组内数据添加失败!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_APPEND_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '组内数据添加操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_APPEND_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '组内数据添加操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_APPEND_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '组内数据添加操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_APPEND_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '组内数据添加操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_APPEND_VALIDATION',
            'status' => false,
            'message' => '组内数据添加时输入参数验证失败!'
        ],
    ],
    'expand'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_EXPAND_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到组属性添加提交申请!'
            ],
            'failed'=>[
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_EXPAND_SUBMIT_FAILED',
                'status' => false,
                'message' => '组属性添加失败!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_EXPAND_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '组属性添加操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_EXPAND_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '组属性添加操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_EXPAND_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '组属性添加操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_EXPAND_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '组属性添加操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_EXPAND_VALIDATION',
            'status' => false,
            'message' => '组属性添加时输入参数验证失败!'
        ],
    ],
    'shrink'=>[
        'submit'=>[
            'success'=>[
                'http_code' => 201,
                'code' => 'ZBASEMENT_CODE_SHRINK_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '已经接收到组属性移除提交申请!'
            ],
            'failed'=>[
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_SHRINK_SUBMIT_FAILED',
                'status' => false,
                'message' => '组属性移除失败!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_SHRINK_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '组属性移除操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_SHRINK_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '组属性移除操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_SHRINK_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '组属性移除操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_SHRINK_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '组属性移除操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
        'validation' => [
            'http_code' => 422,
            'code' => 'ZBASEMENT_CODE_SHRINK_VALIDATION',
            'status' => false,
            'message' => '组属性移除时输入参数验证失败!'
        ],
    ],
];
