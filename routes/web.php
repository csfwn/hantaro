<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('/privacy', function () {
    return Inertia::render('PrivacyPolicy');
});

Route::get('/terms', function () {
    return Inertia::render('TermsOfService');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    // Route::get('/', 'index')->name('index');
    Route::get('{product}', 'show')->name('show');
});

Route::controller(CartController::class)->prefix('carts')->name('carts.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/review', 'review')->name('review');
    Route::get('{cart}', 'show')->name('show');
    Route::post('/add', 'add')->name('add');  
    Route::post('/remove', 'remove')->name('remove'); 
});

Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/pay-again/{orderId}', 'payAgain')->name('payAgain');
    Route::post('/process', 'process')->name('process');
    Route::post('/pay', 'pay')->name('pay');
});

Route::controller(StoreController::class)->prefix('store')->name('store.')->group(function () {
     Route::get('{code}', 'show')->name('show');
});

Route::controller(PaymentController::class)->prefix('payment')->name('payment.')->group(function () {
    Route::get('/return', 'return')->name('return');
    Route::get('/success/{order}', 'success')->name('success');
    Route::get('/failure/{order}', 'failure')->name('failure');
});

Route::controller(PaymentController::class)->prefix('payment')->name('payment.')->group(function () {
    Route::get('/return', 'return')->name('return');
    Route::get('/success/{order}', 'success')->name('success');
    Route::get('/failure/{order}', 'failure')->name('failure');
});

Route::get('/receipt/{order}/download', [ReceiptController::class, 'download'])->name('receipt.download');
Route::get('/tracking/{code}', [TrackingController::class, 'track'])->name('order.tracking');

require __DIR__.'/settings.php';
