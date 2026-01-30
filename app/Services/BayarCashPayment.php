<?php

namespace App\Services;

use App\Models\Order;
use Webimpian\BayarcashSdk\Bayarcash;

class BayarCashPayment
{
    public $portalKey;

    public function configureBayarCash(): Bayarcash
    {
        $this->portalKey = config('params.bayarcash_portal_key');
        $bayarcash = app(Bayarcash::class);

        if (config('params.bayarcash_sanbox')) {
            $bayarcash->useSandbox();
        }

        $bayarcash->setApiVersion('v3');
        return $bayarcash;
    }

    public function getChannels()
    {
        $bayarcash = $this->configureBayarCash();
        return $bayarcash->getChannels($this->portalKey);
    }

    public function processPayment(Order $order)
    {
        $bayarcash = $this->configureBayarCash();

        $data = [
            'portal_key' => $this->portalKey,
            'order_number' => $order->ref_no,
            'amount' => $order->total_amount, // float 
            'payer_name' => $order->customer_name,
            'payer_email' => $order->customer_email,
            'payer_telephone_number' => $order->customer_phone, // string ]
            'callback_url' => route('payment.callback'),
            'return_url' => route('payment.return'),
            // 'callback_url' =>  route('payment.callback'),
            // 'return_url' => route('payment.return'),
            'payment_channel' => $order->payment_method,
        ];

        // Make sure checksum is last 
        $data['checksum'] = $bayarcash->createPaymentIntentChecksumValue(
            config('params.bayarcash_api_secret_key'),
            $data
        );

        try {
            $response = $bayarcash->createPaymentIntent($data);
            return $response->url;
        } catch (\Throwable $e) {
            \Log::warning('Payment failed', $e->getMessage());
        }
    }

    public function callbackValidation($request)
    {
        $bayarcash = $this->configureBayarCash();

        $isValid = $bayarcash->verifyTransactionCallbackData(
            $request->all(),
            config('params.bayarcash_api_secret_key')
        );

        return $isValid;
    }
}
