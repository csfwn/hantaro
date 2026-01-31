<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\WahaService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendPaymentSuccessWhatsApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;          // retry 3 times
    public int $timeout = 30;       // seconds
    public $backoff = [10, 30, 60]; // retry delay

    public function __construct(
        public int $orderId
    ) {}

    public function handle(WahaService $waha): void
    {
        $order = Order::find($this->orderId);

        if (!$order || !$order->customer_phone) {
            Log::warning('WAHA: Order not found or phone missing', [
                'order_id' => $this->orderId,
            ]);
            return;
        }

        $message = $this->buildMessage($order);

        $response = $waha->sendText(
            $order->customer_phone,
            $message
        );

        $order->update([
            'whatsapp_sent' => true,
        ]);

        Log::info('WAHA: Payment success message sent', [
            'order_id' => $order->id,
            'response' => $response,
        ]);
    }

    protected function buildMessage(Order $order): string
    {
        return
            "Hi 👋, {$order->customer_name}\n\n"
            . "Payment received successfully\n\n"
            . "Order No: *{$order->ref_no}*\n"
            . "Amount: RM {$order->paid_amount}\n\n"
            . "Track your order:\n"
            . route('order.tracking', ['code' => $order->ref_no]);
    }
}
