<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TiktokController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/order-status/{ref}', function ($ref) {
    return Order::where('ref_no', $ref)->firstOrFail();
});

Route::post('/tiktok/callback', [TiktokController::class, 'callback'])->name('tiktok.callback');
