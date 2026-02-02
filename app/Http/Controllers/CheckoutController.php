<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\BayarCashPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function process(CheckoutRequest $request)
    {
        session()->put('customer', [
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'address' => $request->customer_address,
            'email' => $request->customer_email,
        ]);

        $items = $request->items;

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $totalAmount += $product->price * $item['quantity'];
            }
            $store = store_session();
            $order = Order::create([
                'currency_code' => 'MYR',
                'store_id' => $store->id,
                'total_amount' => $totalAmount,
                'paid_amount' => 0,
                'delivery_fee' => 0,
                'service_fee' => 0,
                'payment_method' => $request->payment_method,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_email' => $request->customer_email,
                'status' => OrderStatus::Processing->value,
                'payment_status' => PaymentStatus::New->value,
            ]);

            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'store_id' => $product->store_id ?? null,
                    'name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }

            DB::commit();

            $bayarCashPayment = new BayarCashPayment();
            $paymentUrl = $bayarCashPayment->processPayment($order);

            return Inertia::location($paymentUrl);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Order creation failed: ' . $e->getMessage()]);
        }
    }

    public function payAgain($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Only allow retry if payment is not already successful
        if ($order->payment_status === PaymentStatus::Success->value) {
            return back()->withErrors(['error' => 'Pembayaran telah berjaya, tidak boleh bayar semula.']);
        }

        $bayarCashPayment = new BayarCashPayment();
        $paymentUrl = $bayarCashPayment->processPayment($order); // Generate new payment URL

        return Inertia::location($paymentUrl); // Redirect user to BayarCash payment page
    }
}
