<?php

return [
    'currency_symbol' => 'RM',
    'pagination_limit' => env('PAGINATION_LIMIT_DEFAULT', 15),
    'bayarcash_portal_key' => env('BAYARCASH_API_PORTAL_KEY'),
    'bayarcash_api_secret_key' => env('BAYARCASH_API_SECRET_KEY'),
    'bayarcash_sanbox' => env('BAYARCASH_SANBOX', true),
    'callback_url' => 'https://hantaro.stwo.my/payment/callback',
    'return_url' => 'https://hantaro.stwo.my/payment/return',
];
