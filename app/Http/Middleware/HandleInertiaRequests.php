<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
// app/Http/Middleware/HandleInertiaRequests.php

public function share(Request $request): array
{
    $cart = $request->session()->get('cart', []);

    $cartQuantity = collect($cart)->sum('quantity');
    $cartTotal = collect($cart)->sum(fn($item) => $item['quantity'] * $item['price']);

    return [
        ...parent::share($request),
        'name' => config('app.name'),
        'auth' => [
            'user' => $request->user(),
        ],
        'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',

        // Share full cart
        'cart' => $cart,
        'cartQuantity' => $cartQuantity,
        'cartTotal' => $cartTotal,

        // optional store info
        'store' => $request->session()->get('store', null),
    ];
}


}
