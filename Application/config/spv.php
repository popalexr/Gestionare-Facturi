<?php

return [
    'status' => [
        'pending'  => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'not_set'  => 'Not set',
    ],
    'url' => [
        'authorize' => env('SPV_URL_AUTHORIZE', ''),
        'token'     => env('SPV_URL_TOKEN', ''),
        'upload'    => env('SPV_URL_UPLOAD', ''),
        'get_status'=> env('SPV_URL_GET_STATUS', ''),
    ],
    'client' => [
        'id'     => env('SPV_CLIENT_ID', ''),
        'secret' => env('SPV_CLIENT_SECRET', ''),
    ],
];