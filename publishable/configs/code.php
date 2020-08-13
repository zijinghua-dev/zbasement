<?php
return [

    'index' => [
        'submit'=>[
            'success' => [
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_INDEX_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '获取列表成功!'
            ],
            'failed' => [
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_INDEX_SUBMIT_FAILED',
                'status' => false,
                'message' => '获取用户列表失败!'
            ],
        ],

        'validation' => [
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_INDEX_VALIDATION_FAILED',
                'status' => false,
                'message' => '列表输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_INDEX_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '列表输入参数验证成功!'
            ],
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
        'submit'=>[
            'success' => [
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_FETCH_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '获取单个记录成功!'
            ],
            'failed' => [
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_FETCH_SUBMIT_FAILED',
                'status' => false,
                'message' => '获取单个记录失败!'
            ],
        ],

        'validation' => [
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_FETCH_VALIDATION_FAILED',
                'status' => false,
                'message' => '查找单个记录输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_FETCH_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '查找单个记录输入参数验证成功!'
            ],
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
        'submit'=>[
            'success' => [
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_SHOW_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '获取详情信息成功!'
            ],
            'failed' => [
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_SHOW_SUBMIT_FAILED',
                'status' => false,
                'message' => '获取详情信息失败!'
            ],
        ],

        'validation' => [
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_SHOW_VALIDATION_FAILED',
                'status' => false,
                'message' => '详情信息输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_SHOW_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '详情信息输入参数验证成功!'
            ],
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
            'submit'=>[
                'failed'=>[
                    'http_code' => 500,
                    'code' => 'ZBASEMENT_CODE_FIELD_SEARCH_SUBMIT_FAILED',
                    'status' => false,
                    'message' => '数据模型中字段丢失!'
                ],
            ]

        ],
    ],
    'fields'=>[
        'search'=>[
            'submit'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_FIELDS_SEARCH_SUBMIT_SUCCESS',
                    'status' => true,
                    'message' => '数据模型中字段搜索成功!'
                ],
                'failed'=>[
                    'http_code' => 500,
                    'code' => 'ZBASEMENT_CODE_FIELDS_SEARCH_SUBMIT_FAILED',
                    'status' => false,
                    'message' => '数据模型中字段搜索失败!'
                ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_STORE_VALIDATION_FAILED',
                'status' => false,
                'message' => '新建用户帐户时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_STORE_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '新建用户帐户时输入参数验证成功!'
            ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_UPDATE_SUBMIT_FAILED',
                'status' => true,
                'message' => '数据更新提交失败!'
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_UPDATE_VALIDATION_FAILED',
                'status' => false,
                'message' => '更新数据时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_UPDATE_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '更新数据时输入参数验证失败!'
            ],
        ],
    ],
    'search'=>[
        'submit'=>[
            'failed'=>[
                'code'=>'ZBASEMENT_CODE_SEARCH_SUBMIT_FAILED',
                'http_code'=>'403',
                'message'=>'搜索失败！',
                'status'=>false,
            ],
            'success'=>[
                'code'=>'ZBASEMENT_CODE_SEARCH_SUBMIT_SUCCESS',
                'http_code'=>'200',
                'message'=>'搜索成功！',
                'status'=>true,
            ]
        ],

    ],
    'authorize'=>[
        'submit'=>[
            'failed'=>[
                'code'=>'ZBASEMENT_CODE_AUTHORIZE_SUBMIT_FAILED',
                'http_code'=>'403',
                'message'=>'授权失败，用户无权限访问该资源！',
                'status'=>false,
            ],
            'success'=>[
                'code'=>'ZBASEMENT_CODE_AUTHORIZE_SUBMIT_SUCCESS',
                'http_code'=>'200',
                'message'=>'授权成功！',
                'status'=>true,
            ]
        ],
        'validation' => [
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_AUTHORIZE_VALIDATION_FAILED',
                'status' => false,
                'message' => '授权时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_AUTHORIZE_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '授权时输入参数验证成功!'
            ],
        ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_DELETE_VALIDATION_FAILED',
                'status' => false,
                'message' => '批量删除数据时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_DELETE_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '批量删除数据时输入参数验证成功!'
            ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_DESTROY_VALIDATION_FAILED',
                'status' => false,
                'message' => '删除数据时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_DESTROY_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '删除数据时输入参数验证成功!'
            ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_CLEAR_VALIDATION_FAILED',
                'status' => false,
                'message' => '组内数据移除时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_CLEAR_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '组内数据移除时输入参数验证成功!'
            ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_APPEND_VALIDATION_FAILED',
                'status' => false,
                'message' => '组内数据添加时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_APPEND_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '组内数据添加时输入参数验证成功!'
            ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_EXPAND_VALIDATION_FAILED',
                'status' => false,
                'message' => '组属性添加时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_EXPAND_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '组属性添加时输入参数验证成功!'
            ],
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
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_SHRINK_VALIDATION_FAILED',
                'status' => false,
                'message' => '组属性移除时输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_SHRINK_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '组属性移除时输入参数验证成功!'
            ]
        ],
    ],

    'mine' => [
        'submit'=>[
            'success' => [
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_MINE_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '获取我的列表成功!'
            ],
            'failed' => [
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_MINE_SUBMIT_FAILED',
                'status' => false,
                'message' => '获取我的列表失败!'
            ],
        ],

        'validation' => [
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_MINE_VALIDATION_FAILED',
                'status' => false,
                'message' => '我的列表输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_MINE_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '我的列表输入参数验证成功!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_MINE_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '我的列表操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_MINE_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '我的列表操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_MINE_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '我的列表操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_MINE_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '我的列表操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
    ],
    'run' => [
        'submit'=>[
            'success' => [
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_RUN_SUBMIT_SUCCESS',
                'status' => true,
                'message' => '运行成功!'
            ],
            'failed' => [
                'http_code' => 403,
                'code' => 'ZBASEMENT_CODE_RUN_SUBMIT_FAILED',
                'status' => false,
                'message' => '运行失败!'
            ],
        ],

        'validation' => [
            'failed'=>[
                'http_code' => 422,
                'code' => 'ZBASEMENT_CODE_RUN_VALIDATION_FAILED',
                'status' => false,
                'message' => '运行操作输入参数验证失败!'
            ],
            'success'=>[
                'http_code' => 200,
                'code' => 'ZBASEMENT_CODE_RUN_VALIDATION_SUCCESS',
                'status' => true,
                'message' => '运行操作输入参数验证成功!'
            ],
        ],
        'load'=>[
            'rules'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_RUN_LOAD_RULES_SUCCESS',
                    'status' => true,
                    'message' => '运行操作所需验证规则加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_RUN_LOAD_RULES_FAILED',
                    'status' => false,
                    'message' => '运行操作所需验证规则加载失败!'
                ],

            ],
            'messages'=>[
                'success'=>[
                    'http_code' => 200,
                    'code' => 'ZBASEMENT_CODE_RUN_LOAD_MESSAGES_SUCCESS',
                    'status' => true,
                    'message' => '运行操作所需验证规则的提示信息加载成功!'
                ],
                'failed'=>[
                    'http_code' => 403,
                    'code' => 'ZBASEMENT_CODE_RUN_LOAD_MESSAGES_FAILED',
                    'status' => false,
                    'message' => '运行操作所需验证规则的提示信息加载失败!'
                ],

            ],
        ],
    ],
];
