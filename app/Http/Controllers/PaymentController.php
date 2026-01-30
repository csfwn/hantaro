<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\BayarCashPayment;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PaymentController extends Controller
{
    // BayarCash callback (server-to-server)
    public function callback(Request $request)
    {
        Log::channel('bayarcash')->info('CALLBACK HIT', [
            'payload' => $request->all(),
        ]);

        $bayarCashPayment = new BayarCashPayment();
        $isValid = $bayarCashPayment->callbackValidation($request);

        if (!$isValid) {
            Log::channel('bayarcash')->warning('Invalid BayarCash callback checksum HIT');
            return;
        }

        $order = Order::where('ref_no', $request->order_number)->first();

        if (!$order) {
            Log::channel('bayarcash')->warning('Order not found', [
                'payload' => $request->all(),
            ]);
            return;
        }

        $order->payment_status = PaymentStatus::tryFrom((int) $request->status);

        $status = (int)$request->status;

        if ($status === PaymentStatus::Success->value) {
            $order->paid_amount = $request->amount;
        }

        $order->save();

        Log::channel('bayarcash')->info('Payment processed', [
            'order_id' => $order->id,
            'ref_no' => $order->ref_no,
            'status' => $request->status,
            'status_description' => $request->status_description,
            'paid_amount' => $order->paid_amount,
        ]);

        return response()->json(['message' => 'OK'], 200);
    }


    // BayarCash return URL (frontend redirect)
    public function return(Request $request)
    {
        session()->forget('cart', []);
        $order = Order::where('ref_no', $request->query('order_number'))->with('products')->firstOrFail();

        return Inertia::render('checkouts/Receipt', [
            'order' => $order,
            'gatewayStatus' => (int) $request->query('status'), // 👈 IMPORTANT
        ]);
    }
}
