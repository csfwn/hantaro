<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TiktokController;
use App\Http\Controllers\TikTokProductTestController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/order-status/{ref}', function ($ref) {
    return Order::where('ref_no', $ref)->firstOrFail();
});

Route::post('/tiktok/callback', [TiktokController::class, 'callback'])->name('tiktok.callback');
Route::post('/tiktok/webhook', [TiktokController::class, 'webhook'])->name('tiktok.webhook');

Route::get('/test/tiktok/products', [TikTokProductTestController::class, 'sync']);
