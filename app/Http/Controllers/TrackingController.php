<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;

class TrackingController extends Controller
{
    public function track($code)
    {
        $order = Order::where('ref_no', $code)->with('products')->first();

        return inertia('orders/Track', [
            'order' => new OrderResource($order),
        ]);   
    }
}
