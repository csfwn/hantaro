<?php

return [
    'currency_symbol' => 'RM',
    'pagination_limit' => env('PAGINATION_LIMIT_DEFAULT', 15),
    'bayarcash_portal_key' => env('BAYARCASH_API_PORTAL_KEY'),
    'bayarcash_sanbox' => env('BAYARCASH_SANBOX', true)
];
