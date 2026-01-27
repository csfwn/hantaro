<?php

return [
    'currency_symbol' => 'RM',
    'pagination_limit' => env('PAGINATION_LIMIT_DEFAULT', 15),
    'bayarcash_portal_key' => env('BAYARCASH_API_PORTAL_KEY'),
    // 'callback_url' => route('payment.callback'),
    // 'return_url'   => route('payment.return'),
];
