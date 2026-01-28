<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', 'index')->name('index');
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
});

Route::get('/payment/return', [PaymentController::class, 'return'])->name('payment.return');


require __DIR__.'/settings.php';
