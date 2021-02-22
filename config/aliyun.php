<?php

return [
    'access_id' => env('ALIYUN_ACCESS_ID'),
    'access_key' => env('ALIYUN_ACCESS_KEY'),

    'services' => [
        'cdn' => [
            'driver' => 'cdn',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY'),
        ],
        'cloudPush' => [
            'driver' => 'cloudPush',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY'),
        ],
        'dns' => [
            'driver' => 'dns',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY'),
        ],
        'domain' => [
            'driver' => 'domain',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY')
        ],
        'httpDns' => [
            'driver' => 'httpDns',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY')
        ],
        'dm' => [
            'driver' => 'dm',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY')
        ],
        'snSu' => [
            'driver' => 'snSu',
            'access_id' => env('ALIYUN_ACCESS_ID'),
            'access_key' => env('ALIYUN_ACCESS_KEY')
        ],
    ],

];