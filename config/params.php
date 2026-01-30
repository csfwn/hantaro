<?php

return [
    'currency_symbol' => 'RM',
    'pagination_limit' => env('PAGINATION_LIMIT_DEFAULT', 15),
    'bayarcash_portal_key' => env('BAYARCASH_API_PORTAL_KEY'),
    'bayarcash_api_secret_key' => env('BAYARCASH_API_SECRET_KEY'),
    'bayarcash_sanbox' => env('BAYARCASH_SANBOX', true),
    'currency_code' => env('CURRENCY_CODE', 'MYR'),
    'customer_url' => env('APP_URL').'/tracking',
];
