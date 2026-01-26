<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->where('is_active', true)->whereHas('store', function ($q) {
                $q->where('status', ActiveStatus::Active->value);
            })->with('store')
            ->filter($request->all())
            ->latest()
            ->paginate(config('params.pagination_limit'));

        return inertia('products/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }

    public function show(Product $product)
    {
        $product->load('store'); 

        return inertia('products/Show', [
            'product' => new ProductResource($product),
        ]);
    }
}
