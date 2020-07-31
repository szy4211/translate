<?php

return [
    'default'  => 'baidu',
    'gateways' => [
        'baidu'  => [
            'app_id'       => env('TRANS_BAIDU_APP_ID'),
            'app_secret'   => env('TRANS_BAIDU_APP_SECRET'),
        ],
        'youdao' => [
            'app_id'       => env('TRANS_YOUDAO_APP_ID'),
            'app_secret'   => env('TRANS_YOUDAO_APP_SECRET'),
        ],
    ],
    // common options
    'options'  => [
        'http_timeout' => env('TRANS_HTTP_TIMEOUT', 5.0), // http timeout
        'http_options' => [],
    ]
];