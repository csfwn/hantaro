<?php

use App\Models\Order;
use App\Models\Store;

if (!function_exists('random_alphanumeric')) {
    function random_alphanumeric(int $length = 7)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($characters), 0, $length);
    }
}

if (!function_exists('order_ref_no')) {
    function order_ref_no()
    {
        $code = 'ORD-'.random_alphanumeric();

        while (Order::where('ref_no', $code)->count()) {
            $code = 'ORD-'.random_alphanumeric();
        }

        return $code;
    }
}

if (!function_exists('code_generate')) {
    function code_generate()
    {
        $code = random_alphanumeric();

        while (Store::where('code', $code)->count()) {
            $code = random_alphanumeric();
        }

        return $code;
    }
}

if (!function_exists('store_session')) {
    function store_session(): ?Store
    {
        $code = session('store_code');

        if (!$code) {
            return null;
        }

        return Store::where('code', $code)->first();
    }
}