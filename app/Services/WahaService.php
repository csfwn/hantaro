<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WahaService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $session;

    public function __construct()
    {
        $this->baseUrl = config('params.waha_base_url');
        $this->apiKey  = config('params.waha_api_key');
        $this->session = config('params.waha_session');
    }

    protected function request()
    {
        return Http::withHeaders([
            'X-Api-Key'    => $this->apiKey,
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }

    public function sendText(string $phone, string $message)
    {
        $chatId = $this->formatChatId($phone);

        return $this->request()
            ->post($this->baseUrl . '/api/sendText', [
                'session' => $this->session,
                'chatId'  => $chatId,
                'text'    => $message,
            ])
            ->json();
    }

    protected function formatChatId(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (!str_ends_with($phone, '@c.us')) {
            $phone .= '@c.us';
        }

        return $phone;
    }
}
