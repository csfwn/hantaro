<?php

use App\Models\Order;

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
        $code = random_alphanumeric();

        while (Order::where('ref_no', $code)->count()) {
            $code = random_alphanumeric();
        }

        return $code;
    }
}