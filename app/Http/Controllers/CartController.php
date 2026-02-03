<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreResource;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class CartController extends Controller
{
    // Add or update product in session cart
    public function add(Request $request)
    {
        $store = store_session();

        if (!$store) {
            return redirect('/');
        }

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        // Get existing cart or create new
        $cart = session()->get('cart', [
            'store_id' => $store->id,
            'items' => [],
        ]);

        // Cart belongs to different store → reset
        if ($cart['store_id'] !== $store->id) {
            $cart = [
                'store_id' => $store->id,
                'items' => [],
            ];
        }

        $increment = $request->boolean('increment');

        foreach ($request->items as $item) {
            $product = Product::where('id', $item['product_id'])
                ->where('store_id', $store->id)
                ->first();

            if (!$product) continue;

            $qty = $item['quantity'];
            $pid = $product->id;

            // ✅ MULTI-ITEM LOGIC
            if (isset($cart['items'][$pid])) {
                $cart['items'][$pid]['quantity'] = $increment
                    ? $cart['items'][$pid]['quantity'] + $qty
                    : $qty;
            } else if ($qty > 0) {
                $cart['items'][$pid] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty,
                ];
            }

            // Remove if quantity <= 0
            if (($cart['items'][$pid]['quantity'] ?? 0) <= 0) {
                unset($cart['items'][$pid]);
            }
        }

        // Save / clear cart
        if (empty($cart['items'])) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->to(url()->previous());
    }

    public function remove(Request $request)
    {
        $store = store_session();

        if (!$store) {
            return redirect('/');
        }

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'nullable|integer|min:1',
        ]);

        $cart = session()->get('cart');

        if (
            !$cart ||
            $cart['store_id'] !== $store->id
        ) {
            session()->forget('cart');
            return redirect()->to(url()->previous());
        }

        foreach ($request->items as $item) {
            $pid = $item['product_id'];
            $qty = $item['quantity'] ?? null;

            if (!isset($cart['items'][$pid])) continue;

            if ($qty !== null) {
                $cart['items'][$pid]['quantity'] -= $qty;
                if ($cart['items'][$pid]['quantity'] <= 0) {
                    unset($cart['items'][$pid]);
                }
            } else {
                unset($cart['items'][$pid]);
            }
        }

        if (empty($cart['items'])) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->to(url()->previous());
    }


    public function review()
    {
        $cart = session()->get('cart', []);
        $items = $cart['items'] ?? [];
        
        return Inertia::render('carts/Review', [
            'customer' => session('customer'),
            'cart' => $cart,
            'store' => new StoreResource(store_session()),
            'cartQuantity' => array_sum(array_map(fn($i) => $i['quantity'], $items)),
            'cartTotal' => array_sum(array_map(fn($i) => $i['quantity'] * $i['price'], $items)),
        ]);
    }
}
