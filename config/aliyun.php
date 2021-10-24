<?php

return [
    'default' => [// 默认设置
        'type' => 'access_key',
        'region' => 'cn-beijing',
        'access_id' => env('ALIBABA_CLOUD_ACCESS_KEY_ID'),
        'access_key' => env('ALIBABA_CLOUD_ACCESS_KEY_SECRET'),
        'connect_timeout' => 5,
        'timeout' => 10,
        'proxy' => null,
        //'debug' => env('APP_DEBUG'),//仅控制台有效
    ],
];