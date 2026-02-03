<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ChipPaymentService;
use App\Enums\PaymentStatus;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function success(Order $order, ChipPaymentService $chip)
    {
        try {
            // Verify payment with CHIP
            if ($order->payment_gateway_reference) {
                $purchase = $chip->getPurchase($order->payment_gateway_reference);
                
                Log::info('CHIP Payment Success Callback:', [
                    'order_id' => $order->id,
                    'purchase_status' => $purchase->status ?? 'unknown',
                    'purchase_data' => $purchase
                ]);

                // Update order if payment is confirmed
                if (isset($purchase->status) && $purchase->status === 'paid') {
                    $order->update([
                        'payment_status' => PaymentStatus::Success->value,
                        'paid_amount' => $order->total_amount,
                        'status' => OrderStatus::Processing->value,
                    ]);

                    session()->forget('customer');

                    return Inertia::render('payments/Success', [
                        'order' => $order->load('products', 'store'),
                        'message' => 'Payment successful! Your order has been confirmed.',
                    ]);
                }
            }

            // If payment not confirmed, show pending status
            return Inertia::render('payments/Pending', [
                'order' => $order->load('products', 'store'),
                'message' => 'Payment is being processed. Please wait for confirmation.',
            ]);

        } catch (\Exception $e) {
            Log::error('Payment success callback error:', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return Inertia::render('payments/Pending', [
                'order' => $order->load('products', 'store'),
                'message' => 'Payment verification in progress. We will notify you once confirmed.',
            ]);
        }
    }

    public function failure(Order $order, ChipPaymentService $chip)
    {
        try {
            // Verify payment status with CHIP
            if ($order->payment_gateway_reference) {
                $purchase = $chip->getPurchase($order->payment_gateway_reference);
                
                Log::info('CHIP Payment Failure Callback:', [
                    'order_id' => $order->id,
                    'purchase_status' => $purchase->status ?? 'unknown',
                    'purchase_data' => $purchase
                ]);

                // Check if payment is actually paid (user might have paid but clicked back)
                if (isset($purchase->status) && $purchase->status === 'paid') {
                    return redirect()->route('payment.success', ['order' => $order->id]);
                }
            }

            // Mark order as failed
            $order->update([
                'payment_status' => PaymentStatus::Failed->value,
            ]);

            return Inertia::render('payments/Failure', [
                'order' => $order->load('products', 'store'),
                'message' => 'Payment was not completed. Please try again.',
            ]);

        } catch (\Exception $e) {
            Log::error('Payment failure callback error:', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return Inertia::render('paymets/Failure', [
                'order' => $order->load('products', 'store'),
                'message' => 'Payment was not completed. Please try again.',
            ]);
        }
    }

    public function return(Request $request)
    {
        // Generic return handler (if needed for backward compatibility)
        Log::info('Payment return endpoint hit', $request->all());
        
        return redirect()->route('home')->with('info', 'Payment process completed.');
    }
}