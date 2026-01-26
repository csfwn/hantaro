<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

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

        return Inertia::render('carts/Review', [
            'cart' => $cart,
            'cartQuantity' => array_sum(array_map(fn($item) => $item['quantity'], $cart)),
            'cartTotal' => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)),
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,qr',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        $cartItems = $request->items;
        $paymentMethod = $request->payment_method;

        // Here you can save the order to database...
        // e.g., Order::create([...]);

        // Clear session cart
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
