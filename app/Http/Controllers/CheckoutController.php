<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Validate request
        $request->validate([
            'payment_method' => 'required|in:cash,qr',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'regex:/^60\d{8,13}$/'], // starts with 60
            'customer_address' => 'required|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $items = $request->items;
        $paymentMethod = $request->payment_method;

        // Generate unique order reference
        $refNo = 'ORD-' . strtoupper(Str::random(8));

        // Calculate total amount
        $totalAmount = 0;
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            $totalAmount += $product->price * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'ref_no' => $refNo,
            'currency_code' => 'MYR',
            'total_amount' => $totalAmount,
            'paid_amount' => 0,
            'delivery_fee' => 0,
            'service_fee' => 0,
            'payment_method' => $paymentMethod,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'status' => 0, // pending
        ]);

        // Save order products
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
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

        // Generate WhatsApp message
        $now = now();
        $orderDate = $now->format('d/m/Y');
        $orderTime = $now->format('h:ia');

        $message = "Hi, saya nak order:\n";
        foreach ($order->products as $p) {
            $message .= "- {$p->name} x {$p->quantity}\n";
        }

        $message .= "\nTarikh Hantar: {$orderDate}\n";
        $message .= "Masa: {$orderTime}\n\n";
        $message .= "Maklumat Pembeli:\n";
        $message .= "- Nama: {$order->customer_name}\n";
        $message .= "- Phone: {$order->customer_phone}\n";
        $message .= "- Alamat: {$order->customer_address}\n\n";
        $message .= "Kaedah pembayaran:\n- {$order->payment_method}\n\n";
        $message .= "Harga total: RM " . number_format($order->total_amount, 2);

        // WhatsApp number to send to (merchant)
        $whatsappNumber = '60129531174';
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$whatsappNumber}&text=" . urlencode($message);

        // Save WhatsApp URL in the order
        $order->update(['whatsapp_url' => $whatsappUrl]);

        // Clear session cart
        session()->forget('cart');

        // Redirect user to WhatsApp
        // return redirect()->away($whatsappUrl);
        return Inertia::location($whatsappUrl);
    }
}
