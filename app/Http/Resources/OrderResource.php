<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ref_no' => $this->ref_no,
            'currency_code' => $this->currency_code,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'service_fee' => $this->service_fee,
            'payment_method' => $this->payment_method,
            'whatsapp_url' => $this->whatsapp_url,
            'completed_at' => $this->completed_at,
            'status' => new EnumResource($this->status),
            'payment_status' => new EnumResource($this->payment_status),
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'customer_address' => $this->customer_address,
            'products' => OrderProductResource::collection(
                $this->whenLoaded('products')
            ),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
