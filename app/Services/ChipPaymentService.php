<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChipPaymentService
{
    protected $brandId;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->brandId = config('services.chip.brand_id');
        $this->apiKey = config('services.chip.api_key');
        $this->baseUrl = config('services.chip.endpoint');
    }

    public function createPurchase(array $data)
    {
        $payload = [
            'client' => [
                'email' => $data['email'],
                'full_name' => $data['name'],
            ],
            'purchase' => [
                'currency' => config('params.currency'),
                'products' => $data['products'],
            ],
            'brand_id' => $this->brandId
        ];

        if (!empty($data['success_url'])) {
            $payload['success_redirect'] = $data['success_url'];
        }

        if (!empty($data['failure_url'])) {
            $payload['failure_redirect'] = $data['failure_url'];
        }

        if (!empty($data['reference'])) {
            $payload['reference'] = $data['reference'];
        }

        Log::info('CHIP Request:', [
            'url' => "{$this->baseUrl}/purchases/",
            'payload' => $payload
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/purchases/", $payload);

            Log::info('CHIP Response:', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if ($response->successful()) {
                return (object) $response->json();
            }

            throw new \Exception('CHIP API Error (' . $response->status() . '): ' . $response->body());

        } catch (\Exception $e) {
            Log::error('CHIP Payment Error:', [
                'message' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function getPurchase(string $purchaseId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->get("{$this->baseUrl}/purchases/{$purchaseId}/");

            Log::info('CHIP Get Purchase Response:', [
                'purchase_id' => $purchaseId,
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if ($response->successful()) {
                return (object) $response->json();
            }

            throw new \Exception('Failed to retrieve purchase: ' . $response->body());

        } catch (\Exception $e) {
            Log::error('CHIP Get Purchase Error:', [
                'purchase_id' => $purchaseId,
                'message' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}