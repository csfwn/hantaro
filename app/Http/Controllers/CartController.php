<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Webimpian\BayarcashSdk\Bayarcash;

class CartController extends Controller
{
    // Add or update product in session cart
    public function add(Request $request)
    {
        $request->validate([
            'store_id' => 'nullable|exists:stores,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $increment = $request->input('increment', false);

        foreach ($request->input('items') as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];

            $product = Product::find($productId);
            if (!$product) continue;

            if (isset($cart[$productId])) {
                if ($increment) {
                    $cart[$productId]['quantity'] += $quantity;
                } else {
                    $cart[$productId]['quantity'] = $quantity; // replace quantity
                }
            } else {
                if ($quantity > 0) {
                    $cart[$productId] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $quantity,
                    ];
                }
            }

            // Remove product if quantity <= 0
            if (isset($cart[$productId]) && $cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated.');
    }

    // Remove product from cart
    public function remove(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'nullable|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        foreach ($request->items as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'] ?? null;

            if (!isset($cart[$productId])) continue;

            if ($quantity !== null) {
                $cart[$productId]['quantity'] -= $quantity;
                if ($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]);
                }
            } else {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated.');
    }

    // Return full cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }

    public function review()
    {
        $cart = session()->get('cart', []);
        $channels = (new \App\Services\BayarCashPayment())->getChannels();

        return Inertia::render('carts/Review', [
            'customer' => session('customer'),
            'channels' => $channels,
            'cart' => $cart,
            'cartQuantity' => array_sum(array_map(fn($item) => $item['quantity'], $cart)),
            'cartTotal' => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)),
        ]);
    }
}
