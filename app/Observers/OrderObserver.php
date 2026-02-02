<?php

namespace App\Observers;

use App\Enums\PaymentStatus;
use App\Jobs\SendPaymentSuccessWhatsApp;
use App\Models\Order;
use Carbon\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "creating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        $order->ref_no = order_ref_no();
    }

    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void {}

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if (
            $order->wasChanged('payment_status') &&
            $order->payment_status->value === PaymentStatus::Success->value &&
            !$order->whatsapp_sent
        ) {
            SendPaymentSuccessWhatsApp::dispatch($order->id);
        }
    }



    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
