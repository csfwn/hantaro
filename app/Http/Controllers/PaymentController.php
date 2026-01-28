<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\BayarCashPayment;
use Inertia\Inertia;

class PaymentController extends Controller
{
    // BayarCash callback (server-to-server)
    public function callback(Request $request)
    {
        \Log::info('BayarCash CALLBACK HIT', $request->all());

        $bayarCashPayment = new BayarCashPayment();
        $isValid = $bayarCashPayment->callbackValidation($request);
        
        if (!$isValid) {
            \Log::warning('Invalid BayarCash callback checksum');
            return response()->json(['error' => 'Invalid checksum'], 400);
        }

        $order = Order::where('ref_no', $request->order_number)->first();

        if (!$order) {
            \Log::warning('Order not found', $request->all());
            return response()->json(['error' => 'Order not found'], 404);
        }

        // status is INTEGER
        if ((int) $request->status === 3) {
            $order->payment_status = PaymentStatus::Paid->value;
        } else {
            $order->payment_status = PaymentStatus::Failed->value;
        }

        $order->save();

        return response()->json(['message' => 'OK'], 200);
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
