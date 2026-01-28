<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class PaymentController extends Controller
{
    // BayarCash callback (server-to-server)
    public function callback(Request $request)
    {
        \Log::info('BayarCash callback received', $request->all());
        
        $order = Order::where('ref_no', $request->order_ref)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($request->status === 'SUCCESS') {
            $order->payment_status = PaymentStatus::Paid->value; // paid
            $order->save();
        } else {
            $order->payment_status = PaymentStatus::Failed->value; // failed
            $order->save();
        }

        return response()->json(['message' => 'ok']);
    }

    // BayarCash return URL (frontend redirect)
    public function return(Request $request)
    {
        $order = Order::where('ref_no', $request->query('order_number'))->with('products')->firstOrFail();

        return Inertia::render('checkouts/Receipt', [
            'order' => $order
        ]);
    }
}
