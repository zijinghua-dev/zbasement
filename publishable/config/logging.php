<?php
return [
    'activity_log' => [
        'driver' => 'daily',
        'path' => storage_path('logs/activity.log'),
        'handler' => Monolog\Handler\StreamHandler::class,
        'formatter' => Monolog\Formatter\JsonFormatter::class,
        'value_max_length' => env('REQUEST_LOG_VALUE_MAX_LENGTH', 300),
    ]
];