<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function show(Request $request, string $code)
    {
        $store = Store::where('code', $code)
            ->where('status', ActiveStatus::Active->value)
            ->firstOrFail();

        $products = Product::query()
            ->where('store_id', $store->id)
            ->where('is_active', true)
            ->with('store')
            ->filter($request->all())
            ->latest()
            ->paginate(config('params.pagination_limit'));

        return inertia('stores/Show', [
            'store' => new StoreResource($store),
            'products' => ProductResource::collection($products),
        ]);
    }
}
